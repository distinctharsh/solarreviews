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

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ $title }}</h1>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Companies
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($method)

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $company->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city_id" class="form-label">Location <span class="text-danger">*</span></label>
                                    <select class="form-select @error('city_id') is-invalid @enderror" 
                                            id="city_id" name="city_id" required>
                                        <option value="">Select City</option>
                                        @foreach($cities as $state => $stateCities)
                                            <optgroup label="{{ $state }}">
                                                @foreach($stateCities as $city)
                                                    <option value="{{ $city->id }}" 
                                                        {{ old('city_id', $company->city_id) == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}, {{ $city->state->code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                               id="website" name="website" value="{{ old('website', $company->website) }}">
                                        @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $company->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone', $company->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2">{{ old('address', $company->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $company->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(isset($company) && $company->exists)
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       value="1" {{ old('is_active', $company->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Company Logo</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->name }}" 
                                             class="img-fluid mb-3" 
                                             style="max-height: 200px;">
                                    @else
                                        <div class="bg-light p-5 text-center mb-3">
                                            <i class="fas fa-building fa-4x text-muted"></i>
                                            <p class="mt-2 mb-0">No logo uploaded</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                           id="logo" name="logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recommended size: 300x300px. Max size: 2MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i> {{ $buttonText }}
                            </button>
                        </div>

                        @if(isset($company) && $company->exists)
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Created</span>
                                    <span>{{ $company->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Last Updated</span>
                                    <span>{{ $company->updated_at->format('M d, Y') }}</span>
                                </div>
                                @if($company->total_reviews > 0)
                                    <div class="mt-2 text-center">
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $company->average_rating)
                                                    <i class="fas fa-star"></i>
                                                @elseif($i - 0.5 <= $company->average_rating)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-1">{{ number_format($company->average_rating, 1) }} ({{ $company->total_reviews }} reviews)</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
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
