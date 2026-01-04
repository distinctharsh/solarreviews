<div class="quote-modal" id="quoteModal" aria-hidden="true">
    <div class="quote-modal__dialog" role="dialog" aria-labelledby="quoteModalTitle">
        <div class="quote-modal__header">
            <div>
                <h3 id="quoteModalTitle">Get a quote from <span data-quote-company>our partners</span></h3>
            </div>
            <button type="button" class="quote-modal__close" data-quote-close>&times;</button>
        </div>
        <form class="quote-form" id="quoteForm">
            @csrf
            <input type="hidden" name="company_id" data-quote-company-id>
            <input type="hidden" name="state_id" value="{{ $defaultStateId ?? '' }}">
            <div class="quote-modal__body">
                <div class="form-group">
                    <label for="serviceType">What do you need?</label>
                    <select id="serviceType" name="service_type" required>
                        <option value="">Select option</option>
                        <option value="Solar Panel">Solar Panel</option>
                        <option value="Solar Battery">Solar Battery</option>
                        <option value="Solar Inverter">Solar Inverter</option>
                        <option value="EPC">EPC</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="quote-form-row">
                    <div class="form-group">
                        <label for="quoteName">Name *</label>
                        <input type="text" id="quoteName" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="quoteMobile">Mobile Number *</label>
                        <input type="tel" id="quoteMobile" name="mobile_number" placeholder="10 digit mobile number" required minlength="10" maxlength="20">
                    </div>
                </div>
                <div class="quote-form-row">
                    <div class="form-group">
                        <label for="quoteEmail">Email ID</label>
                        <input type="email" id="quoteEmail" name="email" placeholder="name@email.com">
                    </div>
                    <div class="form-group">
                        <label for="quoteLocation">Preferred State *</label>
                        <select id="quoteLocation" name="location" required>
                            <option value="">Select state</option>
                            @foreach(($states ?? collect()) as $s)
                                <option value="{{ $s->name }}" @selected(($defaultStateName ?? null) === $s->name)>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quoteNotes">Anything else?</label>
                    <textarea id="quoteNotes" name="notes" placeholder="Tell us about your requirement (optional)"></textarea>
                </div>
            </div>
            <div class="quote-modal__footer">
                <button type="submit" data-quote-submit>Submit &amp; Get Call</button>
                <div class="quote-modal__status" data-quote-status></div>
            </div>
        </form>
    </div>
</div>

