

<style>
/* Get Solution Modal Styles */
.get-solution-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    align-items: flex-start;
    justify-content: center;
    padding: calc(76px + 1rem) 1rem 1.5rem;
    overflow-y: auto;
    z-index: 1200;
    display: flex;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.get-solution-modal:not([aria-hidden="true"]) {
    opacity: 1;
    visibility: visible;
}

.get-solution-modal[aria-hidden="true"] {
    display: none;
}

.get-solution-modal__dialog {
    background: #fff;
    border-radius: 18px;
    width: 100%;
    max-width: 480px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    animation: getSolutionModalSlideIn 0.3s ease;
    transform: translateY(-20px);
}

.get-solution-modal:not([aria-hidden="true"]) .get-solution-modal__dialog {
    transform: translateY(0);
}

@keyframes getSolutionModalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.get-solution-modal__header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    flex-shrink: 0;
}

.get-solution-modal__header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
}

.get-solution-modal__close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #64748b;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.get-solution-modal__close:hover {
    background: rgba(255, 255, 255, 0.3);
}

.get-solution-modal__body {
    padding: 1.1rem 1.5rem;
    overflow-y: auto;
    flex: 1;
    min-height: 0;
    max-height: calc(85vh - 140px);
    -webkit-overflow-scrolling: touch;
}

.get-solution-form .form-group {
    margin-bottom: 1rem;
}

.get-solution-form label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.35rem;
    display: block;
}

.get-solution-form input,
.get-solution-form select,
.get-solution-form textarea {
    width: 100%;
    padding: 0.65rem 0.85rem;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background: #fff;
}

.get-solution-form input:focus,
.get-solution-form select:focus,
.get-solution-form textarea:focus {
    outline: none;
    border-color: #3ba14d;
    box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.12);
}

.get-solution-form textarea {
    min-height: 80px;
    resize: vertical;
}

.get-solution-modal__footer {
    padding: 0.9rem 1.5rem 1.1rem;
    position: sticky;
    bottom: 0;
    background: #fff;
    border-top: 1px solid #e2e8f0;
    flex-shrink: 0;
}

.get-solution-modal__footer button {
    width: 100%;
    border: none;
    border-radius: 12px;
    padding: 0.85rem 1.25rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #3ba14d 0%, #2d8f3f 100%);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.get-solution-modal__footer button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 161, 76, 0.3);
}

.get-solution-modal__footer button:active {
    transform: translateY(0);
}

.get-solution-modal__footer button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.get-solution-modal__footer button .spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spin 0.8s linear infinite;
    margin-right: 8px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.get-solution-modal__status {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    display: none;
}

.get-solution-modal__status.success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.get-solution-modal__status.error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.get-solution-modal__status.show {
    display: block;
}

.get-solution-modal__error-list {
    margin: 0.5rem 0 0 0;
    padding-left: 1.2rem;
}

.get-solution-modal__error-list li {
    margin-bottom: 0.25rem;
}

/* Service Type Section */

@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
    }
    to {
        opacity: 1;
        max-height: 500px;
    }
}

/* Companies Section */
.companies-section {
    margin-bottom: 1rem;
}

.companies-list {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.75rem;
    background: #f8fafc;
}

.company-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    gap: 1rem;
    flex-direction: row;
    border-radius: 12px;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
    cursor: pointer;
    background: #ffffff;
}

.company-item:hover {
    background: #f8fafc;
    border-color: #94a3b8;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.company-item.selected {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border: 2px solid #22c55e;
    box-shadow: 0 4px 12px rgba(34, 196, 94, 0.15);
    transform: translateY(-1px);
}

.company-item.selected .company-name {
    color: #15803d;
    font-weight: 600;
}

.company-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.company-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    flex: 1;
    gap: 0.75rem;
}

.company-radio {
    display: none; /* Hide radio buttons */
}

.company-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.company-name {
    font-weight: 500;
    color: #334155;
    font-size: 0.9rem;
}

.company-location {
    font-size: 0.75rem;
    color: #64748b;
}

