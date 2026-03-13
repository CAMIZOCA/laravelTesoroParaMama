@extends('layouts.admin')

@section('title', 'Nueva Categoría')
@section('page-title', 'Nueva Categoría')

@section('content')
<div class="max-w-lg">
    <a href="{{ route('admin.categories.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-olive-800 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Volver a Categorías
    </a>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="form-label" for="name">Nombre *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="form-input" placeholder="Collares, Pulseras, Dijes..." required>
            </div>

            <div>
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3"
                          class="form-input">{{ old('description') }}</textarea>
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
                <span class="text-sm font-medium text-olive-800">Activa</span>
            </label>

            <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">Crear Categoría</button>
                <a href="{{ route('admin.categories.index') }}" class="admin-btn-secondary px-8 py-3">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