<style>
    .quote-modal {
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

    .quote-modal.active {
        display: flex;
    }

    .quote-modal__dialog {
        background: #fff;
        border-radius: 18px;
        width: 100%;
        max-width: 420px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        animation: quoteModalSlideIn 0.3s ease;
    }

    @keyframes quoteModalSlideIn {
        from {
            transform: translateY(14px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .quote-modal__header {
        padding: 1.1rem 1.5rem;
        background: linear-gradient(135deg, #3ba14c, #2d8f3e);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .quote-modal__header h3 {
        margin: 0;
        font-size: 1.15rem;
        line-height: 1.4;
        font-weight: 700;
    }

    .quote-modal__close {
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

    .quote-modal__close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .quote-modal__body {
        padding: 1.1rem 1.5rem;
        overflow-y: auto;
        flex: 1;
        min-height: 0;
        -webkit-overflow-scrolling: touch;
    }

    .quote-form .form-group {
        margin-bottom: 1rem;
    }

    .quote-form-row {
        display: flex;
        gap: 0.75rem;
    }

    .quote-form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .quote-form label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.35rem;
        display: block;
    }

    .quote-form input,
    .quote-form select,
    .quote-form textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
    }

    .quote-form input:focus,
    .quote-form select:focus,
    .quote-form textarea:focus {
        outline: none;
        border-color: #3ba14c;
        box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.12);
    }

    .quote-form textarea {
        min-height: 80px;
        resize: vertical;
    }

    .quote-modal__footer {
        padding: 0.9rem 1.5rem 1.1rem;
    }

    .quote-modal__footer button {
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

    .quote-modal__footer button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .quote-modal__footer button:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(59, 161, 76, 0.35);
    }

    .quote-modal__status {
        margin-top: 0.75rem;
        font-size: 0.85rem;
        display: none;
    }

    .quote-modal__status.is-visible {
        display: block;
    }

    .quote-modal__status.success {
        color: #15803d;
    }

    .quote-modal__status.error {
        color: #b91c1c;
    }

    @media (max-width: 576px) {
        .quote-modal {
            align-items: flex-end;
            padding: 0.75rem;
        }

        .quote-modal__dialog {
            max-width: none;
            border-radius: 20px 20px 0 0;
            max-height: 85vh;
        }

        .quote-modal__header {
            padding: 1rem 1.25rem;
        }

        .quote-modal__body {
            padding: 1rem 1.25rem 0.5rem;
        }

        .quote-modal__footer {
            padding: 0.75rem 1.25rem 1rem;
        }

        .quote-form-row {
            flex-direction: column;
        }
    }
</style>

<script>
    (function () {
        const quoteModal = document.getElementById('quoteModal');
        const quoteForm = document.getElementById('quoteForm');
        const quoteStatus = quoteModal?.querySelector('[data-quote-status]');
        const quoteSubmitBtn = quoteModal?.querySelector('[data-quote-submit]');
        const companyNameHolder = quoteModal?.querySelector('[data-quote-company]');
        const companyIdInput = quoteModal?.querySelector('[data-quote-company-id]');
        const closeBtn = quoteModal?.querySelector('[data-quote-close]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!quoteModal || !quoteForm) {
            return;
        }

        function toggleQuoteModal(show = true) {
            quoteModal.classList.toggle('active', show);
            quoteModal.setAttribute('aria-hidden', show ? 'false' : 'true');
            document.body.style.overflow = show ? 'hidden' : '';

            if (!show) {
                quoteForm.reset();
                if (companyNameHolder) {
                    companyNameHolder.textContent = 'our partners';
                }
                if (companyIdInput) {
                    companyIdInput.value = '';
                }
                quoteStatus?.classList.remove('is-visible', 'success', 'error');
                if (quoteStatus) {
                    quoteStatus.textContent = '';
                }
            }
        }

        document.querySelectorAll('.btn-get-quote').forEach((btn) => {
            btn.addEventListener('click', () => {
                const companyName = btn.dataset.companyName || 'our partners';
                const companyId = btn.dataset.companyId || '';

                if (companyNameHolder) {
                    companyNameHolder.textContent = companyName;
                }
                if (companyIdInput) {
                    companyIdInput.value = companyId;
                }

                toggleQuoteModal(true);
            });
        });

        closeBtn?.addEventListener('click', () => toggleQuoteModal(false));
        quoteModal.addEventListener('click', (event) => {
            if (event.target === quoteModal) {
                toggleQuoteModal(false);
            }
        });

        quoteForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!quoteSubmitBtn) {
                return;
            }

            quoteSubmitBtn.disabled = true;
            quoteSubmitBtn.textContent = 'Submitting...';
            quoteStatus?.classList.remove('is-visible', 'success', 'error');
            if (quoteStatus) {
                quoteStatus.textContent = '';
            }

            try {
                const formData = new FormData(quoteForm);
                const response = await fetch('{{ route('get-quote.store') }}', {
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

                quoteStatus?.classList.add('is-visible', 'success');
                if (quoteStatus) {
                    quoteStatus.textContent = data.message ?? 'Request submitted successfully!';
                }

                quoteForm.reset();
                setTimeout(() => toggleQuoteModal(false), 1500);
            } catch (error) {
                const errorMessage = error?.message ?? 'Unable to submit request. Please try again.';
                quoteStatus?.classList.add('is-visible', 'error');
                if (quoteStatus) {
                    quoteStatus.textContent = errorMessage;
                }
            } finally {
                quoteSubmitBtn.disabled = false;
                quoteSubmitBtn.textContent = 'Submit & Get Call';
            }
        });
    })();
</script>
