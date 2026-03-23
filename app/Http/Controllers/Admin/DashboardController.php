<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $month = now()->month;
        $year  = now()->year;

        $totalVentas = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereNotIn('status', ['cancelled', 'pending'])
            ->sum('total');

        $pedidosMes = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();

        $pedidosPendientes = Order::where('status', 'pending')->count();

        $pedidosPagados = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('status', 'paid')
            ->count();

        $ultimosPedidos = Order::with('items')
            ->latest()
            ->limit(8)
            ->get();

        $porEstado = Order::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $topProductos = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->whereNotIn('orders.status', ['cancelled'])
            ->selectRaw('order_items.product_name, sum(order_items.quantity) as vendidos, sum(order_items.subtotal) as ingresos')
            ->groupBy('order_items.product_name')
            ->orderByDesc('vendidos')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVentas',
            'pedidosMes',
            'pedidosPendientes',
            'pedidosPagados',
            'ultimosPedidos',
            'porEstado',
            'topProductos',
        ));
    }
}
