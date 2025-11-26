<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'brand_id',
        'category_id',
        'name',
        'slug',
        'model_number',
        'variant',
        'wattage_or_capacity',
        'technology',
        'efficiency',
        'warranty_years',
        'datasheet_url',
        'msrp',
        'specs',
        'is_active',
    ];

    protected $casts = [
        'specs' => 'array',
        'is_active' => 'boolean',
        'efficiency' => 'float',
        'msrp' => 'float',
        'warranty_years' => 'integer',
    ];

    /**
     * Relationship: product belongs to company.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relationship: product belongs to brand.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relationship: product belongs to category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: product has many media items.
     */
    public function media(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }
}
