<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'category_id',
        'state_id',
        'reviewer_name',
        'email',
        'rating',
        'review_title',
        'review_text',
        'review_date',
        'source',
        'is_featured',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'date',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
