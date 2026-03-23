<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_country',
        'customer_city',
        'customer_address',
        'customer_notes',
        'subtotal',
        'total',
        'payphone_transaction_id',
        'payphone_client_transaction_id',
        'status',
        'admin_notes',
        'tracking_number',
        'paid_at',
        'shipped_at',
    ];

    protected $casts = [
        'subtotal'  => 'decimal:2',
        'total'     => 'decimal:2',
        'paid_at'   => 'datetime',
        'shipped_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        $year = date('Y');
        $last = static::whereYear('created_at', $year)->max('id') ?? 0;
        return 'ORD-' . $year . '-' . str_pad($last + 1, 4, '0', STR_PAD_LEFT);
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'pending'    => 'Pendiente',
            'paid'       => 'Pagado',
            'processing' => 'Procesando',
            'shipped'    => 'Enviado',
            'delivered'  => 'Entregado',
            'cancelled'  => 'Cancelado',
            default      => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match($this->status) {
            'pending'    => 'yellow',
            'paid'       => 'green',
            'processing' => 'blue',
            'shipped'    => 'purple',
            'delivered'  => 'emerald',
            'cancelled'  => 'red',
            default      => 'gray',
        };
    }
}
