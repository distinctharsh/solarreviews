@extends('admin.layouts.app')

@section('page_title', 'Edit Brand')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Edit Brand</h1>
        <p class="text-muted">Update brand: {{ $brand->name }}</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Brands
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Brand Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $brand->name) }}" placeholder="e.g., Tata Solar, Luminous, Havells" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" 
                                       value="{{ old('country', $brand->country) }}" placeholder="e.g., India, China, USA">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                          rows="4" placeholder="Brief description about this brand">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Brand Logo</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="logo_url" class="form-label">Brand Logo</label>
                                
                                @if($brand->logo_url)
                                    <div class="mb-2">
                                        <img src="{{ asset($brand->logo_url) }}" alt="{{ $brand->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 100px;">
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo" value="1">
                                        <label class="form-check-label" for="remove_logo">
                                            Remove current logo
                                        </label>
                                    </div>
                                    <small class="d-block text-muted mb-2">- OR -</small>
                                @endif
                                
                                <input type="file" name="logo_url" id="logo_url" class="form-control-file @error('logo_url') is-invalid @enderror" 
                                       accept="image/*">
                                @error('logo_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Recommended size: 200x100px</small>
                                
                                <div class="mt-2" id="logo-preview" style="display: none;">
                                    <img src="#" alt="Logo Preview" class="img-thumbnail" style="max-width: 200px; max-height: 100px;">
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Brand
                                </button>
                                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

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