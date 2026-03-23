@extends('layouts.public')

@section('title', 'Tu carrito')
@section('seo_title', 'Carrito — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-6">

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-8">Tu carrito</h1>

        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-3 text-sm">
                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-cream-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                </svg>
                <h2 class="font-serif text-xl text-olive-700 mb-3">Tu carrito está vacío</h2>
                <p class="text-olive-500 mb-6">Explora nuestra tienda y encuentra el kit perfecto para ti.</p>
                <a href="{{ route('tienda') }}" class="btn-primary-sm">Ver la tienda</a>
            </div>
        @else
            {{-- Items --}}
            <div class="bg-white rounded-2xl shadow-sm border border-cream-200 mb-6 overflow-hidden">
                @foreach($cart as $cartKey => $item)
                <div class="flex items-center gap-4 p-5 {{ !$loop->last ? 'border-b border-cream-100' : '' }}">
                    {{-- Image --}}
                    <div class="w-20 h-20 bg-cream-100 rounded-xl overflow-hidden flex-shrink-0">
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['product_name'] }}"
                             class="w-full h-full object-cover">
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-olive-900">{{ $item['product_name'] }}</p>
                        @if($item['variant_name'])
                            <p class="text-xs text-olive-500">{{ $item['variant_name'] }}</p>
                        @endif
                        <p class="text-sm font-bold text-olive-900 mt-1">${{ number_format($item['price'], 2) }}</p>
                    </div>

                    {{-- Qty --}}
                    <form method="POST" action="{{ route('carrito.update', $cartKey) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center border border-cream-300 rounded-lg text-sm">
                            <button type="submit" name="quantity" value="{{ max(0, $item['quantity'] - 1) }}"
                                    class="px-2.5 py-1.5 hover:bg-cream-100 text-olive-700">−</button>
                            <span class="px-3 font-medium text-olive-900">{{ $item['quantity'] }}</span>
                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                    class="px-2.5 py-1.5 hover:bg-cream-100 text-olive-700">+</button>
                        </div>
                    </form>

                    {{-- Subtotal --}}
                    <div class="text-right w-20 flex-shrink-0">
                        <p class="font-bold text-olive-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>

                    {{-- Remove --}}
                    <form method="POST" action="{{ route('carrito.remove', $cartKey) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6">
                <div class="flex justify-between items-center mb-5">
                    <span class="font-semibold text-olive-900">Total</span>
                    <span class="text-2xl font-bold text-olive-900">${{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="btn-primary w-full justify-center block text-center">
                    Ir al checkout
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>

                <a href="{{ route('tienda') }}" class="block text-center text-sm text-olive-500 hover:text-olive-800 mt-3 transition-colors">
                    Seguir comprando
                </a>

                {{-- Trust badges --}}
                <div class="flex justify-center gap-6 mt-5 pt-5 border-t border-cream-100">
                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Pago seguro con PayPhone
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                        <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Encriptado SSL
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
