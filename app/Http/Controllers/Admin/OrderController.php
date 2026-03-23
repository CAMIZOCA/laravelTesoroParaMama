<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with('items')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'like', "%{$s}%")
                  ->orWhere('customer_name', 'like', "%{$s}%")
                  ->orWhere('customer_email', 'like', "%{$s}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        $statuses = [
            'pending'    => 'Pendiente',
            'paid'       => 'Pagado',
            'processing' => 'Procesando',
            'shipped'    => 'Enviado',
            'delivered'  => 'Entregado',
            'cancelled'  => 'Cancelado',
        ];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order): View
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status'          => 'required|in:pending,paid,processing,shipped,delivered,cancelled',
            'admin_notes'     => 'nullable|string|max:1000',
            'tracking_number' => 'nullable|string|max:100',
        ]);

        $oldStatus = $order->status;

        $order->update([
            'status'          => $request->status,
            'admin_notes'     => $request->admin_notes,
            'tracking_number' => $request->tracking_number,
        ]);

        if ($request->status === 'paid' && !$order->paid_at) {
            $order->update(['paid_at' => now()]);
        }

        if ($request->status === 'shipped' && !$order->shipped_at) {
            $order->update(['shipped_at' => now()]);
        }

        // Send email when status changes to relevant ones
        if ($oldStatus !== $request->status && in_array($request->status, ['processing', 'shipped', 'delivered'])) {
            try {
                Mail::to($order->customer_email)->queue(new OrderStatusUpdated($order));
            } catch (\Exception $e) {
                // Mail failure should not block the admin action
            }
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pedido actualizado correctamente.');
    }
}
