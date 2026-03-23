@extends('layouts.admin')

@section('title', 'Pedidos')
@section('page-title', 'Pedidos')

@section('content')
@php
    $statusLabels = ['pending'=>'Pendiente','paid'=>'Pagado','processing'=>'Procesando','shipped'=>'Enviado','delivered'=>'Entregado','cancelled'=>'Cancelado'];
    $statusColors = ['pending'=>'yellow','paid'=>'green','processing'=>'blue','shipped'=>'purple','delivered'=>'emerald','cancelled'=>'red'];
@endphp

{{-- Filters --}}
<div class="admin-card mb-6">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="form-label">Buscar</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nº pedido, nombre o email..."
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Estado</label>
            <select name="status" class="form-input w-40">
                <option value="">Todos</option>
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="admin-btn-primary px-5 py-2">Filtrar</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.orders.index') }}" class="admin-btn-secondary px-4 py-2">Limpiar</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="admin-card p-0 overflow-hidden">
    @if($orders->isEmpty())
        <div class="text-center py-16">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
            </svg>
            <p class="text-gray-400 font-medium">No hay pedidos con estos criterios.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Pedido</th>
                        <th class="text-left font-medium text-gray-500 px-4 py-3.5">Cliente</th>
                        <th class="text-left font-medium text-gray-500 px-4 py-3.5">Fecha</th>
                        <th class="text-right font-medium text-gray-500 px-4 py-3.5">Total</th>
                        <th class="text-center font-medium text-gray-500 px-4 py-3.5">Estado</th>
                        <th class="px-4 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($orders as $order)
                    @php $color = $statusColors[$order->status] ?? 'gray'; @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-olive-900">{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-400">{{ $order->items->count() }} {{ $order->items->count() === 1 ? 'producto' : 'productos' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="font-medium text-olive-900">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-400">{{ $order->customer_email }}</p>
                        </td>
                        <td class="px-4 py-4 text-gray-500 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-4 text-right font-semibold text-olive-900">${{ number_format($order->total, 2) }}</td>
                        <td class="px-4 py-4 text-center">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="admin-btn-secondary px-3 py-1.5 text-xs">
                                Ver detalle
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
