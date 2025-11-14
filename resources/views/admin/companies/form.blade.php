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
                <!-- Left Column -->
                <div>
                    <!-- Company Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            Company Name <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                               class="form-input @error('name') border-red-500 @enderror"
                               value="{{ old('name', $company->name) }}">
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="form-group">
                        <label for="state_id" class="form-label">
                            State <span style="color: #e53e3e;">*</span>
                        </label>
                        <select id="state_id" name="state_id" required
                                class="form-input @error('state_id') border-red-500 @enderror">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id', $company->state_id) == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }} ({{ $state->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categories -->
                    <div class="form-group">
                        <label for="category_ids" class="form-label">
                            Categories (Products Provided)
                        </label>
                        <select id="category_ids" name="category_ids[]" multiple
                                class="form-input @error('category_ids') border-red-500 @enderror">
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('category_ids', isset($company) ? $company->categories()->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('category_ids')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="4"
                                  class="form-input form-textarea @error('description') border-red-500 @enderror">{{ old('description', $company->description) }}</textarea>
                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo Upload -->
                    <div class="form-group">
                        <label class="form-label">Company Logo</label>
                        <div class="logo-upload">
                            @if($company->logo)
                                <div class="logo-preview">
                                    <img src="{{ asset($company->logo) }}" 
                                         alt="{{ $company->name }} logo"
                                         style="width: 100%; height: 100%; object-fit: cover; max-width: 200px; max-height: 200px;">
                                </div>
                                <div style="flex: 1; margin-left: 20px;">
                                    <input type="file" id="logo" name="logo" accept="image/*" 
                                           class="form-input" style="padding: 5px; margin-bottom: 10px;">
                                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                                        Current logo will be replaced
                                    </div>
                                </div>
                            @else
                                <label class="logo-preview" style="cursor: pointer;">
                                    <div class="logo-placeholder">
                                        <div>Logo</div>
                                        <div>+</div>
                                    </div>
                                    <input type="file" id="logo" name="logo" accept="image/*" 
                                           style="display: none;">
                                </label>
                                <div>
                                    <div style="font-size: 14px; margin-bottom: 4px;">Click to upload logo</div>
                                    <div style="font-size: 12px; color: #a0aec0;">PNG, JPG up to 2MB</div>
                                </div>
                            @endif
                        </div>
                        @error('logo')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status (only for edit) -->
                    @if(isset($company) && $company->exists)
                        <div class="form-group" style="display: flex; align-items: center;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   style="margin-right: 8px;"
                                   {{ old('is_active', $company->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="form-label" style="margin: 0;">
                                Active Company
                            </label>
                        </div>
                    @endif
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
