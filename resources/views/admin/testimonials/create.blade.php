@extends('layouts.admin')
@section('title', 'Añadir Testimonio')
@section('page-title', 'Añadir Testimonio')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nombre del cliente *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Producto comprado</label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}"
                           class="form-input" placeholder="Dije dorado corazón">
                </div>
            </div>

            <div>
                <label class="form-label">Testimonio *</label>
                <textarea name="text" rows="4" class="form-input" required
                          placeholder="Escribe aquí el comentario del cliente...">{{ old('text') }}</textarea>
                @error('text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Foto del cliente (opcional)</label>
                <input type="file" name="image" accept="image/*" class="form-input">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Orden de aparición</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="form-input">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_visible" value="0">
                        <input type="checkbox" id="is_visible" name="is_visible" value="1"
                               {{ old('is_visible', '1') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-champagne-500 focus:ring-champagne-500">
                        <label for="is_visible" class="text-sm font-medium text-gray-700">Visible en web</label>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="admin-btn-primary">Añadir testimonio</button>
                <a href="{{ route('admin.testimonials.index') }}" class="admin-btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
