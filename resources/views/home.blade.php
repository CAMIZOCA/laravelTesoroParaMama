@extends('layouts.public')

@section('title', 'Un Tesoro Para Mamá — Joyería de Leche Materna')
@section('description', 'Transforma tu lactancia en una joya artesanal única. Kit DIY completo con todo lo que necesitas para crear tu propio dije de leche materna.')

@section('content')

@php
    $mediaUrl = function (?string $path): string {
        $path = trim((string) $path);
        if ($path === '') return '';
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        return asset('storage/' . ltrim($path, '/'));
    };

    $waNumber  = $c['whatsapp_number'] ?? '';
    $waMessage = urlencode('Hola, quiero más información sobre el kit de Un Tesoro Para Mamá.');
    $waUrl     = $waNumber ? 'https://wa.me/' . preg_replace('/\D/', '', $waNumber) . '?text=' . $waMessage : '#';
@endphp

{{-- ═══════════════════════════════════════════════════════════════
     1. HERO PRINCIPAL
═══════════════════════════════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-white">

    {{-- Fondo sutil --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-champagne-100/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-gradient-to-t from-blush-50/40 to-transparent"></div>
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 lg:py-36">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Texto hero --}}
            <div class="order-2 lg:order-1 text-center lg:text-left">

                <div class="flex items-center gap-3 justify-center lg:justify-start mb-6">
                    <div class="h-px w-8 bg-champagne-500"></div>
                    <span class="hero-eyebrow">{{ $c['hero_label'] }}</span>
                    <div class="h-px w-8 bg-champagne-500"></div>
                </div>

                <h1 class="hero-display mb-6">
                    @foreach(explode("\n", $c['hero_title']) as $i => $line)
                        @if($i === 1)
                            <em class="font-serif italic text-champagne-500 block">{{ $line }}</em>
                        @else
                            <span class="block">{{ $line }}</span>
                        @endif
                    @endforeach
                </h1>

                <div class="ornament max-w-[200px] mx-auto lg:mx-0 mb-6">
                    <span class="text-champagne-300 text-lg">✦</span>
                </div>

                <p class="text-taupe-500 text-lg leading-relaxed mb-10 max-w-lg mx-auto lg:mx-0">
                    {{ $c['hero_subtitle'] }}
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ route('tienda') }}" class="btn-primary text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                        </svg>
                        {{ $c['hero_btn_text'] }}
                    </a>
                    @if($waNumber)
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-whatsapp text-base">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Consultar por WhatsApp
                    </a>
                    @else
                    <a href="#proceso" class="btn-outline">
                        Ver cómo funciona
                    </a>
                    @endif
                </div>

                <p class="text-xs text-taupe-400 mt-6 flex items-center gap-2 justify-center lg:justify-start">
                    <svg class="w-3.5 h-3.5 text-champagne-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Kit completo · Instrucciones incluidas · Sin experiencia necesaria
                </p>
            </div>

            {{-- Imagen hero --}}
            <div class="order-1 lg:order-2 relative">
                <div class="relative mx-auto max-w-md lg:max-w-full">
                    <div class="absolute -top-4 -right-4 w-full h-full border border-champagne-300/40 rounded-3xl"></div>
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/5] shadow-2xl bg-cream-100">
                        @if($c['historia_image'])
                            <img src="{{ $mediaUrl($c['historia_image']) }}"
                                 alt="Joya de leche materna"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-champagne-100 to-blush-100
                                        flex items-center justify-center">
                                <div class="text-center text-taupe-300 p-8">
                                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm font-serif italic">Tu foto aquí</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg px-5 py-3 border border-cream-300">
                        <p class="text-xs text-taupe-400 mb-0.5">Kit incluye</p>
                        <p class="font-serif text-sm text-taupe-800 font-medium">Todo lo necesario ✦</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 animate-bounce">
        <div class="w-px h-8 bg-gradient-to-b from-champagne-400/50 to-transparent"></div>
        <svg class="w-4 h-4 text-champagne-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     2. SECCIÓN EMOCIONAL
═══════════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-taupe-900 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: repeating-linear-gradient(45deg, #fff 0, #fff 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6">
        <div class="ornament max-w-[80px] mx-auto mb-8 opacity-20">
            <span class="text-champagne-400 text-xs">✦</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-white mb-6 leading-tight">
            {{ $c['emotional_title'] ?? 'Tu leche es única, tu historia también.' }}
        </h2>
        <p class="text-taupe-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
            {{ $c['emotional_text'] ?? 'Cada gota representa una etapa irrepetible: noches, abrazos, esfuerzo, amor y conexión. Por eso cada joya es diferente, porque nace de tu propia historia.' }}
        </p>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     3. PRODUCTOS DESTACADOS
═══════════════════════════════════════════════════════════════ --}}
@if($featuredProducts->count())
<section id="productos" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="section-label block mb-3">Nuestra colección</span>
            <h2 class="section-title mb-4">Elige tu joya perfecta</h2>
            <p class="text-taupe-400 max-w-md mx-auto text-sm leading-relaxed">
                Por ahora puedes elegir el color y la forma de tu dije. La cadena y el kit vienen incluidos.
            </p>
        </div>

        <div x-data="{ activeCategory: 'all' }">

            {{-- Filtros --}}
            @if($categories->count() > 1)
            <div class="flex flex-wrap gap-2 justify-center mb-10">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-taupe-900 text-white' : 'bg-white text-taupe-500 hover:text-taupe-800 border border-cream-300'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200">
                    Todos
                </button>
                @foreach($categories as $cat)
                <button @click="activeCategory = '{{ $cat->slug ?? $cat->name }}'"
                        :class="activeCategory === '{{ $cat->slug ?? $cat->name }}' ? 'bg-taupe-900 text-white' : 'bg-white text-taupe-500 hover:text-taupe-800 border border-cream-300'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug ?? $product->category->name ?? '' }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="product-card-premium group">

                    <a href="{{ route('producto.show', $product->slug) }}" class="product-card-image block aspect-square">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            @if($product->badge)
                                <span class="badge-popular">{{ $product->badge }}</span>
                            @endif
                        </div>
                    </a>

                    <div class="product-card-body">
                        @if($product->material ?? null)
                            <p class="section-eyebrow mb-1">
                                {{ $product->material === 'gold' ? 'Dorado' : 'Plateado' }}
                                @if($product->shape ?? null)
                                    · {{ $product->shape === 'heart' ? 'Corazón' : 'Gota' }}
                                @endif
                            </p>
                        @elseif($product->category)
                            <p class="section-eyebrow mb-1">{{ $product->category->name }}</p>
                        @endif

                        <a href="{{ route('producto.show', $product->slug) }}"
                           class="font-serif text-lg text-taupe-900 hover:text-champagne-500
                                  transition-colors duration-200 block mb-2 leading-snug">
                            {{ $product->name }}
                        </a>

                        @if($product->short_description)
                            <p class="text-sm text-taupe-400 mb-3 leading-relaxed line-clamp-2">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-cream-200">
                            <div>
                                <span class="font-serif text-xl text-taupe-900 font-semibold">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->hasDiscount())
                                    <span class="text-xs text-taupe-300 line-through ml-2">
                                        ${{ number_format($product->original_price, 2) }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('producto.show', $product->slug) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-medium text-champagne-500
                                      hover:text-champagne-600 transition-colors duration-200 group/link">
                                Ver kit
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/link:translate-x-0.5"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('tienda') }}" class="btn-outline">
                Ver toda la colección
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════════════════════
     4. CÓMO FUNCIONA (3 pasos)
═══════════════════════════════════════════════════════════════ --}}
<section id="proceso" class="py-24 bg-cream-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <span class="section-label block mb-3">Cómo funciona</span>
            <h2 class="section-title mb-4">Tan simple como amar</h2>
            <p class="text-taupe-400 max-w-md mx-auto text-sm leading-relaxed">
                En 3 pasos sencillos transformarás tu leche materna en una joya para siempre.
            </p>
        </div>

        @php
            $howSteps = [
                [
                    'num'  => '01',
                    'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z',
                    'title' => $c['how_step_1_title'] ?? 'Recibe tu kit',
                    'text'  => $c['how_step_1_text']  ?? 'Te enviamos todo lo necesario para preparar tu muestra desde casa.',
                ],
                [
                    'num'  => '02',
                    'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                    'title' => $c['how_step_2_title'] ?? 'Mezcla tu leche',
                    'text'  => $c['how_step_2_text']  ?? 'Sigue instrucciones simples para conservar este recuerdo de forma segura.',
                ],
                [
                    'num'  => '03',
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'title' => $c['how_step_3_title'] ?? 'Crea tu joya',
                    'text'  => $c['how_step_3_text']  ?? 'Tu muestra se transforma en una joya única, hecha con amor.',
                ],
            ];
        @endphp

        {{-- Desktop horizontal --}}
        <div class="hidden lg:flex items-start gap-0 mb-12">
            @foreach($howSteps as $i => $step)
            <div class="flex-1 flex flex-col items-center text-center relative px-6">
                @if(!$loop->last)
                <div class="absolute top-6 left-1/2 right-0 h-px bg-taupe-200 z-0"></div>
                @endif
                <div class="process-step-number relative z-10 mb-5">{{ $step['num'] }}</div>
                <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-champagne-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-serif text-lg text-taupe-800 font-semibold mb-2">{{ $step['title'] }}</h3>
                <p class="text-sm text-taupe-400 leading-relaxed">{{ $step['text'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Mobile vertical --}}
        <div class="lg:hidden space-y-8">
            @foreach($howSteps as $step)
            <div class="flex gap-5 items-start">
                <div class="process-step-number flex-shrink-0">{{ $step['num'] }}</div>
                <div class="pt-2">
                    <h3 class="font-serif text-base text-taupe-800 font-semibold mb-1">{{ $step['title'] }}</h3>
                    <p class="text-sm text-taupe-400 leading-relaxed">{{ $step['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('tienda') }}" class="btn-primary">
                Comenzar ahora
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     5. BENEFICIOS (4 cards)
═══════════════════════════════════════════════════════════════ --}}
<section id="beneficios" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="section-label block mb-3">{{ $c['kit_label'] }}</span>
            <h2 class="section-title mb-4">{{ $c['kit_title'] }}</h2>
        </div>

        @php
            $benefits = [
                [
                    'title' => $c['feature_1_title'],
                    'text'  => $c['feature_1_text'],
                    'icon'  => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                ],
                [
                    'title' => $c['feature_2_title'],
                    'text'  => $c['feature_2_text'],
                    'icon'  => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                ],
                [
                    'title' => $c['feature_3_title'],
                    'text'  => $c['feature_3_text'],
                    'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                ],
                [
                    'title' => $c['feature_4_title'],
                    'text'  => $c['feature_4_text'],
                    'icon'  => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($benefits as $b)
            @if($b['title'])
            <div class="card-feature text-center group hover:border-champagne-200 transition-colors duration-300">
                <div class="w-14 h-14 rounded-2xl bg-champagne-100 group-hover:bg-champagne-500
                            flex items-center justify-center mx-auto mb-5 transition-colors duration-300">
                    <svg class="w-7 h-7 text-champagne-500 group-hover:text-white transition-colors duration-300"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $b['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-serif text-lg text-taupe-800 font-semibold mb-3">{{ $b['title'] }}</h3>
                <p class="text-sm text-taupe-400 leading-relaxed">{{ $b['text'] }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     6. HISTORIA / MARCA
═══════════════════════════════════════════════════════════════ --}}
<section id="historia" class="py-24 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="order-2 lg:order-1 relative">
                <div class="relative rounded-3xl overflow-hidden aspect-[4/5] shadow-xl bg-cream-200">
                    @if($c['historia_image'])
                        <img src="{{ $mediaUrl($c['historia_image']) }}"
                             alt="{{ $c['historia_title_1'] }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-champagne-100 to-blush-100 flex items-center justify-center">
                            <p class="font-serif italic text-taupe-300 text-lg text-center px-8">
                                "Un recuerdo<br>para siempre"
                            </p>
                        </div>
                    @endif
                </div>

                @if($c['historia_quote'])
                <div class="absolute -bottom-6 -right-4 lg:-right-8 bg-white rounded-2xl shadow-lg
                            p-5 max-w-[220px] border-l-4 border-champagne-500">
                    <p class="font-serif italic text-sm text-taupe-600 leading-relaxed">
                        "{{ $c['historia_quote'] }}"
                    </p>
                </div>
                @endif
            </div>

            <div class="order-1 lg:order-2">
                <span class="section-label block mb-3">{{ $c['historia_label'] }}</span>
                <h2 class="section-title mb-6">
                    {{ $c['historia_title_1'] }}<br>
                    <em class="italic text-champagne-500">{{ $c['historia_title_2'] }}</em>
                </h2>
                <div class="space-y-4 text-taupe-500 leading-relaxed text-sm">
                    @if($c['historia_p1'])<p>{{ $c['historia_p1'] }}</p>@endif
                    @if($c['historia_p2'])<p>{{ $c['historia_p2'] }}</p>@endif
                    @if($c['historia_p3'])<p>{{ $c['historia_p3'] }}</p>@endif
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     7. TESTIMONIOS
═══════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="section-label block mb-3">{{ $c['testimonios_label'] }}</span>
            <h2 class="section-title">{{ $c['testimonios_title'] }}</h2>
            <p class="text-taupe-400 text-sm mt-3 max-w-md mx-auto">Experiencias reales de mamás que ya tienen su tesoro.</p>
        </div>

        @php
            $hasDbTestimonials = isset($testimonials) && $testimonials->count() > 0;
        @endphp

        @if($hasDbTestimonials)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    @for($s = 0; $s < 5; $s++)
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>

                <p class="testimonial-quote">"{{ $t->text }}"</p>

                <div class="testimonial-author">
                    @if($t->image)
                        <img src="{{ asset('storage/' . $t->image) }}"
                             alt="{{ $t->name }}"
                             class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                    @else
                        <div class="testimonial-avatar">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-taupe-800">{{ $t->name }}</p>
                        @if($t->product_name)
                            <p class="text-xs text-taupe-400">{{ $t->product_name }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        {{-- Fallback: testimonios del CMS --}}
        @php
            $cmsTestimonios = [
                ['name' => $c['testimonio_1_name'], 'loc' => $c['testimonio_1_loc'], 'text' => $c['testimonio_1_text']],
                ['name' => $c['testimonio_2_name'], 'loc' => $c['testimonio_2_loc'], 'text' => $c['testimonio_2_text']],
                ['name' => $c['testimonio_3_name'], 'loc' => $c['testimonio_3_loc'], 'text' => $c['testimonio_3_text']],
            ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($cmsTestimonios as $t)
            @if($t['name'])
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    @for($s = 0; $s < 5; $s++)
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <p class="testimonial-quote">"{{ $t['text'] }}"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        {{ strtoupper(substr($t['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-taupe-800">{{ $t['name'] }}</p>
                        <p class="text-xs text-taupe-400">{{ $t['loc'] }}</p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif

        {{-- Trust stats (500+ mamás) --}}
        <div class="mt-14 border-t border-cream-200 pt-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $trustStats = [
                        ['number' => $c['trust_stat_1_number'], 'label' => $c['trust_stat_1_label'],
                         'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['number' => $c['trust_stat_2_number'], 'label' => $c['trust_stat_2_label'],
                         'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                        ['number' => $c['trust_stat_3_number'], 'label' => $c['trust_stat_3_label'],
                         'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['number' => $c['trust_stat_4_number'], 'label' => $c['trust_stat_4_label'],
                         'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                    ];
                @endphp
                @foreach($trustStats as $stat)
                <div class="trust-item justify-center text-center">
                    <div class="trust-icon mx-auto mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="trust-text items-center">
                        <span class="trust-number">{{ $stat['number'] }}</span>
                        <span class="trust-label">{{ $stat['label'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     8. GALERÍA
═══════════════════════════════════════════════════════════════ --}}
@if($galleryItems->count())
<section id="galeria" class="py-24 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="section-label block mb-3">{{ $c['galeria_label'] }}</span>
            <h2 class="section-title mb-4">{{ $c['galeria_title'] }}</h2>
            <p class="text-taupe-400 max-w-sm mx-auto text-sm leading-relaxed">
                {{ $c['galeria_description'] }}
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
            @foreach($galleryItems as $item)
            <div class="relative rounded-2xl overflow-hidden aspect-square group">
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->caption ?? '' }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-taupe-900/50 to-transparent
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300
                            flex items-end p-4">
                    @if($item->caption)
                        <p class="text-white text-xs font-serif italic">{{ $item->caption }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════════════════════
     9. FAQ
═══════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="section-label block mb-3">{{ $c['faq_label'] }}</span>
            <h2 class="section-title">{{ $c['faq_title'] }}</h2>
        </div>

        @php
            $faqs = [
                ['q' => $c['faq_1_q'], 'a' => $c['faq_1_a']],
                ['q' => $c['faq_2_q'], 'a' => $c['faq_2_a']],
                ['q' => $c['faq_3_q'], 'a' => $c['faq_3_a']],
                ['q' => $c['faq_4_q'], 'a' => $c['faq_4_a']],
                ['q' => $c['faq_5_q'], 'a' => $c['faq_5_a']],
                ['q' => $c['faq_6_q'], 'a' => $c['faq_6_a']],
            ];
        @endphp

        <div x-data="{ open: null }">
            @foreach($faqs as $i => $faq)
            @if($faq['q'])
            <div class="faq-item">
                <button class="faq-question" @click="open = open === {{ $i }} ? null : {{ $i }}">
                    <span>{{ $faq['q'] }}</span>
                    <svg class="w-4 h-4 text-champagne-500 flex-shrink-0 transition-transform duration-200"
                         :class="open === {{ $i }} ? 'rotate-45' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
                <div x-show="open === {{ $i }}"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-cloak>
                    <p class="faq-answer">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        @if($waNumber)
        <div class="mt-10 text-center">
            <p class="text-sm text-taupe-400 mb-4">¿Tienes otra pregunta? Escríbenos directamente.</p>
            <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-whatsapp">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Consultar por WhatsApp
            </a>
        </div>
        @endif
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════════
     10. CTA FINAL
═══════════════════════════════════════════════════════════════ --}}
<section class="py-28 bg-taupe-900 text-center relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-16 bg-gradient-to-b from-champagne-500/50 to-transparent"></div>

    <div class="relative z-10 max-w-2xl mx-auto px-4 sm:px-6">
        <span class="hero-eyebrow block mb-4">{{ $c['cta_label'] }}</span>
        <h2 class="font-serif text-4xl sm:text-5xl text-white mb-5 leading-tight">
            {{ $c['cta_title'] }}
        </h2>
        <div class="ornament max-w-[80px] mx-auto mb-6 opacity-20">
            <span class="text-champagne-400 text-sm">✦</span>
        </div>
        <p class="text-taupe-300 text-base mb-10 leading-relaxed opacity-80">
            {{ $c['cta_description'] }}
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('tienda') }}" class="btn-primary text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                </svg>
                {{ $c['cta_btn_text'] }}
            </a>
            @if($waNumber)
            <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-whatsapp text-base">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Consultar por WhatsApp
            </a>
            @endif
        </div>
    </div>
</section>

@endsection
