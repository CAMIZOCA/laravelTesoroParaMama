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
            ['key' => 'proceso',   'label' => 'Cómo Funciona'],
            ['key' => 'tangible',   'label' => 'Tu Joya'],
            ['key' => 'personaliz', 'label' => 'Personalización'],
            ['key' => 'galeria',     'label' => 'Galería'],
            ['key' => 'testimonios', 'label' => 'Testimonios'],
            ['key' => 'faq',         'label' => 'FAQ'],
            ['key' => 'cta',         'label' => 'CTA Final'],
            ['key' => 'instrucciones', 'label' => 'Instrucciones'],
        ] as $t)
        <button @click="tab = '{{ $t['key'] }}'"
                :class="tab === '{{ $t['key'] }}' ? 'border-b-2 border-gold-500 text-gold-600 font-semibold' : 'text-gray-500 hover:text-olive-900'"
                class="px-4 py-2.5 text-sm transition-colors -mb-px">
            {{ $t['label'] }}
        </button>
        @endforeach
    </div>

    @php
        // Badge "Nuevo" visible durante 3 días desde el despliegue (2026-05-21)
        $showNew = now()->lte(\Carbon\Carbon::parse('2026-05-24'));
    @endphp

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

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen de la portada (Hero)</label>
                    @if($content['hero_image'])
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . ltrim($content['hero_image'], '/')) }}"
                                 alt="Hero" class="h-40 w-auto rounded-xl object-cover border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
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

                {{-- Fotos del Kit --}}
                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Fotos de la sección
                        @if($showNew)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                        </span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">1 foto → aparece entre el encabezado y las tarjetas. 2 ó 3 fotos → carrusel.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach([1 => 'kit_image_1', 2 => 'kit_image_2', 3 => 'kit_image_3'] as $n => $key)
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }}{{ $n > 1 ? ' (opcional)' : '' }}</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content[$key]))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── PROCESO ── --}}
        <div x-show="tab === 'proceso'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección "Cómo Funciona"</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="proceso_label" value="{{ $content['proceso_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título principal</label>
                    <input type="text" name="proceso_title" value="{{ $content['proceso_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="proceso_description" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['proceso_description'] }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-4">Los 5 pasos del proceso</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach([1,2,3,4,5] as $i)
                        <div class="border border-gray-100 rounded-xl p-4 space-y-3 bg-cream-50">
                            <p class="text-xs font-semibold text-gold-600 uppercase tracking-wide">Paso {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</p>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Título</label>
                                <input type="text" name="proceso_step_{{ $i }}_title" value="{{ $content['proceso_step_' . $i . '_title'] }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Descripción</label>
                                <textarea name="proceso_step_{{ $i }}_desc" rows="2"
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">{{ $content['proceso_step_' . $i . '_desc'] }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Fotos del proceso --}}
                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Fotos de la sección
                        @if($showNew)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                        </span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">1 foto → aparece al lado de los pasos. 2 ó 3 fotos → se muestran como carrusel.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach([1 => 'proceso_image_1', 2 => 'proceso_image_2', 3 => 'proceso_image_3'] as $n => $key)
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }}{{ $n > 1 ? ' (opcional)' : '' }}</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content[$key]))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
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

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Fotos de la sección
                        @if($showNew)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                        </span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">1 foto → aparece al lado del texto. 2 ó 3 fotos → se muestran como carrusel.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- Foto 1 (campo original) --}}
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto 1</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content['tangible_image']))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content['tangible_image'], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="tangible_image" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        {{-- Fotos 2 y 3 --}}
                        @foreach([2 => 'tangible_image_2', 3 => 'tangible_image_3'] as $n => $key)
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }} (opcional)</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content[$key]))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
                </div>
            </div>
        </div>

        {{-- ── PERSONALIZACIÓN ── --}}
        <div x-show="tab === 'personaliz'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección "Personalización"</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="personaliz_label" value="{{ $content['personaliz_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título principal</label>
                    <input type="text" name="personaliz_title" value="{{ $content['personaliz_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="personaliz_desc" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">{{ $content['personaliz_desc'] }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-4">Los 6 ítems del checklist</p>
                    <div class="space-y-3">
                        @foreach([1,2,3,4,5,6] as $i)
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Ítem {{ $i }}</label>
                            <input type="text" name="personaliz_item_{{ $i }}" value="{{ $content['personaliz_item_' . $i] }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Fotos de la sección
                        @if($showNew)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                        </span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">1 foto → aparece al lado del checklist. 2 ó 3 fotos → se muestran como carrusel.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- Foto 1 (campo original) --}}
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto 1</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content['personaliz_image']))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content['personaliz_image'], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="personaliz_image" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        {{-- Fotos 2 y 3 --}}
                        @foreach([2 => 'personaliz_image_2', 3 => 'personaliz_image_3'] as $n => $key)
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }} (opcional)</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content[$key]))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
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

        {{-- ── TESTIMONIOS ── --}}
        <div x-show="tab === 'testimonios'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">Sección "Testimonios"</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiqueta pequeña</label>
                    <input type="text" name="testimonios_label" value="{{ $content['testimonios_label'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título principal</label>
                    <input type="text" name="testimonios_title" value="{{ $content['testimonios_title'] }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none">
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-4">Los 3 testimonios</p>
                    <div class="space-y-6">
                        @foreach([1,2,3] as $i)
                        <div class="border border-gray-100 rounded-xl p-4 space-y-3 bg-cream-50">
                            <p class="text-xs font-semibold text-gold-600 uppercase tracking-wide">Testimonio {{ $i }}</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Nombre</label>
                                    <input type="text" name="testimonio_{{ $i }}_name" value="{{ $content['testimonio_' . $i . '_name'] }}"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Ciudad / Ubicación</label>
                                    <input type="text" name="testimonio_{{ $i }}_loc" value="{{ $content['testimonio_' . $i . '_loc'] }}"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Texto del testimonio</label>
                                <textarea name="testimonio_{{ $i }}_text" rows="3"
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gold-400 focus:border-transparent outline-none bg-white">{{ $content['testimonio_' . $i . '_text'] }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Fotos de testimonios --}}
                <div class="border-t border-gray-100 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Fotos de la sección
                        @if($showNew)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                        </span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">1 foto → aparece entre el encabezado y los testimonios. 2 ó 3 fotos → carrusel.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach([1 => 'testimonios_image_1', 2 => 'testimonios_image_2', 3 => 'testimonios_image_3'] as $n => $key)
                        <div x-data="{ preview: null }">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }}{{ $n > 1 ? ' (opcional)' : '' }}</label>
                            <div x-show="preview" class="mb-2">
                                <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                                <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                            </div>
                            @if(!empty($content[$key]))
                            <div x-show="!preview" class="mb-2">
                                <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                     class="h-24 w-full rounded-xl object-cover border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                   class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FAQ ── --}}
        <div x-show="tab === 'faq'" x-cloak>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h3 class="font-serif text-xl text-olive-900 font-semibold border-b border-gray-100 pb-4">
                    Sección "Preguntas Frecuentes"
                </h3>
                <p class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                    Fotos de la sección
                    @if($showNew)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 border border-gold-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse inline-block"></span>Nuevo
                    </span>
                    @endif
                </p>
                <p class="text-sm text-gray-500">Agrega hasta 3 fotos de referencia que aparecerán encima del acordeón de preguntas.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([1 => 'faq_image_1', 2 => 'faq_image_2', 3 => 'faq_image_3'] as $n => $key)
                    <div x-data="{ preview: null }">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Foto {{ $n }}{{ $n > 1 ? ' (opcional)' : '' }}</label>
                        <div x-show="preview" class="mb-2">
                            <img :src="preview" class="h-24 w-full rounded-xl object-cover border-2 border-gold-300">
                            <p class="text-xs text-gold-600 mt-1">Vista previa — aún no guardada</p>
                        </div>
                        @if(!empty($content[$key]))
                        <div x-show="!preview" class="mb-2">
                            <img src="{{ asset('storage/' . ltrim($content[$key], '/')) }}"
                                 class="h-24 w-full rounded-xl object-cover border border-gray-200">
                            <p class="text-xs text-gray-400 mt-1">Imagen actual</p>
                        </div>
                        @endif
                        <input type="file" name="{{ $key }}" accept="image/*"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                               class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cream-100 file:text-olive-800 hover:file:bg-cream-200">
                    </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400">JPG, PNG, WebP. Máx 3 MB. Dejar vacío para mantener la imagen actual.</p>
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
