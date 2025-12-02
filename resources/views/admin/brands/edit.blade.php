@extends('admin.layouts.app')

@section('page_title', 'Edit Brand')

@section('content')
<div class="form-page-hero">
    <div>
        <h1>Edit Brand</h1>
        <p>Refresh {{ $brand->name }} details and visuals.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-pill">
            <i class="fas fa-arrow-left"></i>
            Back to list
        </a>
        <span class="badge-note">
            <i class="fas fa-tags"></i>
            Brand #{{ $brand->id }}
        </span>
    </div>
</div>

@if($errors->any())
    <div class="form-alert">
        <strong>We found a few issues:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data" class="form-wrapper">
    @csrf
    @method('PUT')

    <section class="form-section">
        <div class="form-grid-two">
            <div class="form-control-stack">
                <label for="name">Brand name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $brand->name) }}" required class="@error('name') is-invalid @enderror">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-control-stack">
                <label for="country">Country of origin</label>
                <input type="text" id="country" name="country" value="{{ old('country', $brand->country) }}" placeholder="e.g., India, USA" class="@error('country') is-invalid @enderror">
                @error('country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="form-control-stack mt-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" class="@error('description') is-invalid @enderror" placeholder="Brief overview of the brand">{{ old('description', $brand->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </section>

    <section class="form-section">
        <div class="form-grid-two" style="align-items: flex-start;">
            <div class="form-control-stack">
                <label for="logo_url">Brand logo</label>
                @if($brand->logo_url)
                    <div class="media-preview">
                        <img src="{{ asset($brand->logo_url) }}" alt="{{ $brand->name }} logo">
                        <div>
                            <strong>Current logo</strong>
                            <p class="mb-0 form-hint">Upload a file to replace</p>
                        </div>
                    </div>
                    <label class="switch-stack mt-2">
                        <span>
                            <input class="form-check-input" type="checkbox" name="remove_logo" value="1">
                            Remove current logo
                        </span>
                    </label>
                @endif
                <input type="file" id="logo_url" name="logo_url" accept="image/*" class="@error('logo_url') is-invalid @enderror">
                <span class="form-hint">Recommended size: 200x100px PNG/JPG</span>
                @error('logo_url') <small class="text-danger">{{ $message }}</small> @enderror
                <div class="media-preview mt-3" id="logo-preview" style="display:none;">
                    <img src="#" alt="Logo preview">
                    <div>
                        <strong>New upload preview</strong>
                    </div>
                </div>
            </div>
            <div class="form-control-stack">
                <label>Status</label>
                <div class="switch-stack">
                    <label>
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $brand->is_featured ?? false) ? 'checked' : '' }}>
                        Featured brand
                    </label>
                </div>
                <span class="form-hint">Optional badge for highlighting brands in listings.</span>
            </div>
        </div>

        <div class="form-actions-bar mt-4">
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-pill">Cancel</a>
            <button type="submit" class="btn btn-primary btn-pill">
                <i class="fas fa-save"></i>
                Update brand
            </button>
        </div>
    </section>
</form>

@section('scripts')
<script>
    // Show image preview when a file is selected
    document.getElementById('logo_url').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.getElementById('logo-preview');
            const img = preview.querySelector('img');
            
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

@endsection