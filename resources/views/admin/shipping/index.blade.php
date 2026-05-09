@extends('layouts.admin')
@section('title', 'Envíos y WhatsApp')
@section('page-title', 'Envíos y WhatsApp')

@section('content')
<form method="POST" action="{{ route('admin.shipping.update') }}" class="space-y-6 max-w-3xl">
    @csrf

    <div class="admin-card">
        <h2 class="font-semibold text-gray-900 mb-5 text-base">Número de WhatsApp</h2>
        <div>
            <label class="form-label">Número de WhatsApp (con código de país)</label>
            <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] }}"
                   class="form-input" placeholder="+593988888888">
            <p class="text-xs text-gray-400 mt-1">
                Incluye el código de país sin espacios ni guiones. Ej: <code>+593988888888</code>.
                Si está vacío, los botones de WhatsApp no aparecerán.
            </p>
            @error('whatsapp_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="admin-card">
        <h2 class="font-semibold text-gray-900 mb-5 text-base">Costos de envío</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="form-label">Costo — Quito ($)</label>
                <input type="number" name="shipping_cost_quito" value="{{ $settings['shipping_cost_quito'] }}"
                       step="0.01" min="0" class="form-input">
                <p class="text-xs text-gray-400 mt-1">Poner 0 para envío gratis.</p>
                @error('shipping_cost_quito') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Costo — Provincias Ecuador ($)</label>
                <input type="number" name="shipping_cost_provinces" value="{{ $settings['shipping_cost_provinces'] }}"
                       step="0.01" min="0" class="form-input">
                @error('shipping_cost_provinces') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="admin-card">
        <h2 class="font-semibold text-gray-900 mb-5 text-base">Mensajes de envío</h2>
        <div class="space-y-4">
            <div>
                <label class="form-label">Mensaje — Quito</label>
                <input type="text" name="shipping_quito" value="{{ $settings['shipping_quito'] }}" class="form-input">
                @error('shipping_quito') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Mensaje — Provincias</label>
                <input type="text" name="shipping_provinces" value="{{ $settings['shipping_provinces'] }}" class="form-input">
                @error('shipping_provinces') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Mensaje — Galápagos</label>
                <input type="text" name="shipping_galapagos" value="{{ $settings['shipping_galapagos'] }}" class="form-input">
                @error('shipping_galapagos') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Mensaje — Internacional</label>
                <input type="text" name="shipping_international" value="{{ $settings['shipping_international'] }}" class="form-input">
                @error('shipping_international') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="admin-btn-primary">Guardar configuración</button>
    </div>
</form>
@endsection
