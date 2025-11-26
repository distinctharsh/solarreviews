@extends('admin.layouts.app')

@section('page_title', 'Edit Brand')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Edit Brand</h1>
        <p class="text-muted">Update brand: {{ $brand->name }}</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Brands
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="form-label">Brand Name <span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $brand->name) }}" placeholder="e.g., Tata Solar, Luminous, Havells" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="country" class="form-label">Country of Origin</label>
                    <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" 
                           value="{{ old('country', $brand->country) }}" placeholder="e.g., India, China, USA">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3" placeholder="Brief description about this brand">{{ old('description', $brand->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="website" class="form-label">Website URL</label>
                    <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" 
                           value="{{ old('website', $brand->website) }}" placeholder="https://www.example.com">
                    @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="established_year" class="form-label">Established Year</label>
                    <input type="number" name="established_year" id="established_year" class="form-control @error('established_year') is-invalid @enderror" 
                           value="{{ old('established_year', $brand->established_year) }}" min="1800" max="{{ date('Y') }}" placeholder="e.g., 1995">
                    @error('established_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="logo" class="form-label">Brand Logo</label>
                    @if($brand->logo)
                        <div class="current-image">
                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                            <span>Current Logo</span>
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" 
                           accept="image/*">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Leave empty to keep current logo. Recommended: 200x200px, Max 2MB</small>
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', $brand->sort_order) }}" min="0" placeholder="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lower numbers appear first</small>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Categories</label>
                <p class="form-text text-muted mb-2">Select categories where this brand has products</p>
                <div class="checkbox-grid">
                    @php
                        $selectedCategories = old('categories', $brand->categories->pluck('id')->toArray());
                    @endphp
                    @foreach($categories as $category)
                        <label class="checkbox-item">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                   {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                            <span class="checkbox-label">
                                @if($category->icon)
                                    <i class="{{ $category->icon }}"></i>
                                @endif
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-row">
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
                        <span class="checkbox-label">Active</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $brand->is_featured) ? 'checked' : '' }}>
                        <span class="checkbox-label">Featured Brand</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Brand
                </button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #374151;
}

.required {
    color: #ef4444;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #3ba14c;
    box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.1);
}

.form-control.is-invalid {
    border-color: #ef4444;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-text {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.current-image {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: #f9fafb;
    border-radius: 8px;
}

.current-image img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    background: #fff;
    padding: 4px;
}

.current-image span {
    font-size: 0.875rem;
    color: #6b7280;
}

.checkbox-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 0.75rem;
}

.checkbox-row {
    display: flex;
    gap: 2rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.2s;
}

.checkbox-item:hover {
    background: #f9fafb;
    border-color: #3ba14c;
}

.checkbox-item input {
    width: 1.1rem;
    height: 1.1rem;
    cursor: pointer;
}

.checkbox-item input:checked + .checkbox-label {
    color: #3ba14c;
    font-weight: 600;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.9rem;
}

.checkbox-label i {
    font-size: 0.85rem;
    color: #6b7280;
}

.form-actions {
    display: flex;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 1rem;
}
</style>
@endsection

