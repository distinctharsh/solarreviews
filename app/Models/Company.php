<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'state_id',
        'average_rating',
        'total_reviews',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'average_rating' => 'float',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
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


    public function updateAverageRating()
    {
        $this->average_rating = $this->companyReviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->companyReviews()->count();
        $this->save();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'company_category');
    }
}