@extends('layouts.admin')
@section('title', 'Reporte — ' . $ambassador->fullName())
@section('page-title', 'Reporte: ' . $ambassador->fullName())

@section('content')

{{-- Filtro mes/año --}}
<div class="flex flex-wrap items-center gap-4 mb-6">
    <form method="GET" action="{{ route('admin.ambassadors.report', $ambassador) }}" class="flex items-center gap-3">
        <select name="month" class="form-input w-auto text-sm py-2">
            @foreach($months as $num => $name)
            <option value="{{ $num }}" {{ $month === $num ? 'selected' : '' }}>{{ ucfirst($name) }}</option>
            @endforeach
        </select>
        <select name="year" class="form-input w-auto text-sm py-2">
            @for($y = now()->year; $y >= now()->year - 3; $y--)
            <option value="{{ $y }}" {{ $year === $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button type="submit" class="admin-btn-primary text-sm px-4 py-2">Ver</button>
    </form>
    <a href="{{ route('admin.ambassadors.index') }}" class="admin-btn-secondary text-sm">← Volver</a>
</div>

{{-- Resumen --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="admin-card text-center">
        <p class="text-3xl font-serif font-bold text-taupe-900">{{ $totalOrders }}</p>
        <p class="text-sm text-gray-500 mt-1">Ventas del mes</p>
    </div>
    <div class="admin-card text-center">
        <p class="text-3xl font-serif font-bold text-taupe-900">${{ number_format($totalSales, 2) }}</p>
        <p class="text-sm text-gray-500 mt-1">Total facturado</p>
    </div>
    <div class="admin-card text-center">
        <p class="text-3xl font-serif font-bold text-champagne-500">${{ number_format($totalDiscount, 2) }}</p>
        <p class="text-sm text-gray-500 mt-1">Descuento aplicado</p>
    </div>
</div>

{{-- Código & config --}}
<div class="admin-card mb-6 flex flex-wrap items-center gap-6 text-sm">
    <div>
        <p class="text-xs text-gray-400 mb-1">Código</p>
        <code class="bg-gray-100 text-gray-800 px-3 py-1 rounded font-mono text-base">{{ $ambassador->code }}</code>
    </div>
    <div>
        <p class="text-xs text-gray-400 mb-1">Descuento</p>
        <p class="font-medium">
            @if($ambassador->discount_type === 'percent')
                {{ $ambassador->discount_value }}%
            @else
                ${{ number_format($ambassador->discount_value, 2) }} fijo
            @endif
        </p>
    </div>
    <div>
        <p class="text-xs text-gray-400 mb-1">Estado</p>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                     {{ $ambassador->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
            {{ $ambassador->is_active ? 'Activa' : 'Inactiva' }}
        </span>
    </div>
</div>

{{-- Tabla de pedidos --}}
<div class="admin-card p-0 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Pedido</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Cliente</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Fecha</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Total</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Descuento</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="font-mono text-champagne-600 hover:underline">
                        {{ $order->order_number }}
                    </a>
                </td>
                <td class="px-6 py-4 text-gray-700">
                    {{ $order->customer_name }} {{ $order->customer_lastname }}
                </td>
                <td class="px-6 py-4 text-gray-500">
                    {{ $order->created_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 text-right font-medium">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4 text-right text-champagne-600">
                    ${{ number_format($ambassador->applyDiscount((float)$order->subtotal), 2) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                    Sin ventas con este código en el período seleccionado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
