<?php

namespace App\Http\Controllers;

use App\Services\AmbassadorDiscountService;
use App\Services\ShippingCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito')->withErrors(['Tu carrito está vacío.']);
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout', compact('cart', 'subtotal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito');
        }

        $request->validate([
            'nombre'           => 'required|string|min:2|max:100',
            'apellido'         => 'required|string|min:2|max:100',
            'email'            => 'required|email|max:150',
            'telefono'         => 'required|string|min:7|max:25',
            'whatsapp'         => 'nullable|string|min:7|max:25',
            'pais'             => 'required|string|max:100',
            'ciudad'           => 'required|string|max:100',
            'direccion'        => 'required|string|max:255',
            'notas'            => 'nullable|string|max:500',
            'ambassador_code'  => 'nullable|string|max:50',
        ]);

        $subtotal        = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $ambassadorCode  = strtoupper(trim($request->input('ambassador_code', '')));
        $ambassadorData  = null;
        $discount        = 0.0;

        if ($ambassadorCode) {
            $discountService = new AmbassadorDiscountService();
            $result = $discountService->validate($ambassadorCode);
            if ($result['valid']) {
                $ambassadorData = $result;
                $discount       = $discountService->calculateDiscount($ambassadorCode, $subtotal);
            }
        }

        $shipping = (new ShippingCalculator())->calculate(
            $request->input('ciudad'),
            $request->input('pais')
        );
        $shippingCost = $shipping['amount'] ?? 0.0;

        session(['checkout_data' => [
            'nombre'          => $request->input('nombre'),
            'apellido'        => $request->input('apellido'),
            'email'           => $request->input('email'),
            'telefono'        => $request->input('telefono'),
            'whatsapp'        => $request->input('whatsapp'),
            'pais'            => $request->input('pais'),
            'ciudad'          => $request->input('ciudad'),
            'direccion'       => $request->input('direccion'),
            'notas'           => $request->input('notas'),
            'ambassador_code' => $ambassadorCode ?: null,
            'ambassador_id'   => $ambassadorData['ambassador_id'] ?? null,
            'discount'        => $discount,
            'shipping_cost'   => $shippingCost,
        ]]);

        return redirect()->route('pago.index');
    }

    public function validateCode(Request $request): JsonResponse
    {
        $code    = strtoupper(trim($request->input('code', '')));
        $service = new AmbassadorDiscountService();
        return response()->json($service->validate($code));
    }

    public function shippingCost(Request $request): JsonResponse
    {
        $city    = $request->input('city', '');
        $country = $request->input('country', 'Ecuador');
        $result  = (new ShippingCalculator())->calculate($city, $country);
        return response()->json($result);
    }
}
