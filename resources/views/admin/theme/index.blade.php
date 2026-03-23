@extends('layouts.admin')

@section('title', 'Colores y Tema')
@section('page-title', 'Colores y Tema')

@section('content')
<div x-data="{
    theme: @js($theme),
    applyPalette(palette) {
        const values = @js(collect($palettes)->map(fn($p) => $p['values']));
        if (values[palette]) {
            Object.assign(this.theme, values[palette]);
        }
    },
    updatePreview(key, value) {
        this.theme[key] = value;
        document.documentElement.style.setProperty('--preview-' + key.replace('theme_color_', ''), value);
    }
}">

    {{-- Palette Selector --}}
    <div class="admin-card mb-6">
        <h3 class="font-serif text-lg text-olive-900 font-semibold mb-4">Paletas predefinidas</h3>
        <p class="text-sm text-gray-500 mb-4">Aplica una paleta completa con un clic. Puedes ajustar colores individuales después.</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach($palettes as $key => $palette)
            <form method="POST" action="{{ route('admin.theme.palette') }}">
                @csrf
                <input type="hidden" name="palette" value="{{ $key }}">
                <button type="submit"
                        class="w-full text-left rounded-xl border-2 border-transparent hover:border-gold-400 transition-all overflow-hidden group">
                    {{-- Color preview swatches --}}
                    <div class="flex h-8">
                        <div class="flex-1" style="background: {{ $palette['values']['theme_color_primary'] }}"></div>
                        <div class="flex-1" style="background: {{ $palette['values']['theme_color_secondary'] }}"></div>
                        <div class="flex-1" style="background: {{ $palette['values']['theme_color_accent'] }}"></div>
                        <div class="flex-1" style="background: {{ $palette['values']['theme_color_bg_main'] }}"></div>
                    </div>
                    <div class="px-2 py-1.5 bg-gray-50 group-hover:bg-gold-50">
                        <p class="text-xs font-medium text-olive-900 leading-tight">{{ $palette['name'] }}</p>
                    </div>
                </button>
            </form>
            @endforeach
        </div>
    </div>

    {{-- Color Editor --}}
    <form method="POST" action="{{ route('admin.theme.update') }}">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Brand Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-olive-900 font-semibold border-b border-gray-100 pb-3">Colores de marca</h3>

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
                        <label class="block text-sm font-medium text-olive-800">{{ $label }}</label>
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
                <h3 class="font-serif text-lg text-olive-900 font-semibold border-b border-gray-100 pb-3">Fondos</h3>

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
                        <label class="block text-sm font-medium text-olive-800">{{ $label }}</label>
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
                <h3 class="font-serif text-lg text-olive-900 font-semibold border-b border-gray-100 pb-3">Textos y enlaces</h3>

                @foreach([
                    ['theme_color_title',  'Color de títulos',    'H1, H2, H3 del sitio'],
                    ['theme_color_text',   'Color de texto',      'Párrafos y texto general'],
                    ['theme_color_link',   'Color de enlaces',    'Links y botones de texto'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-olive-800">{{ $label }}</label>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="text" x-model="theme['{{ $key }}']"
                           class="w-24 text-xs border border-gray-200 rounded-lg px-2 py-1.5 font-mono">
                </div>
                @endforeach
            </div>

            {{-- Button & UI Colors --}}
            <div class="admin-card space-y-5">
                <h3 class="font-serif text-lg text-olive-900 font-semibold border-b border-gray-100 pb-3">Botones y UI</h3>

                @foreach([
                    ['theme_color_btn',       'Fondo de botones',     'Color principal de los botones CTA'],
                    ['theme_color_btn_hover',  'Hover de botones',     'Color al pasar el mouse por botones'],
                    ['theme_color_btn_text',   'Texto de botones',     'Color del texto dentro de botones'],
                    ['theme_color_border',     'Color de bordes',      'Líneas divisorias y marcos de tarjetas'],
                    ['theme_color_badge',      'Fondo de badges',      'Etiquetas de oferta, "Nuevo", etc.'],
                ] as [$key, $label, $hint])
                <div class="flex items-center gap-4">
                    <input type="color" name="{{ $key }}" value="{{ $theme[$key] }}"
                           x-model="theme['{{ $key }}']"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-olive-800">{{ $label }}</label>
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
                    class="inline-flex items-center gap-2 bg-olive-900 hover:bg-olive-800 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar colores
            </button>
        </div>
    </form>
</div>
@endsection
