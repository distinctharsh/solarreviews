<div class="details-modal" id="detailsModal" aria-hidden="true">
    <div class="details-modal__dialog" role="dialog" aria-labelledby="detailsModalTitle">
        <div class="details-modal__header">
            <div>
                <h3 id="detailsModalTitle">Get details for <span data-details-company>this company</span></h3>
            </div>
            <button type="button" class="details-modal__close" data-details-close>&times;</button>
        </div>
        <form class="details-form" id="detailsForm">
            @csrf
            <input type="hidden" name="company_id" data-details-company-id>
            <div class="details-modal__body">
                <div class="details-form-row">
                    <div class="form-group">
                        <label for="detailsName">Name *</label>
                        <input type="text" id="detailsName" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="detailsMobile">Mobile Number *</label>
                        <input type="tel" id="detailsMobile" name="mobile_number" placeholder="10 digit mobile number" required minlength="10" maxlength="20">
                    </div>
                </div>
                <div class="details-form-row">
                    <div class="form-group">
                        <label for="detailsEmail">Email ID</label>
                        <input type="email" id="detailsEmail" name="email" placeholder="name@email.com">
                    </div>
                    <div class="form-group">
                        <label for="detailsLocation">Location</label>
                        <input type="text" id="detailsLocation" name="location" placeholder="City / State">
                    </div>
                </div>
                <div class="form-group">
                    <label for="detailsMessage">What details do you need?</label>
                    <textarea id="detailsMessage" name="message" placeholder="Tell us what you want to know (optional)"></textarea>
                </div>
            </div>
            <div class="details-modal__footer">
                <button type="submit" data-details-submit>Submit</button>
                <div class="details-modal__status" data-details-status></div>
            </div>
        </form>
    </div>
</div>

<style>
    .details-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1200;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        align-items: flex-start;
        justify-content: center;
        padding: calc(80px + 1rem) 1rem 1.5rem;
        overflow-y: auto;
    }

    .details-modal.active {
        display: flex;
    }

    .details-modal__dialog {
        background: #fff;
        border-radius: 18px;
        width: 100%;
        max-width: 440px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        animation: detailsModalSlideIn 0.3s ease;
    }

    @keyframes detailsModalSlideIn {
        from {
            transform: translateY(14px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .details-modal__header {
        padding: 1.1rem 1.5rem;
        background: linear-gradient(135deg, #3ba14c, #2d8f3e);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .details-modal__header h3 {
        margin: 0;
        font-size: 1.15rem;
        line-height: 1.4;
        font-weight: 700;
    }

    .details-modal__close {
        border: none;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 1.15rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .details-modal__close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .details-modal__body {
        padding: 1.1rem 1.5rem;
        overflow-y: auto;
        flex: 1;
        min-height: 0;
        -webkit-overflow-scrolling: touch;
    }

    .details-form .form-group {
        margin-bottom: 1rem;
    }

    .details-form-row {
        display: flex;
        gap: 0.75rem;
    }

    .details-form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .details-form label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.35rem;
        display: block;
    }

    .details-form input,
    .details-form textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
    }

    .details-form input:focus,
    .details-form textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .details-form textarea {
        min-height: 90px;
        resize: vertical;
    }

    .details-modal__footer {
        padding: 0.9rem 1.5rem 1.1rem;
    }

    .details-modal__footer button {
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

    .details-modal__footer button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .details-modal__footer button:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.35);
    }

    .details-modal__status {
        margin-top: 0.75rem;
        font-size: 0.85rem;
        display: none;
    }

    .details-modal__status.is-visible {
        display: block;
    }

    .details-modal__status.success {
        color: #15803d;
    }

    .details-modal__status.error {
        color: #b91c1c;
    }

    @media (max-width: 576px) {
        .details-modal {
            align-items: flex-end;
            padding: 0.75rem;
        }

        .details-modal__dialog {
            max-width: none;
            border-radius: 20px 20px 0 0;
            max-height: 85vh;
        }

        .details-form-row {
            flex-direction: column;
        }
    }
</style>

<script>
    (function () {
        const detailsModal = document.getElementById('detailsModal');
        const detailsForm = document.getElementById('detailsForm');
        const statusEl = detailsModal?.querySelector('[data-details-status]');
        const submitBtn = detailsModal?.querySelector('[data-details-submit]');
        const companyNameHolder = detailsModal?.querySelector('[data-details-company]');
        const companyIdInput = detailsModal?.querySelector('[data-details-company-id]');
        const closeBtn = detailsModal?.querySelector('[data-details-close]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!detailsModal || !detailsForm) {
            return;
        }

        function toggleDetailsModal(show = true) {
            detailsModal.classList.toggle('active', show);
            detailsModal.setAttribute('aria-hidden', show ? 'false' : 'true');
            document.body.style.overflow = show ? 'hidden' : '';

            if (!show) {
                detailsForm.reset();
                if (companyNameHolder) {
                    companyNameHolder.textContent = 'this company';
                }
                if (companyIdInput) {
                    companyIdInput.value = '';
                }
                statusEl?.classList.remove('is-visible', 'success', 'error');
                if (statusEl) {
                    statusEl.textContent = '';
                }
            }
        }

        document.addEventListener('click', (event) => {
            const btn = event.target?.closest?.('.btn-get-details');
            if (!btn) {
                return;
            }

            const companyName = btn.dataset.companyName || 'this company';
            const companyId = btn.dataset.companyId || '';

            if (companyNameHolder) {
                companyNameHolder.textContent = companyName;
            }
            if (companyIdInput) {
                companyIdInput.value = companyId;
            }

            toggleDetailsModal(true);
        });

        closeBtn?.addEventListener('click', () => toggleDetailsModal(false));
        detailsModal.addEventListener('click', (event) => {
            if (event.target === detailsModal) {
                toggleDetailsModal(false);
            }
        });

        detailsForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!submitBtn) {
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            statusEl?.classList.remove('is-visible', 'success', 'error');
            if (statusEl) {
                statusEl.textContent = '';
            }

            try {
                const formData = new FormData(detailsForm);
                const response = await fetch('{{ route('company-detail-requests.store') }}', {
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

                statusEl?.classList.add('is-visible', 'success');
                if (statusEl) {
                    statusEl.textContent = data.message ?? 'Request submitted successfully!';
                }

                detailsForm.reset();
                setTimeout(() => toggleDetailsModal(false), 1500);
            } catch (error) {
                const errorMessage = error?.message ?? 'Unable to submit request. Please try again.';
                statusEl?.classList.add('is-visible', 'error');
                if (statusEl) {
                    statusEl.textContent = errorMessage;
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit';
            }
        });
    })();
</script>
