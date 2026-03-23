@extends('layouts.public')

@section('title', 'Checkout')
@section('seo_title', 'Checkout — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-2">Finalizar compra</h1>
        <p class="text-olive-500 mb-8">Completa tus datos para continuar al pago.</p>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Form --}}
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('checkout.store') }}" class="space-y-5">
                    @csrf

                    <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6 space-y-5">
                        <h2 class="font-semibold text-olive-900 text-lg">Datos de contacto</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="form-label" for="nombre">Nombre completo *</label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                       class="form-input" placeholder="María García" required>
                                @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label" for="email">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       class="form-input" placeholder="maria@email.com" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label" for="telefono">Teléfono *</label>
                                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                       class="form-input" placeholder="+593 99 999 9999" required>
                                @error('telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6 space-y-5">
                        <h2 class="font-semibold text-olive-900 text-lg">Dirección de envío</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="pais">País *</label>
                                <input type="text" id="pais" name="pais" value="{{ old('pais', 'Ecuador') }}"
                                       class="form-input" required>
                                @error('pais') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label" for="ciudad">Ciudad *</label>
                                <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                                       class="form-input" placeholder="Quito" required>
                                @error('ciudad') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="form-label" for="direccion">Dirección completa *</label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                       class="form-input" placeholder="Calle Principal 123, Barrio, Apartamento..." required>
                                @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="form-label" for="notas">Notas adicionales (opcional)</label>
                                <textarea id="notas" name="notas" rows="2" class="form-input"
                                          placeholder="Referencias de entrega, instrucciones especiales...">{{ old('notas') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">
                        Continuar al pago
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Order summary --}}
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-5 sticky top-24">
                    <h3 class="font-semibold text-olive-900 mb-4">Resumen</h3>
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

                    <div class="mt-4 pt-4 border-t border-cream-100 flex items-center gap-2 text-xs text-gray-400">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Pago 100% seguro con PayPhone. Tus datos no son almacenados.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
