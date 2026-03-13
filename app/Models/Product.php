<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'original_price',
        'image',
        'gallery',
        'includes',
        'whatsapp_message',
        'is_featured',
        'is_active',
        'order',
        'badge',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'gallery' => 'array',
        'includes' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = config('app.whatsapp_number', '593999829469');
        $message = $this->whatsapp_message
            ?? "Hola! Me interesa el kit *{$this->name}* - ${$this->price}. ¿Podría darme más información?";

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://picsum.photos/seed/' . $this->slug . '/800/600';
    }

    public function hasDiscount(): bool
    {
        return $this->original_price && $this->original_price > $this->price;
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->hasDiscount()) return 0;
        return (int) round((($this->original_price - $this->price) / $this->original_price) * 100);
    }
}
