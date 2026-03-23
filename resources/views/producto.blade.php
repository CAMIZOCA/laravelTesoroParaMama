@extends('layouts.public')

@section('title', $product->name)
@section('seo_title', $product->name . ' — Un Tesoro Para Mamá')
@section('seo_description', $product->short_description ?? $product->name)

@section('content')

<section class="pt-24 pb-20 bg-cream-50">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Breadcrumb --}}
        <a href="{{ route('tienda') }}"
           class="inline-flex items-center gap-2 text-xs text-taupe-400 hover:text-taupe-700
                  mb-10 transition-colors group">
            <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a la tienda
        </a>

        {{-- Producto: 2 columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start"
             x-data="{
                selectedVariant: null,
                selectedPrice: {{ $product->hasVariants() ? 'null' : $product->price }},
                qty: 1,
                variants: {{ json_encode($product->variants ?? []) }},
                selectVariant(v) {
                    this.selectedVariant = v.name;
                    this.selectedPrice = v.price;
                }
             }">

            {{-- Imagen --}}
            <div class="relative">
                <div class="rounded-3xl overflow-hidden bg-gradient-to-br from-champagne-100 to-blush-50
                            aspect-square shadow-md ring-1 ring-cream-200">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                </div>
                {{-- Badge flotante --}}
                @if($product->badge)
                <div class="absolute top-4 left-4">
                    <span class="badge-popular">{{ $product->badge }}</span>
                </div>
                @endif
                @if($product->hasDiscount())
                <div class="absolute top-4 right-4">
                    <span class="badge-sale">-{{ $product->discount_percent }}%</span>
                </div>
                @endif
            </div>

            {{-- Info del producto --}}
            <div class="flex flex-col gap-6">

                {{-- Categoría + título --}}
                <div>
                    @if($product->category)
                        <p class="section-eyebrow mb-2">{{ $product->category->name }}</p>
                    @endif
                    <h1 class="font-serif text-3xl sm:text-4xl text-taupe-900 leading-tight mb-3">
                        {{ $product->name }}
                    </h1>
                    @if($product->short_description)
                        <p class="text-taupe-400 text-sm leading-relaxed">{{ $product->short_description }}</p>
                    @endif
                </div>

                {{-- Precio --}}
                <div class="flex items-baseline gap-3">
                    <span class="font-serif text-3xl text-taupe-900 font-semibold"
                          x-text="selectedPrice ? '$' + parseFloat(selectedPrice).toFixed(2) : 'Selecciona variante'">
                        @if($product->hasVariants())
                            Selecciona una variante
                        @else
                            ${{ number_format($product->price, 2) }}
                        @endif
                    </span>
                    @if($product->hasDiscount() && !$product->hasVariants())
                        <span class="text-base text-taupe-300 line-through">
                            ${{ number_format($product->original_price, 2) }}
                        </span>
                    @endif
                </div>

                {{-- Variantes --}}
                @if($product->hasVariants())
                <div>
                    <label class="form-label">Elige tu variante</label>
                    <div class="flex flex-wrap gap-3 mt-2">
                        @foreach($product->variants as $variant)
                        <button type="button"
                                @click="selectVariant({{ json_encode($variant) }})"
                                :class="selectedVariant === '{{ $variant['name'] }}'
                                    ? 'border-champagne-400 bg-champagne-100 text-taupe-900 shadow-sm'
                                    : 'border-cream-300 text-taupe-500 hover:border-champagne-300'"
                                class="px-4 py-2.5 rounded-xl border-2 text-sm font-medium transition-all duration-200">
                            {{ $variant['name'] }}
                            <span class="text-taupe-400 ml-1">· ${{ number_format($variant['price'], 2) }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Formulario carrito --}}
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_name"  x-bind:value="selectedVariant">
                    <input type="hidden" name="variant_price" x-bind:value="selectedPrice">

                    {{-- Cantidad --}}
                    <div class="flex items-center gap-4 mb-5">
                        <label class="text-sm font-medium text-taupe-700">Cantidad</label>
                        <div class="flex items-center border border-cream-300 rounded-xl overflow-hidden">
                            <button type="button" @click="qty = Math.max(1, qty - 1)"
                                    class="px-4 py-2.5 text-taupe-500 hover:bg-cream-100 transition-colors text-lg leading-none">
                                −
                            </button>
                            <input type="number" name="quantity" x-model="qty" min="1" max="10" readonly
                                   class="w-12 text-center border-0 text-sm font-semibold text-taupe-900
                                          bg-transparent focus:ring-0">
                            <button type="button" @click="qty = Math.min(10, qty + 1)"
                                    class="px-4 py-2.5 text-taupe-500 hover:bg-cream-100 transition-colors text-lg leading-none">
                                +
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                            :disabled="{{ $product->hasVariants() ? '!selectedVariant' : 'false' }}"
                            class="w-full inline-flex items-center justify-center gap-2.5
                                   bg-taupe-900 hover:bg-taupe-800 text-white font-semibold
                                   py-4 px-8 rounded-xl transition-all duration-200
                                   hover:shadow-lg disabled:opacity-40 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                        </svg>
                        Añadir a mi pedido
                    </button>
                </form>

                {{-- Trust micro-block --}}
                <div class="grid grid-cols-3 gap-3 py-4 border-y border-cream-200">
                    <div class="text-center">
                        <svg class="w-5 h-5 text-champagne-400 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <p class="text-xs text-taupe-400 leading-tight">Materiales<br>seguros</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-5 h-5 text-champagne-400 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-xs text-taupe-400 leading-tight">Guía paso<br>a paso</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-5 h-5 text-champagne-400 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <p class="text-xs text-taupe-400 leading-tight">Hecho<br>con amor</p>
                    </div>
                </div>

                {{-- Incluye --}}
                @if($product->includes && count($product->includes) > 0)
                <div class="bg-champagne-100/50 rounded-2xl p-5 border border-champagne-200">
                    <h3 class="section-eyebrow mb-3">¿Qué incluye?</h3>
                    <ul class="space-y-2">
                        @foreach($product->includes as $item)
                        <li class="flex items-start gap-2.5 text-sm text-taupe-600">
                            <svg class="w-3.5 h-3.5 text-champagne-500 mt-0.5 flex-shrink-0"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Link instrucciones --}}
                <a href="{{ route('instrucciones') }}" target="_blank"
                   class="inline-flex items-center gap-2 text-xs text-champagne-500
                          hover:text-champagne-400 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Ver instrucciones paso a paso →
                </a>
            </div>
        </div>

        {{-- Descripción completa --}}
        @if($product->description)
        <div class="mt-16 pt-12 border-t border-cream-200 max-w-2xl">
            <h2 class="font-serif text-2xl text-taupe-900 mb-5">Descripción</h2>
            <p class="text-taupe-500 leading-relaxed text-sm">{{ $product->description }}</p>
        </div>
        @endif

        {{-- Productos relacionados --}}
        @if($related->count() > 0)
        <div class="mt-16 pt-12 border-t border-cream-200">
            <h2 class="font-serif text-2xl text-taupe-900 mb-8">También te puede interesar</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($related as $rel)
                <a href="{{ route('producto.show', $rel->slug) }}" class="product-card-premium group">
                    <div class="product-card-image aspect-square block">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="product-card-body">
                        <p class="font-serif text-sm font-medium text-taupe-900 mb-1 group-hover:text-champagne-500 transition-colors">
                            {{ $rel->name }}
                        </p>
                        <p class="font-serif text-base text-taupe-700 font-semibold">
                            ${{ number_format($rel->price, 2) }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
