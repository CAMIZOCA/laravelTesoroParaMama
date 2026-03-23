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
            ['key' => 'cta',          'label' => 'CTA Final'],
            ['key' => 'instrucciones', 'label' => 'Instrucciones'],
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
                            <img src="{{ asset('storage/' . ltrim($content['historia_image'], '/')) }}"
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
                            <img src="{{ asset('storage/' . ltrim($content['tangible_image'], '/')) }}"
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

        {{-- ── INSTRUCCIONES ── --}}
        <div x-show="tab === 'instrucciones'" x-cloak class="space-y-6">

            {{-- Encabezado --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Encabezado de la página</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="instr_page_label" value="{{ $content['instr_page_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título principal</label>
                    <input type="text" name="instr_page_title" value="{{ $content['instr_page_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtítulo / descripción</label>
                    <textarea name="instr_page_subtitle" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_page_subtitle'] }}</textarea>
                </div>
            </div>

            {{-- Bienvenida --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Mensaje de bienvenida</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título del mensaje</label>
                    <input type="text" name="instr_welcome_title" value="{{ $content['instr_welcome_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texto del mensaje</label>
                    <textarea name="instr_welcome_text" rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_welcome_text'] }}</textarea>
                </div>
            </div>

            {{-- Contenido del kit --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Contenido del kit</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título de la sección</label>
                    <input type="text" name="instr_kit_title" value="{{ $content['instr_kit_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Sobre 1 --}}
                    <div class="space-y-3 bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-semibold text-gray-700">Sobre 1</label>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Título</label>
                            <input type="text" name="instr_kit_sobre1_title" value="{{ $content['instr_kit_sobre1_title'] }}"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ítems <span class="text-gray-400">(uno por línea)</span></label>
                            <textarea name="instr_kit_sobre1_items" rows="5"
                                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_kit_sobre1_items'] }}</textarea>
                        </div>
                    </div>
                    {{-- Sobre 2 --}}
                    <div class="space-y-3 bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-semibold text-gray-700">Sobre 2</label>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Título</label>
                            <input type="text" name="instr_kit_sobre2_title" value="{{ $content['instr_kit_sobre2_title'] }}"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ítems <span class="text-gray-400">(uno por línea)</span></label>
                            <textarea name="instr_kit_sobre2_items" rows="5"
                                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_kit_sobre2_items'] }}</textarea>
                        </div>
                    </div>
                    {{-- Sobre 3 --}}
                    <div class="space-y-3 bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-semibold text-gray-700">Sobre 3</label>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Título</label>
                            <input type="text" name="instr_kit_sobre3_title" value="{{ $content['instr_kit_sobre3_title'] }}"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ítems <span class="text-gray-400">(uno por línea)</span></label>
                            <textarea name="instr_kit_sobre3_items" rows="4"
                                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_kit_sobre3_items'] }}</textarea>
                        </div>
                    </div>
                    {{-- Extras --}}
                    <div class="space-y-3 bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-semibold text-gray-700">Extras incluidos</label>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Título</label>
                            <input type="text" name="instr_kit_extras_title" value="{{ $content['instr_kit_extras_title'] }}"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ítems <span class="text-gray-400">(uno por línea)</span></label>
                            <textarea name="instr_kit_extras_items" rows="7"
                                      class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_kit_extras_items'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Paso 1 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Paso 1 — Preservación</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta (ej. "Paso 1")</label>
                        <input type="text" name="instr_step1_label" value="{{ $content['instr_step1_label'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título del paso</label>
                        <input type="text" name="instr_step1_title" value="{{ $content['instr_step1_title'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge sobre (ej. "Sobre 1")</label>
                        <input type="text" name="instr_step1_sobre" value="{{ $content['instr_step1_sobre'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge duración (ej. "24 horas")</label>
                        <input type="text" name="instr_step1_duration" value="{{ $content['instr_step1_duration'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pasos <span class="text-gray-400 font-normal text-xs">— un paso por línea</span></label>
                    <textarea name="instr_step1_steps" rows="10"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_step1_steps'] }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen ilustrativa (opcional)</label>
                    @if($content['instr_step1_image'])
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . ltrim($content['instr_step1_image'], '/')) }}" alt="Paso 1" class="h-28 rounded-lg object-cover">
                        <p class="text-xs text-gray-400 mt-1">Imagen actual. Sube otra para reemplazarla.</p>
                    </div>
                    @endif
                    <input type="file" name="instr_step1_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100">
                </div>
            </div>

            {{-- Paso 2 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Paso 2 — Hacer la joya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta (ej. "Paso 2")</label>
                        <input type="text" name="instr_step2_label" value="{{ $content['instr_step2_label'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título del paso</label>
                        <input type="text" name="instr_step2_title" value="{{ $content['instr_step2_title'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge sobre (ej. "Sobre 2")</label>
                        <input type="text" name="instr_step2_sobre" value="{{ $content['instr_step2_sobre'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge duración (ej. "24 horas")</label>
                        <input type="text" name="instr_step2_duration" value="{{ $content['instr_step2_duration'] }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pasos <span class="text-gray-400 font-normal text-xs">— un paso por línea</span></label>
                    <textarea name="instr_step2_steps" rows="13"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_step2_steps'] }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen ilustrativa (opcional)</label>
                    @if($content['instr_step2_image'])
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . ltrim($content['instr_step2_image'], '/')) }}" alt="Paso 2" class="h-28 rounded-lg object-cover">
                        <p class="text-xs text-gray-400 mt-1">Imagen actual. Sube otra para reemplazarla.</p>
                    </div>
                    @endif
                    <input type="file" name="instr_step2_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100">
                </div>
            </div>

            {{-- Cierre --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Cierre y compartir</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="instr_closing_title" value="{{ $content['instr_closing_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texto</label>
                    <textarea name="instr_closing_text" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['instr_closing_text'] }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texto del botón WhatsApp</label>
                    <input type="text" name="instr_closing_btn_text" value="{{ $content['instr_closing_btn_text'] }}"
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
