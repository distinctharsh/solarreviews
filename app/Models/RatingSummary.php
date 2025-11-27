<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RatingSummary extends Model
{
    protected $fillable = [
        'reviewable_type',
        'reviewable_id',
        'avg_rating',
        'total_reviews'
    ];

    protected $casts = [
        'avg_rating' => 'float',
        'total_reviews' => 'integer',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function updateFor(Review $review): void
    {
        $summary = static::firstOrNew([
            'reviewable_type' => $review->reviewable_type,
            'reviewable_id' => $review->reviewable_id,
        ]);

        $summary->avg_rating = Review::where('reviewable_type', $review->reviewable_type)
            ->where('reviewable_id', $review->reviewable_id)
            ->avg('rating') ?? 0;

        $summary->total_reviews = Review::where('reviewable_type', $review->reviewable_type)
            ->where('reviewable_id', $review->reviewable_id)
            ->count();

        $summary->save();
    }
}