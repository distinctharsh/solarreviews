<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reviewable_type',
        'reviewable_id',
        'rating',
        'title',
        'comment',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'rating' => 'integer',
    ];

    /**
     * Get the parent reviewable model (product, company, or brand).
     */
    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the average rating for a reviewable model.
     */
    public static function getAverageRating(string $reviewableType, int $reviewableId): float
    {
        return static::where('reviewable_type', $reviewableType)
            ->where('reviewable_id', $reviewableId)
            ->avg('rating') ?? 0;
    }

    /**
     * Get the review count for a reviewable model.
     */
    public static function getReviewCount(string $reviewableType, int $reviewableId): int
    {
        return static::where('reviewable_type', $reviewableType)
            ->where('reviewable_id', $reviewableId)
            ->count();
    }


    // In app/Models/Review.php
    protected static function booted()
    {
        static::created(function ($review) {
            \App\Models\RatingSummary::updateFor($review);
        });

        static::updated(function ($review) {
            \App\Models\RatingSummary::updateFor($review);
        });

        static::deleted(function ($review) {
            \App\Models\RatingSummary::updateFor($review);
        });
    }
}