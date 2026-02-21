<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SolarEnquiryMail;
use App\Models\SolarEnquiry;

class SolarEnquiryController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                // Location preference and fields
                'use_location' => 'required|in:dropdown,other',
                'state_id' => 'required_if:use_location,dropdown|nullable|exists:states,id',
                'city' => 'required_if:use_location,dropdown|nullable|string|max:100',
                'city_id' => 'nullable|exists:cities,id',
                'pincode' => 'required_if:use_location,dropdown|nullable|string|max:10',
                'other_location' => 'required_if:use_location,other|nullable|string|max:500',
                'other' => 'nullable|string|max:1000',
                
                // Original fields (capacity and net_metering are now optional)
                'capacity' => 'nullable|numeric|min:0.1|max:1000',
                'category' => 'required|string|in:Residential,Commercial,Industrial,Groundmount,Group Captive',
                'net_metering' => 'nullable|string|in:Yes,No',
                'type' => 'required|string|in:Tin Shed,RCC roof,Groundmount',
                'tin_shed_age' => 'nullable|numeric|min:1|max:50',
                'distance_from_substation' => 'nullable|numeric|min:0.1|max:500',
                'line' => 'nullable|string|in:11,33,66,132',
                'name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\.]+$/',
                'mobile_number' => 'required|string|regex:/^[6-9]\d{9}$/|min:10|max:15',
                'email' => 'nullable|email|max:255',
                'notes' => 'nullable|string|max:2000',
            ], [
                // Location validation messages
                'use_location.required' => '⚡ Please select location preference',
                'use_location.in' => '⚡ Invalid location preference selected',
                'state_id.required_if' => '⚡ State is required when using dropdown selection',
                'state_id.exists' => '⚡ Selected state is not valid',
                'city.required_if' => '⚡ City is required when using dropdown selection',
                'city.max' => '⚡ City name cannot exceed 100 characters',
                'city_id.exists' => '⚡ Selected city is not valid',
                'pincode.required_if' => '⚡ Pincode is required when using dropdown selection',
                'pincode.max' => '⚡ Pincode cannot exceed 10 characters',
                'other_location.required_if' => '⚡ Location details are required when entering location manually',
                'other_location.max' => '⚡ Location details cannot exceed 500 characters',
                'other.max' => '⚡ Other details cannot exceed 1000 characters',
                
                // Original validation messages (updated for optional fields)
                'capacity.numeric' => '⚡ Capacity must be a valid number',
                'capacity.min' => '⚡ Minimum capacity is 0.1 KW',
                'capacity.max' => '⚡ Maximum capacity is 1000 KW',
                'category.required' => '⚡ Please select a category',
                'category.in' => '⚡ Invalid category selected',
                'net_metering.required' => '⚡ Please select net metering option',
                'net_metering.in' => '⚡ Invalid net metering selection',
                'type.required' => '⚡ Please select installation type',
                'type.in' => '⚡ Invalid installation type selected',
                'tin_shed_age.required' => '⚡ Tin shed age is required',
                'tin_shed_age.numeric' => '⚡ Please enter a valid age',
                'tin_shed_age.min' => '⚡ Tin shed age must be at least 1 year',
                'tin_shed_age.max' => '⚡ Tin shed age cannot exceed 50 years',
                'distance_from_substation.required' => '⚡ Distance from substation is required',
                'distance_from_substation.numeric' => '⚡ Please enter a valid distance',
                'distance_from_substation.min' => '⚡ Distance cannot be negative',
                'distance_from_substation.max' => '⚡ Distance cannot exceed 500 Kms',
                'line.required' => '⚡ Line selection is required',
                'line.in' => '⚡ Invalid line selected',
                'name.required' => '⚡ Name is required',
                'name.min' => '⚡ Name must be at least 2 characters',
                'name.max' => '⚡ Name cannot exceed 255 characters',
                'name.regex' => '⚡ Name can only contain letters and spaces',
                'mobile_number.required' => '⚡ Mobile number is required',
                'mobile_number.regex' => '⚡ Please enter a valid 10-digit mobile number starting with 6-9',
                'mobile_number.min' => '⚡ Mobile number must be at least 10 digits',
                'mobile_number.max' => '⚡ Mobile number cannot exceed 15 digits',
                'email.email' => '⚡ Please enter a valid email address',
                'email.max' => '⚡ Email cannot exceed 255 characters',
                'notes.max' => '⚡ Notes cannot exceed 2000 characters',
            ]);

            // Additional validation based on type selection
            if ($validated['type'] === 'Tin Shed') {
                if (empty($validated['tin_shed_age']) || $validated['tin_shed_age'] < 1) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚡ Tin shed age is required when type is Tin Shed',
                    ], 422);
                }
                
                if ($validated['tin_shed_age'] > 50) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚡ Tin shed age cannot exceed 50 years',
                    ], 422);
                }
            }

            if ($validated['type'] === 'Groundmount') {
                if (empty($validated['distance_from_substation']) || $validated['distance_from_substation'] < 0.1) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚡ Distance from substation is required when type is Groundmount',
                    ], 422);
                }
                
                if ($validated['distance_from_substation'] > 500) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚡ Distance from substation cannot exceed 500 Kms',
                    ], 422);
                }
                
                if (empty($validated['line'])) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚡ Line selection is required when type is Groundmount',
                    ], 422);
                }
            }

            // Additional business logic validation (only if capacity is provided)
            if (!empty($validated['capacity']) && $validated['capacity'] < 1 && in_array($validated['category'], ['Commercial', 'Industrial'])) {
                return response()->json([
                    'success' => false,
                    'message' => '⚡ Commercial and Industrial projects require minimum 1 KW capacity',
                ], 422);
            }

            // Clean and format mobile number
            $validated['mobile_number'] = preg_replace('/[^0-9]/', '', $validated['mobile_number']);

            // Store enquiry with new location fields
            $enquiry = SolarEnquiry::create([
                // Location fields
                'use_location' => $validated['use_location'],
                'state_id' => $validated['state_id'] ?? null,
                'city' => $validated['city'] ?? null,
                'city_id' => $validated['city_id'] ?? null,
                'pincode' => $validated['pincode'] ?? null,
                'other_location' => $validated['other_location'] ?? null,
                'other' => $validated['other'] ?? null,
                
                // Original fields (now optional)
                'capacity' => $validated['capacity'] ?? null,
                'category' => $validated['category'],
                'net_metering' => $validated['net_metering'] ?? null,
                'type' => $validated['type'],
                'tin_shed_age' => $validated['tin_shed_age'] ?? null,
                'distance_from_substation' => $validated['distance_from_substation'] ?? null,
                'line' => $validated['line'] ?? null,
                'name' => trim($validated['name']),
                'mobile_number' => $validated['mobile_number'],
                'email' => $validated['email'] ?? null,
                'notes' => trim($validated['notes'] ?? ''),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);


            return response()->json([
                'success' => true,
                'message' => '✅ Your solar enquiry has been submitted successfully! We will contact you within 24 hours.',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => '⚡ Please check the form errors below',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Solar enquiry submission error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '⚡ Server error occurred. Please try again after some time.',
            ], 500);
        }
    }
}
