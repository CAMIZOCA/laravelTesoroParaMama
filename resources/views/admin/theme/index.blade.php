@extends('layouts.admin')

@section('title', 'Colores y Tema')
@section('page-title', 'Colores y Tema')

@section('content')
@php
    $theme['theme_color_btn_inverse']       ??= '#F8D3DF';
    $theme['theme_color_btn_inverse_hover'] ??= '#f0b8ca';
    $theme['theme_color_btn_inverse_text']  ??= '#272D3E';
    $theme['theme_color_link_hover']        ??= '#B45F7F';
@endphp
<div x-data="{
    theme: @js($theme),
    updatePreview(key, value) {
        this.theme[key] = value;
        document.documentElement.style.setProperty('--preview-' + key.replace('theme_color_', ''), value);
    }
}">

    {{-- Color Editor --}}
    <form method="POST" action="{{ route('admin.theme.update') }}">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Brand Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-slate-900 font-semibold border-b border-gray-100 pb-3">Colores de marca</h3>

                @foreach([
                    ['theme_color_primary',   'Color primario',   'Dorado, rosado, el color principal'],
                    ['theme_color_secondary',  'Color secundario', 'Oliva, azul oscuro, el color de apoyo'],
                    ['theme_color_accent',     'Acento',           'Detalles decorativos y bordes especiales'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-800">{{ $label }}</label>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="text" x-model="theme['{{ $key }}']"
                           class="w-24 text-xs border border-gray-200 rounded-lg px-2 py-1.5 font-mono"
                           placeholder="#C9A96E">
                </div>
                @endforeach
            </div>

            {{-- Background Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-slate-900 font-semibold border-b border-gray-100 pb-3">Fondos</h3>

                @foreach([
                    ['theme_color_bg_main',    'Fondo general',          'Color base de toda la página'],
                    ['theme_color_bg_section',  'Fondo de secciones',     'Secciones alternadas en el home'],
                    ['theme_color_card',        'Fondo de tarjetas',      'Fondo de cards y modales'],
                    ['theme_color_header',      'Fondo del header',       'Barra de navegación superior'],
                    ['theme_color_footer',      'Fondo del footer',       'Pie de página'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-800">{{ $label }}</label>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="text" x-model="theme['{{ $key }}']"
                           class="w-24 text-xs border border-gray-200 rounded-lg px-2 py-1.5 font-mono"
                           placeholder="#FAF7F2">
                </div>
                @endforeach
            </div>

            {{-- Text Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-slate-900 font-semibold border-b border-gray-100 pb-3">Textos y enlaces</h3>

                @foreach([
                    ['theme_color_title',  'Color de títulos',    'H1, H2, H3 del sitio'],
                    ['theme_color_text',   'Color de texto',      'Párrafos y texto general'],
                    ['theme_color_link',       'Color de enlaces',       'Links y botones de texto'],
                    ['theme_color_link_hover', 'Hover de enlaces',       'Color al pasar el mouse por un link'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-800">{{ $label }}</label>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="text" x-model="theme['{{ $key }}']"
                           class="w-24 text-xs border border-gray-200 rounded-lg px-2 py-1.5 font-mono">
                </div>
                @endforeach
            </div>

            {{-- Button & UI Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-slate-900 font-semibold border-b border-gray-100 pb-3">Botones y UI</h3>

                @foreach([
                    ['theme_color_btn',                'Fondo de botones',          'Color principal de los botones CTA (fondos claros)'],
                    ['theme_color_btn_hover',           'Hover de botones',          'Color al pasar el mouse por botones'],
                    ['theme_color_btn_text',            'Texto de botones',          'Color del texto dentro de botones'],
                    ['theme_color_btn_inverse',         'Botón inverso (fondo)',     'Botones sobre secciones oscuras, p.ej. footer'],
                    ['theme_color_btn_inverse_hover',   'Botón inverso (hover)',     'Color al pasar el mouse por botones inversos'],
                    ['theme_color_btn_inverse_text',    'Botón inverso (texto)',     'Texto dentro del botón inverso'],
                    ['theme_color_border',              'Color de bordes',           'Líneas divisorias y marcos de tarjetas'],
                    ['theme_color_badge',               'Fondo de badges',           'Etiquetas de oferta, "Nuevo", etc.'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-800">{{ $label }}</label>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="text" x-model="theme['{{ $key }}']"
                           class="w-24 text-xs border border-gray-200 rounded-lg px-2 py-1.5 font-mono">
                </div>
                @endforeach
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar colores
            </button>
        </div>
    </form>
</div>
@endsection
