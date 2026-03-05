<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GetSolution;
use Illuminate\Http\Request;

class GetSolutionController extends Controller
{
    public function index(Request $request)
    {
        $query = GetSolution::with(['state'])
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('service_type', 'like', "%{$search}%");
            });
        }

        // Filter by service type
        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        // Filter by location preference
        if ($request->filled('use_location')) {
            $query->where('use_location', $request->use_location);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $solutions = $query->paginate(20)->withQueryString();

        // Get unique service types for filters
        $serviceTypes = GetSolution::distinct()->pluck('service_type')->sort();

        return view('admin.get-solutions.index', compact('solutions', 'serviceTypes'));
    }

    public function show(GetSolution $getSolution)
    {
        $solution = $getSolution->load(['state']);
        return view('admin.get-solutions.show', compact('solution'));
    }

    public function destroy(GetSolution $getSolution)
    {
        $getSolution->delete();
        return redirect()->route('admin.get-solutions.index')
            ->with('success', 'Solution request deleted successfully.');
    }
}
