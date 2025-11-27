<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo_url',
        'country',
        'description',
    ];

    protected $casts = [
        // No special casts needed for the current fields
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });

        static::updating(function ($brand) {
            if ($brand->isDirty('name')) {
                $brand->slug = Str::slug($brand->name);
            }
        });
    }

    /**
     * Scope: Order by name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    /**
     * Relationship: Brand belongs to many categories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'brand_category')
                    ->withTimestamps();
    }

    /**
     * Relationship: Brand has many products
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset($this->logo) : null;
    }

    // app/Models/Brand.php
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_brand')
                    ->withPivot('type')
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

