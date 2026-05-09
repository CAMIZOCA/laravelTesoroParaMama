@extends('layouts.admin')
@section('title', 'Nueva Embajadora')
@section('page-title', 'Nueva Embajadora')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.ambassadors.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Apellido</label>
                    <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input"
                       placeholder="Se usará para notificarle de ventas">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Código de embajadora *</label>
                <input type="text" name="code" value="{{ old('code') }}" class="form-input font-mono uppercase"
                       placeholder="MASLACTANCIA" style="text-transform:uppercase" required>
                <p class="text-xs text-gray-400 mt-1">Se guardará en mayúsculas automáticamente.</p>
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Tipo de descuento *</label>
                    <select name="discount_type" class="form-input">
                        <option value="percent" {{ old('discount_type') === 'percent' ? 'selected' : '' }}>Porcentaje (%)</option>
                        <option value="fixed"   {{ old('discount_type') === 'fixed'   ? 'selected' : '' }}>Valor fijo ($)</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Valor del descuento *</label>
                    <input type="number" name="discount_value" value="{{ old('discount_value', 0) }}"
                           step="0.01" min="0" class="form-input" required>
                    @error('discount_value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="form-label">Notas internas</label>
                <textarea name="notes" rows="2" class="form-input">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', '1') ? 'checked' : '' }}
                       class="rounded border-gray-300 text-champagne-500 focus:ring-champagne-500">
                <label for="is_active" class="text-sm font-medium text-gray-700">Activa</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="admin-btn-primary">Crear embajadora</button>
                <a href="{{ route('admin.ambassadors.index') }}" class="admin-btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
