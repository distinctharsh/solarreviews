@php
    $isEdit = isset($product) && $product->exists;
    $route = $isEdit ? route('admin.products.update', $product) : route('admin.products.store');
    $method = $isEdit ? 'PUT' : 'POST';
    $title = $isEdit ? 'Edit Product' : 'Add Product';
    $buttonText = $isEdit ? 'Update Product' : 'Create Product';
    $specValue = old('specs');
    if ($specValue === null && isset($product) && $product->specs) {
        $specValue = implode("\n", (array) $product->specs);
    }
@endphp

<style>
    .product-form__container { max-width: 960px; margin: 0 auto; padding: 20px; }
    .product-form__header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .product-form__section { background:#fff; border-radius:16px; padding:28px; box-shadow:0 16px 30px rgb(15 23 42 / 0.09); }
    .product-form__row { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:18px; margin-bottom:18px; }
    .product-form__group { margin-bottom:18px; }
    .product-form__label { font-weight:600; font-size:0.9rem; color:#0f172a; margin-bottom:6px; display:block; }
    .product-form__input,
    .product-form__select,
    .product-form__textarea { width:100%; border:1px solid #d0d7e3; border-radius:10px; padding:11px 14px; font-size:.95rem; transition:border .15s ease, box-shadow .15s ease; background:#f8fafc; }
    .product-form__input:focus,
    .product-form__select:focus,
    .product-form__textarea:focus { outline:none; border-color:#2563eb; box-shadow:0 0 0 2px rgba(37,99,235,.15); background:#fff; }
    .product-form__textarea { min-height:115px; resize:vertical; }
    .product-form__actions { display:flex; justify-content:flex-end; gap:12px; margin-top:24px; }
    .product-form__btn { border:none; border-radius:999px; padding:12px 24px; font-weight:600; cursor:pointer; transition:transform .15s ease, box-shadow .15s ease; }
    .product-form__btn:hover { transform: translateY(-1px); box-shadow:0 8px 16px rgb(15 23 42 / 0.15); }
    .product-form__btn-primary { background:linear-gradient(135deg,#2563eb,#1d4ed8); color:#fff; }
    .product-form__btn-secondary { background:#e2e8f0; color:#0f172a; }
    .product-form__error { color:#dc2626; font-size:.8rem; margin-top:4px; }
    .product-form__alert { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; border-radius:10px; padding:14px 18px; margin-bottom:24px; }
</style>

<div class="product-form__container">
    <div class="product-form__header">
        <h1 class="form-title">{{ $title }}</h1>
        <a href="{{ route('admin.products.index') }}" class="product-form__btn product-form__btn-secondary">&larr; Back to Products</a>
    </div>

    @if($errors->any())
        <div class="product-form__alert">
            <strong>There were some problems with your input:</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="product-form__section">
        <form action="{{ $route }}" method="POST">
            @csrf
            @method($method)

            <div class="product-form__row">
                <div class="product-form__group">
                    <label class="product-form__label">Product Name *</label>
                    <input type="text" name="name" class="product-form__input @error('name') border-red-500 @enderror" value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name')<p class="product-form__error">{{ $message }}</p>@enderror
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Company *</label>
                    <select name="company_id" class="product-form__select @error('company_id') border-red-500 @enderror" required>
                        <option value="">Select company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id', $product->company_id ?? '') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')<p class="product-form__error">{{ $message }}</p>@enderror
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Brand</label>
                    <select name="brand_id" class="product-form__select">
                        <option value="">Select brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Category *</label>
                    <select name="category_id" class="product-form__select @error('category_id') border-red-500 @enderror" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="product-form__error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="product-form__row">
                <div class="product-form__group">
                    <label class="product-form__label">Model Number</label>
                    <input type="text" name="model_number" class="product-form__input" value="{{ old('model_number', $product->model_number ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Variant</label>
                    <input type="text" name="variant" class="product-form__input" value="{{ old('variant', $product->variant ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Wattage / Capacity</label>
                    <input type="text" name="wattage_or_capacity" class="product-form__input" value="{{ old('wattage_or_capacity', $product->wattage_or_capacity ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Technology</label>
                    <input type="text" name="technology" class="product-form__input" value="{{ old('technology', $product->technology ?? '') }}">
                </div>
            </div>

            <div class="product-form__row">
                <div class="product-form__group">
                    <label class="product-form__label">Efficiency (%)</label>
                    <input type="number" step="0.01" min="0" max="100" name="efficiency" class="product-form__input" value="{{ old('efficiency', $product->efficiency ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Warranty (years)</label>
                    <input type="number" min="0" max="50" name="warranty_years" class="product-form__input" value="{{ old('warranty_years', $product->warranty_years ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">Datasheet URL</label>
                    <input type="url" name="datasheet_url" class="product-form__input" value="{{ old('datasheet_url', $product->datasheet_url ?? '') }}">
                </div>
                <div class="product-form__group">
                    <label class="product-form__label">MSRP (₹)</label>
                    <input type="number" step="0.01" min="0" name="msrp" class="product-form__input" value="{{ old('msrp', $product->msrp ?? '') }}">
                </div>
            </div>

            <div class="product-form__group">
                <label class="product-form__label">Description</label>
                <textarea name="description" class="product-form__textarea">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="product-form__group">
                <label class="product-form__label">Key Specs (one per line)</label>
                <textarea name="specs" class="product-form__textarea" rows="4">{{ $specValue }}</textarea>
            </div>

            <div class="product-form__group" style="display:flex; align-items:center; gap:18px;">
                <label class="product-form__label" style="margin:0; display:flex; align-items:center; gap:6px;">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? 1) ? 'checked' : '' }}>
                    Active product
                </label>
            </div>

            <div class="product-form__actions">
                <a href="{{ route('admin.products.index') }}" class="product-form__btn product-form__btn-secondary">Cancel</a>
                <button type="submit" class="product-form__btn product-form__btn-primary">{{ $buttonText }}</button>
            </div>
        </form>
    </div>
</div>
