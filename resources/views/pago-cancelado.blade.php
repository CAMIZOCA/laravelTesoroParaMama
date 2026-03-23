@extends('layouts.public')

@section('title', 'Pago cancelado')
@section('seo_title', 'Pago cancelado — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-lg mx-auto px-6 text-center">

        {{-- Icon --}}
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-3">No pudimos procesar tu pago</h1>
        <p class="text-olive-600 mb-8">Tu tarjeta no fue cobrada. Puedes intentarlo de nuevo o contactarnos si necesitas ayuda.</p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 mb-8 text-sm text-red-700 text-left">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-cream-200 p-6 mb-8 text-left">
            <h3 class="font-semibold text-olive-900 mb-3">¿Qué puedes hacer?</h3>
            <ul class="space-y-2 text-sm text-olive-700">
                <li class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Verifica que los datos de tu tarjeta sean correctos.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Asegúrate de tener fondos suficientes o contacta a tu banco.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Tu carrito se ha conservado. Puedes intentar el pago nuevamente.
                </li>
            </ul>
        </div>

        <div class="flex justify-center">
            <a href="{{ route('checkout') }}" class="btn-primary justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Intentar de nuevo
            </a>
        </div>

    </div>
</section>
@endsection
