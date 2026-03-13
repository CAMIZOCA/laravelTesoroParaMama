@extends('layouts.admin')

@section('title', 'Agregar Imagen')
@section('page-title', 'Agregar Imagen a Galería')

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
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="form-label" for="image">Imagen *</label>
                <input type="file" id="image" name="image" accept="image/*" required
                       class="form-input py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gold-400/20 file:text-olive-800">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF — máximo 2MB</p>
            </div>

            <div>
                <label class="form-label" for="caption">Descripción (Caption)</label>
                <input type="text" id="caption" name="caption" value="{{ old('caption') }}"
                       class="form-input" placeholder="Un vínculo irrompible">
            </div>

            <div>
                <label class="form-label" for="alt">Texto Alternativo (Alt)</label>
                <input type="text" id="alt" name="alt" value="{{ old('alt') }}"
                       class="form-input" placeholder="Descripción para accesibilidad">
            </div>

            <div>
                <label class="form-label" for="order">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                       min="0" class="form-input w-32">
            </div>

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', '1') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                <span class="text-sm font-medium text-olive-800">Visible en la galería</span>
            </label>

            <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">Agregar Imagen</button>
                <a href="{{ route('admin.gallery.index') }}" class="admin-btn-secondary px-8 py-3">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
