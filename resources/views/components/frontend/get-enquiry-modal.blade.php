<div class="enquiry-modal" id="enquiryModal" aria-hidden="true">
    <div class="enquiry-modal__dialog" role="dialog" aria-labelledby="enquiryModalTitle">
        <div class="enquiry-modal__header">
            <div>
                <h3 id="enquiryModalTitle">New Solar Enquiry</h3>
            </div>
            <button type="button" class="enquiry-modal__close" data-enquiry-close>&times;</button>
        </div>
        <form class="enquiry-form" id="enquiryForm">
            @csrf
            <div class="enquiry-modal__body">

                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="">Select category</option>
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Groundmount">Groundmount</option>
                        <option value="Group Captive">Group Captive</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="capacity">Capacity in KW *</label>
                    <input type="number" id="capacity" name="capacity" placeholder="Enter capacity in KW" required step="0.1" min="0.1">
                </div> -->

                <div class="form-group">
                    <label for="useLocation">Location Preference *</label>
                    <select id="useLocation" name="use_location" required>
                        <option value="dropdown">Select State, City & Pincode</option>
                        <option value="other">Enter Location Manually</option>
                    </select>
                </div>

                <div class="form-group" id="locationFieldsGroup">
                    <label>Location Details *</label>
                    <x-location-fields 
                        id-prefix="enquiry" 
                        :states="$states ?? \App\Models\State::where('is_active', true)->orderBy('name')->get()"
                        label-class="block text-sm font-semibold text-slate-700 mb-1"
                        wrapper-class="space-y-2"
                        grid-class="grid gap-3"
                        control-class="w-full rounded-lg border-slate-200 focus:border-green-500 focus:ring-green-500"
                    />
                </div>

                <div class="form-group" id="otherLocationGroup" style="display: none;">
                    <label for="otherLocation">Location Details *</label>
                    <textarea id="otherLocation" name="other_location" placeholder="Enter your location details (area, landmark, etc.)" rows="3"></textarea>
                </div>

                

                <!-- <div class="form-group">
                    <label for="netMetering">Net Metering *</label>
                    <select id="netMetering" name="net_metering" required>
                        <option value="">Select option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label for="type">Type *</label>
                    <select id="type" name="type" required>
                        <option value="">Select type</option>
                        <option value="Tin Shed">Tin Shed</option>
                        <option value="RCC roof">RCC roof</option>
                        <option value="Groundmount">Groundmount</option>
                    </select>
                </div>

                <div class="form-group" id="tinShedAgeGroup" style="display: none;">
                    <label for="tinShedAge">How old is Tin Shed (in years) *</label>
                    <input type="number" id="tinShedAge" name="tin_shed_age" placeholder="Enter age in years" min="0" max="100">
                </div>

                <div class="form-group" id="groundmountDetailsGroup" style="display: none;">
                    <label for="distanceFromSubstation">Distance from substation (in Kms) *</label>
                    <input type="number" id="distanceFromSubstation" name="distance_from_substation" placeholder="Enter distance in Kms" min="0" step="0.1">
                </div>

                <div class="form-group" id="lineGroup" style="display: none;">
                    <label for="line">Line *</label>
                    <select id="line" name="line">
                        <option value="">Select line</option>
                        <option value="11">11 KV</option>
                        <option value="33">33 KV</option>
                        <option value="66">66 KV</option>
                        <option value="132">132 KV</option>
                    </select>
                </div>

                <div class="enquiry-form-row">
                    <div class="form-group">
                        <label for="enquiryName">Name *</label>
                        <input type="text" id="enquiryName" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="enquiryMobile">Mobile Number *</label>
                        <input type="tel" id="enquiryMobile" name="mobile_number" placeholder="10 digit mobile number" required minlength="10" maxlength="20">
                    </div>
                </div>

                <div class="form-group">
                    <label for="enquiryEmail">Email ID</label>
                    <input type="email" id="enquiryEmail" name="email" placeholder="name@email.com">
                </div>

                <div class="form-group">
                    <label for="enquiryNotes">Additional Requirements</label>
                    <textarea id="enquiryNotes" name="notes" placeholder="Tell us about your requirements (optional)"></textarea>
                </div>
            </div>
            <div class="enquiry-modal__footer">
                <button type="submit" data-enquiry-submit>Submit Enquiry</button>
                <div class="enquiry-modal__status" data-enquiry-status></div>
            </div>
        </form>
    </div>
</div>

