<div class="modal fade" id="businessLoginModal" tabindex="-1" aria-labelledby="businessLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
            <div class="modal-header" style="border-bottom: none; padding: 2rem 2rem 1rem;">
                <h5 class="modal-title" id="businessLoginModalLabel" style="font-weight: 600; font-size: 1.5rem;">Login to Your Business Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1rem 2rem 2rem;">
                <!-- Step 1: Choose Login Method -->
                <div id="businessLoginChoiceStep" class="login-step">
                    <p class="text-muted mb-4" style="font-size: 0.95rem;">Choose how you want to login</p>
                    <div class="d-grid gap-3">
                        <button type="button" class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center gap-3" 
                                id="businessGoogleLoginBtn" style="border-radius: 12px; padding: 0.875rem; border: 2px solid #4285f4;">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285f4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34a853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#fbbc05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#ea4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <span style="font-weight: 500;">Continue with Google</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-lg d-flex align-items-center justify-content-center gap-3" 
                                id="businessEmailLoginBtn" style="border-radius: 12px; padding: 0.875rem; border: 2px solid #6b7280;">
                            <i class="fas fa-envelope" style="font-size: 1.1rem;"></i>
                            <span style="font-weight: 500;">Continue with Email</span>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Email Input -->
                <div id="businessEmailInputStep" class="login-step" style="display: none;">
                    <p class="text-muted mb-3" style="font-size: 0.95rem;">Enter your business email address</p>
                    <form id="businessEmailLoginForm">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" id="businessLoginEmail" 
                                   placeholder="your.email@company.com" required 
                                   style="border-radius: 12px; padding: 0.875rem; border: 2px solid #e5e7eb;">
                        </div>
                        <div id="businessEmailError" class="text-danger small mb-3" style="display: none;"></div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" id="businessBackToChoiceBtn" 
                                    style="border-radius: 12px; padding: 0.75rem 1.5rem;">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </button>
                            <button type="submit" class="btn btn-primary flex-grow-1" 
                                    id="businessSendOtpBtn" style="border-radius: 12px; padding: 0.75rem 1.5rem; font-weight: 500;">
                                Send Verification Code
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 3: OTP Verification -->
                <div id="businessOtpVerificationStep" class="login-step" style="display: none;">
                    <p class="text-muted mb-2" style="font-size: 0.95rem;">We sent a verification code to</p>
                    <p class="mb-4 fw-semibold" id="businessOtpEmailDisplay"></p>
                    <form id="businessOtpVerificationForm">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg text-center" id="businessOtpInput" 
                                   placeholder="Enter 6-digit code" maxlength="6" required
                                   style="border-radius: 12px; padding: 0.875rem; border: 2px solid #e5e7eb; font-size: 1.25rem; letter-spacing: 0.5rem;">
                        </div>
                        <div id="businessOtpError" class="text-danger small mb-3" style="display: none;"></div>
                        <div id="businessOtpSuccess" class="text-success small mb-3" style="display: none;"></div>
                        <div class="d-flex gap-2 mb-3">
                            <button type="button" class="btn btn-outline-secondary" id="businessBackToEmailBtn" 
                                    style="border-radius: 12px; padding: 0.75rem 1.5rem;">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </button>
                            <button type="submit" class="btn btn-primary flex-grow-1" 
                                    id="businessVerifyOtpBtn" style="border-radius: 12px; padding: 0.75rem 1.5rem; font-weight: 500;">
                                Verify Code
                            </button>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-link text-decoration-none p-0" id="businessResendOtpBtn" 
                                    style="font-size: 0.875rem; color: #5325c7;">
                                Didn't receive code? Resend
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #businessLoginModal .modal-content {
        max-width: 450px;
        margin: 0 auto;
    }

    #businessLoginModal .btn:focus {
        box-shadow: none;
    }

    #businessLoginModal .form-control:focus {
        border-color: #5325c7;
        box-shadow: 0 0 0 0.2rem rgba(83, 37, 199, 0.25);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('businessLoginModal'));
    const loginChoiceStep = document.getElementById('businessLoginChoiceStep');
    const emailInputStep = document.getElementById('businessEmailInputStep');
    const otpVerificationStep = document.getElementById('businessOtpVerificationStep');
    
    const googleLoginBtn = document.getElementById('businessGoogleLoginBtn');
    const emailLoginBtn = document.getElementById('businessEmailLoginBtn');
    const backToChoiceBtn = document.getElementById('businessBackToChoiceBtn');
    const backToEmailBtn = document.getElementById('businessBackToEmailBtn');
    const emailLoginForm = document.getElementById('businessEmailLoginForm');
    const otpVerificationForm = document.getElementById('businessOtpVerificationForm');
    const sendOtpBtn = document.getElementById('businessSendOtpBtn');
    const verifyOtpBtn = document.getElementById('businessVerifyOtpBtn');
    const resendOtpBtn = document.getElementById('businessResendOtpBtn');
    const loginEmail = document.getElementById('businessLoginEmail');
    const otpInput = document.getElementById('businessOtpInput');
    const otpEmailDisplay = document.getElementById('businessOtpEmailDisplay');
    const emailError = document.getElementById('businessEmailError');
    const otpError = document.getElementById('businessOtpError');
    const otpSuccess = document.getElementById('businessOtpSuccess');

    let currentEmail = '';

    // Google Login
    googleLoginBtn.addEventListener('click', function() {
        const returnUrl = window.location.href;
        window.location.href = '{{ route("business.oauth.google.redirect", ["return_url" => ""]) }}' + encodeURIComponent(returnUrl);
    });

    // Show Email Input Step
    emailLoginBtn.addEventListener('click', function() {
        loginChoiceStep.style.display = 'none';
        emailInputStep.style.display = 'block';
    });

    // Back to Choice
    backToChoiceBtn.addEventListener('click', function() {
        emailInputStep.style.display = 'none';
        loginChoiceStep.style.display = 'block';
        emailError.style.display = 'none';
        loginEmail.value = '';
    });

    // Back to Email
    backToEmailBtn.addEventListener('click', function() {
        otpVerificationStep.style.display = 'none';
        emailInputStep.style.display = 'block';
        otpError.style.display = 'none';
        otpSuccess.style.display = 'none';
        otpInput.value = '';
    });

    // Send OTP
    emailLoginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = loginEmail.value.trim();
        
        if (!email || !email.includes('@')) {
            emailError.textContent = 'Please enter a valid email address';
            emailError.style.display = 'block';
            return;
        }

        emailError.style.display = 'none';
        sendOtpBtn.disabled = true;
        sendOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                             document.querySelector('input[name="_token"]')?.value;
            
            if (!csrfToken) {
                emailError.textContent = 'CSRF token not found. Please refresh the page.';
                emailError.style.display = 'block';
                return;
            }

            const response = await fetch('{{ route("business.login.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            });

            let data;
            try {
                data = await response.json();
            } catch (jsonError) {
                emailError.textContent = 'Server error. Please try again.';
                emailError.style.display = 'block';
                return;
            }

            if (response.ok && data.success) {
                currentEmail = email;
                otpEmailDisplay.textContent = email;
                emailInputStep.style.display = 'none';
                otpVerificationStep.style.display = 'block';
                otpInput.focus();
            } else {
                emailError.textContent = data.message || 'Failed to send verification code. Please try again.';
                emailError.style.display = 'block';
            }
        } catch (error) {
            console.error('Error sending OTP:', error);
            emailError.textContent = 'Network error. Please check your connection and try again.';
            emailError.style.display = 'block';
        } finally {
            sendOtpBtn.disabled = false;
            sendOtpBtn.innerHTML = 'Send Verification Code';
        }
    });

    // Verify OTP
    otpVerificationForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const otp = otpInput.value.trim();

        if (otp.length !== 6) {
            otpError.textContent = 'Please enter a 6-digit code';
            otpError.style.display = 'block';
            return;
        }

        otpError.style.display = 'none';
        otpSuccess.style.display = 'none';
        verifyOtpBtn.disabled = true;
        verifyOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Verifying...';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                             document.querySelector('input[name="_token"]')?.value;

            const response = await fetch('{{ route("business.login.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    email: currentEmail,
                    otp: otp 
                })
            });

            const data = await response.json();

            if (data.success) {
                otpSuccess.textContent = 'Verification successful! Redirecting...';
                otpSuccess.style.display = 'block';
                
                // Redirect based on response
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else if (data.requires_registration) {
                        // Show registration form with pre-filled email
                        window.location.href = '{{ route("register") }}?email=' + encodeURIComponent(currentEmail) + '&otp_verified=1';
                    } else {
                        window.location.href = '{{ route("dashboard") }}';
                    }
                }, 500);
            } else {
                otpError.textContent = data.message || 'Invalid verification code. Please try again.';
                otpError.style.display = 'block';
            }
        } catch (error) {
            console.error('Error verifying OTP:', error);
            otpError.textContent = 'Something went wrong. Please try again.';
            otpError.style.display = 'block';
        } finally {
            verifyOtpBtn.disabled = false;
            verifyOtpBtn.innerHTML = 'Verify Code';
        }
    });

    // Resend OTP
    resendOtpBtn.addEventListener('click', async function() {
        resendOtpBtn.disabled = true;
        resendOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                             document.querySelector('input[name="_token"]')?.value;

            const response = await fetch('{{ route("business.login.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: currentEmail })
            });

            const data = await response.json();

            if (data.success) {
                otpSuccess.textContent = 'Verification code sent! Please check your email.';
                otpSuccess.style.display = 'block';
                otpError.style.display = 'none';
            } else {
                otpError.textContent = data.message || 'Failed to resend code. Please try again.';
                otpError.style.display = 'block';
            }
        } catch (error) {
            otpError.textContent = 'Something went wrong. Please try again.';
            otpError.style.display = 'block';
        } finally {
            resendOtpBtn.disabled = false;
            resendOtpBtn.innerHTML = 'Didn\'t receive code? Resend';
        }
    });

    // Auto-format OTP input (numbers only)
    otpInput.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Expose modal for external triggers
    window.openBusinessLoginModal = function() {
        modal.show();
    };
});
</script>

