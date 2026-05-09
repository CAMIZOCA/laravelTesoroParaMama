<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ambassador extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'code',
        'discount_type',
        'discount_value',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'discount_value' => 'decimal:2',
    ];

    public function setCodeAttribute(string $value): void
    {
        $this->attributes['code'] = strtoupper(trim($value));
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function applyDiscount(float $amount): float
    {
        if ($this->discount_type === 'percent') {
            return round($amount * ($this->discount_value / 100), 2);
        }
        return min((float) $this->discount_value, $amount);
    }

    public function fullName(): string
    {
        return trim($this->name . ' ' . $this->lastname);
    }
}
