<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // app/Models/Company.php
    protected $fillable = [
        'owner_id',
        'slug',
        'company_type',
        'owner_name',
        'gst_number',
        'address',
        'city',
        'state',
        'pincode',
        'email',
        'phone',
        'website_url',
        'logo_url',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
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