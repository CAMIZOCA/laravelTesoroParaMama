<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ambassador extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'code',
        'discount_type',
        'discount_value',
        'status',
    ];

    public function setCodeAttribute(string $value): void
    {
        $this->attributes['code'] = strtoupper(trim($value));
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->discount_type === 'percentage') {
            return round($subtotal * ($this->discount_value / 100), 2);
        }

        return min((float) $this->discount_value, $subtotal);
    }

    public function discountLabel(): string
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        }

        return '$' . number_format($this->discount_value, 2);
    }
}
