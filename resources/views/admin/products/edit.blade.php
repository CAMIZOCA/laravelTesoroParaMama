@extends('layouts.admin')

@section('title', 'Editar: ' . $product->name)
@section('page-title', 'Editar Producto')

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
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label class="form-label" for="name">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                           class="form-input" required>
                </div>

                <div>
                    <label class="form-label" for="category_id">Categoría</label>
                    <select id="category_id" name="category_id" class="form-input">
                        <option value="">Sin categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label" for="badge">Etiqueta (Badge)</label>
                    <input type="text" id="badge" name="badge" value="{{ old('badge', $product->badge) }}"
                           class="form-input" placeholder="Más popular, Nuevo...">
                </div>

                <div>
                    <label class="form-label" for="price">Precio *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                               step="0.01" min="0" class="form-input pl-7" required>
                    </div>
                </div>

                <div>
                    <label class="form-label" for="original_price">Precio Original</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" id="original_price" name="original_price"
                               value="{{ old('original_price', $product->original_price) }}"
                               step="0.01" min="0" class="form-input pl-7">
                    </div>
                </div>
            </div>

            <div>
                <label class="form-label" for="short_description">Descripción Corta</label>
                <input type="text" id="short_description" name="short_description"
                       value="{{ old('short_description', $product->short_description) }}"
                       class="form-input" maxlength="500">
            </div>

            <div>
                <label class="form-label" for="description">Descripción Completa</label>
                <textarea id="description" name="description" rows="4"
                          class="form-input">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="form-label" for="includes">Contenido del Kit (uno por línea)</label>
                <textarea id="includes" name="includes" rows="6"
                          class="form-input font-mono text-sm">{{ old('includes', $includesText) }}</textarea>
            </div>


            {{-- Stock --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="stock">Stock disponible</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                           min="0" class="form-input" placeholder="Vacío = ilimitado">
                    <p class="text-xs text-gray-400 mt-1">Déjalo vacío para stock ilimitado</p>
                </div>
            </div>

            {{-- Variants --}}
            <div x-data="{
                variants: {{ json_encode(old('variant_data', $product->variants ?? [])) }},
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

            <div>
                <label class="form-label">Imagen Actual</label>
                @if($product->image)
                    <div class="mb-3 w-32 h-32 rounded-xl overflow-hidden bg-cream-100">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <label class="form-label" for="image">Nueva Imagen (opcional)</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="form-input py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gold-400/20 file:text-olive-800">
            </div>

            <div>
                <label class="form-label" for="order">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', $product->order) }}"
                       min="0" class="form-input w-32">
            </div>

            <div class="flex flex-wrap gap-6 pt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm font-medium text-olive-800">Activo</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm font-medium text-olive-800">Destacado</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Cambios
                </button>
                <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary px-8 py-3">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
