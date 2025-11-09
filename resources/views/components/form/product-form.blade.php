@props([
    'product' => null,
    'categories' => [],
    'states' => [],
    'cities' => []
])

<div class="space-y-6">
    <!-- Basic Information -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Product Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                    :value="old('name', $product->name ?? '')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Category -->
            <div>
                <x-input-label for="category_id" :value="__('Category')" />
                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <!-- Price -->
            <div>
                <x-input-label for="price" :value="__('Price')" />
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" 
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" 
                           placeholder="0.00" 
                           :value="old('price', $product->price ?? '')">
                </div>
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <!-- Stock -->
            <div>
                <x-input-label for="stock" :value="__('Stock Quantity')" />
                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" 
                    :value="old('stock', $product->stock ?? 0)" min="0" />
                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" rows="3" 
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            >{{ old('description', $product->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>

    <!-- Product Images -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
        
        <!-- Main Image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Main Product Image')" />
            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100"
                accept="image/*">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            
            @if(isset($product) && $product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded">
                </div>
            @endif
        </div>

        <!-- Additional Images -->
        <div class="mt-6">
            <x-input-label :value="__('Additional Images')" />
            <div class="mt-1 flex flex-wrap gap-4" id="additional-images-container">
                @if(isset($product) && $product->images->count() > 0)
                    @foreach($product->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product image" class="h-24 w-24 object-cover rounded">
                            <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" 
                                onclick="this.parentElement.remove()">×</button>
                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                        </div>
                    @endforeach
                @endif
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 flex items-center justify-center cursor-pointer" 
                    onclick="document.getElementById('additional-images').click()">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium text-indigo-600 hover:text-indigo-500">Upload additional images</span>
                        </p>
                    </div>
                    <input type="file" id="additional-images" name="additional_images[]" class="hidden" multiple 
                        onchange="previewAdditionalImages(this)">
                </div>
            </div>
        </div>
    </div>

    <!-- Location Information -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Location Information</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- State -->
            <div>
                <x-input-label for="state_id" :value="__('State')" />
                <select id="state_id" name="state_id" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    onchange="loadCities(this.value)">
                    <option value="">Select State</option>
                    @foreach(\App\Models\State::orderBy('name')->get() as $state)
                        <option value="{{ $state->id }}" {{ old('state_id', $product->state_id ?? '') == $state->id ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
            </div>

            <!-- City -->
            <div>
                <x-input-label for="city_id" :value="__('City')" />
                <select id="city_id" name="city_id" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select City</option>
                    @if(isset($product) && $product->city)
                        <option value="{{ $product->city_id }}" selected>{{ $product->city->name }}</option>
                    @endif
                </select>
                <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
            </div>
        </div>

        <!-- Address -->
        <div class="mt-6">
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="2" 
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            >{{ old('address', $product->address ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
    </div>

    <!-- SEO Information -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Information</h3>
        
        <div class="space-y-6">
            <!-- Meta Title -->
            <div>
                <x-input-label for="meta_title" :value="__('Meta Title')" />
                <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" 
                    :value="old('meta_title', $product->meta_title ?? '')" />
                <p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters</p>
                <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
            </div>

            <!-- Meta Description -->
            <div>
                <x-input-label for="meta_description" :value="__('Meta Description')" />
                <textarea id="meta_description" name="meta_description" rows="2" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
            </div>

            <!-- Meta Keywords -->
            <div>
                <x-input-label for="meta_keywords" :value="__('Meta Keywords (comma separated)')" />
                <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="mt-1 block w-full" 
                    :value="old('meta_keywords', $product->meta_keywords ?? '')" />
                <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancel
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isset($product) ? 'Update Product' : 'Create Product' }}
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Load cities based on selected state
    function loadCities(stateId) {
        const citySelect = document.getElementById('city_id');
        citySelect.innerHTML = '<option value="">Loading cities...</option>';
        
        if (!stateId) {
            citySelect.innerHTML = '<option value="">Select City</option>';
            return;
        }
        
        fetch(`/api/states/${stateId}/cities`)
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                data.forEach(city => {
                    const option = new Option(city.name, city.id);
                    citySelect.add(option);
                });
                
                // If editing, select the previously saved city
                @if(isset($product) && $product->city_id)
                    citySelect.value = '{{ $product->city_id }}';
                @endif
            })
            .catch(error => {
                console.error('Error loading cities:', error);
                citySelect.innerHTML = '<option value="">Error loading cities</option>';
            });
    }

    // Preview additional images before upload
    function previewAdditionalImages(input) {
        const container = document.getElementById('additional-images-container');
        
        // Keep the existing file input container
        const fileInputContainer = container.lastElementChild;
        
        // Remove all but the file input container
        while (container.children.length > 1) {
            container.removeChild(container.firstChild);
        }
        
        // Add new image previews
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                if (!file.type.startsWith('image/')) return;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${e.target.result}" class="h-24 w-24 object-cover rounded" alt="Preview">
                        <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" 
                            onclick="this.parentElement.remove()">×</button>
                    `;
                    container.insertBefore(preview, fileInputContainer);
                };
                reader.readAsDataURL(file);
            });
        }
    }
    
    // Initialize city select if state is already selected
    document.addEventListener('DOMContentLoaded', function() {
        const stateSelect = document.getElementById('state_id');
        if (stateSelect.value) {
            loadCities(stateSelect.value);
        }
    });
</script>
@endpush
