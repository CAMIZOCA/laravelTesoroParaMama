@extends('layouts.public')

@section('title', 'Checkout')
@section('seo_title', 'Checkout — Un Tesoro Para Mamá')

@section('content')
<section class="pt-24 pb-16 bg-cream-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="font-serif text-3xl font-bold text-olive-900 mb-2">Finalizar compra</h1>
        <p class="text-olive-500 mb-8">Completa tus datos para continuar al pago.</p>

        <div
            x-data="{
                pais: '{{ old('pais', session('checkout_data.pais', 'Ecuador')) }}',
                ciudad: '{{ old('ciudad', session('checkout_data.ciudad', '')) }}',
                subtotal: {{ $subtotal }},
                discount: {{ $discount }},
                get isEcuador() { return this.pais === 'Ecuador'; },
                get isGalapagos() { return this.ciudad === 'Galápagos'; },
                get needsConsulta() { return !this.isEcuador || this.isGalapagos; },
                get shippingCost() { return this.ciudad === 'Quito' ? 0 : 5; },
                get total() {
                    if (this.needsConsulta) return this.subtotal - this.discount;
                    return Math.max(0, this.subtotal + this.shippingCost - this.discount);
                },
                get citySelected() { return this.ciudad !== ''; },
                formatMoney(v) { return '$' + v.toFixed(2); }
            }"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8"
        >

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

                            {{-- Country --}}
                            <div>
                                <label class="form-label" for="pais">País *</label>
                                <select id="pais" name="pais" class="form-input" x-model="pais" required>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="otro">Otro país</option>
                                </select>
                                @error('pais') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- City dropdown — Ecuador only --}}
                            <div x-show="isEcuador" x-cloak>
                                <label class="form-label" for="ciudad">Ciudad *</label>
                                <select id="ciudad" name="ciudad" class="form-input"
                                        x-model="ciudad"
                                        :required="isEcuador">
                                    <option value="">Selecciona tu ciudad…</option>
                                    <optgroup label="✓ Envío incluido">
                                        <option value="Quito">Quito</option>
                                    </optgroup>
                                    <optgroup label="Provincias — +$5.00">
                                        <option value="Ambato">Ambato</option>
                                        <option value="Azogues">Azogues</option>
                                        <option value="Babahoyo">Babahoyo</option>
                                        <option value="Cuenca">Cuenca</option>
                                        <option value="El Coca">El Coca (Puerto Francisco de Orellana)</option>
                                        <option value="Esmeraldas">Esmeraldas</option>
                                        <option value="Guaranda">Guaranda</option>
                                        <option value="Guayaquil">Guayaquil</option>
                                        <option value="Ibarra">Ibarra</option>
                                        <option value="Lago Agrio">Lago Agrio (Nueva Loja)</option>
                                        <option value="Latacunga">Latacunga</option>
                                        <option value="Loja">Loja</option>
                                        <option value="Machala">Machala</option>
                                        <option value="Manta">Manta</option>
                                        <option value="Portoviejo">Portoviejo</option>
                                        <option value="Puyo">Puyo</option>
                                        <option value="Quevedo">Quevedo</option>
                                        <option value="Riobamba">Riobamba</option>
                                        <option value="Salinas">Salinas</option>
                                        <option value="Santa Elena">Santa Elena</option>
                                        <option value="Santo Domingo">Santo Domingo</option>
                                        <option value="Tena">Tena</option>
                                        <option value="Tulcán">Tulcán</option>
                                        <option value="Zamora">Zamora</option>
                                    </optgroup>
                                    <optgroup label="Consultar por WhatsApp">
                                        <option value="Galápagos">Galápagos (Puerto Ayora / San Cristóbal)</option>
                                    </optgroup>
                                </select>
                                @error('ciudad') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2" x-show="isEcuador" x-cloak>
                                <label class="form-label" for="direccion">Dirección completa *</label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                       class="form-input" placeholder="Calle Principal 123, Barrio, Apartamento..." required>
                                @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2" x-show="isEcuador" x-cloak>
                                <label class="form-label" for="notas">Notas adicionales (opcional)</label>
                                <textarea id="notas" name="notas" rows="2" class="form-input"
                                          placeholder="Referencias de entrega, instrucciones especiales...">{{ old('notas') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- WhatsApp CTA — Otro país --}}
                    <div x-show="!isEcuador" x-cloak
                         class="bg-amber-50 border border-amber-200 rounded-2xl p-5 text-sm text-amber-800">
                        <p class="font-semibold mb-1">Envíos internacionales</p>
                        <p class="mb-3">Actualmente los envíos fuera del Ecuador se gestionan directamente con nosotros. Escríbenos por WhatsApp y con gusto te ayudamos a completar tu pedido.</p>
                        <a href="https://wa.me/593999999999?text=Hola,%20quiero%20hacer%20un%20pedido%20con%20envío%20internacional"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Escribir por WhatsApp
                        </a>
                    </div>

                    {{-- WhatsApp CTA — Galápagos --}}
                    <div x-show="isEcuador && isGalapagos" x-cloak
                         class="bg-amber-50 border border-amber-200 rounded-2xl p-5 text-sm text-amber-800">
                        <p class="font-semibold mb-1">Envío a Galápagos</p>
                        <p class="mb-3">Para envíos a Galápagos coordinamos el costo directamente contigo. Escríbenos por WhatsApp y te cotizamos.</p>
                        <a href="https://wa.me/593999999999?text=Hola,%20quiero%20consultar%20el%20envío%20a%20Galápagos"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Consultar por WhatsApp
                        </a>
                    </div>

                    {{-- Ambassador / discount code — only visible for Ecuador --}}
                    <div x-show="isEcuador" x-cloak class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6">
                        <h2 class="font-semibold text-olive-900 text-lg mb-4">Código de embajadora</h2>
                        <div>
                            <label class="form-label" for="ambassador_code">Código de descuento (opcional)</label>
                            <input type="text" id="ambassador_code" name="ambassador_code"
                                   value="{{ old('ambassador_code', $ambassadorCode ?? '') }}"
                                   class="form-input uppercase" placeholder="Ej: UNTESOROPARAMAMA"
                                   style="text-transform:uppercase">
                            @error('ambassador_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @if($ambassadorCode && !$errors->has('ambassador_code'))
                                <p class="text-green-600 text-xs mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Código aplicado: -${{ number_format($discount, 2) }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Submit: shown when Ecuador + valid city selected --}}
                    <button type="submit" class="btn-primary w-full justify-center"
                            x-show="!needsConsulta && citySelected" x-cloak>
                        Continuar al pago
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    {{-- Disabled: Ecuador selected but no city yet --}}
                    <button type="button" class="btn-primary w-full justify-center opacity-50 cursor-not-allowed"
                            x-show="isEcuador && !citySelected" x-cloak disabled>
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

                    <div class="border-t border-cream-100 pt-3 space-y-1.5">
                        <div class="flex justify-between text-sm text-olive-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-olive-600"
                             x-show="isEcuador && citySelected && !isGalapagos" x-cloak>
                            <span>Envío</span>
                            <span x-text="ciudad === 'Quito' ? 'Incluido' : formatMoney(shippingCost)"></span>
                        </div>
                        @if($discount > 0)
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Descuento ({{ $ambassadorCode }})</span>
                            <span>-${{ number_format($discount, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between font-bold text-olive-900 pt-1 border-t border-cream-100">
                            <span>Total</span>
                            <span x-text="formatMoney(total)"></span>
                        </div>
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
