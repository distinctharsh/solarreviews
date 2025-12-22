<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GetQuote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GetQuoteController extends Controller
{
    /**
     * Store a newly created quote request.
     */
    public function store(Request $request): JsonResponse
    {
        $serviceTypes = ['Solar Panel', 'Solar Battery', 'Solar Inverter', 'EPC', 'Others'];

        try {
            $validated = $request->validate([
                'company_id' => 'nullable|exists:companies,id',
                'state_id' => 'nullable|exists:states,id',
                'service_type' => 'required|string|in:' . implode(',', $serviceTypes),
                'name' => 'required|string|max:255',
                'mobile_number' => 'required|string|min:10|max:20',
                'email' => 'nullable|email|max:255',
                'location' => 'nullable|string|max:255',
                'notes' => 'nullable|string|max:1000',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the highlighted errors.',
                'errors' => $exception->errors(),
            ], 422);
        }

        GetQuote::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Our solar expert will contact you shortly.',
        ]);
    }
}
