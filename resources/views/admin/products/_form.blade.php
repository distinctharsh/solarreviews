@props(['product' => null, 'categories', 'states'])

<!-- Basic Information -->
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
    
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Name -->
        <div class="md:col-span-2">
            <x-label for="name" :value="__('Product Name')" required />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name ?? '')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Category -->
        <div>
            <x-label for="category_id" :value="__('Category')" required />
            <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="">{{ __('Select a category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <!-- Manufacturer -->
        <div>
            <x-label for="manufacturer" :value="__('Manufacturer')" />
            <x-input id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" :value="old('manufacturer', $product->manufacturer ?? '')" />
            <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
        </div>

        <!-- Model Number -->
        <div>
            <x-label for="model_number" :value="__('Model Number')" />
            <x-input id="model_number" class="block mt-1 w-full" type="text" name="model_number" :value="old('model_number', $product->model_number ?? '')" />
            <x-input-error :messages="$errors->get('model_number')" class="mt-2" />
        </div>

        <!-- Warranty -->
        <div>
            <x-label for="warranty_years" :value="__('Warranty (Years)')" />
            <x-input id="warranty_years" class="block mt-1 w-full" type="number" min="0" max="100" name="warranty_years" :value="old('warranty_years', $product->warranty_years ?? '')" />
            <x-input-error :messages="$errors->get('warranty_years')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center">
                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm text-gray-600">{{ __('Active') }}</label>
            </div>
            
            <div class="flex items-center">
                <input id="is_featured" name="is_featured" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                <label for="is_featured" class="ml-2 text-sm text-gray-600">{{ __('Featured') }}</label>
            </div>
        </div>

        <!-- Image -->
        <div class="md:col-span-2">
            <x-label for="image" :value="__('Product Image')" />
            @if(isset($product) && $product->image)
                <div class="mt-2">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded-md">
                </div>
            @endif
            <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <x-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $product->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Features -->
        <div class="md:col-span-2">
            <x-label :value="__('Features')" />
            <div id="features-container" class="space-y-2">
                @php
                    $features = old('features', $product->features ?? ['']);
                    if (is_string($features)) {
                        $features = json_decode($features, true) ?: [];
                    }
                @endphp
                
                @foreach($features as $index => $feature)
                    <div class="flex items-center">
                        <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter a feature">
                        @if($index > 0)
                            <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-feature">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-feature" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Add Feature') }}
            </button>
        </div>
    </div>
</div>

<!-- Product Variants -->
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Product Variants') }}</h3>
    </div>
    
    <div id="variants-container">
        @php
            $variants = old('variants', isset($product) && $product->variants->count() ? $product->variants->toArray() : [['state_id' => '', 'price' => '', 'sale_price' => '', 'stock_quantity' => 0, 'sku' => '', 'weight' => '', 'length' => '', 'width' => '', 'height' => '']]);
            if (empty($variants)) {
                $variants = [['state_id' => '', 'price' => '', 'sale_price' => '', 'stock_quantity' => 0, 'sku' => '', 'weight' => '', 'length' => '', 'width' => '', 'height' => '']];
            }
        @endphp
        
        @foreach($variants as $index => $variant)
            <div class="variant-item border border-gray-200 rounded-lg p-4 mb-4">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-medium text-gray-700">{{ __('Variant #') }}{{ $index + 1 }}</h4>
                    @if($index > 0)
                        <button type="button" class="text-red-500 hover:text-red-700 remove-variant">
                            {{ __('Remove') }}
                        </button>
                    @endif
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant['id'] ?? '' }}">
                    
                    <!-- State -->
                    <div>
                        <x-label :value="__('State')" required />
                        <select name="variants[{{ $index }}][state_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">{{ __('Select a state') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ (old('variants.'.$index.'.state_id', $variant['state_id'] ?? '') == $state->id) ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('variants.'.$index.'.state_id')" class="mt-1" />
                    </div>
                    
                    <!-- Price -->
                    <div>
                        <x-label :value="__('Price')" required />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="variants[{{ $index }}][price]" value="{{ old('variants.'.$index.'.price', $variant['price'] ?? '') }}" required class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('variants.'.$index.'.price')" class="mt-1" />
                    </div>
                    
                    <!-- Sale Price -->
                    <div>
                        <x-label :value="__('Sale Price')" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="variants[{{ $index }}][sale_price]" value="{{ old('variants.'.$index.'.sale_price', $variant['sale_price'] ?? '') }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('variants.'.$index.'.sale_price')" class="mt-1" />
                    </div>
                    
                    <!-- Stock Quantity -->
                    <div>
                        <x-label :value="__('Stock Quantity')" required />
                        <x-input type="number" min="0" name="variants[{{ $index }}][stock_quantity]" :value="old('variants.'.$index.'.stock_quantity', $variant['stock_quantity'] ?? 0)" required />
                        <x-input-error :messages="$errors->get('variants.'.$index.'.stock_quantity')" class="mt-1" />
                    </div>
                    
                    <!-- SKU -->
                    <div>
                        <x-label :value="__('SKU')" />
                        <x-input type="text" name="variants[{{ $index }}][sku]" :value="old('variants.'.$index.'.sku', $variant['sku'] ?? '')" />
                        <x-input-error :messages="$errors->get('variants.'.$index.'.sku')" class="mt-1" />
                    </div>
                    
                    <!-- Dimensions -->
                    <div class="md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-label :value="__('Weight (kg)')" />
                            <x-input type="number" step="0.01" min="0" name="variants[{{ $index }}][weight]" :value="old('variants.'.$index.'.weight', $variant['weight'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.weight')" class="mt-1" />
                        </div>
                        <div>
                            <x-label :value="__('Length (cm)')" />
                            <x-input type="number" step="0.01" min="0" name="variants[{{ $index }}][length]" :value="old('variants.'.$index.'.length', $variant['length'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.length')" class="mt-1" />
                        </div>
                        <div>
                            <x-label :value="__('Width (cm)')" />
                            <x-input type="number" step="0.01" min="0" name="variants[{{ $index }}][width]" :value="old('variants.'.$index.'.width', $variant['width'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.width')" class="mt-1" />
                        </div>
                        <div>
                            <x-label :value="__('Height (cm)')" />
                            <x-input type="number" step="0.01" min="0" name="variants[{{ $index }}][height]" :value="old('variants.'.$index.'.height', $variant['height'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.height')" class="mt-1" />
                        </div>
                    </div>
                    
                    <!-- Sale Dates -->
                    <div class="md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-label :value="__('Sale Start Date')" />
                            <x-input type="date" name="variants[{{ $index }}][sale_start_date]" :value="old('variants.'.$index.'.sale_start_date', $variant['sale_start_date'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.sale_start_date')" class="mt-1" />
                        </div>
                        <div>
                            <x-label :value="__('Sale End Date')" />
                            <x-input type="date" name="variants[{{ $index }}][sale_end_date]" :value="old('variants.'.$index.'.sale_end_date', $variant['sale_end_date'] ?? '')" />
                            <x-input-error :messages="$errors->get('variants.'.$index.'.sale_end_date')" class="mt-1" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <button type="button" id="add-variant" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ __('Add Variant') }}
    </button>
</div>

<!-- Form Actions -->
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.products.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ __('Cancel') }}
    </a>
    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ $product ? __('Update Product') : __('Create Product') }}
    </button>
