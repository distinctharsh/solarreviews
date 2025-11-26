<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Basic counts - will add more as we create models
        $stats = [
            'total_categories' => Category::count(),
            'total_brands' => Brand::count(),
            'total_companies' => 0, // Will update when Company model is created  
            'total_products' => 0, // Will update when Product model is created
            'total_reviews' => 0, // Will update when Review model is created
            'total_users' => User::count(),
        ];

        // Recent users
        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(function($user) {
                return [
                    'id' => (string)$user->id,
                    'name' => (string)$user->name,
                    'email' => (string)$user->email,
                    'user_type' => (string)($user->user_type ?? 'regular'),
                    'created_at' => $user->created_at,
                    'is_admin' => (bool)($user->is_admin ?? false),
                ];
            });

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers'
        ));
    }
}
