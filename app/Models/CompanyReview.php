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
        'product_id',
        'reviewer_name',
        'rating',
        'review_text',
        'review_date',
        'source',
        'is_featured',
        'is_approved'
    ];

    protected $casts = [
        'review_date' => 'date',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}