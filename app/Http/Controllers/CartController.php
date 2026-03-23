<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('carrito', compact('cart', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1|max:10',
            'variant_name' => 'nullable|string|max:100',
            'variant_price' => 'nullable|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {
            return back()->withErrors(['Este producto no está disponible.']);
        }

        $price = $request->filled('variant_price') ? (float)$request->variant_price : (float)$product->price;
        $variantName = $request->variant_name ?? null;

        $cartKey = $product->id . ($variantName ? '_' . md5($variantName) : '');

        $cart = session('cart', []);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += (int)$request->quantity;
        } else {
            $cart[$cartKey] = [
                'product_id'   => $product->id,
                'product_name' => $product->name,
                'variant_name' => $variantName,
                'price'        => $price,
                'image_url'    => $product->image_url,
                'quantity'     => (int)$request->quantity,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('carrito')
            ->with('success', '¡' . $product->name . ' añadido a tu pedido!');
    }

    public function update(Request $request, string $cartKey): RedirectResponse
    {
        $request->validate(['quantity' => 'required|integer|min:0|max:10']);

        $cart = session('cart', []);

        if ($request->quantity <= 0) {
            unset($cart[$cartKey]);
        } elseif (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = (int)$request->quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('carrito');
    }

    public function remove(string $cartKey): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$cartKey]);
        session(['cart' => $cart]);

        return redirect()->route('carrito');
    }

    public function count(): JsonResponse
    {
        $cart = session('cart', []);
        $count = collect($cart)->sum('quantity');
        return response()->json(['count' => $count]);
    }
}
