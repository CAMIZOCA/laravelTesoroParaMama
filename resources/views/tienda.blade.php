@extends('layouts.public')

@section('title', 'Tienda — Un Tesoro Para Mamá')
@section('seo_title', 'Tienda — Un Tesoro Para Mamá')
@section('seo_description', 'Kits DIY de joyería de leche materna. Crea tu propia joya desde casa con todo incluido.')

@section('content')

{{-- Hero tienda --}}
<section class="pt-28 pb-14 bg-gradient-to-b from-blush-50 to-cream-50 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-30"
         style="background: radial-gradient(ellipse at 50% 0%, #F9E4C4 0%, transparent 60%)"></div>
    <div class="relative z-10 max-w-2xl mx-auto px-6">
        <div class="flex items-center gap-3 justify-center mb-4">
            <div class="h-px w-6 bg-champagne-400"></div>
            <span class="hero-eyebrow">Nuestra Tienda</span>
            <div class="h-px w-6 bg-champagne-400"></div>
        </div>
        <h1 class="font-serif text-4xl sm:text-5xl text-taupe-900 leading-tight mb-4">
            Elige tu <em class="italic text-champagne-500">joya perfecta</em>
        </h1>
        <p class="text-taupe-400 text-sm leading-relaxed max-w-sm mx-auto">
            Kits completos para crear tu joya de leche materna desde casa. Todo incluido.
        </p>
    </div>
</section>

{{-- Filtro de categorías --}}
@if($categories->count() > 1)
<section class="bg-white border-b border-cream-200 sticky top-0 z-30 shadow-sm">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex gap-2 overflow-x-auto py-3.5 scrollbar-hide">
            <a href="{{ route('tienda') }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-medium transition-all duration-200
                      {{ !request('categoria')
                           ? 'bg-taupe-800 text-white shadow-sm'
                           : 'text-taupe-500 hover:text-taupe-800 hover:bg-cream-100' }}">
                Todos
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('tienda', ['categoria' => $cat->slug]) }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-medium transition-all duration-200
                      {{ request('categoria') === $cat->slug
                           ? 'bg-taupe-800 text-white shadow-sm'
                           : 'text-taupe-500 hover:text-taupe-800 hover:bg-cream-100' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Grid de productos --}}
<section class="py-14 bg-cream-50">
    <div class="max-w-6xl mx-auto px-6">
        @if($products->isEmpty())
            <div class="text-center py-20">
                <svg class="w-12 h-12 text-taupe-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="text-taupe-400 font-serif text-lg">No hay productos en esta categoría.</p>
                <a href="{{ route('tienda') }}" class="btn-ghost mt-4 inline-flex">Ver todos los kits →</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                <div class="product-card-premium group">

                    {{-- Imagen --}}
                    <a href="{{ route('producto.show', $product->slug) }}" class="product-card-image block aspect-square">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        {{-- Badges --}}
                        @if($product->badge || $product->hasDiscount())
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            @if($product->badge)
                                <span class="badge-popular">{{ $product->badge }}</span>
                            @endif
                            @if($product->hasDiscount())
                                <span class="badge-sale">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                        @endif
                    </a>

                    {{-- Contenido --}}
                    <div class="product-card-body">
                        @if($product->category)
                            <p class="section-eyebrow mb-1.5">{{ $product->category->name }}</p>
                        @endif

                        <a href="{{ route('producto.show', $product->slug) }}"
                           class="font-serif text-lg text-taupe-900 hover:text-champagne-500
                                  transition-colors duration-200 block mb-2 leading-snug">
                            {{ $product->name }}
                        </a>

                        @if($product->short_description)
                            <p class="text-sm text-taupe-400 leading-relaxed mb-4 line-clamp-2 flex-1">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        {{-- Precio --}}
                        <div class="flex items-baseline gap-2 mb-4 mt-auto">
                            @if($product->hasVariants())
                                <span class="text-xs text-taupe-400">Desde</span>
                                <span class="font-serif text-xl text-taupe-900 font-semibold">
                                    ${{ number_format(collect($product->variants)->min('price'), 2) }}
                                </span>
                            @else
                                <span class="font-serif text-xl text-taupe-900 font-semibold">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->hasDiscount())
                                    <span class="text-xs text-taupe-300 line-through">
                                        ${{ number_format($product->original_price, 2) }}
                                    </span>
                                @endif
                            @endif
                        </div>

                        {{-- CTA --}}
                        <a href="{{ route('producto.show', $product->slug) }}"
                           class="w-full text-center inline-flex items-center justify-center gap-2
                                  bg-taupe-800 hover:bg-taupe-900 text-white text-sm font-medium
                                  py-3 px-5 rounded-xl transition-all duration-200 hover:shadow-md">
                            Ver producto
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
