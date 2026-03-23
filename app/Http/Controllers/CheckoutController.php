<?php

namespace App\Http\Controllers;

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

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito');
        }

        $request->validate([
            'nombre'    => 'required|string|min:3|max:100',
            'email'     => 'required|email|max:150',
            'telefono'  => 'required|string|min:7|max:20',
            'pais'      => 'required|string|max:100',
            'ciudad'    => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'notas'     => 'nullable|string|max:500',
        ]);

        session(['checkout_data' => $request->only([
            'nombre', 'email', 'telefono', 'pais', 'ciudad', 'direccion', 'notas'
        ])]);

        return redirect()->route('pago.index');
    }
}
