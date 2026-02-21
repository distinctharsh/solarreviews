<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\GetSolution;

class GetSolutionController extends Controller
{
    public function store(Request $request)
    {
        try {

            $rules = [
                'service_type'   => 'required|string|in:O&M,AMC,Cleaning,Net metering,Delay in Execution,Generation variation',
                'use_location'   => 'required|in:dropdown,other',
                'name'           => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\.]+$/',
                'mobile_number'  => 'required|regex:/^[6-9]\d{9}$/',
                'email'          => 'nullable|email|max:255',
                'details'        => 'nullable|string|max:2000',
            ];

            // Location based validation
            if ($request->use_location === 'dropdown') {
                $rules['state_id'] = 'required|exists:states,id';
                $rules['city']     = 'required|string|max:255';
                $rules['pincode']  = 'required|regex:/^[0-9]{6}$/';
            } else {
                $rules['other_location'] = 'required|string|min:3|max:500';
            }

            $validated = $request->validate($rules);

            // Clean mobile
            $mobile = preg_replace('/[^0-9]/', '', $validated['mobile_number']);

            // Store request
            $solution = GetSolution::create([
                'service_type'   => $validated['service_type'],
                'use_location'   => $validated['use_location'],
                'state_id'       => $validated['state_id'] ?? null,
                'city'           => $validated['city'] ?? null,
                'pincode'        => $validated['pincode'] ?? null,
                'other_location' => $validated['other_location'] ?? null,
                'name'           => trim($validated['name']),
                'mobile_number'  => $mobile,
                'email'          => $validated['email'] ?? null,
                'details'        => trim($validated['details'] ?? null),
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Your solution request has been submitted successfully!',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => '⚡ Please check form errors below',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Exception $e) {

            \Log::error('Get solution error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => '⚡ Server error occurred. Please try again.',
            ], 500);
        }
    }
    
    public function getCompaniesByPincode($pincode)
    {
        try {
            // Get state from pincode (you can use a pincode service or database)
            $state = $this->getStateFromPincode($pincode);
            
            // Debug: Check if any companies exist with this pincode
            $testCompany = \App\Models\Company::where('pincode', $pincode)->first();
            \Log::info("Test company found: " . ($testCompany ? $testCompany->owner_name : 'None'));
            
            // Debug: Log the pincode and state
            $searchType = ($state !== 'Unknown') ? 'pincode + state' : 'pincode only';
            \Log::info("Searching companies for pincode: {$pincode}, state: {$state} ({$searchType})");
            
            // Get companies from same state or with matching pincode
            $companies = \App\Models\Company::where('is_active', 1)
            ->where('is_subscribed', 1)
            ->where('pincode', $pincode)
            ->when($state !== 'Unknown', function($query) use ($state) {
                $query->orWhereHas('state', function($stateQuery) use ($state) {
                    $stateQuery->where('name', $state);
                });
            })
            ->select('id', 'owner_name as name', 'slug', 'city', 'state_id', 'is_subscribed')
            ->with('state:name')
            ->orderBy('owner_name')
            ->limit(10)
            ->get();
            
            // Debug: Log the count
            \Log::info("Found {$companies->count()} companies");
            
            return response()->json([
                'success' => true,
                'data' => $companies,
                'pincode' => $pincode,
                'state' => $state
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching companies'
            ], 500);
        }
    }
    
