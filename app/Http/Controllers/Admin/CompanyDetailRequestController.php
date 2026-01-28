<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetailRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyDetailRequestController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $query = CompanyDetailRequest::query()
            ->with(['company:id,owner_name,slug'])
            ->latest();

        if (! empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('name', 'like', $search)
                    ->orWhere('mobile_number', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('location', 'like', $search)
                    ->orWhere('message', 'like', $search)
                    ->orWhereHas('company', function ($companyQuery) use ($search) {
                        $companyQuery->where('owner_name', 'like', $search);
                    });
            });
        }

        $requests = $query->paginate(20)->withQueryString();

        return view('admin.company-detail-requests.index', [
            'requests' => $requests,
            'filters' => [
                'search' => $filters['search'] ?? null,
            ],
        ]);
    }

    public function show(CompanyDetailRequest $companyDetailRequest): View
    {
        $companyDetailRequest->load(['company:id,owner_name,slug,website_url']);

        return view('admin.company-detail-requests.show', [
            'request' => $companyDetailRequest,
        ]);
    }
}
