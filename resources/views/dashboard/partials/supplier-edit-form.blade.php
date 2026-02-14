@php
    $labelClass = 'block text-sm font-semibold text-slate-700 mb-1';
    $supplierProductCategories = [
        'Solar Panels',
        'Inverters',
        'Structures',
        'Batteries',
        'Cables',
        'Switchgear',
        'Other Solar Components',
    ];
    $profileSubmission = $user->profileSubmissions->first() ?? null;
@endphp

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    @method('PUT')

    <input type="hidden" name="company_type" value="manufacturer">
    <input type="hidden" name="status" value="active">
    <input type="hidden" name="is_active" value="1">

    <div class="row g-3">
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-building me-1"></i>
                Company Name*
            </label>
            <input type="text" name="owner_name" class="control" value="{{ $profileSubmission?->owner_name ?? old('owner_name') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-telephone me-1"></i>
                Phone*
            </label>
            <input type="text" name="phone" class="control" value="{{ $profileSubmission?->phone ?? old('phone') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-envelope me-1"></i>
                Email*
            </label>
            <input type="email" name="email" class="control" value="{{ $profileSubmission?->email ?? old('email') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-globe me-1"></i>
                Website URL
            </label>
            <input type="url" name="website_url" class="control" value="{{ $profileSubmission?->website_url ?? old('website_url') }}">
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-calendar me-1"></i>
                Years in Business
            </label>
            <input type="number" name="years_in_business" min="0" max="200" class="control" value="{{ $profileSubmission?->years_in_business ?? old('years_in_business') }}">
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-receipt me-1"></i>
                GST Number
            </label>
            <input type="text" name="gst_number" class="control" value="{{ $profileSubmission?->gst_number ?? old('gst_number') }}">
        </div>
        <div class="col-12">
            <label class="{{ $labelClass }}">
                <i class="bi bi-text-paragraph me-1"></i>
                Description
            </label>
            <textarea name="description" rows="3" class="control">{{ $profileSubmission?->description ?? old('description') }}</textarea>
        </div>
        <div class="col-12">
            <label class="{{ $labelClass }}">
                <i class="bi bi-geo-alt me-1"></i>
                Address*
            </label>
            <textarea name="address" rows="2" class="control" required>{{ $profileSubmission?->address ?? old('address') }}</textarea>
        </div>
        <div class="col-12">
            @include('components.location-fields', [
                'idPrefix' => 'supplier_edit_location',
                'states' => $states ?? collect(),
                'selectedStateId' => $profileSubmission?->state_id ?? old('state_id'),
                'selectedCityName' => $profileSubmission?->city ?? old('city'),
                'selectedLinkedCityId' => $profileSubmission?->city_id ?? old('city_id'),
                'selectedPincode' => $profileSubmission?->pincode ?? old('pincode'),
                'labelClass' => $labelClass,
                'wrapperClass' => 'space-y-3',
                'gridClass' => 'grid gap-5 md:grid-cols-2',
                'controlClass' => 'control',
            ])
        </div>
        <div class="col-12">
            <label class="{{ $labelClass }}">
                <i class="bi bi-image me-1"></i>
                Logo
            </label>
            <input type="file" name="logo" accept=".jpg,.jpeg,.png,.gif" class="control">
            @if($profileSubmission?->logo)
                <div class="mt-2">
                    <small class="text-muted">Current logo:</small><br>
                    <img src="{{ asset('storage/' . $profileSubmission->logo) }}" alt="Company Logo" style="max-height: 60px;" class="rounded">
                </div>
            @endif
        </div>
    </div>

    <!-- Product Categories Section -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-box me-2"></i>
            Product Categories
        </h5>
        <div class="row g-3">
            @foreach($supplierProductCategories as $category)
                <div class="col-md-6">
                    <label class="d-flex align-items-center gap-2 p-3 border rounded">
                        <input type="checkbox" name="product_categories[]" value="{{ $category }}" 
                               class="form-check-input" 
                               @if(in_array($category, $profileSubmission?->product_categories ?? [])) checked @endif>
                        <span>{{ $category }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Manufacturing Details -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-gear me-2"></i>
            Manufacturing Details
        </h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-graph-up me-1"></i>
                    Annual Production Capacity
                </label>
                <input type="text" name="annual_capacity" class="control" value="{{ $profileSubmission?->annual_capacity ?? old('annual_capacity') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-award me-1"></i>
                    Quality Certifications
                </label>
                <input type="text" name="quality_certifications" class="control" value="{{ $profileSubmission?->quality_certifications ?? old('quality_certifications') }}">
            </div>
            <div class="col-12">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-list-check me-1"></i>
                    Key Products
                </label>
                <textarea name="key_products" rows="3" class="control">{{ $profileSubmission?->key_products ?? old('key_products') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Commercial Information -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-currency-dollar me-2"></i>
            Commercial Information
        </h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-clock me-1"></i>
                    Lead Time
                </label>
                <input type="text" name="lead_time" class="control" value="{{ $profileSubmission?->lead_time ?? old('lead_time') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-credit-card me-1"></i>
                    Payment Terms
                </label>
                <input type="text" name="payment_terms" class="control" value="{{ $profileSubmission?->payment_terms ?? old('payment_terms') }}">
            </div>
            <div class="col-12">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-truck me-1"></i>
                    Logistics Capabilities
                </label>
                <textarea name="logistics_capabilities" rows="3" class="control">{{ $profileSubmission?->logistics_capabilities ?? old('logistics_capabilities') }}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 justify-content-end pt-3 mt-4 border-top">
        <button type="button" class="btn btn-outline-secondary" data-profile-close>
            <i class="bi bi-x-circle me-2"></i>
            Cancel
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>
            Update Profile
        </button>
    </div>
</form>
