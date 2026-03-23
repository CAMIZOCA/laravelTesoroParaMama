@extends('layouts.public')

@section('title', '¡Pedido confirmado!')
@section('seo_title', 'Pedido confirmado — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-6 text-center">

        {{-- Success icon --}}
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-3">¡Tu joya está en camino!</h1>
        <p class="text-olive-600 mb-2">Hemos recibido tu pedido <strong class="text-olive-900">{{ $order->order_number }}</strong></p>
        <p class="text-olive-500 text-sm mb-8">Te enviamos un correo de confirmación a <strong>{{ $order->customer_email }}</strong></p>

        {{-- Order card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6 text-left mb-8">
            <h2 class="font-semibold text-olive-900 mb-4">Resumen de tu pedido</h2>

            <div class="space-y-3 mb-4">
                @foreach($order->items as $item)
                <div class="flex justify-between text-sm">
                    <div>
                        <p class="font-medium text-olive-800">{{ $item->product_name }}</p>
                        @if($item->variant_name)
                            <p class="text-xs text-gray-400">{{ $item->variant_name }}</p>
                        @endif
                        <p class="text-xs text-gray-400">× {{ $item->quantity }}</p>
                    </div>
                    <p class="font-medium text-olive-900">${{ number_format($item->subtotal, 2) }}</p>
                </div>
                @endforeach
            </div>

            <div class="border-t border-cream-100 pt-3 flex justify-between font-bold text-olive-900 mb-5">
                <span>Total pagado</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-olive-700 pt-4 border-t border-cream-100">
                <div>
                    <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Envío a</span>
                    {{ $order->customer_city }}, {{ $order->customer_country }}
                </div>
                <div>
                    <span class="text-xs text-gray-400 uppercase tracking-wide block mb-0.5">Dirección</span>
                    {{ $order->customer_address }}
                </div>
            </div>
        </div>

        {{-- What's next --}}
        <div class="bg-cream-100 rounded-2xl p-6 text-left mb-8">
            <h3 class="font-semibold text-olive-900 mb-4">¿Qué sigue?</h3>
            <div class="space-y-3">
                <div class="flex items-start gap-3 text-sm text-olive-700">
                    <div class="w-6 h-6 rounded-full bg-gold-200 text-gold-800 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                    <p>Recibirás un correo de confirmación con los detalles de tu pedido.</p>
                </div>
                <div class="flex items-start gap-3 text-sm text-olive-700">
                    <div class="w-6 h-6 rounded-full bg-gold-200 text-gold-800 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                    <p>Prepararemos y enviaremos tu kit en los próximos días hábiles.</p>
                </div>
                <div class="flex items-start gap-3 text-sm text-olive-700">
                    <div class="w-6 h-6 rounded-full bg-gold-200 text-gold-800 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                    <p>Recibirás el número de guía de envío por correo cuando tu paquete esté en camino.</p>
                </div>
                <div class="flex items-start gap-3 text-sm text-olive-700">
                    <div class="w-6 h-6 rounded-full bg-gold-200 text-gold-800 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</div>
                    <p>Sigue las instrucciones del kit para crear tu joya única de leche materna.</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('instrucciones') }}" target="_blank"
               class="btn-primary justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Ver instrucciones del kit
            </a>
            <a href="{{ route('tienda') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-cream-300 text-olive-700 hover:bg-cream-100 transition-colors text-sm font-medium justify-center">
                Volver a la tienda
            </a>
        </div>

    </div>
</section>
@endsection