.company-profile-btn {
    background: linear-gradient(135deg, #3ba14d 0%, #2d8f3f 100%);
    color: white;
    border: none;
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
    box-shadow: 0 2px 4px rgba(59, 161, 76, 0.2);
}

.company-profile-btn:hover {
    background: linear-gradient(135deg, #2d8f3f 0%, #22c55e 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(59, 161, 76, 0.3);
}

.loading-spinner {
    text-align: center;
    color: #64748b;
    font-style: italic;
    padding: 1rem;
}

.no-companies {
    text-align: center;
    color: #64748b;
    padding: 1rem;
    font-style: italic;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .get-solution-modal {
        align-items: center;
        padding: 0.5rem;
    }

    .get-solution-modal__dialog {
        max-width: none;
        border-radius: 20px;
        max-height: 75vh;
        margin: auto;
    }

    .get-solution-modal__header {
        padding: 0.8rem 1rem;
    }

    .get-solution-modal__body {
        padding: 0.5rem 1rem 0.25rem;
        max-height: calc(75vh - 120px);
    }

    .get-solution-modal__footer {
        padding: 0.6rem 1rem 0.8rem;
        position: sticky;
        bottom: 0;
        background: #fff;
        border-top: 1px solid #e2e8f0;
        flex-shrink: 0;
    }
}
</style>

<div class="get-solution-modal" id="getSolutionModal" aria-hidden="true">
    <div class="get-solution-modal__dialog" role="dialog" aria-labelledby="getSolutionModalTitle">
        <div class="get-solution-modal__header">
            <div>
                <h3 id="getSolutionModalTitle">Get Solar Solution</h3>
            </div>
            <button type="button" class="get-solution-modal__close" data-get-solution-close>&times;</button>
        </div>
        
        <div class="get-solution-modal__status" data-get-solution-status></div>
        
        <form class="get-solution-form" id="getSolutionForm">
            @csrf
            <div class="get-solution-modal__body">
                <!-- Location Preference Section -->


                   <!-- Service Type Section - Hidden Initially -->
                <div class="service-type-section" data-service-type-section>
                    <div class="form-group">
                        <label for="service_type">Service Type *</label>
                        <select id="service_type" name="service_type" required data-get-solution-service>
                            <option value="">Select service type</option>
                            <option value="O&M">O&M (Operations & Maintenance)</option>
                            <option value="AMC">AMC (Annual Maintenance Contract)</option>
                            <option value="Cleaning">Solar Panel Cleaning</option>
                            <option value="Net metering">Net Metering Support</option>
                            <option value="Delay in Execution">Delay in Execution</option>
                            <option value="Generation variation">Generation variation - Committed/Actual</option>
                        </select>
                    </div>


                        <div class="form-group">
                    <label for="use_location">Location Preference *</label>
                    <select id="use_location" name="use_location" required data-get-solution-location>
                        <option value="">Select location preference</option>
                        <option value="dropdown">Select State, City & Pincode</option>
                        <option value="other">Enter Location Manually</option>
                    </select>
                </div>

                <!-- Location Fields (Hidden Initially) -->
                <div class="form-group" id="locationFields" style="display: none;">
                    <label>Location Details *</label>
                    <x-location-fields 
                        id-prefix="solution" 
                        :states="$states ?? \App\Models\State::where('is_active', true)->orderBy('name')->get()"
                        label-class="block text-sm font-semibold text-slate-700 mb-1"
                        wrapper-class="space-y-2"
                        grid-class="grid gap-3"
                        control-class="w-full rounded-lg border-slate-200 focus:border-green-500 focus:ring-green-500"
                    />
                </div>

                <!-- Manual Location Field (Hidden Initially) -->
                <div class="form-group" id="manualLocationField" style="display: none;">
                    <label for="other_location">Location Details *</label>
                    <textarea 
                        id="other_location" 
                        name="other_location" 
                        placeholder="Enter your location details manually (area, landmark, etc.)"
                        rows="3"
                        data-get-solution-other-location
                    ></textarea>
                </div>

                    <div class="form-group">
                        <label for="solution_name">Your Name *</label>
                        <input 
                            type="text" 
                            id="solution_name" 
                            name="name" 
                            placeholder="Enter your full name" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="solution_mobile">Mobile Number *</label>
                        <input 
                            type="tel" 
                            id="solution_mobile" 
                            name="mobile_number" 
                            placeholder="Enter 10-digit mobile number" 
                            required 
                            pattern="[6-9][0-9]{9}"
                            maxlength="10"
                        >
                    </div>

                    <div class="form-group">
                        <label for="solution_email">Email Address</label>
                        <input 
                            type="email" 
                            id="solution_email" 
                            name="email" 
                            placeholder="Enter your email address (optional)"
                        >
                    </div>

                    <div class="form-group">
                        <label for="solution_details">Additional Details</label>
                        <textarea 
                            id="solution_details" 
                            name="details" 
                            placeholder="Please describe your specific requirements or issues..."
                            rows="3"
                        ></textarea>
                    </div>
                </div>



            

             
            </div>
            
            <div class="get-solution-modal__footer">
                <button type="submit" id="getSolutionSubmitBtn">
                    <span class="btn-text">Submit Solution Request</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
(function () {

    const getSolutionModal = document.getElementById('getSolutionModal');
    const getSolutionForm = document.getElementById('getSolutionForm');
    const getSolutionStatus = getSolutionModal?.querySelector('[data-get-solution-status]');
    const submitBtn = document.getElementById('getSolutionSubmitBtn');

    const useLocationSelect = document.getElementById('use_location');
    const locationFields = document.getElementById('locationFields');
    const manualLocationField = document.getElementById('manualLocationField');

    /* -----------------------------
       LOCATION PREFERENCE TOGGLE
    ----------------------------- */
    useLocationSelect?.addEventListener('change', function toggleLocationFields() {
        const preference = useLocationSelect.value;
        
        if (preference === 'dropdown') {
            locationFields.style.display = 'block';
            manualLocationField.style.display = 'none';
            
            // Add required attributes to dropdown location fields
            document.getElementById('solution_state_id')?.setAttribute('required', 'required');
            document.getElementById('solution_city')?.setAttribute('required', 'required');
            document.getElementById('solution_pincode')?.setAttribute('required', 'required');
        } else if (preference === 'other') {
            locationFields.style.display = 'none';
            manualLocationField.style.display = 'block';
            
            // Remove required attributes from hidden dropdown location fields
            document.getElementById('solution_state_id')?.removeAttribute('required');
            document.getElementById('solution_city')?.removeAttribute('required');
            document.getElementById('solution_pincode')?.removeAttribute('required');
        } else {
            locationFields.style.display = 'none';
            manualLocationField.style.display = 'none';
        }
    });

    /* --------------------------------------------------
       PINCODE AUTO-SELECT (after city selection)
    -------------------------------------------------- */

    const solutionCitySelect = document.getElementById('solution_city');
    const solutionPincodeSelect = document.getElementById('solution_pincode');

    function selectFirstAvailableSolutionPincode() {
        if (!solutionPincodeSelect) return;

        const options = Array.from(solutionPincodeSelect.options || []);
        const firstValid = options.find(opt => {
            if (!opt) return false;
            const value = (opt.value ?? '').toString().trim();
            return value !== '' && !opt.disabled;
        });

        if (!firstValid) return;

        solutionPincodeSelect.value = firstValid.value;
        solutionPincodeSelect.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function scheduleFirstSolutionPincodeSelect() {
        // Allow any async city->pincode population logic to finish first.
        setTimeout(selectFirstAvailableSolutionPincode, 0);
        setTimeout(selectFirstAvailableSolutionPincode, 50);
        setTimeout(selectFirstAvailableSolutionPincode, 150);
    }

    if (solutionCitySelect && solutionPincodeSelect) {
        solutionCitySelect.addEventListener('change', () => {
            scheduleFirstSolutionPincodeSelect();
        });
    }

    if (solutionPincodeSelect) {
        const observer = new MutationObserver(() => {
            selectFirstAvailableSolutionPincode();
        });

        observer.observe(solutionPincodeSelect, { childList: true, subtree: true });
    }

    /* -----------------------------
       OPEN MODAL
    ----------------------------- */
    document.addEventListener('click', function (e) {
        if (e.target.closest('#getSolarCard')) {
            e.preventDefault();
            getSolutionModal?.removeAttribute('aria-hidden');
            document.body.style.overflow = 'hidden';
        }
    });

    /* -----------------------------
       CLOSE MODAL
    ----------------------------- */
    function closeGetSolutionModal() {
        getSolutionModal?.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        resetGetSolutionForm();
    }

    document.addEventListener('click', function (e) {
        if (e.target.closest('[data-get-solution-close]')) {
            closeGetSolutionModal();
        }
        if (e.target === getSolutionModal) {
            closeGetSolutionModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !getSolutionModal?.hasAttribute('aria-hidden')) {
            closeGetSolutionModal();
        }
    });

    /* -----------------------------
       FORM SUBMIT
    ----------------------------- */
    getSolutionForm?.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(getSolutionForm);
        const submitBtnText = submitBtn.querySelector('.btn-text');
        const originalText = submitBtnText.textContent;

        // Capture location data
        let locationData = {};
        const useLocation = formData.get('use_location');
        
        if (useLocation === 'dropdown') {
            locationData = {
                stateId: formData.get('state_id'),
                cityId: formData.get('city_lookup_id'),
                pincode: formData.get('pincode')
            };
        } else {
            // Handle manual location input with pincode extraction
            const otherLocation = formData.get('other_location') || '';
            
            // Try to extract pincode from manual input
            const match = otherLocation.match(/\b\d{6}\b/);
            const pincode = match ? match[0] : '';
            
            locationData = {
                state: 'Manual Location',
                city: otherLocation,
                pincode: pincode
            };
        }

        submitBtn.disabled = true;
        submitBtnText.innerHTML = '<span class="spinner"></span>Submitting...';

        try {
            const response = await fetch('/get-solution', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content') || ''
                }
            });

            const result = await response.json();

            if (result.success) {
                showGetSolutionStatus('success', result.message);

                setTimeout(() => {
                    closeGetSolutionModal();
                    
                    // Redirect to companies index with location filters
                    let redirectUrl = '/compare/companies';
                    const params = new URLSearchParams();
                    
                    if (locationData.pincode) {
                        params.append('pincode', locationData.pincode);
                    }
                    if (locationData.stateId) {
                        params.append('state', locationData.stateId);
                    }
                    if (locationData.cityId) {
                        params.append('city', locationData.cityId);
                    }
                                        
                    // Add from_form parameter to indicate form submission
                    params.append('from_form', 'solution');
                    
                    if (params.toString()) {
                        redirectUrl += '?' + params.toString();
                    }
                    
                    window.location.href = redirectUrl;
                }, 2000);

            } else {
                showGetSolutionStatus('error', result.message, result.errors);
            }

        } catch (error) {
            console.error('Submission error:', error);
            showGetSolutionStatus(
                'error',
                'Network error occurred. Please try again.'
            );
        } finally {
            submitBtn.disabled = false;
            submitBtnText.textContent = originalText;
        }
    });

    /* -----------------------------
       STATUS MESSAGE
    ----------------------------- */
    function showGetSolutionStatus(type, message, errors = null) {
        if (!getSolutionStatus) return;

        getSolutionStatus.className = `get-solution-modal__status ${type} show`;

        let html = message;

        if (errors && Object.keys(errors).length > 0) {
            html += '<ul class="get-solution-modal__error-list">';
            Object.values(errors).forEach(msg => {
                html += `<li>${msg}</li>`;
            });
            html += '</ul>';
        }

        getSolutionStatus.innerHTML = html;

        if (type === 'success') {
            setTimeout(() => {
                getSolutionStatus.classList.remove('show');
            }, 5000);
        }
    }

    function resetGetSolutionForm() {
        getSolutionForm?.reset();
        getSolutionStatus?.classList.remove('show');
        locationFields.style.display = 'none';
        manualLocationField.style.display = 'none';
    }

})();
</script>
