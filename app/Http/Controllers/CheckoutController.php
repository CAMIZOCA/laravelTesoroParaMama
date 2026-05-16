<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito')
                ->withErrors(['Tu carrito está vacío.']);
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = (float) session('ambassador_discount', 0);
        $total    = max(0, $subtotal - $discount);

        $ambassadorCode = session('ambassador_code');

        return view('checkout', compact('cart', 'subtotal', 'discount', 'total', 'ambassadorCode'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito');
        }

        $request->validate([
            'nombre'          => 'required|string|min:3|max:100',
            'email'           => 'required|email|max:150',
            'telefono'        => 'required|string|min:7|max:20',
            'pais'            => 'required|string|max:100',
            'ciudad'          => 'required|string|max:100',
            'direccion'       => 'required|string|max:255',
            'notas'           => 'nullable|string|max:500',
            'ambassador_code' => 'nullable|string|max:50',
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

        session(['checkout_data' => $request->only([
            'nombre', 'email', 'telefono', 'pais', 'ciudad', 'direccion', 'notas'
        ])]);

        return redirect()->route('pago.index');
    }
}