</div>

@push('scripts')
<script>
    // Add feature field
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const featureCount = container.querySelectorAll('input[type="text"]').length;
        const div = document.createElement('div');
        div.className = 'flex items-center';
        div.innerHTML = `
            <input type="text" name="features[]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter a feature">
            <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-feature">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        `;
        container.appendChild(div);
        
        // Add event listener to the new remove button
        div.querySelector('.remove-feature').addEventListener('click', function() {
            div.remove();
        });
    });
    
    // Remove feature field
    document.querySelectorAll('.remove-feature').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.flex').remove();
        });
    });
    
    // Add variant
    document.getElementById('add-variant').addEventListener('click', function() {
        const container = document.getElementById('variants-container');
        const variantCount = container.querySelectorAll('.variant-item').length;
        const template = `
            <div class="variant-item border border-gray-200 rounded-lg p-4 mb-4">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-medium text-gray-700">{{ __('Variant #') }}${variantCount + 1}</h4>
                    <button type="button" class="text-red-500 hover:text-red-700 remove-variant">
                        {{ __('Remove') }}
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <input type="hidden" name="variants[${variantCount}][id]" value="">
                    
                    <!-- State -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('State') }} <span class="text-red-500">*</span></label>
                        <select name="variants[${variantCount}][state_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">{{ __('Select a state') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Price') }} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][price]" required class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                    </div>
                    
                    <!-- Sale Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Sale Price') }}</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][sale_price]" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                    </div>
                    
                    <!-- Stock Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Stock Quantity') }} <span class="text-red-500">*</span></label>
                        <input type="number" min="0" name="variants[${variantCount}][stock_quantity]" value="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <!-- SKU -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('SKU') }}</label>
                        <input type="text" name="variants[${variantCount}][sku]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <!-- Dimensions -->
                    <div class="md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Weight (kg)') }}</label>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][weight]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Length (cm)') }}</label>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][length]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Width (cm)') }}</label>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][width]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Height (cm)') }}</label>
                            <input type="number" step="0.01" min="0" name="variants[${variantCount}][height]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    
                    <!-- Sale Dates -->
                    <div class="md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Sale Start Date') }}</label>
                            <input type="date" name="variants[${variantCount}][sale_start_date]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Sale End Date') }}</label>
                            <input type="date" name="variants[${variantCount}][sale_end_date]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = template.trim();
        const newVariant = tempDiv.firstChild;
        
        // Add event listener to the remove button
        newVariant.querySelector('.remove-variant').addEventListener('click', function() {
            newVariant.remove();
            updateVariantNumbers();
        });
        
        container.appendChild(newVariant);
        updateVariantNumbers();
    });
    
    // Remove variant
    document.querySelectorAll('.remove-variant').forEach(button => {
        button.addEventListener('click', function() {
            if (document.querySelectorAll('.variant-item').length > 1) {
                this.closest('.variant-item').remove();
                updateVariantNumbers();
            }
        });
    });
    
    // Update variant numbers
    function updateVariantNumbers() {
        document.querySelectorAll('.variant-item').forEach((item, index) => {
            item.querySelector('h4').textContent = '{{ __("Variant #") }}' + (index + 1);
            
            // Update input names with correct indices
            const inputs = item.querySelectorAll('input, select');
            inputs.forEach(input => {
                const name = input.name;
                if (name.includes('[') && name.includes(']')) {
                    const prefix = name.substring(0, name.indexOf('[') + 1);
                    const suffix = name.substring(name.indexOf(']'));
                    input.name = prefix + index + suffix;
                }
            });
        });
    }
    
    // Initialize date pickers
    document.addEventListener('DOMContentLoaded', function() {
        // Set min date for sale end date based on sale start date
        document.addEventListener('change', function(e) {
            if (e.target.name && e.target.name.includes('[sale_start_date]')) {
                const variantItem = e.target.closest('.variant-item');
                if (variantItem) {
                    const endDateInput = variantItem.querySelector('input[name$="[sale_end_date]"]');
                    if (endDateInput && e.target.value) {
                        endDateInput.min = e.target.value;
                        if (endDateInput.value && endDateInput.value < e.target.value) {
                            endDateInput.value = e.target.value;
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
