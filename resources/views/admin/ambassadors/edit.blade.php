@extends('layouts.admin')
@section('title', 'Editar Embajadora')
@section('page-title', 'Editar Embajadora')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.ambassadors.update', $ambassador) }}" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $ambassador->name) }}" class="form-input" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Apellido</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $ambassador->lastname) }}" class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $ambassador->email) }}" class="form-input">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Código *</label>
                <input type="text" name="code" value="{{ old('code', $ambassador->code) }}"
                       class="form-input font-mono uppercase" style="text-transform:uppercase" required>
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Tipo de descuento *</label>
                    <select name="discount_type" class="form-input">
                        <option value="percent" {{ old('discount_type', $ambassador->discount_type) === 'percent' ? 'selected' : '' }}>Porcentaje (%)</option>
                        <option value="fixed"   {{ old('discount_type', $ambassador->discount_type) === 'fixed'   ? 'selected' : '' }}>Valor fijo ($)</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Valor del descuento *</label>
                    <input type="number" name="discount_value" value="{{ old('discount_value', $ambassador->discount_value) }}"
                           step="0.01" min="0" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Notas internas</label>
                <textarea name="notes" rows="2" class="form-input">{{ old('notes', $ambassador->notes) }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $ambassador->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-champagne-500 focus:ring-champagne-500">
                <label for="is_active" class="text-sm font-medium text-gray-700">Activa</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="admin-btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.ambassadors.index') }}" class="admin-btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
