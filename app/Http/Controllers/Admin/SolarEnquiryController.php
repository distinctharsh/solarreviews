<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolarEnquiry;
use Illuminate\Http\Request;

class SolarEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = SolarEnquiry::with(['state'])
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $enquiries = $query->paginate(20)->withQueryString();

        // Get unique categories and types for filters
        $categories = SolarEnquiry::distinct()->pluck('category')->sort();
        $types = SolarEnquiry::distinct()->pluck('type')->sort();

        return view('admin.solar-enquiries.index', compact('enquiries', 'categories', 'types'));
    }

    public function show(SolarEnquiry $solarEnquiry)
    {
        $enquiry = $solarEnquiry->load(['state']);
        return view('admin.solar-enquiries.show', compact('enquiry'));
    }

    public function destroy(SolarEnquiry $solarEnquiry)
    {
        $solarEnquiry->delete();
        return redirect()->route('admin.solar-enquiries.index')
            ->with('success', 'Solar enquiry deleted successfully.');
    }
}
