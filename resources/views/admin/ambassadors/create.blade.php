@extends('layouts.admin')

@section('title', 'Nueva embajadora')
@section('page-title', 'Nueva embajadora')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.ambassadors.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="name">Nombre *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="form-input" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label" for="last_name">Apellido</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                           class="form-input">
                    @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="form-input" placeholder="embajadora@email.com">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label" for="code">Código *</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}"
                       class="form-input uppercase font-mono" placeholder="Ej: MASLACTANCIA"
                       style="text-transform:uppercase" required>
                <p class="text-xs text-gray-400 mt-1">Se guardará en mayúsculas automáticamente.</p>
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="discount_type">Tipo de descuento *</label>
                    <select id="discount_type" name="discount_type" class="form-input" required>
                        <option value="percentage" {{ old('discount_type', 'percentage') === 'percentage' ? 'selected' : '' }}>Porcentaje (%)</option>
                        <option value="fixed"      {{ old('discount_type') === 'fixed'      ? 'selected' : '' }}>Valor fijo ($)</option>
                    </select>
                    @error('discount_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label" for="discount_value">Valor del descuento *</label>
                    <input type="number" id="discount_value" name="discount_value"
                           value="{{ old('discount_value', 10) }}" min="0" step="0.01"
                           class="form-input" required>
                    @error('discount_value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="form-label" for="status">Estado *</label>
                <select id="status" name="status" class="form-input" required>
                    <option value="active"   {{ old('status', 'active') === 'active'   ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="admin-btn-primary px-6 py-2">Crear embajadora</button>
                <a href="{{ route('admin.ambassadors.index') }}" class="admin-btn-secondary px-6 py-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
