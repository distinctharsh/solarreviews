<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_brand_id',
        'product_line_type_id',
        'name',
        'slug',
        'model_number',
        'specifications',
        'image',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }

    public function productLineType(): BelongsTo
    {
        return $this->belongsTo(ProductLineType::class);
    }

    public function parts(): HasMany
    {
        return $this->hasMany(ProductPart::class);
    }
}
