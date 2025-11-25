<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_model_id',
        'product_brand_id',
        'product_line_type_id',
        'name',
        'slug',
        'part_number',
        'compatibility',
        'specifications',
        'is_active',
    ];

    protected $casts = [
        'compatibility' => 'array',
        'specifications' => 'array',
        'is_active' => 'boolean',
    ];

    public function productModel(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }

    public function productLineType(): BelongsTo
    {
        return $this->belongsTo(ProductLineType::class);
    }
}
