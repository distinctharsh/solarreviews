<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'owner_name' => 'required|string|max:255',
            'company_type' => 'required|in:manufacturer,distributor,dealer,installer,wholesaler,retailer,epc',
            'phone' => 'required|string|max:32',
            'email' => 'required|email|max:255',
            'website_url' => 'nullable|url|max:255',
            'years_in_business' => 'nullable|integer|min:0|max:200',
            'gst_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'city_id' => 'nullable|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'pincode' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}