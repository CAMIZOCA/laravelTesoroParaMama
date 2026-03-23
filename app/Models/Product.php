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
        'stock',
        'variants',
        'image',
        'gallery',
        'includes',
        'is_featured',
        'is_active',
        'order',
        'badge',
    ];

    protected $casts = [
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
        'gallery'        => 'array',
        'includes'       => 'array',
        'variants'       => 'array',
        'price'          => 'decimal:2',
        'original_price' => 'decimal:2',
    ];

    public function hasVariants(): bool
    {
        return !empty($this->variants) && count($this->variants) > 0;
    }

    public function inStock(): bool
    {
        return $this->stock === null || $this->stock > 0;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset('storage/' . ltrim($this->image, '/'));
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
