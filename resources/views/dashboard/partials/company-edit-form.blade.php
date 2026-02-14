@php
    $labelClass = 'block text-sm font-semibold text-slate-700 mb-1';
    $company = $company ?? null;
    $profileSubmission = $user->profileSubmissions->first() ?? null;
@endphp

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-building me-1"></i>
                Company Name*
            </label>
            <input type="text" name="owner_name" class="control" value="{{ $company?->name ?? old('owner_name') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-telephone me-1"></i>
                Phone*
            </label>
            <input type="text" name="phone" class="control" value="{{ $company?->phone ?? old('phone') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-envelope me-1"></i>
                Email*
            </label>
            <input type="email" name="email" class="control" value="{{ $company?->email ?? old('email') }}" required>
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-globe me-1"></i>
                Website URL
            </label>
            <input type="url" name="website_url" class="control" value="{{ $company?->website_url ?? old('website_url') }}">
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-calendar me-1"></i>
                Years in Business
            </label>
            <input type="number" name="years_in_business" min="0" max="200" class="control" value="{{ $company?->years_in_business ?? old('years_in_business') }}">
        </div>
        <div class="col-md-6">
            <label class="{{ $labelClass }}">
                <i class="bi bi-receipt me-1"></i>
                GST Number
            </label>
            <input type="text" name="gst_number" class="control" value="{{ $company?->gst_number ?? old('gst_number') }}">
        </div>
        <div class="col-12">
            <label class="{{ $labelClass }}">
                <i class="bi bi-text-paragraph me-1"></i>
                Description
            </label>
            <textarea name="description" rows="3" class="control">{{ $company?->description ?? old('description') }}</textarea>
        </div>
        <div class="col-12">
            <label class="{{ $labelClass }}">
                <i class="bi bi-geo-alt me-1"></i>
                Address*
            </label>
            <textarea name="address" rows="2" class="control" required>{{ $company?->address ?? old('address') }}</textarea>
        </div>
        <div class="col-12">
            @include('components.location-fields', [
                'idPrefix' => 'company_edit_location',
                'states' => $states ?? collect(),
                'selectedStateId' => $company?->state_id ?? old('state_id'),
                'selectedCityName' => $company?->city ?? old('city'),
                'selectedLinkedCityId' => $company?->city_id ?? old('city_id'),
                'selectedPincode' => $company?->pincode ?? old('pincode'),
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
            @if($company?->logo)
                <div class="mt-2">
                    <small class="text-muted">Current logo:</small><br>
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" style="max-height: 60px;" class="rounded">
                </div>
            @endif
        </div>
    </div>

    <!-- Additional Company Details -->
    <div class="mt-4">
        <h5 class="fw-semibold mb-3">
            <i class="bi bi-info-circle me-2"></i>
            Additional Company Details
        </h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-people me-1"></i>
                    Team Size
                </label>
                <input type="number" name="team_size" min="0" class="control" value="{{ $company?->team_size ?? old('team_size') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-graph-up me-1"></i>
                    Annual Revenue
                </label>
                <input type="text" name="annual_revenue" class="control" value="{{ $company?->annual_revenue ?? old('annual_revenue') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-award me-1"></i>
                    Certifications
                </label>
                <input type="text" name="certifications" class="control" value="{{ $company?->certifications ?? old('certifications') }}">
            </div>
            <div class="col-md-6">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-map me-1"></i>
                    Service Areas
                </label>
                <input type="text" name="service_areas" class="control" value="{{ $company?->service_areas ?? old('service_areas') }}">
            </div>
            <div class="col-12">
                <label class="{{ $labelClass }}">
                    <i class="bi bi-list-check me-1"></i>
                    Key Products/Services
                </label>
                <textarea name="key_products" rows="3" class="control">{{ $company?->key_products ?? old('key_products') }}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 justify-content-end pt-3 mt-4 border-top">
        <button type="button" class="btn btn-outline-secondary" data-company-close>
            <i class="bi bi-x-circle me-2"></i>
            Cancel
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>
            Update Company
        </button>
    </div>
</form>
