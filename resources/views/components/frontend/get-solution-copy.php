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
    z-index: 1000;
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
.service-type-section {
    display: none;
    animation: slideDown 0.3s ease;
}

.service-type-section.show {
    display: block;
}

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
        align-items: flex-end;
        padding: 0.75rem;
    }

    .get-solution-modal__dialog {
        max-width: none;
        border-radius: 20px 20px 0 0;
        max-height: 80vh;
    }

    .get-solution-modal__header {
        padding: 1rem 1.25rem;
    }

    .get-solution-modal__body {
        padding: 0.75rem 1rem 0.25rem;
        max-height: calc(80vh - 120px);
    }

    .get-solution-modal__footer {
        padding: 0.75rem 1.25rem 1rem;
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
                <div class="form-group">
                    <label for="pincode">Pincode *</label>
                    <input 
                        type="text" 
                        id="pincode" 
                        name="pincode" 
                        placeholder="Enter your area pincode" 
                        required 
                        pattern="[0-9]{6}"
                        maxlength="6"
                        data-get-solution-pincode
                    >
                    <small style="color: #64748b; font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                        Enter 6-digit pincode to check service availability
                    </small>
                </div>

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
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="generation_variation">Generation variation *</label>
                        <select id="generation_variation" name="generation_variation" required data-get-solution-service>
                            <option value="">Select service type</option>
                            <option value="committed">Committed</option>
                            <option value="actual">Actual</option>
                        </select>
                    </div>

                    <!-- Companies Section - Show after valid pincode -->
                    <div class="companies-section" id="companiesSection" style="display: none;">
                        <div class="form-group">
                            <label>Available Companies in Your Area</label>
                            <div id="companiesList" class="companies-list">
                                <div class="loading-spinner">Loading companies...</div>
                            </div>
                        </div>
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
        const pincodeInput = document.querySelector('[data-get-solution-pincode]');
        const serviceTypeSection = document.querySelector('[data-service-type-section]');
        const submitBtn = document.getElementById('getSolutionSubmitBtn');

        // Open modal
        document.addEventListener('click', function (e) {
            if (e.target.closest('#getSolarCard')) {
                e.preventDefault();
                getSolutionModal?.removeAttribute('aria-hidden');
                document.body.style.overflow = 'hidden';
                pincodeInput?.focus();
            }
        });

        // Close modal
        function closeGetSolutionModal() {
            getSolutionModal?.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            resetGetSolutionForm();
        }

        // Close events
        document.addEventListener('click', function (e) {
            if (e.target.closest('[data-get-solution-close]')) {
                closeGetSolutionModal();
            }
            if (e.target === getSolutionModal) {
                closeGetSolutionModal();
            }
        });

        // ESC key to close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !getSolutionModal?.hasAttribute('aria-hidden')) {
                closeGetSolutionModal();
            }
        });

        // Pincode validation and service type section toggle
        pincodeInput?.addEventListener('input', async function (e) {
            const pincode = e.target.value;
            
            if (pincode.length === 6 && /^[0-9]{6}$/.test(pincode)) {
                // Valid pincode - show service type section and fetch companies
                serviceTypeSection?.classList.add('show');
                submitBtn.querySelector('.btn-text').textContent = 'Submit Solution Request';
                
                // Fetch companies for this pincode
                await fetchCompaniesByPincode(pincode);
            } else if (pincode.length === 0) {
                // Empty pincode - hide service type section and companies
                serviceTypeSection?.classList.remove('show');
                document.getElementById('companiesSection').style.display = 'none';
                submitBtn.querySelector('.btn-text').textContent = 'Submit Solution Request';
            }
        });

        // Fetch companies by pincode
        async function fetchCompaniesByPincode(pincode) {
            const companiesSection = document.getElementById('companiesSection');
            const companiesList = document.getElementById('companiesList');
            
            try {
                companiesSection.style.display = 'block';
                companiesList.innerHTML = '<div class="loading-spinner">Loading companies...</div>';
                
                const response = await fetch(`/api/companies-by-pincode/${pincode}`);
                const companies = await response.json();
                
                if (companies.success && companies.data.length > 0) {
                    displayCompanies(companies.data);
                } else {
                    companiesList.innerHTML = '<div class="no-companies">No companies found in your area. Try nearby pincodes.</div>';
                }
            } catch (error) {
                console.error('Error fetching companies:', error);
                companiesList.innerHTML = '<div class="no-companies">Error loading companies. Please try again.</div>';
            }
        }

        // Display companies in list
        function displayCompanies(companies) {
            const companiesList = document.getElementById('companiesList');
            let html = '';
            
            // Filter only subscribed companies
            const subscribedCompanies = companies.filter(company => company.is_subscribed === true || company.is_subscribed === 1);
            
            if (subscribedCompanies.length === 0) {
                companiesList.innerHTML = '<div class="no-companies">No subscribed companies found in your area.</div>';
                return;
            }
            
            subscribedCompanies.forEach((company, index) => {
                const location = company.state || company.related_state_name || '';
                const locationText = location && location !== 'Unknown' && location !== '[object Object]' ? location : '';
                
                html += `
                    <div class="company-item" data-company-id="${company.id}">
                        <label class="company-label">
                            <input type="radio" name="selected_company" value="${company.id}" class="company-radio" data-company-name="${company.name}" data-company-slug="${company.slug}">
                            <span class="company-info">
                                <span class="company-name">${company.name}</span>
                                ${locationText ? `<span class="company-location">${locationText}</span>` : ''}
                            </span>
                            <button class="company-profile-btn" onclick="event.stopPropagation(); window.open('/companies/${company.slug}', '_blank')">
                                View Profile
                            </button>
                        </label>
                    </div>
                `;
            });
            
            companiesList.innerHTML = html;
            
            // Add click handlers to company items
            document.querySelectorAll('.company-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the profile button
                    if (e.target.classList.contains('company-profile-btn')) {
                        return;
                    }
                    
                    // Remove selected class from all items
                    document.querySelectorAll('.company-item').forEach(i => i.classList.remove('selected'));
                    
                    // Add selected class to clicked item
                    this.classList.add('selected');
                    
                    // Check the radio button
                    const radio = this.querySelector('.company-radio');
                    if (radio) {
                        radio.checked = true;
                    }
                });
            });
        }

        // Pincode validation and service type section toggle
        pincodeInput?.addEventListener('input', async function (e) {
            const pincode = e.target.value;
            
            if (pincode.length === 6 && /^[0-9]{6}$/.test(pincode)) {
                // Valid pincode - show service type section and fetch companies
                serviceTypeSection?.classList.add('show');
                submitBtn.querySelector('.btn-text').textContent = 'Submit Solution Request';
                
                // Fetch companies for this pincode
                await fetchCompaniesByPincode(pincode);
            } else if (pincode.length === 0) {
                // Empty pincode - hide service type section and companies
                serviceTypeSection?.classList.remove('show');
                document.getElementById('companiesSection').style.display = 'none';
                submitBtn.querySelector('.btn-text').textContent = 'Submit Solution Request';
            }
        });

        // Fetch companies by pincode
        async function fetchCompaniesByPincode(pincode) {
            const companiesSection = document.getElementById('companiesSection');
            const companiesList = document.getElementById('companiesList');
            
            try {
                companiesSection.style.display = 'block';
                companiesList.innerHTML = '<div class="loading-spinner">Loading companies...</div>';
                
                const response = await fetch(`/api/companies-by-pincode/${pincode}`);
                const companies = await response.json();
                
                if (companies.success && companies.data.length > 0) {
                    displayCompanies(companies.data);
                } else {
                    companiesList.innerHTML = '<div class="no-companies">No companies found in your area. Try nearby pincodes.</div>';
                }
            } catch (error) {
                console.error('Error fetching companies:', error);
                companiesList.innerHTML = '<div class="no-companies">Error loading companies. Please try again.</div>';
            }
        }

        // Form submission
        getSolutionForm?.addEventListener('submit', async function (e) {
            e.preventDefault();
            
            // Check if company is selected
            const selectedCompany = document.querySelector('input[name="selected_company"]:checked');
            if (!selectedCompany) {
                showGetSolutionStatus('error', 'Please select a company from the list');
                return;
            }
            
            const formData = new FormData(getSolutionForm);
            const submitBtnText = submitBtn.querySelector('.btn-text');
            const originalText = submitBtnText.textContent;

            // Add selected company data to form
            formData.append('company_id', selectedCompany.value);
            formData.append('company_name', selectedCompany.dataset.companyName);
            formData.append('company_slug', selectedCompany.dataset.companySlug);

            // Show loading
            submitBtn.disabled = true;
            submitBtnText.innerHTML = '<span class="spinner"></span>Submitting...';

            try {
                const response = await fetch('/get-solution', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showGetSolutionStatus('success', result.message);
                    setTimeout(() => {
                        closeGetSolutionModal();
                    }, 2000);
                } else {
                    showGetSolutionStatus('error', result.message, result.errors);
                }
            } catch (error) {
                console.error('Get solution submission error:', error);
                showGetSolutionStatus('error', '⚡ Network error occurred. Please try again after some time.');
            } finally {
                submitBtn.disabled = false;
                submitBtnText.textContent = originalText;
            }
        });

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
            
            // Auto hide success messages
            if (type === 'success') {
                setTimeout(() => {
                    getSolutionStatus.classList.remove('show');
                }, 5000);
            }
        }

        function closeGetSolutionModal() {
            getSolutionModal?.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            resetGetSolutionForm();
        }

        function resetGetSolutionForm() {
            getSolutionForm?.reset();
            getSolutionStatus?.classList.remove('show');
        }
    })();
</script>
