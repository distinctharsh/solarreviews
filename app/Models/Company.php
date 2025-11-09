<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'website',
        'phone',
        'email',
        'address',
        'city_id',
        'average_rating',
        'total_reviews',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'average_rating' => 'float',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function companyReviews(): HasMany
    {
        return $this->hasMany(CompanyReview::class);
    }
    
    // Alias for companyReviews to maintain backward compatibility
    public function reviews(): HasMany
    {
        return $this->companyReviews();
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->companyReviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->companyReviews()->count();
        $this->save();
    }
}