@extends('layouts.admin')

@section('title', 'Editar: ' . $category->name)
@section('page-title', 'Editar Categoría')

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
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label" for="name">Nombre *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                       class="form-input" required>
            </div>

            <div>
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3"
                          class="form-input">{{ old('description', $category->description) }}</textarea>
            </div>

            <div>
                <label class="form-label" for="order">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', $category->order) }}"
                       min="0" class="form-input w-32">
            </div>

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-gold-400 focus:ring-gold-400">
                <span class="text-sm font-medium text-olive-800">Activa</span>
            </label>

            <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary px-8 py-3">Guardar Cambios</button>
                <a href="{{ route('admin.categories.index') }}" class="admin-btn-secondary px-8 py-3">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
