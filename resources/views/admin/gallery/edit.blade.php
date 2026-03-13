@extends('layouts.admin')

@section('title', 'Editar Imagen')
@section('page-title', 'Editar Imagen de Galería')

@section('content')
<div class="max-w-lg">
    <a href="{{ route('admin.gallery.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-olive-800 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Volver a Galería
    </a>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.gallery.update', ['gallery' => $galleryItem]) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Imagen Actual</label>
                <div class="w-40 h-40 rounded-xl overflow-hidden bg-cream-100 mb-3">
                    <img src="{{ $galleryItem->image_url }}" alt="{{ $galleryItem->alt }}"
                         class="w-full h-full object-cover">
                </div>
                <label class="form-label" for="image">Nueva Imagen (opcional)</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="form-input py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gold-400/20 file:text-olive-800">
            </div>

            <div>
                <label class="form-label" for="caption">Descripción (Caption)</label>
                <input type="text" id="caption" name="caption" value="{{ old('caption', $galleryItem->caption) }}"
                       class="form-input">
            </div>

            <div>
                <label class="form-label" for="alt">Texto Alternativo (Alt)</label>
                <input type="text" id="alt" name="alt" value="{{ old('alt', $galleryItem->alt) }}"
                       class="form-input">
            </div>

            <div>
                <label class="form-label" for="order">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', $galleryItem->order) }}"
                       min="0" class="form-input w-32">
            </div>

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                <span class="text-sm font-medium text-olive-800">Visible en la galería</span>
            </label>

            <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">Guardar Cambios</button>
                <a href="{{ route('admin.gallery.index') }}" class="admin-btn-secondary px-8 py-3">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
