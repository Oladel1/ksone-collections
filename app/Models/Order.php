<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'reference', 'product_id', 'product_name', 'product_image',
        'variant', 'size', 'customer_name', 'customer_email',
        'customer_phone', 'amount', 'currency', 'status',
        'gateway_response', 'channel', 'paid_at', 'paystack_data',
    ];

    protected $casts = [
        'amount'        => 'integer',
        'paid_at'       => 'datetime',
        'paystack_data' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'success'  => 'bg-green-100 text-green-800',
            'pending'  => 'bg-yellow-100 text-yellow-800',
            'failed'   => 'bg-red-100 text-red-800',
            'refunded' => 'bg-gray-100 text-gray-800',
            default    => 'bg-gray-100 text-gray-600',
        };
    }
}
