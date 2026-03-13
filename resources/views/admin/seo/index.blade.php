@extends('layouts.admin')

@section('title', 'SEO')
@section('page-title', 'Configuración SEO')

@section('content')
<div class="max-w-4xl">

    {{-- Tabs --}}
    <div x-data="{ tab: 'basic' }" class="space-y-6">
        <div class="flex flex-wrap gap-1 bg-gray-100 rounded-xl p-1">
            @php
                $tabs = [
                    'basic'    => ['label' => 'General',       'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    'social'   => ['label' => 'Redes Sociales', 'icon' => 'M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z'],
                    'tracking' => ['label' => 'Analytics',     'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    'schema'   => ['label' => 'Schema.org',    'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                    'advanced' => ['label' => 'Avanzado',      'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
            @endphp
            @foreach($tabs as $key => $tab)
            <button @click="tab = '{{ $key }}'"
                    :class="tab === '{{ $key }}' ? 'bg-white text-olive-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex-1 justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"/>
                </svg>
                <span class="hidden sm:inline">{{ $tab['label'] }}</span>
            </button>
            @endforeach
        </div>

        <form method="POST" action="{{ route('admin.seo.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- ══════════════════════════════════════
                 TAB: GENERAL
            ══════════════════════════════════════ --}}
            <div x-show="tab === 'basic'" class="space-y-5">
                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Información General
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="form-label" for="site_name">
                                Nombre del Sitio
                                <span class="text-xs text-gray-400 font-normal ml-1">Aparece en resultados de búsqueda</span>
                            </label>
                            <input type="text" id="site_name" name="site_name"
                                   value="{{ old('site_name', $seo['site_name']) }}"
                                   class="form-input" maxlength="100">
                        </div>

                        <div>
                            <label class="form-label" for="meta_title">
                                Meta Title
                                <span class="text-xs text-gray-400 font-normal ml-1">Máximo 60 caracteres recomendado</span>
                            </label>
                            <input type="text" id="meta_title" name="meta_title"
                                   value="{{ old('meta_title', $seo['meta_title']) }}"
                                   class="form-input" maxlength="70"
                                   x-data x-on:input="$el.nextElementSibling.querySelector('span').textContent = $el.value.length">
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-400">El título que aparece en Google y en la pestaña del navegador</p>
                                <p class="text-xs text-gray-400"><span>{{ strlen($seo['meta_title']) }}</span>/70</p>
                            </div>
                            {{-- Preview --}}
                            <div class="mt-3 bg-gray-50 rounded-lg p-3 border border-gray-100">
                                <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">Vista previa en Google</p>
                                <p class="text-blue-600 text-sm font-medium leading-snug line-clamp-1" id="preview_title">{{ $seo['meta_title'] }}</p>
                                <p class="text-green-700 text-xs mt-0.5">{{ url('/') }}</p>
                                <p class="text-gray-500 text-xs mt-0.5 line-clamp-2" id="preview_desc">{{ $seo['meta_description'] }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="form-label" for="meta_description">
                                Meta Description
                                <span class="text-xs text-gray-400 font-normal ml-1">Máximo 160 caracteres</span>
                            </label>
                            <textarea id="meta_description" name="meta_description" rows="3"
                                      class="form-input" maxlength="160"
                                      x-data x-on:input="document.getElementById('preview_desc').textContent = $el.value; $el.nextElementSibling.querySelector('span').textContent = $el.value.length">{{ old('meta_description', $seo['meta_description']) }}</textarea>
                            <div class="flex justify-end mt-1">
                                <p class="text-xs text-gray-400"><span>{{ strlen($seo['meta_description']) }}</span>/160</p>
                            </div>
                        </div>

                        <div>
                            <label class="form-label" for="meta_keywords">
                                Palabras Clave (Keywords)
                                <span class="text-xs text-gray-400 font-normal ml-1">Separadas por coma</span>
                            </label>
                            <input type="text" id="meta_keywords" name="meta_keywords"
                                   value="{{ old('meta_keywords', $seo['meta_keywords']) }}"
                                   class="form-input"
                                   placeholder="joyería leche materna, kit DIY, collar lactancia">
                            <p class="text-xs text-gray-400 mt-1">Aunque Google no los usa directamente, otros motores sí</p>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> URL Canónica
                    </h3>
                    <div>
                        <label class="form-label" for="canonical_url">URL Canónica Base</label>
                        <input type="url" id="canonical_url" name="canonical_url"
                               value="{{ old('canonical_url', $seo['canonical_url']) }}"
                               class="form-input" placeholder="https://untesoroparamama.com">
                        <p class="text-xs text-gray-400 mt-1">Dejar vacío para usar la URL actual automáticamente. Útil si tienes múltiples dominios.</p>
                    </div>
                </div>

                {{-- SEO Score indicator --}}
                @php
                    $score = 0;
                    if(strlen($seo['meta_title']) >= 30 && strlen($seo['meta_title']) <= 60) $score += 25;
                    if(strlen($seo['meta_description']) >= 120 && strlen($seo['meta_description']) <= 155) $score += 25;
                    if(!empty($seo['meta_keywords'])) $score += 10;
                    if(!empty($seo['og_image'])) $score += 20;
                    if(!empty($seo['google_analytics_id']) || !empty($seo['google_tag_manager_id'])) $score += 20;
                @endphp
                <div class="admin-card bg-gradient-to-r from-olive-900 to-olive-800 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-semibold text-cream-50">Puntuación SEO</h4>
                        <span class="text-2xl font-bold text-gold-400">{{ $score }}%</span>
                    </div>
                    <div class="w-full bg-olive-700 rounded-full h-2.5">
                        <div class="bg-gold-400 h-2.5 rounded-full transition-all duration-500" style="width: {{ $score }}%"></div>
                    </div>
                    <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center gap-1.5 {{ strlen($seo['meta_title']) >= 30 && strlen($seo['meta_title']) <= 60 ? 'text-green-300' : 'text-red-300' }}">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                @if(strlen($seo['meta_title']) >= 30 && strlen($seo['meta_title']) <= 60)
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                @else
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            Título (30-60 chars)
                        </div>
                        <div class="flex items-center gap-1.5 {{ strlen($seo['meta_description']) >= 120 && strlen($seo['meta_description']) <= 155 ? 'text-green-300' : 'text-red-300' }}">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                @if(strlen($seo['meta_description']) >= 120 && strlen($seo['meta_description']) <= 155)
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                @else
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            Descripción (120-155 chars)
                        </div>
                        <div class="flex items-center gap-1.5 {{ !empty($seo['og_image']) ? 'text-green-300' : 'text-red-300' }}">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                @if(!empty($seo['og_image']))
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                @else
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            Imagen OG definida
                        </div>
                        <div class="flex items-center gap-1.5 {{ (!empty($seo['google_analytics_id']) || !empty($seo['google_tag_manager_id'])) ? 'text-green-300' : 'text-red-300' }}">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                @if(!empty($seo['google_analytics_id']) || !empty($seo['google_tag_manager_id']))
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                @else
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            Analytics configurado
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB: REDES SOCIALES (Open Graph)
            ══════════════════════════════════════ --}}
            <div x-show="tab === 'social'" class="space-y-5" style="display:none">
                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Open Graph (Facebook, WhatsApp, LinkedIn)
                    </h3>
                    <p class="text-xs text-gray-500 mb-5 bg-blue-50 border border-blue-100 rounded-lg px-4 py-3">
                        Estos datos controlan cómo se ve el enlace cuando se comparte en redes sociales y aplicaciones de mensajería.
                    </p>

                    <div class="space-y-4">
                        <div>
                            <label class="form-label" for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title"
                                   value="{{ old('og_title', $seo['og_title']) }}"
                                   class="form-input" maxlength="95"
                                   placeholder="Dejar vacío para usar el Meta Title">
                            <p class="text-xs text-gray-400 mt-1">Máximo 95 caracteres. Se usará el Meta Title si se deja vacío.</p>
                        </div>

                        <div>
                            <label class="form-label" for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                      class="form-input" maxlength="200"
                                      placeholder="Dejar vacío para usar la Meta Description">{{ old('og_description', $seo['og_description']) }}</textarea>
                        </div>

                        <div>
                            <label class="form-label" for="og_image">
                                OG Image
                                <span class="text-xs text-gray-400 font-normal ml-1">Recomendado: 1200×630px</span>
                            </label>
                            @if(!empty($seo['og_image']))
                            <div class="mb-3 relative w-48 h-24 rounded-xl overflow-hidden bg-cream-100 border border-gray-100">
                                <img src="{{ $seo['og_image'] }}" alt="OG Image actual" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <span class="text-white text-xs">Imagen actual</span>
                                </div>
                            </div>
                            @endif
                            <input type="file" id="og_image" name="og_image" accept="image/*"
                                   class="form-input py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gold-400/20 file:text-olive-800">
                            <p class="text-xs text-gray-400 mt-1">Esta imagen aparece al compartir el enlace en WhatsApp, Facebook, etc. Máximo 2MB.</p>
                        </div>

                        <div>
                            <label class="form-label" for="og_type">Tipo de Página</label>
                            <select id="og_type" name="og_type" class="form-input">
                                <option value="website"  {{ ($seo['og_type'] ?? 'website') === 'website'  ? 'selected' : '' }}>Website</option>
                                <option value="product"  {{ ($seo['og_type'] ?? '') === 'product'  ? 'selected' : '' }}>Product</option>
                                <option value="article"  {{ ($seo['og_type'] ?? '') === 'article'  ? 'selected' : '' }}>Article</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Twitter / X Card
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="form-label" for="twitter_card">Tipo de Card</label>
                            <select id="twitter_card" name="twitter_card" class="form-input">
                                <option value="summary_large_image" {{ ($seo['twitter_card'] ?? '') === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image (recomendado)</option>
                                <option value="summary"             {{ ($seo['twitter_card'] ?? '') === 'summary'             ? 'selected' : '' }}>Summary</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="twitter_site">Twitter Site (@@usuario)</label>
                                <input type="text" id="twitter_site" name="twitter_site"
                                       value="{{ old('twitter_site', $seo['twitter_site']) }}"
                                       class="form-input" placeholder="@@untesoroparamama">
                            </div>
                            <div>
                                <label class="form-label" for="twitter_creator">Twitter Creator (@@usuario)</label>
                                <input type="text" id="twitter_creator" name="twitter_creator"
                                       value="{{ old('twitter_creator', $seo['twitter_creator']) }}"
                                       class="form-input" placeholder="@@untesoroparamama">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB: ANALYTICS
            ══════════════════════════════════════ --}}
            <div x-show="tab === 'tracking'" class="space-y-5" style="display:none">
                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Google
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-amber-50 border border-amber-100 rounded-lg px-4 py-3 text-xs text-amber-800">
                            <strong>Nota:</strong> Si usas Google Tag Manager, no es necesario configurar Google Analytics por separado — GTM puede incluirlo.
                        </div>

                        <div>
                            <label class="form-label" for="google_tag_manager_id">
                                Google Tag Manager ID
                                <span class="text-xs text-gray-400 font-normal ml-1">Recomendado</span>
                            </label>
                            <input type="text" id="google_tag_manager_id" name="google_tag_manager_id"
                                   value="{{ old('google_tag_manager_id', $seo['google_tag_manager_id']) }}"
                                   class="form-input font-mono" placeholder="GTM-XXXXXXX">
                            <p class="text-xs text-gray-400 mt-1">Gestiona todos los scripts desde Google Tag Manager. Formato: GTM-XXXXXXX</p>
                        </div>

                        <div>
                            <label class="form-label" for="google_analytics_id">
                                Google Analytics 4 ID
                                <span class="text-xs text-gray-400 font-normal ml-1">Solo si no usas GTM</span>
                            </label>
                            <input type="text" id="google_analytics_id" name="google_analytics_id"
                                   value="{{ old('google_analytics_id', $seo['google_analytics_id']) }}"
                                   class="form-input font-mono" placeholder="G-XXXXXXXXXX">
                            <p class="text-xs text-gray-400 mt-1">Formato: G-XXXXXXXXXX</p>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Meta (Facebook & Instagram)
                    </h3>
                    <div>
                        <label class="form-label" for="facebook_pixel_id">Facebook Pixel ID</label>
                        <input type="text" id="facebook_pixel_id" name="facebook_pixel_id"
                               value="{{ old('facebook_pixel_id', $seo['facebook_pixel_id']) }}"
                               class="form-input font-mono" placeholder="XXXXXXXXXXXXXXXXXX">
                        <p class="text-xs text-gray-400 mt-1">Permite rastrear conversiones de tus anuncios de Facebook e Instagram.</p>
                    </div>
                </div>

                {{-- Quick links --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([
                        ['label' => 'Google Search Console', 'url' => 'https://search.google.com/search-console', 'color' => 'blue'],
                        ['label' => 'Google Analytics',      'url' => 'https://analytics.google.com', 'color' => 'orange'],
                        ['label' => 'Meta Business Suite',   'url' => 'https://business.facebook.com', 'color' => 'indigo'],
                    ] as $tool)
                    <a href="{{ $tool['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center gap-3 admin-card hover:shadow-md transition-shadow p-4">
                        <div class="w-8 h-8 rounded-lg bg-{{ $tool['color'] }}-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-{{ $tool['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-olive-800">{{ $tool['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB: SCHEMA.ORG
            ══════════════════════════════════════ --}}
            <div x-show="tab === 'schema'" class="space-y-5" style="display:none">
                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-2 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Datos Estructurados (Schema.org)
                    </h3>
                    <p class="text-xs text-gray-500 mb-5 bg-green-50 border border-green-100 rounded-lg px-4 py-3">
                        Los datos estructurados ayudan a Google a entender mejor tu negocio y pueden generar <strong>rich snippets</strong> en los resultados de búsqueda (estrellas, teléfono, dirección, etc.).
                    </p>

                    <div class="space-y-4">
                        <div>
                            <label class="form-label" for="schema_phone">Teléfono / WhatsApp</label>
                            <input type="text" id="schema_phone" name="schema_phone"
                                   value="{{ old('schema_phone', $seo['schema_phone']) }}"
                                   class="form-input" placeholder="+593 999 829 469">
                        </div>
                        <div>
                            <label class="form-label" for="schema_email">Email de Contacto</label>
                            <input type="email" id="schema_email" name="schema_email"
                                   value="{{ old('schema_email', $seo['schema_email'] ?? '') }}"
                                   class="form-input" placeholder="hola@untesoroparamama.com">
                        </div>
                        <div>
                            <label class="form-label" for="schema_address">
                                Ciudad / Dirección
                                <span class="text-xs text-gray-400 font-normal ml-1">Aparece en Google Maps Knowledge Panel</span>
                            </label>
                            <input type="text" id="schema_address" name="schema_address"
                                   value="{{ old('schema_address', $seo['schema_address'] ?? '') }}"
                                   class="form-input" placeholder="Quito, Ecuador">
                        </div>
                    </div>

                    {{-- JSON-LD preview --}}
                    <div class="mt-6">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Vista previa del JSON-LD generado</p>
                        <pre class="bg-gray-900 text-green-400 rounded-xl p-4 text-xs overflow-x-auto leading-relaxed font-mono">{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "{{ $seo['site_name'] }}",
  "description": "{{ \Illuminate\Support\Str::limit($seo['meta_description'], 80) }}",
  "telephone": "{{ $seo['schema_phone'] ?? '' }}",
  "email": "{{ $seo['schema_email'] ?? '' }}",
  "address": {
    "@@type": "PostalAddress",
    "addressLocality": "{{ $seo['schema_address'] ?? '' }}"
  }
}</pre>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB: AVANZADO
            ══════════════════════════════════════ --}}
            <div x-show="tab === 'advanced'" class="space-y-5" style="display:none">
                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Archivo robots.txt
                    </h3>
                    <p class="text-xs text-gray-500 mb-4 bg-yellow-50 border border-yellow-100 rounded-lg px-4 py-3">
                        Controla qué páginas pueden rastrear los motores de búsqueda.
                        Accesible en <a href="{{ url('/robots.txt') }}" target="_blank" class="text-blue-600 hover:underline">{{ url('/robots.txt') }}</a>
                    </p>
                    <textarea id="robots_txt" name="robots_txt" rows="10"
                              class="form-input font-mono text-sm">{{ old('robots_txt', $seo['robots_txt']) }}</textarea>
                </div>

                <div class="admin-card">
                    <h3 class="font-semibold text-olive-900 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gold-400 rounded-full"></span> Sitemap XML
                    </h3>
                    <p class="text-xs text-gray-500 mb-4">
                        El sitemap se genera automáticamente en
                        <a href="{{ url('/sitemap.xml') }}" target="_blank" class="text-blue-600 hover:underline font-mono">{{ url('/sitemap.xml') }}</a>
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/sitemap.xml') }}" target="_blank"
                           class="admin-btn-secondary text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Ver Sitemap
                        </a>
                        <a href="https://search.google.com/search-console/sitemaps" target="_blank" rel="noopener noreferrer"
                           class="admin-btn-secondary text-xs">
                            Enviar a Google Search Console
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Save button (visible in all tabs) ── --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="admin-btn-primary px-8 py-3 text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Configuración SEO
                </button>
                <span class="text-xs text-gray-400">Los cambios se aplican inmediatamente en el sitio</span>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Live preview update
    const titleInput = document.getElementById('meta_title');
    const descInput  = document.getElementById('meta_description');
    const prevTitle  = document.getElementById('preview_title');
    const prevDesc   = document.getElementById('preview_desc');

    if (titleInput && prevTitle) {
        titleInput.addEventListener('input', () => prevTitle.textContent = titleInput.value);
    }
    if (descInput && prevDesc) {
        descInput.addEventListener('input', () => prevDesc.textContent = descInput.value);
    }
</script>
@endpush
@endsection
