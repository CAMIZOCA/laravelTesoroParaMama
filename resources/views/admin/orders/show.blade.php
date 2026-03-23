@extends('layouts.admin')

@section('title', 'Pedido ' . $order->order_number)
@section('page-title', 'Pedido ' . $order->order_number)

@section('content')
@php
    $statusLabels = ['pending'=>'Pendiente','paid'=>'Pagado','processing'=>'Procesando','shipped'=>'Enviado','delivered'=>'Entregado','cancelled'=>'Cancelado'];
    $statusColors = ['pending'=>'yellow','paid'=>'green','processing'=>'blue','shipped'=>'purple','delivered'=>'emerald','cancelled'=>'red'];
    $color = $statusColors[$order->status] ?? 'gray';
@endphp

<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-olive-800 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Volver a Pedidos
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Main info --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Order Items --}}
        <div class="admin-card">
            <h3 class="font-serif text-lg font-semibold text-olive-900 mb-4">Productos</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                    <div>
                        <p class="font-medium text-olive-900">{{ $item->product_name }}</p>
                        @if($item->variant_name)
                            <p class="text-xs text-gray-500">Variante: {{ $item->variant_name }}</p>
                        @endif
                        <p class="text-xs text-gray-400">Cantidad: {{ $item->quantity }} × ${{ number_format($item->product_price, 2) }}</p>
                    </div>
                    <p class="font-semibold text-olive-900">${{ number_format($item->subtotal, 2) }}</p>
                </div>
                @endforeach
                <div class="flex justify-between pt-3 border-t border-gray-200">
                    <span class="font-semibold text-olive-900">Total</span>
                    <span class="text-xl font-bold text-olive-900">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="admin-card">
            <h3 class="font-serif text-lg font-semibold text-olive-900 mb-4">Datos del cliente</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500 block text-xs uppercase tracking-wide">Nombre</span>{{ $order->customer_name }}</div>
                <div><span class="text-gray-500 block text-xs uppercase tracking-wide">Email</span>{{ $order->customer_email }}</div>
                <div><span class="text-gray-500 block text-xs uppercase tracking-wide">Teléfono</span>{{ $order->customer_phone }}</div>
                <div><span class="text-gray-500 block text-xs uppercase tracking-wide">Ciudad</span>{{ $order->customer_city }}, {{ $order->customer_country }}</div>
                <div class="sm:col-span-2"><span class="text-gray-500 block text-xs uppercase tracking-wide">Dirección</span>{{ $order->customer_address }}</div>
                @if($order->customer_notes)
                <div class="sm:col-span-2"><span class="text-gray-500 block text-xs uppercase tracking-wide">Notas del cliente</span>{{ $order->customer_notes }}</div>
                @endif
            </div>
        </div>

    </div>

    {{-- Sidebar: Status + Update --}}
    <div class="space-y-5">

        {{-- Current Status --}}
        <div class="admin-card">
            <div class="flex items-center gap-3 mb-3">
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-{{ $color }}-100 text-{{ $color }}-700">
                    {{ $statusLabels[$order->status] ?? $order->status }}
                </span>
            </div>
            <p class="text-xs text-gray-400">Pedido: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            @if($order->paid_at)
            <p class="text-xs text-gray-400">Pagado: {{ $order->paid_at->format('d/m/Y H:i') }}</p>
            @endif
            @if($order->shipped_at)
            <p class="text-xs text-gray-400">Enviado: {{ $order->shipped_at->format('d/m/Y H:i') }}</p>
            @endif
            @if($order->tracking_number)
            <p class="text-xs text-gray-600 mt-2 font-medium">Guía: {{ $order->tracking_number }}</p>
            @endif
            @if($order->payphone_transaction_id)
            <p class="text-xs text-gray-300 mt-2 font-mono truncate">TX: {{ $order->payphone_transaction_id }}</p>
            @endif
        </div>

        {{-- Update Form --}}
        <div class="admin-card">
            <h3 class="font-semibold text-olive-900 mb-4">Actualizar pedido</h3>
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-input">
                        @foreach($statusLabels as $key => $label)
                            <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Número de guía (tracking)</label>
                    <input type="text" name="tracking_number" value="{{ $order->tracking_number }}"
                           class="form-input" placeholder="Ej: EC123456789">
                </div>

                <div>
                    <label class="form-label">Notas internas</label>
                    <textarea name="admin_notes" rows="3" class="form-input"
                              placeholder="Notas visibles solo para el admin...">{{ $order->admin_notes }}</textarea>
                </div>

                <button type="submit" class="admin-btn-primary w-full justify-center py-2.5">
                    Guardar cambios
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
