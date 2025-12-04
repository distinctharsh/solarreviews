<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function compareBrand(Brand $brand)
    {
        $brands = Brand::query()
            ->select('brands.*',
                DB::raw('COALESCE(rs.avg_rating, 0) as avg_rating'),
                DB::raw('COALESCE(rs.total_reviews, 0) as total_reviews'))
            ->leftJoin('rating_summaries as rs', function ($join) {
                $join->on('rs.reviewable_id', '=', 'brands.id')
                    ->where('rs.reviewable_type', '=', Brand::class);
            })
            ->orderByDesc('avg_rating')
            ->orderByDesc('total_reviews')
            ->limit(20)
            ->get();

        $efficiencyLeaders = Product::query()
            ->select(
                'brands.id as brand_id',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
                'brands.logo_url',
                DB::raw('AVG(products.efficiency) as avg_efficiency'),
                DB::raw('MAX(products.efficiency) as max_efficiency'),
                DB::raw('COUNT(products.id) as product_count')
            )
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.brand_id', $brand->id)
            ->whereNotNull('products.efficiency')
            ->groupBy('brands.id', 'brands.name', 'brands.slug', 'brands.logo_url')
            ->orderByDesc('avg_efficiency')
            ->limit(10)
            ->get();

        return view('frontend.brands.compare-generic', [
            'selectedBrand' => $brand,
            'brands' => $brands,
            'efficiencyLeaders' => $efficiencyLeaders,
        ]);
    }
}