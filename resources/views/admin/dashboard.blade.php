@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
@php
    $statusLabels = ['pending'=>'Pendiente','paid'=>'Pagado','processing'=>'Procesando','shipped'=>'Enviado','delivered'=>'Entregado','cancelled'=>'Cancelado'];
    $statusColors = ['pending'=>'yellow','paid'=>'green','processing'=>'blue','shipped'=>'purple','delivered'=>'emerald','cancelled'=>'red'];
@endphp

{{-- KPI Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Ventas este mes</p>
            <p class="text-2xl font-bold text-olive-900">${{ number_format($totalVentas, 2) }}</p>
        </div>
    </div>

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Pedidos este mes</p>
            <p class="text-2xl font-bold text-olive-900">{{ $pedidosMes }}</p>
        </div>
    </div>

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Pendientes de pago</p>
            <p class="text-2xl font-bold text-olive-900">{{ $pedidosPendientes }}</p>
        </div>
    </div>

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Pagados este mes</p>
            <p class="text-2xl font-bold text-olive-900">{{ $pedidosPagados }}</p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- Recent Orders --}}
    <div class="admin-card">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-semibold text-olive-900">Últimos pedidos</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gold-600 hover:underline">Ver todos</a>
        </div>
        @if($ultimosPedidos->isEmpty())
            <p class="text-sm text-gray-400 text-center py-6">Aún no hay pedidos.</p>
        @else
            <div class="space-y-3">
                @foreach($ultimosPedidos as $order)
                <a href="{{ route('admin.orders.show', $order) }}"
                   class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div>
                        <p class="text-sm font-medium text-olive-900">{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-400">{{ $order->customer_name }} · {{ $order->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-olive-900">${{ number_format($order->total, 2) }}</span>
                        @php $color = $statusColors[$order->status] ?? 'gray'; @endphp
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">
                            {{ $statusLabels[$order->status] ?? $order->status }}
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Orders by status --}}
    <div class="admin-card">
        <h2 class="font-semibold text-olive-900 mb-5">Pedidos por estado</h2>
        @if(empty($porEstado))
            <p class="text-sm text-gray-400 text-center py-6">Aún no hay pedidos.</p>
        @else
            <div class="space-y-3">
                @foreach($statusLabels as $key => $label)
                <div class="flex items-center justify-between">
                    @php $color = $statusColors[$key] ?? 'gray'; @endphp
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-{{ $color }}-400"></span>
                        <span class="text-sm text-gray-700">{{ $label }}</span>
                    </div>
                    <span class="text-sm font-semibold text-olive-900">{{ $porEstado[$key] ?? 0 }}</span>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

{{-- Top Products --}}
<div class="admin-card">
    <h2 class="font-semibold text-olive-900 mb-5">Productos más vendidos este mes</h2>
    @if($topProductos->isEmpty())
        <p class="text-sm text-gray-400 text-center py-6">Aún no hay ventas este mes.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left font-medium text-gray-500 pb-3">#</th>
                        <th class="text-left font-medium text-gray-500 pb-3">Producto</th>
                        <th class="text-right font-medium text-gray-500 pb-3">Unidades</th>
                        <th class="text-right font-medium text-gray-500 pb-3">Ingresos</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($topProductos as $i => $product)
                    <tr>
                        <td class="py-3 text-gray-400">{{ $i + 1 }}</td>
                        <td class="py-3 font-medium text-olive-900">{{ $product->product_name }}</td>
                        <td class="py-3 text-right text-olive-700">{{ $product->vendidos }}</td>
                        <td class="py-3 text-right font-semibold text-olive-900">${{ number_format($product->ingresos, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
