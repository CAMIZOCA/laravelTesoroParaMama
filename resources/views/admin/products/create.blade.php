@extends('layouts.admin')

@section('title', 'Nuevo Producto')
@section('page-title', 'Nuevo Producto')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.products.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-olive-800 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Volver a Productos
    </a>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="sm:col-span-2">
                    <label class="form-label" for="name">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="form-input" placeholder="Kit Collar Básico" required>
                </div>

                <!-- Category -->
                <div>
                    <label class="form-label" for="category_id">Categoría</label>
                    <select id="category_id" name="category_id" class="form-input">
                        <option value="">Sin categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Badge -->
                <div>
                    <label class="form-label" for="badge">Etiqueta (Badge)</label>
                    <input type="text" id="badge" name="badge" value="{{ old('badge') }}"
                           class="form-input" placeholder="Más popular, Nuevo...">
                </div>

                <!-- Price -->
                <div>
                    <label class="form-label" for="price">Precio *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" id="price" name="price" value="{{ old('price') }}"
                               step="0.01" min="0" class="form-input pl-7" placeholder="0.00" required>
                    </div>
                </div>

                <!-- Original Price -->
                <div>
                    <label class="form-label" for="original_price">Precio Original (antes del descuento)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" id="original_price" name="original_price" value="{{ old('original_price') }}"
                               step="0.01" min="0" class="form-input pl-7" placeholder="0.00">
                    </div>
                </div>
            </div>

            <!-- Short description -->
            <div>
                <label class="form-label" for="short_description">Descripción Corta</label>
                <input type="text" id="short_description" name="short_description"
                       value="{{ old('short_description') }}"
                       class="form-input" placeholder="Breve descripción que aparece en la tarjeta del producto" maxlength="500">
                <p class="text-xs text-gray-400 mt-1">Máximo 500 caracteres</p>
            </div>

            <!-- Description -->
            <div>
                <label class="form-label" for="description">Descripción Completa</label>
                <textarea id="description" name="description" rows="4"
                          class="form-input" placeholder="Descripción detallada del producto...">{{ old('description') }}</textarea>
            </div>

            <!-- Includes -->
            <div>
                <label class="form-label" for="includes">Contenido del Kit (uno por línea)</label>
                <textarea id="includes" name="includes" rows="6"
                          class="form-input font-mono text-sm"
                          placeholder="Resina epóxica transparente&#10;Catalizador&#10;Molde de silicona para dije&#10;Pigmentos nacarados&#10;Guantes de látex&#10;Instrucciones paso a paso">{{ old('includes') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Escribe cada elemento incluido en una línea separada</p>
            </div>


            <!-- Stock -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="stock">Stock disponible</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                           min="0" class="form-input" placeholder="Vacío = ilimitado">
                    <p class="text-xs text-gray-400 mt-1">Déjalo vacío para stock ilimitado</p>
                </div>
            </div>

            <!-- Variants -->
            <div x-data="{
                variants: [],
                addVariant() { this.variants.push({ name: '', price: '' }) },
                removeVariant(i) { this.variants.splice(i, 1) }
            }">
                <div class="flex items-center justify-between mb-2">
                    <label class="form-label mb-0">Variantes (Ej: Dorado, Plateado)</label>
                    <button type="button" @click="addVariant()"
                            class="text-xs text-gold-600 hover:text-gold-800 font-medium flex items-center gap-1 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Agregar variante
                    </button>
                </div>

                <template x-if="variants.length === 0">
                    <p class="text-sm text-gray-400 italic">Sin variantes — el precio base se usará directamente.</p>
                </template>

                <div class="space-y-3">
                    <template x-for="(v, i) in variants" :key="i">
                        <div class="flex items-center gap-3">
                            <input type="text" :name="'variant_names[' + i + ']'"
                                   x-model="v.name" class="form-input flex-1" placeholder="Ej: Colgante Dorado">
                            <div class="relative w-32 flex-shrink-0">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">$</span>
                                <input type="number" :name="'variant_prices[' + i + ']'"
                                       x-model="v.price" step="0.01" min="0" class="form-input pl-7" placeholder="0.00">
                            </div>
                            <button type="button" @click="removeVariant(i)"
                                    class="text-gray-300 hover:text-red-400 transition-colors flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <p class="text-xs text-gray-400 mt-2">Si hay variantes, el precio base se ignora en la tienda pública.</p>
            </div>

            <!-- Image -->
            <div>
                <label class="form-label" for="image">Imagen Principal</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="form-input py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gold-400/20 file:text-olive-800 hover:file:bg-gold-400/30">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF — máximo 2MB</p>
            </div>

            <!-- Order -->
            <div>
                <label class="form-label" for="order">Orden de aparición</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                       min="0" class="form-input w-32">
                <p class="text-xs text-gray-400 mt-1">Número menor aparece primero</p>
            </div>

            <!-- Toggles -->
            <div class="flex flex-wrap gap-6 pt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', '1') ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm font-medium text-olive-800">Activo (visible en el sitio)</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm font-medium text-olive-800">Producto Destacado</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Crear Producto
                </button>
                <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary px-8 py-3">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
