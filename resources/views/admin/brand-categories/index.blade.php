@extends('admin.layouts.app')

@section('page_title', 'Manage Brand Categories')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Brand Categories</h1>
        <p class="text-muted">Manage relationships between brands and categories</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Select Brand</h5>
                    </div>
                    <div class="card-body">
                        <select id="brandSelect" class="form-select">
                            <option value="">-- Select a Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Assign Categories</h5>
                        <span id="selectedBrand" class="badge bg-primary"></span>
                    </div>
                    <div class="card-body">
                        <form id="brandCategoryForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">Select Categories</label>
                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input category-checkbox" type="checkbox" 
                                               name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                        <label class="form-check-label" for="category{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="saveButton" disabled>
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const brandSelect = document.getElementById('brandSelect');
        const brandCategoryForm = document.getElementById('brandCategoryForm');
        const selectedBrandSpan = document.getElementById('selectedBrand');
        const saveButton = document.getElementById('saveButton');
        
        brandSelect.addEventListener('change', function() {
            const brandId = this.value;
            
            if (!brandId) {
                selectedBrandSpan.textContent = '';
                saveButton.disabled = true;
                document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.disabled = true;
                });
                return;
            }
            
            // Update form action
            brandCategoryForm.action = `/admin/brand-categories/${brandId}`;
            
            // Show selected brand
            const selectedOption = this.options[this.selectedIndex];
            selectedBrandSpan.textContent = selectedOption.text;
            
            // Fetch brand's categories
            fetch(`/admin/brand-categories/${brandId}/get-categories`)
                .then(response => response.json())
                .then(data => {
                    // Uncheck all checkboxes first
                    document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                        checkbox.checked = false;
                        checkbox.disabled = false;
                    });
                    
                    // Check the categories that this brand belongs to
                    data.categories.forEach(categoryId => {
                        const checkbox = document.querySelector(`input[value="${categoryId}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                    
                    saveButton.disabled = false;
                });
        });
    });
</script>
@endpush

<style>
.badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.card {
    margin-bottom: 1.5rem;
}

.card-header h5 {
    margin-bottom: 0;
}

.form-check {
    margin-bottom: 0.5rem;
}

#saveButton:disabled {
    cursor: not-allowed;
}
</style>
@endsection
