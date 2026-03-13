@extends('layouts.public')

@section('title', 'Un Tesoro Para Mamá')

@section('content')

{{-- ===== HERO ===== --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
    <!-- Background texture -->
    <div class="absolute inset-0 bg-gradient-to-br from-cream-100 via-cream-50 to-cream-200"></div>
    <div class="absolute inset-0 opacity-30"
         style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');"></div>

    <!-- Decorative circles -->
    <div class="absolute top-20 right-10 w-64 h-64 bg-gold-400/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-80 h-80 bg-olive-800/5 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 py-24">
        <span class="section-label block mb-4">{{ $c['hero_label'] }}</span>

        <h1 class="font-serif text-5xl sm:text-6xl md:text-7xl lg:text-8xl text-olive-900 leading-none mb-6">
            @php $heroLines = explode("\n", $c['hero_title']); @endphp
            @foreach($heroLines as $i => $line)
                @if($i === 0){{ $line }}<br>@else<em class="text-gold-500">{{ $line }}</em>@endif
            @endforeach
        </h1>

        <p class="text-olive-800/70 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed font-light">
            {{ $c['hero_subtitle'] }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ $whatsappUrl }}"
               target="_blank" rel="noopener noreferrer"
               class="btn-whatsapp text-base">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                {{ $c['hero_btn_text'] }}
            </a>
            <a href="#kit"
               class="inline-flex items-center gap-2 text-olive-800 hover:text-gold-500 font-medium text-base transition-colors">
                {{ $c['hero_link_text'] }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ===== HISTORIA ===== --}}
