<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'slug', 'name', 'category_id', 'type', 'description',
        'price', 'image', 'badge', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'price'      => 'integer',
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
    ];

    /**
     * The top-level category this product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class)->orderBy('size');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    /**
     * Total stock across all sizes.
     */
    public function getTotalStockAttribute(): int
    {
        return $this->sizes->sum('stock_quantity');
    }

    /**
     * Stock status label.
     */
    public function getStockStatusAttribute(): string
    {
        $total = $this->total_stock;

        if ($total <= 0) return 'out_of_stock';
        if ($total <= 5) return 'low_stock';
        return 'in_stock';
    }

    /**
     * Auto-generate slug from name on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Scope: only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: ordered by sort_order then name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
