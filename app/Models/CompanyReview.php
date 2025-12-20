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
        'reviewer_state_id',
        'reviewer_city',
        'reviewer_name',
        'email',
        'normal_user_id',
        'rating',
        'experience_metrics',
        'system_size_kw',
        'system_price',
        'year_installed',
        'panel_brand',
        'inverter_brand',
        'media_paths',
        'media_terms_accepted',
        'review_title',
        'review_text',
        'review_date',
        'source',
        'is_featured',
        'is_approved',
        'sales_process_rating',
        'price_charged_as_quoted_rating',
        'on_schedule_rating',
        'installation_quality_rating',
        'after_sales_support_rating',
        'primary_media_path',
    ];

    protected $casts = [
        'rating' => 'integer',
        'experience_metrics' => 'array',
        'media_paths' => 'array',
        'media_terms_accepted' => 'boolean',
        'review_date' => 'date',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
        'sales_process_rating' => 'integer',
        'price_charged_as_quoted_rating' => 'integer',
        'on_schedule_rating' => 'integer',
        'installation_quality_rating' => 'integer',
        'after_sales_support_rating' => 'integer',
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

    public function normalUser(): BelongsTo
    {
        return $this->belongsTo(NormalUser::class);
    }
}
