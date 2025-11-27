<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use App\Models\ProductSpec;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'product_name',
        'slug',
        'model_name',
        'type',
        'capacity_kw',
        'size',
        'warranty',
        'technical_details'
    ];

    protected $casts = [
        'capacity_kw' => 'float',
        'technical_details' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->product_name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('product_name')) {
                $product->slug = Str::slug($product->product_name);
            }
        });
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function specs()
    {
        return $this->hasMany(ProductSpec::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // app/Models/Product.php
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_product')
                    ->withPivot(['is_manufacturer', 'stock_status', 'price', 'min_order_qty'])
                    ->withTimestamps();
    }


    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // Add this to calculate average rating
    public function averageRating(): float
    {
        return $this->ratingSummary ? $this->ratingSummary->avg_rating : 0;
    }

        // Add this to get review count
    public function reviewCount(): int
    {
        return $this->ratingSummary ? $this->ratingSummary->total_reviews : 0;
    }

        public function ratingSummary()
    {
        return $this->morphOne(\App\Models\RatingSummary::class, 'reviewable');
    }
}