<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private const CITIES_FREE = ['Quito'];
    private const CITIES_PAID = [
        'Ambato', 'Azogues', 'Babahoyo', 'Cuenca', 'El Coca', 'Esmeraldas',
        'Guaranda', 'Guayaquil', 'Ibarra', 'Lago Agrio', 'Latacunga', 'Loja',
        'Machala', 'Manta', 'Portoviejo', 'Puyo', 'Quevedo', 'Riobamba',
        'Salinas', 'Santa Elena', 'Santo Domingo', 'Tena', 'Tulcán', 'Zamora',
    ];

    public function index(): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito')
                ->withErrors(['Tu carrito está vacío.']);
        }

        $subtotal     = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount     = (float) session('ambassador_discount', 0);
        $shippingCost = (float) (session('checkout_data.shipping_cost') ?? 0);
        $total        = max(0, $subtotal + $shippingCost - $discount);

        $ambassadorCode = session('ambassador_code');

        return view('checkout', compact('cart', 'subtotal', 'discount', 'shippingCost', 'total', 'ambassadorCode'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito');
        }

        $validCities = implode(',', array_merge(self::CITIES_FREE, self::CITIES_PAID));

        $request->validate([
            'nombre'          => 'required|string|min:3|max:100',
            'email'           => 'required|email|max:150',
            'telefono'        => 'required|string|min:7|max:20',
            'pais'            => 'required|in:Ecuador',
            'ciudad'          => 'required|in:' . $validCities,
            'direccion'       => 'required|string|max:255',
            'notas'           => 'nullable|string|max:500',
            'ambassador_code' => 'nullable|string|max:50',
        ], [
            'pais.in'   => 'Para envíos internacionales, escríbenos por WhatsApp para gestionar tu compra.',
            'ciudad.in' => 'Selecciona una ciudad válida del listado.',
        ]);

        // Validate ambassador code if provided
        $rawCode = trim($request->input('ambassador_code', ''));
        if ($rawCode !== '') {
            $ambassador = Ambassador::active()
                ->where('code', strtoupper($rawCode))
                ->first();

            if (!$ambassador) {
                return back()
                    ->withInput()
                    ->withErrors(['ambassador_code' => 'Código de embajadora no válido o inactivo.']);
            }

            $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            session([
                'ambassador_code'     => $ambassador->code,
                'ambassador_id'       => $ambassador->id,
                'ambassador_discount' => $ambassador->calculateDiscount($subtotal),
            ]);
        } else {
            session()->forget(['ambassador_code', 'ambassador_id', 'ambassador_discount']);
        }

        $ciudad       = $request->input('ciudad');
        $shippingCost = $this->shippingCost($ciudad);

        session(['checkout_data' => [
            'nombre'        => $request->nombre,
            'email'         => $request->email,
            'telefono'      => $request->telefono,
            'pais'          => $request->pais,
            'ciudad'        => $ciudad,
            'direccion'     => $request->direccion,
            'notas'         => $request->notas,
            'shipping_cost' => $shippingCost,
        ]]);

        return redirect()->route('pago.index');
    }

    private function shippingCost(string $ciudad): float
    {
        return in_array($ciudad, self::CITIES_FREE) ? 0.00 : 5.00;
    }
}
