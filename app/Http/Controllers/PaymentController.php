<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaymentController extends Controller
{
    private string $baseUrl = 'https://pay.payphonetodoesposible.com/api/button';

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . config('services.payphone.token'),
            'Content-Type'  => 'application/json',
        ];
    }

    public function index(): View|RedirectResponse
    {
        $cart     = session('cart', []);
        $customer = session('checkout_data');

        if (empty($cart) || empty($customer)) {
            return redirect()->route('checkout');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('pago', compact('cart', 'customer', 'total'));
    }

    public function prepare(Request $request): RedirectResponse
    {
        $cart     = session('cart', []);
        $customer = session('checkout_data', []);

        if (empty($cart) || empty($customer)) {
            return redirect()->route('checkout');
        }

        $total       = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $amountCents = (int) round($total * 100);
        $clientTxId  = (string) Str::uuid();

        // Store in session for later verification
        session(['payphone_client_tx_id' => $clientTxId]);

        try {
            $response = Http::withHeaders($this->headers())
                ->post($this->baseUrl . '/Prepare', [
                    'amount'              => $amountCents,
                    'amountWithoutTax'    => $amountCents,
                    'amountWithTax'       => 0,
                    'tax'                 => 0,
                    'service'             => 0,
                    'tip'                 => 0,
                    'currency'            => 'USD',
                    'storeId'             => (int) config('services.payphone.store_id'),
                    'reference'           => 'Pedido - ' . ($customer['nombre'] ?? 'Cliente'),
                    'clientTransactionId' => $clientTxId,
                    'responseUrl'         => route('pago.respuesta'),
                    'cancellationUrl'     => route('pago.cancelado'),
                ]);

            if (!$response->successful()) {
                return redirect()->route('pago.index')
                    ->withErrors(['No se pudo iniciar el proceso de pago. Por favor intenta nuevamente.']);
            }

            $data = $response->json();

            if (empty($data['paymentUrl'])) {
                return redirect()->route('pago.index')
                    ->withErrors(['Respuesta inesperada del sistema de pago. Por favor intenta nuevamente.']);
            }

            return redirect()->away($data['paymentUrl']);

        } catch (\Exception $e) {
            return redirect()->route('pago.index')
                ->withErrors(['Error al conectar con el sistema de pago. Por favor intenta nuevamente.']);
        }
    }

    public function response(Request $request): View|RedirectResponse
    {
        $transactionId   = $request->query('transactionId');
        $clientTxId      = $request->query('clientTransactionId');
        $statusCode      = $request->query('statusCode');

        if (!$transactionId || !$clientTxId) {
            return redirect()->route('tienda');
        }

        // Idempotency: order may already exist
        $existing = Order::where('payphone_transaction_id', $transactionId)->first();
        if ($existing) {
            session()->forget(['cart', 'checkout_data', 'payphone_client_tx_id']);
            return view('pago-exitoso', ['order' => $existing]);
        }

        // Verify payment with PayPhone
        try {
            $confirm = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/V2/Confirm', [
                    'id'                  => $transactionId,
                    'clientTransactionId' => $clientTxId,
                ]);

            if (!$confirm->successful()) {
                return redirect()->route('pago.cancelado');
            }

            $result = $confirm->json();

            // transactionStatus: 3 = approved
            if (($result['transactionStatus'] ?? 0) !== 3) {
                return redirect()->route('pago.cancelado');
            }

        } catch (\Exception $e) {
            return redirect()->route('pago.cancelado');
        }

        $cart     = session('cart', []);
        $customer = session('checkout_data', []);

        if (empty($cart) || empty($customer)) {
            return redirect()->route('tienda');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'order_number'                 => Order::generateOrderNumber(),
            'customer_name'                => $customer['nombre'],
            'customer_email'               => $customer['email'],
            'customer_phone'               => $customer['telefono'],
            'customer_country'             => $customer['pais'],
            'customer_city'                => $customer['ciudad'],
            'customer_address'             => $customer['direccion'],
            'customer_notes'               => $customer['notas'] ?? null,
            'subtotal'                     => $subtotal,
            'total'                        => $subtotal,
            'payphone_transaction_id'      => $transactionId,
            'payphone_client_transaction_id' => $clientTxId,
            'status'                       => 'paid',
            'paid_at'                      => now(),
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item['product_id'],
                'product_name'  => $item['product_name'],
                'product_price' => $item['price'],
                'variant_name'  => $item['variant_name'] ?? null,
                'quantity'      => $item['quantity'],
                'subtotal'      => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget(['cart', 'checkout_data', 'payphone_client_tx_id']);

        $adminEmail = config('mail.admin_email', config('mail.from.address'));
        try {
            Mail::to($customer['email'])->queue(new OrderConfirmation($order));
            Mail::to($adminEmail)->queue(new NewOrderNotification($order));
        } catch (\Exception $e) {
            // Mail failure must not block success page
        }

        return view('pago-exitoso', compact('order'));
    }

    public function cancelled(): View
    {
        return view('pago-cancelado');
    }
}
