<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GetQuote;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GetQuoteController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'service_type' => ['nullable', 'string', 'max:255'],
        ]);

        $query = GetQuote::query()
            ->with(['company', 'state'])
            ->latest();

        if (! empty($filters['service_type'])) {
            $query->where('service_type', $filters['service_type']);
        }

        if (! empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('name', 'like', $search)
                    ->orWhere('mobile_number', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('location', 'like', $search)
                    ->orWhere('notes', 'like', $search);
            });
        }

        $quotes = $query->paginate(20)->withQueryString();

        $serviceTypes = GetQuote::query()
            ->select('service_type')
            ->distinct()
            ->orderBy('service_type')
            ->pluck('service_type')
            ->filter()
            ->values();

        return view('admin.get-quotes.index', [
            'quotes' => $quotes,
            'serviceTypes' => $serviceTypes,
            'filters' => [
                'search' => $filters['search'] ?? null,
                'service_type' => $filters['service_type'] ?? null,
            ],
        ]);
    }

    public function show(GetQuote $quote): View
    {
        $quote->load(['company', 'state']);

        return view('admin.get-quotes.show', [
            'quote' => $quote,
        ]);
    }
}
