@extends('layouts.public')

@section('title', 'Tienda')
@section('seo_title', 'Tienda — Un Tesoro Para Mamá')
@section('seo_description', 'Kits DIY de joyería de leche materna. Crea tu propia joya desde casa.')

@section('content')

{{-- Hero --}}
<section class="pt-24 pb-10 bg-cream-100 text-center">
    <div class="max-w-2xl mx-auto px-6">
        <span class="section-label">Nuestra Tienda</span>
        <h1 class="section-title mt-2 mb-4">Elige tu kit perfecto</h1>
        <p class="text-olive-600 text-base">Kits completos para crear tu joya de leche materna desde casa.</p>
    </div>
</section>

{{-- Category filter --}}
@if($categories->count() > 1)
<section class="bg-white border-b border-cream-200 sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex gap-1 overflow-x-auto py-3 scrollbar-hide">
            <a href="{{ route('tienda') }}"
               class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors {{ !request('categoria') ? 'bg-olive-900 text-white' : 'text-olive-700 hover:bg-cream-100' }}">
                Todos
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('tienda', ['categoria' => $cat->slug]) }}"
               class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors {{ request('categoria') === $cat->slug ? 'bg-olive-900 text-white' : 'text-olive-700 hover:bg-cream-100' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Product Grid --}}
<section class="py-12 bg-cream-50">
    <div class="max-w-6xl mx-auto px-6">
        @if($products->isEmpty())
            <p class="text-center text-olive-500 py-16">No hay productos disponibles en esta categoría.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="card-feature flex flex-col group">
                    {{-- Image --}}
                    <a href="{{ route('producto.show', $product->slug) }}" class="block overflow-hidden rounded-xl mb-4 aspect-square bg-cream-100">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>

                    {{-- Badge --}}
                    @if($product->badge)
                        <span class="inline-block self-start bg-gold-100 text-gold-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">{{ $product->badge }}</span>
                    @endif

                    {{-- Info --}}
                    <a href="{{ route('producto.show', $product->slug) }}" class="font-serif text-lg font-semibold text-olive-900 hover:text-gold-600 transition-colors mb-1">
                        {{ $product->name }}
                    </a>
                    @if($product->short_description)
                        <p class="text-sm text-olive-600 mb-3 flex-1">{{ $product->short_description }}</p>
                    @endif

                    {{-- Price --}}
                    <div class="flex items-baseline gap-2 mb-4">
                        @if($product->hasVariants())
                            <span class="text-sm text-olive-500">Desde</span>
                            <span class="text-xl font-bold text-olive-900">
                                ${{ number_format(collect($product->variants)->min('price'), 2) }}
                            </span>
                        @else
                            <span class="text-xl font-bold text-olive-900">${{ number_format($product->price, 2) }}</span>
                            @if($product->hasDiscount())
                                <span class="text-sm text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                                <span class="text-xs font-semibold text-red-500">-{{ $product->discount_percent }}%</span>
                            @endif
                        @endif
                    </div>

                    {{-- CTA --}}
                    <a href="{{ route('producto.show', $product->slug) }}"
                       class="w-full text-center btn-primary-sm justify-center !rounded-xl !bg-olive-900 !text-white hover:!bg-olive-800">
                        Ver producto
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
