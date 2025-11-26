@extends('admin.layouts.app')

@section('page_title', 'Edit Category')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Edit Category</h1>
        <p class="text-muted">Update category: {{ $category->name }}</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="form-label">Category Name <span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $category->name) }}" placeholder="e.g., Inverter, Panel, Battery" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', $category->sort_order) }}" min="0" placeholder="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lower numbers appear first</small>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3" placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="icon" class="form-label">Icon Class</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" 
                           value="{{ old('icon', $category->icon) }}" placeholder="e.g., fas fa-solar-panel">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Font Awesome icon class</small>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Category Image</label>
                    @if($category->image)
                        <div class="current-image">
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                            <span>Current Image</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Leave empty to keep current image. Recommended: 200x200px, Max 2MB</small>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                           {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Active</label>
                </div>
                <small class="form-text text-muted">Inactive categories won't be shown to users</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
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

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    cursor: pointer;
}

.form-check-label {
    cursor: pointer;
    font-weight: 500;
}

.form-actions {
    display: flex;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 1rem;
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
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

.current-image span {
    font-size: 0.875rem;
    color: #6b7280;
}
</style>
@endsection