<style>
    .enquiry-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1200;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        align-items: flex-start;
        justify-content: center;
        padding: calc(26px + 1rem) 1rem 1.5rem;
        overflow-y: auto;
    }

    .enquiry-modal.active {
        display: flex;
    }

    .enquiry-modal__dialog {
        background: #fff;
        border-radius: 18px;
        width: 100%;
        max-width: 480px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        animation: enquiryModalSlideIn 0.3s ease;
    }

    @keyframes enquiryModalSlideIn {
        from {
            transform: translateY(14px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .enquiry-modal__header {
        padding: 1.1rem 1.5rem;
        background: linear-gradient(135deg, #3ba14c, #2d8f3e);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .enquiry-modal__header h3 {
        margin: 0;
        font-size: 1.15rem;
        line-height: 1.4;
        font-weight: 700;
    }

    .enquiry-modal__close {
        border: none;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 1.15rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .enquiry-modal__close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .enquiry-modal__body {
        padding: 1.1rem 1.5rem;
        overflow-y: auto;
        flex: 1;
        min-height: 0;
        max-height: calc(85vh - 140px);
        -webkit-overflow-scrolling: touch;
    }

    .enquiry-form .form-group {
        margin-bottom: 1rem;
    }

    .enquiry-form-row {
        display: flex;
        gap: 0.75rem;
    }

    .enquiry-form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .enquiry-form label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.35rem;
        display: block;
    }

    .enquiry-form input,
    .enquiry-form select,
    .enquiry-form textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
    }

    .enquiry-form input:focus,
    .enquiry-form select:focus,
    .enquiry-form textarea:focus {
        outline: none;
        border-color: #3ba14c;
        box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.12);
    }

    .enquiry-form textarea {
        min-height: 80px;
        resize: vertical;
    }

    .enquiry-modal__footer {
        padding: 0.9rem 1.5rem 1.1rem;
        bottom: 0;
        background: #fff;
        border-top: 1px solid #e2e8f0;
        flex-shrink: 0;
    }

    .enquiry-modal__footer button {
        width: 100%;
        border: none;
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #3ba14c, #2d8f3e);
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .enquiry-modal__footer button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .enquiry-modal__footer button:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(59, 161, 76, 0.35);
    }

    .enquiry-modal__status {
        margin-top: 0.75rem;
        font-size: 0.85rem;
        display: none;
    }

    .enquiry-modal__status.is-visible {
        display: block;
    }

    .enquiry-modal__status.success {
        color: #15803d;
    }

    .enquiry-modal__status.error {
        color: #b91c1c;
    }

    @media (max-width: 576px) {
        .enquiry-modal {
            align-items: flex-end;
            padding: 0.75rem;
        }

        .enquiry-modal__dialog {
            max-width: none;
            border-radius: 20px 20px 0 0;
            max-height: 80vh;
        }

        .enquiry-modal__header {
            padding: 1rem 1.25rem;
        }

        .enquiry-modal__body {
            padding: 0.75rem 1rem 0.25rem;
            max-height: calc(80vh - 120px);
        }

       .enquiry-modal__footer {
            padding: 0.9rem 1.5rem 1.1rem;
            background: #fff;
            border-top: 1px solid #e2e8f0;
        }


        .enquiry-form-row {
            flex-direction: column;
        }
    }
</style>

<script>
(function () {

    const enquiryModal = document.getElementById('enquiryModal');
    const enquiryForm = document.getElementById('enquiryForm');
    const enquiryStatus = enquiryModal?.querySelector('[data-enquiry-status]');
    const enquirySubmitBtn = enquiryModal?.querySelector('[data-enquiry-submit]');
    const closeBtn = enquiryModal?.querySelector('[data-enquiry-close]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const typeSelect = document.getElementById('type');
    const tinShedAgeGroup = document.getElementById('tinShedAgeGroup');
    const groundmountDetailsGroup = document.getElementById('groundmountDetailsGroup');
    const lineGroup = document.getElementById('lineGroup');

    const useLocationSelect = document.getElementById('useLocation');
    const locationFieldsGroup = document.getElementById('locationFieldsGroup');
    const otherLocationGroup = document.getElementById('otherLocationGroup');

    if (!enquiryModal || !enquiryForm) return;

    /* --------------------------------------------------
       MODAL TOGGLE
    -------------------------------------------------- */

    function toggleEnquiryModal(show = true) {
        enquiryModal.classList.toggle('active', show);
        enquiryModal.setAttribute('aria-hidden', show ? 'false' : 'true');
        document.body.style.overflow = show ? 'hidden' : '';
    }

    document.querySelectorAll('.btn-get-enquiry').forEach(btn => {
        btn.addEventListener('click', () => toggleEnquiryModal(true));
    });

    closeBtn?.addEventListener('click', () => toggleEnquiryModal(false));

    enquiryModal.addEventListener('click', (event) => {
        if (event.target === enquiryModal) {
            toggleEnquiryModal(false);
        }
    });

    /* --------------------------------------------------
       CONDITIONAL FIELDS
    -------------------------------------------------- */

    function hideAllConditionalFields() {
        tinShedAgeGroup.style.display = 'none';
        groundmountDetailsGroup.style.display = 'none';
        lineGroup.style.display = 'none';
        document.getElementById('tinShedAge')?.removeAttribute('required');
        document.getElementById('distanceFromSubstation')?.removeAttribute('required');
        document.getElementById('line')?.removeAttribute('required');
    }

    function showConditionalFields() {
        hideAllConditionalFields();

        const selectedType = typeSelect.value;

        if (selectedType === 'Tin Shed') {
            tinShedAgeGroup.style.display = 'block';
            document.getElementById('tinShedAge')?.setAttribute('required', 'required');
        }

        if (selectedType === 'Groundmount') {
            groundmountDetailsGroup.style.display = 'block';
            lineGroup.style.display = 'block';
            document.getElementById('distanceFromSubstation')?.setAttribute('required', 'required');
            document.getElementById('line')?.setAttribute('required', 'required');
        }
    }

    typeSelect?.addEventListener('change', showConditionalFields);

    /* --------------------------------------------------
       LOCATION TOGGLE
    -------------------------------------------------- */

    function toggleLocationFields() {
        if (useLocationSelect.value === 'dropdown') {
            locationFieldsGroup.style.display = 'block';
            otherLocationGroup.style.display = 'none';
            document.getElementById('otherLocation')?.removeAttribute('required');
        } else {
            locationFieldsGroup.style.display = 'none';
            otherLocationGroup.style.display = 'block';
            document.getElementById('otherLocation')?.setAttribute('required', 'required');
        }
    }

    useLocationSelect?.addEventListener('change', toggleLocationFields);

    /* --------------------------------------------------
       FORM SUBMIT
    -------------------------------------------------- */

    enquiryForm.addEventListener('submit', async function (event) {

        event.preventDefault();

        enquirySubmitBtn.disabled = true;
        enquirySubmitBtn.textContent = 'Submitting...';

        enquiryStatus?.classList.remove('is-visible', 'success', 'error');
        enquiryStatus.textContent = '';

        try {

            const formData = new FormData(enquiryForm);

            const response = await fetch('{{ route('solar-enquiry.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw data;
            }

            enquiryStatus.classList.add('is-visible', 'success');
            enquiryStatus.textContent = data.message ?? 'Enquiry submitted successfully!';

            enquirySubmitBtn.textContent = "Enquiry Submitted";
            enquirySubmitBtn.disabled = true;

            /* ---------- LOCATION + PINCODE ---------- */

            let pincode = '';
            let locationInfo = {};

            if (formData.get('use_location') === 'dropdown') {

                pincode = formData.get('pincode') || '';

                const stateSelect = document.getElementById('enquiry_state_id');
                const citySelect = document.getElementById('enquiry_city');

                locationInfo.stateId = stateSelect?.value || '';
                locationInfo.cityId = citySelect?.value || '';
                locationInfo.state = stateSelect?.options[stateSelect.selectedIndex]?.text || '';
                locationInfo.city = citySelect?.options[citySelect.selectedIndex]?.text || '';
                locationInfo.pincode = pincode;

            } else {

                const otherLocation = formData.get('other_location') || '';
                const match = otherLocation.match(/\b\d{6}\b/);
                pincode = match ? match[0] : '';

                locationInfo = {
                    state: 'Manual Location',
                    city: otherLocation,
                    pincode: pincode
                };
            }

            if (pincode && pincode.length === 6) {
                // Redirect to companies index page with filters
                setTimeout(() => {
                    window.location.href = `/compare/companies?pincode=${encodeURIComponent(pincode)}&state=${encodeURIComponent(locationInfo.stateId)}&city=${encodeURIComponent(locationInfo.cityId)}`;
                }, 1500);
            } else {
                // Show fallback message
                setTimeout(() => {
                    alert('Please provide a valid pincode to see available companies in your area.');
                }, 1500);
            }

        } catch (error) {

            enquiryStatus.classList.add('is-visible', 'error');

            if (error?.errors) {

                enquiryStatus.textContent = error.message || 'Please fix the errors below.';

                // Remove old errors
                document.querySelectorAll('.field-error').forEach(el => el.remove());

                Object.keys(error.errors).forEach(field => {

                    const input = enquiryForm.querySelector(`[name="${field}"]`);

                    if (input) {

                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'field-error';
                        errorDiv.style.color = '#b91c1c';
                        errorDiv.style.fontSize = '0.8rem';
                        errorDiv.style.marginTop = '4px';
                        errorDiv.textContent = error.errors[field][0];

                        input.closest('.form-group')?.appendChild(errorDiv);
                    }
                });

            } else {

                enquiryStatus.textContent = error?.message || 'Unable to submit enquiry.';
            }

            enquirySubmitBtn.disabled = false;
            enquirySubmitBtn.textContent = 'Submit Enquiry';
        }
    });

})();
</script>
