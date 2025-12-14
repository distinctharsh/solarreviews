@if(isset($company) && $company->exists)
    @php
        $route = route('admin.companies.update', $company);
        $method = 'PUT';
        $title = 'Edit Company';
        $buttonText = 'Update Company';
    @endphp
@else
    @php
        $route = route('admin.companies.store');
        $method = 'POST';
        $title = 'Add New Company';
        $buttonText = 'Create Company';
        $company = new App\Models\Company();
    @endphp
@endif

@php
    $selectedStateId = old('state_id', $company->state_id ?? optional($states->firstWhere('name', $company->state))->id);
@endphp

<style>
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .form-title {
        font-size: 24px;
        font-weight: bold;
        color: #1a202c;
    }
    .form-section {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 25px;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #4a5568;
    }
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        font-size: 14px;
    }
    .form-input:focus {
        outline: none;
        border-color: #3182ce;
        box-shadow: 0 0 0 1px #3182ce;
    }
    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }
    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        border: none;
    }
    .btn-primary {
        background: #3182ce;
        color: white;
    }
    .btn-primary:hover {
        background: #2c5282;
    }
    .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }
    .btn-secondary:hover {
        background: #cbd5e0;
    }
    .error-message {
        color: #e53e3e;
        font-size: 14px;
        margin-top: 4px;
    }
    .logo-upload {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .logo-preview {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f7fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .logo-placeholder {
        color: #a0aec0;
        font-size: 12px;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h1 class="form-title">{{ $title }}</h1>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">
            &larr; Back to Companies
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:20px; border-radius:6px; padding:12px 16px; background:#FEF2F2; color:#991B1B;">
            <strong>There were some problems with your input:</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($company) && $company->exists)
    <div style="margin-bottom: 20px; color: #4a5568; font-size: 14px;">
        <div>Created: {{ $company->created_at->format('M d, Y') }}</div>
        @if($company->total_reviews > 0)
            <div>Rating: {{ number_format($company->average_rating, 1) }} ({{ $company->total_reviews }} reviews)</div>
        @endif
    </div>
    @endif

    <div class="form-section">
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="form-row">
                <div>
                    <div class="form-group">
                        <label for="owner_name" class="form-label">
                            Company / Owner Name <span style="color:#e53e3e;">*</span>
                        </label>
                        <input type="text" id="owner_name" name="owner_name" required
                               class="form-input @error('owner_name') border-red-500 @enderror"
                               value="{{ old('owner_name', $company->owner_name) }}">
                        @error('owner_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row" style="gap:10px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label for="company_type" class="form-label">Company Type *</label>
                            <select id="company_type" name="company_type" required class="form-input @error('company_type') border-red-500 @enderror">
                                <option value="">Select Type</option>
                                @foreach($companyTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('company_type', $company->company_type) === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_type')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label for="status" class="form-label">Status *</label>
                            <select id="status" name="status" class="form-input @error('status') border-red-500 @enderror" required>
                                <option value="active" {{ old('status', $company->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $company->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="display:flex; align-items:center; gap:10px;">
                        <input type="hidden" name="is_active" value="0">
                        <label class="form-label" style="margin:0; display:flex; align-items:center; gap:6px;">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $company->is_active ?? 1) ? 'checked' : '' }}>
                            Visible on site
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Details</label>
                        <input type="text" name="phone" placeholder="Phone *" required
                               class="form-input @error('phone') border-red-500 @enderror"
                               value="{{ old('phone', $company->phone) }}" style="margin-bottom:10px;">
                        <input type="email" name="email" placeholder="Email *" required
                               class="form-input @error('email') border-red-500 @enderror"
                               value="{{ old('email', $company->email) }}" style="margin-bottom:10px;">
                        <input type="url" name="website_url" placeholder="Website"
                               class="form-input @error('website_url') border-red-500 @enderror"
                               value="{{ old('website_url', $company->website_url) }}">
                        @error('phone')<p class="error-message">{{ $message }}</p>@enderror
                        @error('email')<p class="error-message">{{ $message }}</p>@enderror
                        @error('website_url')<p class="error-message">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Business Details</label>
                        <div class="form-row" style="gap:10px;">
                            <input type="number" name="years_in_business" placeholder="Years in business"
                                   class="form-input @error('years_in_business') border-red-500 @enderror"
                                   value="{{ old('years_in_business', $company->years_in_business) }}">
                            <input type="text" name="gst_number" placeholder="GST / Registration"
                                   class="form-input @error('gst_number') border-red-500 @enderror"
                                   value="{{ old('gst_number', $company->gst_number) }}">
                        </div>
                        @error('years_in_business')<p class="error-message">{{ $message }}</p>@enderror
                        @error('gst_number')<p class="error-message">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="6"
                                  class="form-input form-textarea @error('description') border-red-500 @enderror">{{ old('description', $company->description) }}</textarea>
                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label for="address" class="form-label">Full Address *</label>
                        <textarea id="address" name="address" rows="3" required
                                  class="form-input form-textarea @error('address') border-red-500 @enderror">{{ old('address', $company->address) }}</textarea>
                        @error('address')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <div class="form-row" style="gap:10px;">
                            <select id="state_id" name="state_id" required
                                    class="form-input @error('state_id') border-red-500 @enderror">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $selectedStateId == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="city" placeholder="City *" required
                                   class="form-input @error('city') border-red-500 @enderror"
                                   value="{{ old('city', $company->city) }}">
                        </div>
                        <div class="form-row" style="gap:10px; margin-top:10px;">
                            <select id="city_id" name="city_id" class="form-input @error('city_id') border-red-500 @enderror">
                                <option value="">Linked City (optional)</option>
                                @foreach($cities as $cityOption)
                                    <option value="{{ $cityOption->id }}" {{ old('city_id', $company->city_id) == $cityOption->id ? 'selected' : '' }}>
                                        {{ $cityOption->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="pincode" placeholder="Pincode *" required
                                   class="form-input @error('pincode') border-red-500 @enderror"
                                   value="{{ old('pincode', $company->pincode) }}">
                        </div>
                        @error('state_id')<p class="error-message">{{ $message }}</p>@enderror
                        @error('city')<p class="error-message">{{ $message }}</p>@enderror
                        @error('city_id')<p class="error-message">{{ $message }}</p>@enderror
                        @error('pincode')<p class="error-message">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Company Logo</label>
                        <div class="logo-upload">
                            @if($company->logo_url)
                                <div class="logo-preview">
                                    <img src="{{ asset($company->logo_url) }}" 
                                         alt="{{ $company->owner_name }} logo"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1; margin-left: 20px;">
                                    <input type="file" id="logo" name="logo" accept="image/*" class="form-input" style="padding:5px; margin-bottom:10px;">
                                    <div style="font-size:12px; color:#666;">Uploading a new image will replace the current logo.</div>
                                </div>
                            @else
                                <label class="logo-preview" style="cursor: pointer;">
                                    <div class="logo-placeholder">
                                        <div>Logo</div>
                                        <div>+</div>
                                    </div>
                                    <input type="file" id="logo" name="logo" accept="image/*" style="display:none;">
                                </label>
                                <div>
                                    <div style="font-size:14px; margin-bottom:4px;">Click to upload logo</div>
                                    <div style="font-size:12px; color:#a0aec0;">PNG / JPG up to 2MB</div>
                                </div>
                            @endif
                        </div>
                        @error('logo')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.companies.index') }}" 
                   class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ $buttonText }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Simple JavaScript for logo preview
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('logo');
        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const logoPreview = document.querySelector('.logo-preview');
                        if (logoPreview) {
                            logoPreview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any JavaScript here if needed
    });
</script>
@endpush
