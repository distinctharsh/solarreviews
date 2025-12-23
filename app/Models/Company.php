<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'slug',
        'company_type',
        'owner_name',
        'phone',
        'website_url',
        'logo_url',
        'description',
        'status',
        'email',
        'years_in_business',
        'gst_number',
        'address',
        'city',
        'pincode',
        'state_id',
        'city_id',
        'is_active',
    ];

    protected $casts = [
        'status' => 'string',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // app/Models/Company.php
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'company_brand')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    // app/Models/Company.php
    public function products()
    {
        return $this->belongsToMany(Product::class, 'company_product')
                    ->withPivot(['is_manufacturer', 'stock_status', 'price', 'min_order_qty'])
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_category')
                    ->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function companyReviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompanyReview::class);
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

    public function getStateNameAttribute(): ?string
    {
        return $this->state?->name;
    }

    public function getCityNameAttribute(): ?string
    {
        if ($this->cityRelation) {
            return $this->cityRelation->name;
        }

        return $this->city;
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function cityRelation(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function ratingSummary()
    {
        return $this->morphOne(\App\Models\RatingSummary::class, 'reviewable');
    }
}