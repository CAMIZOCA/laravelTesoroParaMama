@extends('layouts.admin')
@section('title', 'Editar Testimonio')
@section('page-title', 'Editar Testimonio')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nombre del cliente *</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="form-input" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Producto comprado</label>
                    <input type="text" name="product_name" value="{{ old('product_name', $testimonial->product_name) }}" class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Testimonio *</label>
                <textarea name="text" rows="4" class="form-input" required>{{ old('text', $testimonial->text) }}</textarea>
                @error('text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Foto del cliente</label>
                @if($testimonial->image)
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt=""
                         class="w-12 h-12 rounded-full object-cover">
                    <p class="text-xs text-gray-400">Imagen actual</p>
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="form-input">
                <p class="text-xs text-gray-400 mt-1">Deja vacío para mantener la imagen actual.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Orden</label>
                    <input type="number" name="order" value="{{ old('order', $testimonial->order) }}" min="0" class="form-input">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_visible" value="0">
                        <input type="checkbox" id="is_visible" name="is_visible" value="1"
                               {{ old('is_visible', $testimonial->is_visible) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-champagne-500 focus:ring-champagne-500">
                        <label for="is_visible" class="text-sm font-medium text-gray-700">Visible en web</label>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="admin-btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.testimonials.index') }}" class="admin-btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
