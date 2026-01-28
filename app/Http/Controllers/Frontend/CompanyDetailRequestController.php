<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetailRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyDetailRequestController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'company_id' => 'nullable|exists:companies,id',
                'name' => 'required|string|max:255',
                'mobile_number' => 'required|string|min:10|max:20',
                'email' => 'nullable|email|max:255',
                'location' => 'nullable|string|max:255',
                'message' => 'nullable|string|max:1000',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the highlighted errors.',
                'errors' => $exception->errors(),
            ], 422);
        }

        CompanyDetailRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Our team will share the details with you shortly.',
        ]);
    }
}
