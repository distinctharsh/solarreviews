<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'state_id',
        'price',
        'sale_price',
        'sale_start_date',
        'sale_end_date',
        'stock_quantity',
        'sku',
        'weight',
        'length',
        'width',
        'height',
        'is_active',
        'is_available',
        'specifications',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'sale_start_date' => 'date',
        'sale_end_date' => 'date',
        'stock_quantity' => 'integer',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'is_active' => 'boolean',
        'is_available' => 'boolean',
        'specifications' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function getCurrentPriceAttribute(): float
    {
        $now = now();
        
        if ($this->sale_price && 
            $this->sale_start_date <= $now && 
            (!$this->sale_end_date || $this->sale_end_date >= $now)) {
            return (float) $this->sale_price;
        }
        
        return (float) $this->price;
    }

    public function isOnSale(): bool
    {
        $now = now();
        return $this->sale_price && 
               $this->sale_start_date <= $now && 
               (!$this->sale_end_date || $this->sale_end_date >= $now);
    }
}
