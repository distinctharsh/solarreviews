@extends('admin.layouts.app')

@section('page_title', 'Edit Category')

@section('content')
<div class="form-page-hero">
    <div>
        <h1>Edit Category</h1>
        <p>Update {{ $category->name }} details & presentation.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-pill">
            <i class="fas fa-arrow-left"></i>
            Back to list
        </a>
        <span class="badge-note">
            <i class="fas fa-layer-group"></i>
            ID #{{ $category->id }}
        </span>
    </div>
</div>

@if ($errors->any())
    <div class="form-alert">
        <strong>We found a few issues:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="form-wrapper">
    @csrf
    @method('PUT')

    <section class="form-section">
        <div class="form-grid-two">
            <div class="form-control-stack">
                <label for="name">Category name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="@error('name') is-invalid @enderror">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-control-stack">
                <label for="sort_order">Sort order</label>
                <input type="number" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order) }}" class="@error('sort_order') is-invalid @enderror">
                <span class="form-hint">Lower values appear first in listings</span>
                @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="form-control-stack mt-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" class="@error('description') is-invalid @enderror" placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-grid-two mt-3">
            <div class="form-control-stack">
                <label for="icon">Icon class</label>
                <input type="text" id="icon" name="icon" placeholder="e.g., fas fa-solar-panel" value="{{ old('icon', $category->icon) }}" class="@error('icon') is-invalid @enderror">
                <span class="form-hint">Font Awesome class for badges</span>
                @error('icon') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-control-stack">
                <label for="image">Category image</label>
                @if($category->image)
                    <div class="media-preview">
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }} thumbnail">
                        <div>
                            <strong>Current image</strong>
                            <p class="mb-0 form-hint">Upload a new file to replace</p>
                        </div>
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*" class="@error('image') is-invalid @enderror">
                <span class="form-hint">200x200px PNG/JPG, max 2MB</span>
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="switch-stack mt-3">
            <label>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                Active category
            </label>
            <span class="form-hint">Inactive categories remain hidden from public pages.</span>
        </div>

        <div class="form-actions-bar mt-4">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-pill">Cancel</a>
            <button type="submit" class="btn btn-primary btn-pill">
                <i class="fas fa-save"></i>
                Update category
            </button>
        </div>
    </section>
</form>
@endsection

