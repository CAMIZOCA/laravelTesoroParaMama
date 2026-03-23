@extends('layouts.public')

@section('title', $c['instr_page_title'])
@section('seo_title', $c['instr_page_title'] . ' — Un Tesoro Para Mamá')
@section('seo_description', $c['instr_page_subtitle'])

@section('content')

@php
    $mediaUrl = function (?string $path): string {
        $path = trim((string) $path);
        if ($path === '') {
            return '';
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        return asset('storage/' . ltrim($path, '/'));
    };
@endphp

{{-- ── HERO ── --}}
<section class="relative bg-gradient-to-b from-cream-100 to-cream-50 pt-28 pb-16 text-center overflow-hidden">
    {{-- Decorative circles --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-gold-100 rounded-full opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-gold-100 rounded-full opacity-20 translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-3xl mx-auto px-6">
        <span class="inline-block text-xs font-semibold tracking-widest uppercase text-gold-600 mb-4">
            {{ $c['instr_page_label'] }}
        </span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-olive-900 mb-5 leading-tight">
            {{ $c['instr_page_title'] }}
        </h1>
        <p class="text-lg text-olive-700 max-w-xl mx-auto leading-relaxed">
            {{ $c['instr_page_subtitle'] }}
        </p>

        {{-- Step quick nav --}}
        <div class="flex justify-center gap-4 mt-8 flex-wrap">
            <a href="#paso1" class="inline-flex items-center gap-2 bg-white border border-gold-300 text-olive-800 text-sm font-medium px-5 py-2.5 rounded-full shadow-sm hover:bg-gold-50 transition-colors">
                <span class="w-5 h-5 bg-gold-400 text-white rounded-full text-xs flex items-center justify-center font-bold">1</span>
                Preservación
            </a>
            <a href="#paso2" class="inline-flex items-center gap-2 bg-white border border-gold-300 text-olive-800 text-sm font-medium px-5 py-2.5 rounded-full shadow-sm hover:bg-gold-50 transition-colors">
                <span class="w-5 h-5 bg-gold-400 text-white rounded-full text-xs flex items-center justify-center font-bold">2</span>
                Crear tu joya
            </a>
        </div>
    </div>
</section>

{{-- ── BIENVENIDA ── --}}
<section class="py-14 bg-cream-50">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-sm border-l-4 border-gold-400 p-8 sm:p-10">
            {{-- Candle icon --}}
            <div class="flex items-center gap-3 mb-5">
                <svg class="w-7 h-7 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2c0 0-1 2-1 4s1 3 1 3-1 2-1 4m0 0v9M12 13c0 0 1-2 1-4s-1-3-1-3 1-2 1-4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 22h6M10 18h4"/>
                    <ellipse cx="12" cy="6" rx="1.5" ry="2" fill="currentColor" opacity="0.3"/>
                </svg>
                <h2 class="font-serif text-xl font-semibold text-olive-900">{{ $c['instr_welcome_title'] }}</h2>
            </div>
            <p class="text-olive-700 leading-relaxed italic text-base">
                {{ $c['instr_welcome_text'] }}
            </p>
        </div>
    </div>
</section>

{{-- ── CONTENIDO DEL KIT ── --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="font-serif text-3xl font-bold text-olive-900">{{ $c['instr_kit_title'] }}</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            {{-- Sobre 1 --}}
            <div class="bg-cream-50 rounded-2xl border border-cream-200 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 bg-gold-400 text-white rounded-full text-sm font-bold flex items-center justify-center flex-shrink-0">1</span>
                    <h3 class="font-semibold text-olive-900 text-sm">{{ $c['instr_kit_sobre1_title'] }}</h3>
                </div>
                <ul class="space-y-1.5">
                    @foreach(array_filter(explode("\n", $c['instr_kit_sobre1_items'])) as $item)
                    <li class="flex items-start gap-2 text-sm text-olive-700">
                        <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ trim($item) }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Sobre 2 --}}
            <div class="bg-cream-50 rounded-2xl border border-cream-200 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 bg-olive-700 text-white rounded-full text-sm font-bold flex items-center justify-center flex-shrink-0">2</span>
                    <h3 class="font-semibold text-olive-900 text-sm">{{ $c['instr_kit_sobre2_title'] }}</h3>
                </div>
                <ul class="space-y-1.5">
                    @foreach(array_filter(explode("\n", $c['instr_kit_sobre2_items'])) as $item)
                    <li class="flex items-start gap-2 text-sm text-olive-700">
                        <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ trim($item) }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Sobre 3 --}}
            <div class="bg-cream-50 rounded-2xl border border-cream-200 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 bg-olive-500 text-white rounded-full text-sm font-bold flex items-center justify-center flex-shrink-0">3</span>
                    <h3 class="font-semibold text-olive-900 text-sm">{{ $c['instr_kit_sobre3_title'] }}</h3>
                </div>
                <ul class="space-y-1.5">
                    @foreach(array_filter(explode("\n", $c['instr_kit_sobre3_items'])) as $item)
                    <li class="flex items-start gap-2 text-sm text-olive-700">
                        <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ trim($item) }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Extras --}}
            <div class="bg-cream-50 rounded-2xl border border-cream-200 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 bg-gold-200 text-olive-900 rounded-full text-sm font-bold flex items-center justify-center flex-shrink-0">+</span>
                    <h3 class="font-semibold text-olive-900 text-sm">{{ $c['instr_kit_extras_title'] }}</h3>
                </div>
                <ul class="space-y-1.5">
                    @foreach(array_filter(explode("\n", $c['instr_kit_extras_items'])) as $item)
                    <li class="flex items-start gap-2 text-sm text-olive-700">
                        <svg class="w-4 h-4 text-gold-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ trim($item) }}
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ── PASO 1: PRESERVACIÓN ── --}}
<section id="paso1" class="py-16 bg-cream-50">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Step header --}}
        <div class="flex items-center gap-5 mb-10">
            <div class="w-16 h-16 bg-gold-400 text-white rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="font-serif text-2xl font-bold">1</span>
            </div>
            <div>
                <span class="text-xs font-semibold tracking-widest uppercase text-gold-600">{{ $c['instr_step1_label'] }}</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-olive-900 leading-tight">{{ $c['instr_step1_title'] }}</h2>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="inline-block bg-gold-100 text-gold-800 text-xs font-medium px-3 py-1 rounded-full">{{ $c['instr_step1_sobre'] }}</span>
                    <span class="inline-block bg-olive-100 text-olive-700 text-xs font-medium px-3 py-1 rounded-full">{{ $c['instr_step1_duration'] }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 {{ $c['instr_step1_image'] ? 'lg:grid-cols-2' : '' }} gap-10 items-start">

            {{-- Steps list --}}
            <div class="bg-white rounded-2xl shadow-sm border border-cream-200 p-6 sm:p-8">
                <ol class="space-y-4">
                    @php $stepNum = 1; @endphp
                    @foreach(array_filter(explode("\n", $c['instr_step1_steps'])) as $step)
                    <li class="flex items-start gap-4">
                        <span class="w-7 h-7 bg-gold-50 border-2 border-gold-300 text-gold-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">{{ $stepNum }}</span>
                        <p class="text-olive-700 text-sm leading-relaxed pt-0.5">{{ trim($step) }}</p>
                    </li>
                    @php $stepNum++; @endphp
                    @endforeach
                </ol>
            </div>

            {{-- Optional image --}}
            @if($c['instr_step1_image'])
            <div class="rounded-2xl overflow-hidden shadow-md">
                <img src="{{ $mediaUrl($c['instr_step1_image']) }}"
                     alt="Preservación de leche materna"
                     class="w-full h-full object-cover">
            </div>
            @endif

        </div>
    </div>
</section>

{{-- ── PASO 2: HACER LA JOYA ── --}}
<section id="paso2" class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Step header --}}
        <div class="flex items-center gap-5 mb-10">
            <div class="w-16 h-16 bg-olive-800 text-white rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="font-serif text-2xl font-bold">2</span>
            </div>
            <div>
                <span class="text-xs font-semibold tracking-widest uppercase text-olive-500">{{ $c['instr_step2_label'] }}</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-olive-900 leading-tight">{{ $c['instr_step2_title'] }}</h2>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="inline-block bg-olive-100 text-olive-700 text-xs font-medium px-3 py-1 rounded-full">{{ $c['instr_step2_sobre'] }}</span>
                    <span class="inline-block bg-gold-100 text-gold-800 text-xs font-medium px-3 py-1 rounded-full">{{ $c['instr_step2_duration'] }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 {{ $c['instr_step2_image'] ? 'lg:grid-cols-2' : '' }} gap-10 items-start">

            {{-- Optional image (reversed on desktop) --}}
            @if($c['instr_step2_image'])
            <div class="rounded-2xl overflow-hidden shadow-md lg:order-first">
                <img src="{{ $mediaUrl($c['instr_step2_image']) }}"
                     alt="Crear joya de leche materna"
                     class="w-full h-full object-cover">
            </div>
            @endif

            {{-- Steps list --}}
            <div class="bg-cream-50 rounded-2xl shadow-sm border border-cream-200 p-6 sm:p-8 {{ $c['instr_step2_image'] ? 'lg:order-last' : '' }}">
                <ol class="space-y-4">
                    @php $stepNum = 1; @endphp
                    @foreach(array_filter(explode("\n", $c['instr_step2_steps'])) as $step)
                    <li class="flex items-start gap-4">
                        <span class="w-7 h-7 bg-olive-50 border-2 border-olive-300 text-olive-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">{{ $stepNum }}</span>
                        <p class="text-olive-700 text-sm leading-relaxed pt-0.5">{{ trim($step) }}</p>
                    </li>
                    @php $stepNum++; @endphp
                    @endforeach
                </ol>
            </div>

        </div>
    </div>
</section>

{{-- ── CIERRE ── --}}
<section class="py-20 bg-olive-900 text-white text-center">
    <div class="max-w-2xl mx-auto px-6">
        {{-- Heart icon --}}
        <div class="w-14 h-14 bg-gold-400 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/>
            </svg>
        </div>

        <h2 class="font-serif text-3xl sm:text-4xl font-bold mb-5">{{ $c['instr_closing_title'] }}</h2>
        <p class="text-cream-100 text-base leading-relaxed mb-8 max-w-lg mx-auto opacity-90">
            {{ $c['instr_closing_text'] }}
        </p>

        <a href="{{ route('tienda') }}"
           class="inline-flex items-center gap-3 bg-gold-400 hover:bg-gold-500 text-white font-semibold px-8 py-4 rounded-full text-sm transition-all duration-300 hover:shadow-lg hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
            </svg>
            {{ $c['instr_closing_btn_text'] }}
        </a>
    </div>
</section>

@endsection
