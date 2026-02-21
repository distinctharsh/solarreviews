<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompaniesByLocationController extends Controller
{
    /**
     * Display companies by location page
     */
    public function index(Request $request)
    {
        $pincode = $request->get('pincode');
        $state = $request->get('state');
        $city = $request->get('city');
        
        $companies = [];
        $locationInfo = [
            'state' => $state,
            'city' => $city,
            'pincode' => $pincode
        ];
        
        if ($pincode && strlen($pincode) === 6) {
            try {
                $response = Http::get(url("/api/companies-by-pincode/{$pincode}"));
                $data = $response->json();
                
                if ($data['success'] && isset($data['data'])) {
                    $companies = $data['data'];
                }
            } catch (\Exception $e) {
                $companies = [];
            }
        }
        
        return view('frontend.companies-by-location', compact('companies', 'locationInfo'));
    }
}
