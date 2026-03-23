@extends('layouts.public')

@section('title', 'Confirmar pedido')
@section('seo_title', 'Confirmar pedido — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-2">Confirma tu pedido</h1>
        <p class="text-olive-500 mb-8">Revisa tu pedido y procede al pago seguro con PayPhone.</p>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Payment action --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Customer summary --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6">
                    <h2 class="font-semibold text-olive-900 text-lg mb-4">Datos de envío</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-olive-700">
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Nombre</span>
                            {{ $customer['nombre'] }}
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Email</span>
                            {{ $customer['email'] }}
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Teléfono</span>
                            {{ $customer['telefono'] }}
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Ciudad</span>
                            {{ $customer['ciudad'] }}, {{ $customer['pais'] }}
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Dirección</span>
                            {{ $customer['direccion'] }}
                        </div>
                        @if(!empty($customer['notas']))
                        <div class="sm:col-span-2">
                            <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Notas</span>
                            {{ $customer['notas'] }}
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('checkout') }}" class="inline-flex items-center gap-1 text-xs text-olive-400 hover:text-olive-700 mt-4 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Editar datos
                    </a>
                </div>

                {{-- PayPhone payment --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6">
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-cream-100">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <p class="text-sm text-gray-500">Pago 100% seguro con <strong class="text-gray-700">PayPhone</strong>. Serás redirigido a la plataforma de pago.</p>
                    </div>

                    <p class="text-sm text-olive-600 mb-5">Al hacer clic en el botón, serás redirigido a PayPhone para completar tu pago con tarjeta de crédito o débito de forma segura.</p>

                    <form action="{{ route('pago.preparar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary w-full justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Pagar ${{ number_format($total, 2) }} con PayPhone
                        </button>
                    </form>

                    <div class="flex justify-center gap-6 mt-5 pt-4 border-t border-cream-100">
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            PCI DSS 4.0
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Encriptado SSL
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            3D Secure
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-5 sticky top-24">
                    <h3 class="font-semibold text-olive-900 mb-4">Tu pedido</h3>
                    <div class="space-y-3 mb-4">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="text-olive-800 font-medium">{{ $item['product_name'] }}</p>
                                @if($item['variant_name'])
                                    <p class="text-xs text-gray-400">{{ $item['variant_name'] }}</p>
                                @endif
                                <p class="text-xs text-gray-400">× {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-medium text-olive-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="border-t border-cream-100 pt-3 flex justify-between font-bold text-olive-900">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
