{{-- resources/views/admin/products/_form.blade.php --}}
@props(['product', 'brands', 'categories', 'types'])

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name *</label>
                    <input type="text" 
                           class="form-control @error('product_name') is-invalid @enderror" 
                           id="product_name" 
                           name="product_name" 
                           value="{{ old('product_name', $product->product_name) }}"
                           required>
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand *</label>
                            <select class="form-select @error('brand_id') is-invalid @enderror" 
                                    id="brand_id" 
                                    name="brand_id" 
                                    required>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" 
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category *</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id" 
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="model_name" class="form-label">Model Name *</label>
                            <input type="text" 
                                   class="form-control @error('model_name') is-invalid @enderror" 
                                   id="model_name" 
                                   name="model_name" 
                                   value="{{ old('model_name', $product->model_name) }}"
                                   required>
                            @error('model_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" 
                                    name="type">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" 
                                        {{ old('type', $product->type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="capacity_kw" class="form-label">Capacity (kW)</label>
                            <input type="number" 
                                   step="0.01" 
                                   class="form-control @error('capacity_kw') is-invalid @enderror" 
                                   id="capacity_kw" 
                                   name="capacity_kw" 
                                   value="{{ old('capacity_kw', $product->capacity_kw) }}">
                            @error('capacity_kw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" 
                                   class="form-control @error('size') is-invalid @enderror" 
                                   id="size" 
                                   name="size" 
                                   value="{{ old('size', $product->size) }}">
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="warranty" class="form-label">Warranty</label>
                    <input type="text" 
                           class="form-control @error('warranty') is-invalid @enderror" 
                           id="warranty" 
                           name="warranty" 
                           value="{{ old('warranty', $product->warranty) }}">
                    @error('warranty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="technical_details" class="form-label">Technical Details (one per line)</label>
                    <textarea class="form-control @error('technical_details') is-invalid @enderror" 
                              id="technical_details" 
                              name="technical_details" 
                              rows="5">{{ old('technical_details', is_array($product->technical_details) ? implode("\n", $product->technical_details) : $product->technical_details) }}</textarea>
                    @error('technical_details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Specifications -->
<div class="mb-4">
    <h5 class="mb-3">Product Specifications</h5>
    <div id="specs-container">
        @if(isset($product) && $product->specs->count() > 0)
            @foreach($product->specs as $index => $spec)
                <div class="row mb-2 spec-row">
                    <div class="col-md-5">
                        <input type="text" 
                               name="specs[{{ $index }}][name]" 
                               class="form-control" 
                               placeholder="Specification name"
                               value="{{ old('specs.'.$index.'.name', $spec->spec_name) }}"
                               required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" 
                               name="specs[{{ $index }}][value]" 
                               class="form-control" 
                               placeholder="Specification value"
                               value="{{ old('specs.'.$index.'.value', $spec->spec_value) }}"
                               required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-spec">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row mb-2 spec-row">
                <div class="col-md-5">
                    <input type="text" 
                           name="specs[0][name]" 
                           class="form-control" 
                           placeholder="Specification name"
                           required>
                </div>
                <div class="col-md-5">
                    <input type="text" 
                           name="specs[0][value]" 
                           class="form-control" 
                           placeholder="Specification value"
                           required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-spec">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
    <button type="button" id="add-spec" class="btn btn-secondary btn-sm mt-2">
        <i class="fas fa-plus"></i> Add Specification
    </button>
</div>
</div>




@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('specs-container');
        let specCount = {{ isset($product) ? $product->specs->count() : 1 }};
        
        // Add new spec field
        document.getElementById('add-spec').addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'row mb-2 spec-row';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <input type="text" 
                           name="specs[${specCount}][name]" 
                           class="form-control" 
                           placeholder="Specification name"
                           required>
                </div>
                <div class="col-md-5">
                    <input type="text" 
                           name="specs[${specCount}][value]" 
                           class="form-control" 
                           placeholder="Specification value"
                           required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-spec">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            specCount++;
            
            // Add event listener to the new remove button
            newRow.querySelector('.remove-spec').addEventListener('click', function() {
                newRow.remove();
            });
        });
        
        // Remove spec field
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-spec')) {
                e.target.closest('.spec-row').remove();
            }
        });
    });
</script>
@endpush