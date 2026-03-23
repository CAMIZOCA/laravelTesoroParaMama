@extends('layouts.public')

@section('title', $product->name)
@section('seo_title', $product->name . ' — Un Tesoro Para Mamá')
@section('seo_description', $product->short_description ?? $product->name)

@section('content')

<section class="pt-24 pb-16 bg-cream-50">
    <div class="max-w-5xl mx-auto px-6">

        <a href="{{ route('tienda') }}"
           class="inline-flex items-center gap-2 text-sm text-olive-500 hover:text-olive-800 mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a la tienda
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start"
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

            {{-- Product Image --}}
            <div class="rounded-2xl overflow-hidden bg-cream-100 aspect-square">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>

            {{-- Product Info --}}
            <div>
                @if($product->badge)
                    <span class="inline-block bg-gold-100 text-gold-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">{{ $product->badge }}</span>
                @endif

                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-olive-900 mb-3">{{ $product->name }}</h1>

                @if($product->short_description)
                    <p class="text-olive-600 mb-5">{{ $product->short_description }}</p>
                @endif

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-6">
                    <span class="text-3xl font-bold text-olive-900" x-text="selectedPrice ? '$' + parseFloat(selectedPrice).toFixed(2) : 'Selecciona variante'">
                        @if($product->hasVariants())
                            Selecciona una variante
                        @else
                            ${{ number_format($product->price, 2) }}
                        @endif
                    </span>
                    @if($product->hasDiscount() && !$product->hasVariants())
                        <span class="text-lg text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                        <span class="bg-red-100 text-red-600 text-sm font-semibold px-2 py-0.5 rounded-full">-{{ $product->discount_percent }}%</span>
                    @endif
                </div>

                {{-- Variants --}}
                @if($product->hasVariants())
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-olive-800 mb-3">Variante</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->variants as $variant)
                        <button type="button"
                                @click="selectVariant({{ json_encode($variant) }})"
                                :class="selectedVariant === '{{ $variant['name'] }}' ? 'border-gold-500 bg-gold-50 text-olive-900' : 'border-cream-300 text-olive-600 hover:border-gold-300'"
                                class="px-4 py-2 rounded-full border-2 text-sm font-medium transition-all">
                            {{ $variant['name'] }} — ${{ number_format($variant['price'], 2) }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Add to cart --}}
                <form action="{{ route('carrito.add') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_name" x-bind:value="selectedVariant">
                    <input type="hidden" name="variant_price" x-bind:value="selectedPrice">

                    <div class="flex items-center gap-4 mb-4">
                        <label class="text-sm font-medium text-olive-800">Cantidad</label>
                        <div class="flex items-center border border-cream-300 rounded-xl">
                            <button type="button" @click="qty = Math.max(1, qty - 1)"
                                    class="px-3 py-2 text-olive-700 hover:bg-cream-100 rounded-l-xl transition-colors">−</button>
                            <input type="number" name="quantity" x-model="qty" min="1" max="10" readonly
                                   class="w-12 text-center border-0 text-sm font-medium text-olive-900 bg-transparent">
                            <button type="button" @click="qty = Math.min(10, qty + 1)"
                                    class="px-3 py-2 text-olive-700 hover:bg-cream-100 rounded-r-xl transition-colors">+</button>
                        </div>
                    </div>

                    <button type="submit"
                            :disabled="{{ $product->hasVariants() ? '!selectedVariant' : 'false' }}"
                            class="w-full btn-primary justify-center !rounded-xl disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                        </svg>
                        Añadir a mi pedido
                    </button>
                </form>

                {{-- Kit includes --}}
                @if($product->includes && count($product->includes) > 0)
                <div class="bg-cream-100 rounded-2xl p-5">
                    <h3 class="font-semibold text-olive-900 mb-3 text-sm uppercase tracking-wide">¿Qué incluye?</h3>
                    <ul class="space-y-2">
                        @foreach($product->includes as $item)
                        <li class="flex items-start gap-2 text-sm text-olive-700">
                            <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Instructions link --}}
                <a href="{{ route('instrucciones') }}" target="_blank"
                   class="mt-4 inline-flex items-center gap-2 text-sm text-gold-600 hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Ver instrucciones paso a paso
                </a>
            </div>
        </div>

        {{-- Description --}}
        @if($product->description)
        <div class="mt-12 max-w-2xl">
            <h2 class="font-serif text-2xl font-semibold text-olive-900 mb-4">Descripción</h2>
            <p class="text-olive-700 leading-relaxed">{{ $product->description }}</p>
        </div>
        @endif

        {{-- Related products --}}
        @if($related->count() > 0)
        <div class="mt-16">
            <h2 class="font-serif text-2xl font-semibold text-olive-900 mb-6">También te puede interesar</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('producto.show', $rel->slug) }}"
                   class="card-feature flex flex-col group hover:shadow-md transition-shadow">
                    <div class="aspect-square rounded-xl overflow-hidden bg-cream-100 mb-3">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="font-semibold text-olive-900 text-sm">{{ $rel->name }}</p>
                    <p class="text-gold-600 font-bold mt-1">${{ number_format($rel->price, 2) }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
