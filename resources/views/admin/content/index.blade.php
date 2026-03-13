@extends('layouts.admin')

@section('title', 'Contenido del Sitio')
@section('page-title', 'Contenido del Sitio')

@section('content')
<div x-data="{ tab: 'hero' }">

    {{-- Tab nav --}}
    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-200 pb-0">
        @foreach([
            ['key' => 'hero',      'label' => 'Hero'],
            ['key' => 'historia',  'label' => 'Historia'],
            ['key' => 'kit',       'label' => 'Kit / Beneficios'],
            ['key' => 'tangible',  'label' => 'Tu Joya'],
            ['key' => 'galeria',   'label' => 'Galería'],
            ['key' => 'cta',       'label' => 'CTA Final'],
        ] as $t)
        <button @click="tab = '{{ $t['key'] }}'"
                :class="tab === '{{ $t['key'] }}' ? 'border-b-2 border-gold-500 text-gold-600 font-semibold' : 'text-gray-500 hover:text-olive-900'"
                class="px-4 py-2.5 text-sm transition-colors -mb-px">
            {{ $t['label'] }}
        </button>
        @endforeach
    </div>

    <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ── HERO ── --}}
        <div x-show="tab === 'hero'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección Hero (portada)</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="hero_label" value="{{ $content['hero_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título principal (H1) <span class="text-gray-400 font-normal text-xs">— salto de línea con Enter</span></label>
                    <textarea name="hero_title" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['hero_title'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtítulo / descripción</label>
                    <textarea name="hero_subtitle" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['hero_subtitle'] }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Texto botón WhatsApp</label>
                        <input type="text" name="hero_btn_text" value="{{ $content['hero_btn_text'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Texto enlace secundario</label>
                        <input type="text" name="hero_link_text" value="{{ $content['hero_link_text'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── HISTORIA ── --}}
        <div x-show="tab === 'historia'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección Historia</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                        <input type="text" name="historia_label" value="{{ $content['historia_label'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título línea 1</label>
                        <input type="text" name="historia_title_1" value="{{ $content['historia_title_1'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título línea 2 <span class="text-gold-500 font-normal text-xs">(en cursiva dorada)</span></label>
                        <input type="text" name="historia_title_2" value="{{ $content['historia_title_2'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Párrafo 1</label>
                    <textarea name="historia_p1" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['historia_p1'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Párrafo 2</label>
                    <textarea name="historia_p2" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['historia_p2'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Párrafo 3</label>
                    <textarea name="historia_p3" rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['historia_p3'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Frase destacada / cita</label>
                    <input type="text" name="historia_quote" value="{{ $content['historia_quote'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen de la sección</label>
                    @if($content['historia_image'])
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $content['historia_image']) }}"
                                 alt="Historia" class="h-40 w-auto rounded-xl object-cover border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="historia_image" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
                </div>
            </div>
        </div>

        {{-- ── KIT / BENEFICIOS ── --}}
        <div x-show="tab === 'kit'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección Kit / Beneficios</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="kit_label" value="{{ $content['kit_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="kit_title" value="{{ $content['kit_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="kit_description" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['kit_description'] }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-4">Las 4 tarjetas de beneficios</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach([1,2,3,4] as $i)
                        <div class="border border-gray-100 rounded-xl p-4 space-y-3 bg-cream-50">
                            <p class="text-xs font-semibold text-gold-600 uppercase tracking-wide">Tarjeta {{ $i }}</p>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Título</label>
                                <input type="text" name="feature_{{ $i }}_title" value="{{ $content['feature_' . $i . '_title'] }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Texto</label>
                                <textarea name="feature_{{ $i }}_text" rows="3"
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">{{ $content['feature_' . $i . '_text'] }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── TANGIBLE ── --}}
        <div x-show="tab === 'tangible'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección "Tu Joya"</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="tangible_label" value="{{ $content['tangible_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="tangible_title" value="{{ $content['tangible_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Párrafo 1</label>
                    <textarea name="tangible_p1" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['tangible_p1'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Párrafo 2</label>
                    <textarea name="tangible_p2" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['tangible_p2'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen de la sección</label>
                    @if($content['tangible_image'])
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $content['tangible_image']) }}"
                                 alt="Tu Joya" class="h-40 w-auto rounded-xl object-cover border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="tangible_image" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
                </div>
            </div>
        </div>

        {{-- ── GALERÍA ── --}}
        <div x-show="tab === 'galeria'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Encabezado de la Galería</h3>
                <p class="text-sm text-gray-500">Las imágenes se gestionan desde el módulo <a href="{{ route('admin.gallery.index') }}" class="text-gold-500 underline hover:text-gold-600">Galería</a>.</p>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="galeria_label" value="{{ $content['galeria_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="galeria_title" value="{{ $content['galeria_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="galeria_description" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['galeria_description'] }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── CTA ── --}}
        <div x-show="tab === 'cta'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección CTA Final</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="cta_label" value="{{ $content['cta_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="cta_title" value="{{ $content['cta_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="cta_description" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['cta_description'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texto del botón WhatsApp</label>
                    <input type="text" name="cta_btn_text" value="{{ $content['cta_btn_text'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
            </div>
        </div>

        {{-- Save button --}}
        <div class="mt-6 flex justify-end">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-olive-900 hover:bg-olive-800 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection
