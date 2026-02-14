@php
    $labelClass = 'block text-sm font-semibold text-slate-700 mb-1';
    $productInterests = [
        'Solar Panels',
        'Inverters',
        'Batteries',
        'Mounting Structures',
        'Solar Water Pumps',
        'Solar Street Lights',
        'EV Charging Solutions',
    ];
    $profileSubmission = $user->profileSubmissions->first() ?? null;
@endphp

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    @method('PUT')

    <input type="hidden" name="company_type" value="distributor">
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
                'idPrefix' => 'distributor_edit_location',
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

    <!-- Product Interest Section -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-box me-2"></i>
            Product Interest
        </h5>
        <div class="row g-3">
            @foreach($productInterests as $interest)
                <div class="col-md-6">
                    <label class="d-flex align-items-center gap-2 p-3 border rounded">
                        <input type="checkbox" name="product_interests[]" value="{{ $interest }}" 
                               class="form-check-input" 
                               @if(in_array($interest, $profileSubmission?->product_interests ?? [])) checked @endif>
                        <span>{{ $interest }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Additional Information -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-info-circle me-2"></i>
            Additional Information
        </h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-people me-1"></i>
                    Team Size
                </label>
                <input type="number" name="team_size" min="0" class="control" value="{{ $profileSubmission?->team_size ?? old('team_size') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-graph-up me-1"></i>
                    Expected Monthly Sales Volume
                </label>
                <input type="text" name="monthly_sales_volume" class="control" value="{{ $profileSubmission?->monthly_sales_volume ?? old('monthly_sales_volume') }}">
            </div>
            <div class="col-12">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-map me-1"></i>
                    Market Coverage
                </label>
                <textarea name="market_coverage" rows="3" class="control">{{ $profileSubmission?->market_coverage ?? old('market_coverage') }}</textarea>
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