    private function getStateFromPincode($pincode)
    {
        // This is a simplified version - you can use a proper pincode database or API
        $pincodeStates = [
            // Delhi
            '110001' => 'Delhi', '110002' => 'Delhi', '110003' => 'Delhi', '110004' => 'Delhi', '110005' => 'Delhi',
            '110006' => 'Delhi', '110007' => 'Delhi', '110008' => 'Delhi', '110009' => 'Delhi', '110010' => 'Delhi',
            '110011' => 'Delhi', '110012' => 'Delhi', '110013' => 'Delhi', '110014' => 'Delhi', '110015' => 'Delhi',
            '110016' => 'Delhi', '110017' => 'Delhi', '110018' => 'Delhi', '110019' => 'Delhi', '110020' => 'Delhi',
            '110021' => 'Delhi', '110022' => 'Delhi', '110023' => 'Delhi', '110024' => 'Delhi', '110025' => 'Delhi',
            '110026' => 'Delhi', '110027' => 'Delhi', '110028' => 'Delhi', '110029' => 'Delhi', '110030' => 'Delhi',
            '110031' => 'Delhi', '110032' => 'Delhi', '110033' => 'Delhi', '110034' => 'Delhi', '110035' => 'Delhi',
            '110036' => 'Delhi', '110037' => 'Delhi', '110038' => 'Delhi', '110039' => 'Delhi', '110040' => 'Delhi',
            '110041' => 'Delhi', '110042' => 'Delhi', '110043' => 'Delhi', '110044' => 'Delhi', '110045' => 'Delhi',
            '110046' => 'Delhi', '110047' => 'Delhi', '110048' => 'Delhi', '110049' => 'Delhi', '110050' => 'Delhi',
            
            // Mumbai
            '400001' => 'Maharashtra', '400002' => 'Maharashtra', '400003' => 'Maharashtra', '400004' => 'Maharashtra',
            '400005' => 'Maharashtra', '400006' => 'Maharashtra', '400007' => 'Maharashtra', '400008' => 'Maharashtra',
            '400009' => 'Maharashtra', '400010' => 'Maharashtra', '400011' => 'Maharashtra', '400012' => 'Maharashtra',
            '400013' => 'Maharashtra', '400014' => 'Maharashtra', '400015' => 'Maharashtra', '400016' => 'Maharashtra',
            '400017' => 'Maharashtra', '400018' => 'Maharashtra', '400019' => 'Maharashtra', '400020' => 'Maharashtra',
            '400021' => 'Maharashtra', '400022' => 'Maharashtra', '400023' => 'Maharashtra', '400024' => 'Maharashtra',
            '400025' => 'Maharashtra', '400026' => 'Maharashtra', '400027' => 'Maharashtra', '400028' => 'Maharashtra',
            '400029' => 'Maharashtra', '400030' => 'Maharashtra', '400031' => 'Maharashtra', '400032' => 'Maharashtra',
            '400033' => 'Maharashtra', '400034' => 'Maharashtra', '400035' => 'Maharashtra', '400036' => 'Maharashtra',
            '400037' => 'Maharashtra', '400038' => 'Maharashtra', '400039' => 'Maharashtra', '400040' => 'Maharashtra',
            '400041' => 'Maharashtra', '400042' => 'Maharashtra', '400043' => 'Maharashtra', '400044' => 'Maharashtra',
            '400045' => 'Maharashtra', '400046' => 'Maharashtra', '400047' => 'Maharashtra', '400048' => 'Maharashtra',
            '400049' => 'Maharashtra', '400050' => 'Maharashtra',
            
            // Bangalore
            '560001' => 'Karnataka', '560002' => 'Karnataka', '560003' => 'Karnataka', '560004' => 'Karnataka',
            '560005' => 'Karnataka', '560006' => 'Karnataka', '560007' => 'Karnataka', '560008' => 'Karnataka',
            '560009' => 'Karnataka', '560010' => 'Karnataka', '560011' => 'Karnataka', '560012' => 'Karnataka',
            '560013' => 'Karnataka', '560014' => 'Karnataka', '560015' => 'Karnataka', '560016' => 'Karnataka',
            '560017' => 'Karnataka', '560018' => 'Karnataka', '560019' => 'Karnataka', '560020' => 'Karnataka',
            '560021' => 'Karnataka', '560022' => 'Karnataka', '560023' => 'Karnataka', '560024' => 'Karnataka',
            '560025' => 'Karnataka', '560026' => 'Karnataka', '560027' => 'Karnataka', '560028' => 'Karnataka',
            '560029' => 'Karnataka', '560030' => 'Karnataka', '560031' => 'Karnataka', '560032' => 'Karnataka',
            '560033' => 'Karnataka', '560034' => 'Karnataka', '560035' => 'Karnataka', '560036' => 'Karnataka',
            '560037' => 'Karnataka', '560038' => 'Karnataka', '560039' => 'Karnataka', '560040' => 'Karnataka',
            '560041' => 'Karnataka', '560042' => 'Karnataka', '560043' => 'Karnataka', '560044' => 'Karnataka',
            '560045' => 'Karnataka', '560046' => 'Karnataka', '560047' => 'Karnataka', '560048' => 'Karnataka',
            '560049' => 'Karnataka', '560050' => 'Karnataka',
        ];
        
        return $pincodeStates[$pincode] ?? 'Unknown';
    }
}
