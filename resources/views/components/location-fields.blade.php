@php
    $idPrefix = $idPrefix ?? 'location';
    $selectedStateId = $selectedStateId ?? old('state_id');
    $selectedCityName = $selectedCityName ?? old('city');
    $selectedLinkedCityId = $selectedLinkedCityId ?? old('city_id');
    $selectedPincode = $selectedPincode ?? old('pincode');
    $labelClass = $labelClass ?? 'block text-sm font-semibold text-slate-700 mb-1';
    $wrapperClass = $wrapperClass ?? 'space-y-3';
    $gridClass = $gridClass ?? 'grid gap-5 md:grid-cols-2';
    $controlClass = $controlClass ?? 'w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400';
@endphp

<div class="{{ $wrapperClass }}" data-location-fields data-location-prefix="{{ $idPrefix }}">
    <div class="{{ $gridClass }}">
        <div>
            <label class="{{ $labelClass }}">State*</label>
            <select id="{{ $idPrefix }}_state_id" name="state_id" required class="{{ $controlClass }}">
                <option value="">Select State</option>
                @foreach(($states ?? collect()) as $state)
                    <option value="{{ $state->id }}" {{ (string) $selectedStateId === (string) $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">City*</label>
            <input type="hidden" name="city_lookup_id" value="" data-location-city-lookup>
            <select id="{{ $idPrefix }}_city" name="city" required class="{{ $controlClass }}" data-location-city>
                <option value="">Select City</option>
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">Linked City (optional)</label>
            <select id="{{ $idPrefix }}_linked_city_id" name="city_id" class="{{ $controlClass }}" data-location-linked-city-id>
                <option value="">Linked City (optional)</option>
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">Pincode*</label>
            <select id="{{ $idPrefix }}_pincode" name="pincode" required class="{{ $controlClass }}" data-location-pincode>
                <option value="">Select Pincode</option>
            </select>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const root = document.querySelector('[data-location-fields][data-location-prefix="{{ $idPrefix }}"]');
        if (!root) return;

        const stateSelect = root.querySelector('#{{ $idPrefix }}_state_id');
        const citySelect = root.querySelector('#{{ $idPrefix }}_city');
        const linkedCityIdSelect = root.querySelector('#{{ $idPrefix }}_linked_city_id');
        let pincodeSelect = root.querySelector('#{{ $idPrefix }}_pincode');
        const cityLookupInput = root.querySelector('[data-location-city-lookup]');

        const selectedStateId = @json($selectedStateId);
        const selectedCityName = @json($selectedCityName);
        const selectedLinkedCityId = @json($selectedLinkedCityId);
        const selectedPincode = @json($selectedPincode);

        const clearSelect = (select, placeholder) => {
            select.innerHTML = '';
            const opt = document.createElement('option');
            opt.value = '';
            opt.textContent = placeholder;
            select.appendChild(opt);
        };

        const ensurePincodeSelect = () => {
            if (pincodeSelect && pincodeSelect.tagName === 'SELECT') {
                return;
            }

            const existing = root.querySelector('#{{ $idPrefix }}_pincode');
            if (existing && existing.tagName === 'SELECT') {
                pincodeSelect = existing;
                return;
            }

            const input = root.querySelector('#{{ $idPrefix }}_pincode');
            if (input && input.tagName === 'INPUT') {
                const select = document.createElement('select');
                select.id = '{{ $idPrefix }}_pincode';
                select.name = 'pincode';
                select.required = true;
                select.className = input.className;
                select.setAttribute('data-location-pincode', '');
                input.replaceWith(select);
                pincodeSelect = select;
            }
        };

        const ensurePincodeInput = (value) => {
            const existing = root.querySelector('#{{ $idPrefix }}_pincode');
            if (existing && existing.tagName === 'INPUT') {
                existing.value = value || '';
                attachPincodeInputListener();
                return;
            }

            const input = document.createElement('input');
            input.type = 'text';
            input.id = '{{ $idPrefix }}_pincode';
            input.name = 'pincode';
            input.required = true;
            input.className = pincodeSelect ? pincodeSelect.className : '{{ $controlClass }}';
            input.value = value || '';

            if (existing) {
                existing.replaceWith(input);
            }
            pincodeSelect = input;

            attachPincodeInputListener();
        };

        const fillSelect = (select, items, valueKey, labelKey, selectedValue) => {
            items.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item[valueKey];
                opt.textContent = item[labelKey];
                if (labelKey === 'name') {
                    opt.dataset.name = item[labelKey];
                }
                if (String(selectedValue) !== '' && String(opt.value) === String(selectedValue)) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            });
        };

        const loadCities = async (stateId, selectToSet) => {
            clearSelect(citySelect, 'Select City');
            clearSelect(linkedCityIdSelect, 'Linked City (optional)');
            clearSelect(pincodeSelect, 'Select Pincode');

            if (!stateId) return;

            const res = await fetch(`/locations/states/${stateId}/cities`);
            const json = await res.json();
            const cities = (json && json.data) ? json.data : [];

            cities.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.name;
                opt.textContent = item.name;
                opt.dataset.id = item.id;
                if (String(selectToSet) !== '' && String(opt.value) === String(selectToSet)) {
                    opt.selected = true;
                }
                citySelect.appendChild(opt);
            });
            fillSelect(linkedCityIdSelect, cities, 'id', 'name', selectedLinkedCityId);

            syncCityLookup();
            if (cityLookupInput.value) {
                await loadPincodes(cityLookupInput.value, selectedPincode);
            }
        };

        const loadPincodes = async (cityId, pincodeToSet) => {
            ensurePincodeSelect();
            clearSelect(pincodeSelect, 'Select Pincode');
            if (!cityId) return;

            const res = await fetch(`/locations/cities/${cityId}/pincodes`);
            const json = await res.json();
            const pins = (json && json.data) ? json.data : [];

            if (!Array.isArray(pins) || pins.length === 0) {
                ensurePincodeInput(pincodeToSet);
                return;
            }

            ensurePincodeSelect();
            clearSelect(pincodeSelect, 'Select Pincode');
            fillSelect(pincodeSelect, pins, 'pincode', 'pincode', pincodeToSet);
        };

        const resolveByPincode = async (pincode) => {
            const qs = new URLSearchParams({ pincode: pincode || '' }).toString();
            const res = await fetch(`/locations/resolve?${qs}`);
            const json = await res.json();
            return (json && json.data) ? json.data : null;
        };

        const syncCityLookup = () => {
            const selected = citySelect.options[citySelect.selectedIndex];
            cityLookupInput.value = selected && selected.dataset ? (selected.dataset.id || '') : '';
        };

        const attachPincodeInputListener = () => {
            const input = root.querySelector('#{{ $idPrefix }}_pincode');
            if (!input || input.tagName !== 'INPUT') return;

            if (input.dataset.locationResolveAttached === '1') return;
            input.dataset.locationResolveAttached = '1';

            input.addEventListener('blur', async () => {
                const pin = (input.value || '').trim();
                if (!pin) return;

                try {
                    const resolved = await resolveByPincode(pin);
                    if (!resolved || !resolved.state_id) return;

                    // 1) Set state
                    if (String(stateSelect.value) !== String(resolved.state_id)) {
                        stateSelect.value = String(resolved.state_id);
                    }

                    // 2) Load cities for that state and select resolved city name (preferred)
                    await loadCities(resolved.state_id, resolved.city_name || '');

                    // 3) If we can get a city lookup id, load pincodes for dropdown
                    syncCityLookup();
                    if (cityLookupInput.value) {
                        await loadPincodes(cityLookupInput.value, pin);
                    }
                } catch (e) {
                    // Silent fail - keep manual pin.
                }
            });
        };

        stateSelect.addEventListener('change', async () => {
            await loadCities(stateSelect.value, '');
        });

        citySelect.addEventListener('change', async () => {
            syncCityLookup();
            await loadPincodes(cityLookupInput.value, '');
        });

        if (selectedStateId) {
            loadCities(selectedStateId, selectedCityName);
        }

        // If we fall back to manual pincode input, support reverse lookup
        attachPincodeInputListener();
    });
</script>
