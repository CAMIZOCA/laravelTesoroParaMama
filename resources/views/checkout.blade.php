@extends('layouts.public')

@section('title', 'Finalizar Compra — Un Tesoro Para Mamá')
@section('seo_title', 'Checkout — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-white min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="font-serif text-3xl font-bold text-taupe-900 mb-2">Finalizar compra</h1>
        <p class="text-taupe-400 mb-10">Completa tus datos para continuar al pago.</p>

        <div x-data="checkoutApp()" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── Formulario ── --}}
            <div class="lg:col-span-2 space-y-5">
                <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm" class="space-y-5">
                    @csrf

                    {{-- Datos personales --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-cream-300 p-6 space-y-5">
                        <h2 class="font-serif font-semibold text-taupe-900 text-lg">Datos de contacto</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="nombre">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                       class="form-input" placeholder="María" required>
                                @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label" for="apellido">Apellido *</label>
                                <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}"
                                       class="form-input" placeholder="García" required>
                                @error('apellido') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                            <div class="sm:col-span-2">
                                <label class="form-label" for="whatsapp">WhatsApp (opcional)</label>
                                <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                                       class="form-input" placeholder="+593 99 999 9999">
                                <p class="text-xs text-taupe-400 mt-1">Para enviarte seguimiento de tu pedido por WhatsApp.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Dirección --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-cream-300 p-6 space-y-5">
                        <h2 class="font-serif font-semibold text-taupe-900 text-lg">Dirección de envío</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="pais">País *</label>
                                <input type="text" id="pais" name="pais" value="{{ old('pais', 'Ecuador') }}"
                                       class="form-input" x-model="country" @change="fetchShipping" required>
                                @error('pais') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label" for="ciudad">Ciudad *</label>
                                <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                                       class="form-input" placeholder="Quito"
                                       x-model="city" @change="fetchShipping" required>
                                @error('ciudad') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label" for="direccion">Dirección completa *</label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                       class="form-input" placeholder="Calle Principal 123, Barrio..." required>
                                @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label" for="notas">Notas adicionales (opcional)</label>
                                <textarea id="notas" name="notas" rows="2" class="form-input"
                                          placeholder="Referencias de entrega, instrucciones especiales...">{{ old('notas') }}</textarea>
                            </div>
                        </div>

                        {{-- Info de envío dinámica --}}
                        <div x-show="shippingInfo" x-cloak
                             class="flex items-start gap-3 bg-cream-100 rounded-xl px-4 py-3 text-sm">
                            <svg class="w-4 h-4 text-champagne-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <p class="text-taupe-600" x-text="shippingInfo"></p>
                        </div>
                    </div>

                    {{-- Código de embajadora --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-cream-300 p-6">
                        <h2 class="font-serif font-semibold text-taupe-900 text-lg mb-4">Código de descuento</h2>
                        <div class="flex gap-3">
                            <input type="text" name="ambassador_code" id="ambassador_code"
                                   x-model="ambassadorCode"
                                   class="form-input uppercase flex-1"
                                   style="text-transform:uppercase"
                                   placeholder="MASLACTANCIA"
                                   value="{{ old('ambassador_code') }}">
                            <button type="button" @click="validateCode"
                                    class="admin-btn-primary px-5 rounded-lg whitespace-nowrap">
                                Verificar
                            </button>
                        </div>
                        <div x-show="codeMessage" x-cloak class="mt-3 flex items-center gap-2 text-sm"
                             :class="codeValid ? 'text-green-600' : 'text-red-500'">
                            <svg x-show="codeValid" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <svg x-show="!codeValid" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span x-text="codeMessage"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center text-base">
                        Continuar al pago
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- ── Resumen de pedido ── --}}
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-cream-300 p-5 sticky top-24">
                    <h3 class="font-serif font-semibold text-taupe-900 mb-4">Resumen del pedido</h3>

                    <div class="space-y-3 mb-4">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="text-taupe-800 font-medium">{{ $item['product_name'] }}</p>
                                @if($item['variant_name'])
                                    <p class="text-xs text-taupe-400">{{ $item['variant_name'] }}</p>
                                @endif
                                <p class="text-xs text-taupe-400">× {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-medium text-taupe-900">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-cream-200 pt-3 space-y-2">
                        <div class="flex justify-between text-sm text-taupe-500">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="flex justify-between text-sm text-taupe-500" x-show="shippingLabel" x-cloak>
                            <span>Envío</span>
                            <span x-text="shippingLabel"></span>
                        </div>

                        <div class="flex justify-between text-sm text-green-600" x-show="discountLabel" x-cloak>
                            <span>Descuento</span>
                            <span x-text="'- ' + discountLabel"></span>
                        </div>

                        <div class="flex justify-between font-bold text-taupe-900 pt-2 border-t border-cream-200">
                            <span>Total</span>
                            <span x-text="formattedTotal">${{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-cream-200 flex items-center gap-2 text-xs text-taupe-400">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Pago 100% seguro con PayPhone.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function checkoutApp() {
    return {
        subtotal:      {{ $subtotal }},
        city:          '{{ old('ciudad', '') }}',
        country:       '{{ old('pais', 'Ecuador') }}',
        ambassadorCode:'{{ old('ambassador_code', '') }}',
        shippingAmount: 0,
        shippingLabel:  '',
        shippingInfo:   '',
        discountAmount: 0,
        discountLabel:  '',
        codeMessage:    '',
        codeValid:      false,

        get total() {
            return Math.max(0, this.subtotal - this.discountAmount + this.shippingAmount);
        },

        get formattedTotal() {
            return '$' + this.total.toFixed(2);
        },

        async fetchShipping() {
            if (!this.city) return;
            try {
                const resp = await fetch(`{{ route('checkout.shippingCost') }}?city=${encodeURIComponent(this.city)}&country=${encodeURIComponent(this.country)}`);
                const data = await resp.json();
                this.shippingAmount = data.amount ?? 0;
                this.shippingLabel  = data.label  ?? '';
                this.shippingInfo   = data.message ?? '';
            } catch {
                this.shippingAmount = 0;
                this.shippingLabel  = '';
            }
        },

        async validateCode() {
            const code = this.ambassadorCode.toUpperCase().trim();
            if (!code) return;
            try {
                const resp = await fetch('{{ route('checkout.validateCode') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ code }),
                });
                const data = await resp.json();
                this.codeValid   = data.valid;
                this.codeMessage = data.message;
                if (data.valid) {
                    if (data.discount_type === 'percent') {
                        this.discountAmount = parseFloat((this.subtotal * data.discount_value / 100).toFixed(2));
                    } else {
                        this.discountAmount = Math.min(data.discount_value, this.subtotal);
                    }
                    this.discountLabel = '$' + this.discountAmount.toFixed(2);
                } else {
                    this.discountAmount = 0;
                    this.discountLabel  = '';
                }
            } catch {
                this.codeMessage = 'Error al verificar el código.';
                this.codeValid   = false;
            }
        },

        init() {
            if (this.city) this.fetchShipping();
        }
    };
}
</script>
@endpush
@endsection