<section id="historia" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- Text -->
            <div>
                <span class="section-label block mb-3">{{ $c['historia_label'] }}</span>
                <h2 class="section-title mb-8">
                    {{ $c['historia_title_1'] }}<br>
                    <em>{{ $c['historia_title_2'] }}</em>
                </h2>

                <div class="space-y-5 text-olive-800/75 leading-relaxed">
                    @if($c['historia_p1'])<p>{{ $c['historia_p1'] }}</p>@endif
                    @if($c['historia_p2'])<p>{{ $c['historia_p2'] }}</p>@endif
                    @if($c['historia_p3'])<p>{{ $c['historia_p3'] }}</p>@endif
                </div>
            </div>

            <!-- Image & quote -->
            <div class="relative">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl">
                    @if($c['historia_image'])
                        <img src="{{ asset('storage/' . $c['historia_image']) }}"
                             alt="Madre con su bebé"
                             class="w-full h-full object-cover">
                    @else
                        <img src="https://picsum.photos/seed/motherhood/800/1000"
                             alt="Madre con su bebé"
                             class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Floating quote -->
                <div class="absolute -bottom-8 -left-8 bg-white rounded-2xl shadow-xl p-6 max-w-xs border-l-4 border-gold-400">
                    <svg class="w-8 h-8 text-gold-400 mb-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p class="font-serif text-olive-900 italic text-lg leading-snug">
                        "{{ $c['historia_quote'] }}"
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== BENEFICIOS DEL KIT ===== --}}
<section class="py-24 bg-cream-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="section-label block mb-3">{{ $c['kit_label'] }}</span>
            <h2 class="section-title mb-4">{{ $c['kit_title'] }}</h2>
            <p class="text-olive-800/70 max-w-2xl mx-auto leading-relaxed">
                {{ $c['kit_description'] }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $features = [
                    ['icon' => 'package', 'title' => $c['feature_1_title'], 'text' => $c['feature_1_text']],
                    ['icon' => 'heart',   'title' => $c['feature_2_title'], 'text' => $c['feature_2_text']],
                    ['icon' => 'shield',  'title' => $c['feature_3_title'], 'text' => $c['feature_3_text']],
                    ['icon' => 'star',    'title' => $c['feature_4_title'], 'text' => $c['feature_4_text']],
                ];
            @endphp

            @foreach($features as $feature)
                <div class="card-feature text-center">
                    <div class="w-14 h-14 bg-gold-400/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        @if($feature['icon'] === 'package')
                            <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        @elseif($feature['icon'] === 'heart')
                            <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @elseif($feature['icon'] === 'shield')
                            <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        @else
                            <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        @endif
                    </div>
                    <h3 class="font-serif text-xl text-olive-900 font-semibold mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-olive-800/65 text-sm leading-relaxed">{{ $feature['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PRODUCTOS ===== --}}
@if($featuredProducts->isNotEmpty())
<section id="productos" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="section-label block mb-3">Nuestros Kits</span>
            <h2 class="section-title mb-4">Elige el Kit Perfecto para Ti</h2>
            <p class="text-olive-800/70 max-w-xl mx-auto">
                Cada kit incluye todo lo necesario para crear tu joya de manera sencilla y segura desde casa.
            </p>
        </div>

        <!-- Category tabs (if categories exist) -->
        @if($categories->isNotEmpty())
        <div class="flex flex-wrap gap-3 justify-center mb-12" x-data="{ activeCategory: 'all' }">
            <button @click="activeCategory = 'all'"
                    :class="activeCategory === 'all' ? 'bg-olive-900 text-white' : 'bg-cream-100 text-olive-800 hover:bg-cream-200'"
                    class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200">
                Todos
            </button>
            @foreach($categories as $category)
                <button @click="activeCategory = '{{ $category->id }}'"
                        :class="activeCategory === '{{ $category->id }}' ? 'bg-olive-900 text-white' : 'bg-cream-100 text-olive-800 hover:bg-cream-200'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
        @endif

        <!-- Products grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-cream-200 group">

                <!-- Product image -->
                <div class="relative aspect-square overflow-hidden bg-cream-100">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    @if($product->badge)
                        <span class="absolute top-4 left-4 bg-gold-400 text-olive-900 text-xs font-bold px-3 py-1 rounded-full shadow">
                            {{ $product->badge }}
                        </span>
                    @endif

                    @if($product->hasDiscount())
                        <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                            -{{ $product->discount_percent }}%
                        </span>
                    @endif
                </div>

                <!-- Product info -->
                <div class="p-6">
                    @if($product->category)
                        <span class="text-xs text-gold-500 font-medium uppercase tracking-wide">{{ $product->category->name }}</span>
                    @endif
                    <h3 class="font-serif text-xl text-olive-900 font-semibold mt-1 mb-2">{{ $product->name }}</h3>

                    @if($product->short_description)
                        <p class="text-olive-800/65 text-sm leading-relaxed mb-4">{{ $product->short_description }}</p>
                    @endif

                    @if($product->includes && count($product->includes) > 0)
                        <ul class="space-y-1 mb-4">
                            @foreach(array_slice($product->includes, 0, 4) as $item)
                                <li class="flex items-center gap-2 text-xs text-olive-800/70">
                                    <svg class="w-3.5 h-3.5 text-gold-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                            @if(count($product->includes) > 4)
                                <li class="text-xs text-gold-500 pl-5">+{{ count($product->includes) - 4 }} elementos más...</li>
                            @endif
                        </ul>
                    @endif

                    <!-- Price & CTA -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-cream-100">
                        <div>
                            <span class="font-serif text-2xl text-olive-900 font-bold">${{ number_format($product->price, 2) }}</span>
                            @if($product->hasDiscount())
                                <span class="text-sm text-gray-400 line-through ml-2">${{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                        <a href="{{ $product->whatsapp_url }}"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-1.5 bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-4 py-2.5 rounded-full transition-all duration-300 hover:scale-105 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Comprar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== "TU JOYA" ===== --}}
<section id="kit" class="py-24 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- Image -->
            <div class="order-2 lg:order-1">
                <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
                    @if($c['tangible_image'])
                        <img src="{{ asset('storage/' . $c['tangible_image']) }}"
                             alt="{{ $c['tangible_title'] }}"
                             class="w-full h-full object-cover">
                    @else
                        <img src="https://picsum.photos/seed/giftbox/800/600"
                             alt="Kit Un Tesoro Para Mamá"
                             class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            <!-- Text -->
            <div class="order-1 lg:order-2">
                <span class="section-label block mb-3">{{ $c['tangible_label'] }}</span>
                <h2 class="section-title mb-6">{{ $c['tangible_title'] }}</h2>
                <div class="space-y-4 text-olive-800/75 leading-relaxed">
                    @if($c['tangible_p1'])<p>{{ $c['tangible_p1'] }}</p>@endif
                    @if($c['tangible_p2'])<p>{{ $c['tangible_p2'] }}</p>@endif
                </div>

                <div class="mt-10">
                    <a href="{{ $whatsappUrl }}"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-whatsapp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Comprar por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== GALERÍA ===== --}}
<section id="galeria" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="section-label block mb-3">{{ $c['galeria_label'] }}</span>
            <h2 class="section-title mb-4">{{ $c['galeria_title'] }}</h2>
            <p class="text-olive-800/70 max-w-xl mx-auto">
                {{ $c['galeria_description'] }}
            </p>
        </div>

        @if($galleryItems->isNotEmpty())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleryItems as $item)
            <div class="group relative aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->alt ?? $item->caption ?? 'Joya de leche materna' }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @if($item->caption)
                <div class="absolute inset-0 bg-olive-900/0 group-hover:bg-olive-900/50 transition-all duration-300 flex items-end p-4">
                    <p class="text-white font-serif italic text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                        {{ $item->caption }}
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        {{-- Placeholder gallery when no items --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $placeholders = [
                    ['seed' => 'necklace1', 'caption' => 'Un vínculo irrompible'],
                    ['seed' => 'necklace2', 'caption' => 'Llévalo siempre contigo'],
                    ['seed' => 'box',       'caption' => 'Todo lo que necesitas'],
                    ['seed' => 'sketch',    'caption' => 'Hecho a mano'],
                ];
            @endphp
            @foreach($placeholders as $p)
            <div class="group relative aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <img src="https://picsum.photos/seed/{{ $p['seed'] }}/600/600"
                     alt="{{ $p['caption'] }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-olive-900/0 group-hover:bg-olive-900/50 transition-all duration-300 flex items-end p-4">
                    <p class="text-white font-serif italic text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{ $p['caption'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ===== CTA FINAL ===== --}}
<section class="py-24 bg-olive-900 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-5"
         style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="section-label text-gold-400 block mb-4">{{ $c['cta_label'] }}</span>
        <h2 class="font-serif text-4xl sm:text-5xl text-cream-50 mb-6">
            {{ $c['cta_title'] }}
        </h2>
        <p class="text-cream-100 opacity-75 text-lg mb-10 leading-relaxed">
            {{ $c['cta_description'] }}
        </p>
        <a href="{{ $whatsappUrl }}"
           target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-3 bg-gold-400 hover:bg-gold-500 text-olive-900 font-bold px-10 py-5 rounded-full text-lg transition-all duration-300 hover:scale-105 shadow-xl hover:shadow-2xl">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            {{ $c['cta_btn_text'] }}
        </a>
    </div>
</section>

@endsection
