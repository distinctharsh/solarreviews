<div class="companies-modal" id="companiesModal" aria-hidden="true">
    <div class="companies-modal__dialog">
        <div class="companies-modal__header">
            <h3>Available Companies in Your Area</h3>
            <button type="button" class="companies-modal__close" aria-label="Close modal" onclick="window.toggleCompaniesModal(false)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="companies-modal__body">
            <!-- Location Info -->
            <div class="location-info" id="locationInfo" style="display: none;">
                <div class="location-details">
                    <span class="location-label">Your Location:</span>
                    <span class="location-text" id="locationText"></span>
                </div>
            </div>
            
            <!-- Companies List -->
            <div class="companies-section">
                <div id="companiesModalList" class="companies-list">
                    <div class="loading-spinner">Loading companies...</div>
                </div>
            </div>
        </div>
        
        <div class="companies-modal__footer">
            <button type="button" class="btn-secondary" onclick="window.toggleCompaniesModal(false)">Close</button>
        </div>
    </div>
</div>

<style>
    .companies-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1300;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        padding: 1rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .companies-modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 1;
        visibility: visible;
    }

    .companies-modal__dialog {
        background: white;
        border-radius: 20px;
        max-width: 600px;
        width: 100%;
        max-height: 80vh;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .companies-modal.active .companies-modal__dialog {
        transform: scale(1);
    }

    .companies-modal__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .companies-modal__header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
    }

    .companies-modal__close {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: 8px;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .companies-modal__close:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .companies-modal__body {
        padding: 1.5rem;
        max-height: 60vh;
        overflow-y: auto;
    }

    .location-info {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .location-details {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .location-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }

    .location-text {
        color: #1e293b;
        font-size: 0.9rem;
    }

    .companies-section {
        margin-bottom: 1rem;
    }

    .companies-list {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #f8fafc;
        padding: 0.5rem;
    }

    .company-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.2s ease;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        background: #ffffff;
    }

    .company-item:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .company-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .company-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        flex: 1;
    }

    .company-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.95rem;
    }

    .company-location {
        font-size: 0.85rem;
        color: #64748b;
    }

    .company-profile-btn {
        background: #3ba14c;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .company-profile-btn:hover {
        background: #2d8f3e;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 161, 76, 0.25);
    }

    .loading-spinner {
        text-align: center;
        padding: 2rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .no-companies {
        text-align: center;
        padding: 2rem;
        color: #64748b;
        font-size: 0.9rem;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .companies-modal__footer {
        padding: 1.5rem;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-secondary {
        background: #64748b;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        background: #475569;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(100, 116, 139, 0.25);
    }

    @media (max-width: 576px) {
        .companies-modal {
            align-items: flex-end;
            padding: 0.75rem;
        }

        .companies-modal__dialog {
            max-width: none;
            border-radius: 20px 20px 0 0;
            max-height: 80vh;
        }

        .companies-modal__header,
        .companies-modal__body,
        .companies-modal__footer {
            padding: 1rem;
        }

        .company-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .company-profile-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<script>
    // Fetch companies by pincode for modal
    window.fetchCompaniesForModal = async function(pincode, locationInfo = {}) {
        const companiesList = document.getElementById('companiesModalList');
        const locationInfoDiv = document.getElementById('locationInfo');
        const locationText = document.getElementById('locationText');
        
        try {
            // Show loading state
            companiesList.innerHTML = '<div class="loading-spinner">Loading companies...</div>';
            
            // Show location info if provided
            if (locationInfo.state || locationInfo.city || locationInfo.pincode) {
                locationInfoDiv.style.display = 'block';
                let locationTextContent = '';
                if (locationInfo.city) locationTextContent += locationInfo.city;
                if (locationInfo.state) locationTextContent += locationInfo.city ? ', ' + locationInfo.state : locationInfo.state;
                if (locationInfo.pincode) locationTextContent += ' - ' + locationInfo.pincode;
                locationText.textContent = locationTextContent;
            }
            
            const response = await fetch(`/api/companies-by-pincode/${pincode}`);
            const companies = await response.json();
            
            if (companies.success && companies.data.length > 0) {
                displayCompaniesInModal(companies.data);
            } else {
                companiesList.innerHTML = '<div class="no-companies">No companies found in your area. Try nearby pincodes.</div>';
            }
        } catch (error) {
            console.error('Error fetching companies:', error);
            companiesList.innerHTML = '<div class="no-companies">Error loading companies. Please try again.</div>';
        }
    };

    // Display companies in modal
    window.displayCompaniesInModal = function(companies) {
        const companiesList = document.getElementById('companiesModalList');
        let html = '';
        
        // Filter only subscribed companies
        const subscribedCompanies = companies.filter(company => company.is_subscribed === true || company.is_subscribed === 1);
        
        if (subscribedCompanies.length === 0) {
            companiesList.innerHTML = '<div class="no-companies">No subscribed companies found in your area.</div>';
            return;
        }
        
        subscribedCompanies.forEach(company => {
            const location = company.city_name ? company.city_name : company.state_name;
            const locationText = location && location !== 'Unknown' && location !== '[object Object]' ? location : '';
            
            html += `
                <div class="company-item" data-company-id="${company.id}">
                    <label class="company-label">
                        <span class="company-info">
                            <span class="company-name">${company.name}</span>
                            ${locationText ? `<span class="company-location">${locationText}</span>` : ''}
                        </span>
                    </label>
                    <a href="/companies/${company.slug}" class="company-profile-btn" target="_blank">View Profile</a>
                </div>
            `;
        });
        
        companiesList.innerHTML = html;
    };

    // Toggle companies modal
    window.toggleCompaniesModal = function(show = true) {
        const modal = document.getElementById('companiesModal');
        modal.classList.toggle('active', show);
        modal.setAttribute('aria-hidden', show ? 'false' : 'true');
        document.body.style.overflow = show ? 'hidden' : '';
    };

    // Close modal on backdrop click
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('companiesModal');
        if (modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    window.toggleCompaniesModal(false);
                }
            });
        }
    });
</script>
