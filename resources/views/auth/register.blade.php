<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Reviews — Create account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <style>
        :root {
            --primary: #f5b800;
            --primary-dark: #d29100;
            --deep: #0f172a;
            --muted: #475569;
            --bg: #f8fafc;
            --card: #ffffff;
        }

        body {
            /* margin: 0; -> handled by Bootstrap */
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: radial-gradient(circle at top, rgba(255, 229, 143, 0.4), transparent 60%), var(--bg);
            color: var(--deep);
        }

        .page-wrapper {
            min-height: calc(100vh - 72px);
            display: flex;
            flex-direction: column;
        }

        .register-page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem 1rem 2.5rem;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            width: 100%;
        }

        .register-shell {
            width: min(520px, 100%);
            margin: 0 auto;
            background: var(--card);
            border-radius: 20px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            overflow: hidden;
        }

        .register-form {
            padding: clamp(1.5rem, 5vw, 2.4rem);
        }

        .register-form h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .register-form > p {
            margin: 0.3rem 0 1.5rem;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .progress-step {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(15, 23, 42, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .progress-step.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--deep);
            box-shadow: 0 8px 18px rgba(245, 184, 0, 0.35);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-section {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .form-section.active {
            display: block;
        }

        .role-grid {
            display: grid;
            gap: 0.75rem;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        }

        .role-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 0.8rem 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .role-card input {
            position: absolute;
            opacity: 0;
        }

        .role-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff7e6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .role-card.active {
            border-color: var(--primary);
            box-shadow: 0 10px 26px rgba(245, 184, 0, 0.25);
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .input-group label {
            font-weight: 500;
        }

        .input-group input {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(245, 184, 0, 0.25);
        }

        .error-msg {
            color: #dc2626;
            font-size: 0.85rem;
            min-height: 18px;
        }

        .notice {
            padding: 0.9rem 1.15rem;
            border-radius: 14px;
            background: #fee2e2;
            color: #b91c1c;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 0.85rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .form-actions button {
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1.1rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: var(--deep);
        }

        .btn-primary {
            background: var(--primary);
            color: var(--deep);
            flex: 1;
            min-width: 160px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(245, 184, 0, 0.3);
        }

        .agreement {
            display: flex;
            gap: 0.55rem;
            align-items: flex-start;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .agreement input {
            margin-top: 0.2rem;
            width: auto;
        }

        .login-callout {
            margin-top: 1.2rem;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .login-callout a {
            color: var(--primary-dark);
            font-weight: 600;
            text-decoration: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .register-page { padding: 1.25rem 0.85rem 2rem; }
            .register-shell { border-radius: 18px; }
            .form-actions { flex-direction: column-reverse; }
            .btn-primary { width: 100%; }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    @include('components.frontend.navbar')

    <main class="register-page">
        <div class="register-shell">

            <section class="register-form">
                <h2>Create your account</h2>
                <p>Multi-step onboarding keeps it simple and human.</p>

                @if ($errors->any())
                    <div class="notice">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="progress-steps" data-progress>
                    <div class="progress-step active" data-step="1">1</div>
                    <div class="progress-step" data-step="2">2</div>
                </div>

                <form id="registrationForm" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <div class="form-section active" data-section="1">
                        <div class="input-group">
                            <label>Registering as</label>
                            <div class="role-grid">
                                @forelse($userTypes as $type)
                                    @php($isSelected = (int) old('user_type_id', $userTypes->first()->id ?? null) === $type->id)
                                    <label class="role-card {{ $isSelected ? 'active' : '' }}">
                                        <input type="radio" name="user_type_id" value="{{ $type->id }}" {{ $isSelected ? 'checked' : '' }} required>
                                        <div class="role-icon">{{ strtoupper(substr($type->slug ?? $type->name, 0, 2)) }}</div>
                                        <div>
                                            <strong>{{ $type->name }}</strong><br>
                                            <!-- <span>Tailored workflows</span> -->
                                        </div>
                                    </label>
                                @empty
                                    <p>No user types configured.</p>
                                @endforelse
                            </div>
                            <span class="error-msg" data-error="user_type_id"></span>
                        </div>

                        <div class="input-group">
                            <label for="name">Full name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            <span class="error-msg" data-error="name"></span>
                        </div>

                        <div class="input-group">
                            <label for="email">Work email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            <span class="error-msg" data-error="email"></span>
                        </div>

                        <div class="input-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                            <span class="error-msg" data-error="phone"></span>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-primary" data-next>Next step</button>
                        </div>
                    </div>

                    <div class="form-section" data-section="2">
                        <div class="input-group">
                            <label for="password">Create password</label>
                            <input type="password" id="password" name="password" minlength="8" required>
                            <span class="error-msg" data-error="password"></span>
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required>
                            <span class="error-msg" data-error="password_confirmation"></span>
                        </div>

                        <label class="agreement">
                            <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                            I agree to the <a href="#" target="_blank">Terms &amp; Conditions</a>
                        </label>
                        <span class="error-msg" data-error="terms"></span>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary" data-prev>Back</button>
                            <button type="submit" class="btn-primary">Create account</button>
                        </div>
                    </div>
                </form>

                <div class="login-callout">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in</a>
                </div>
            </section>
        </div>
    </main>

    @include('components.frontend.footer')
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('registrationForm');
        const sections = document.querySelectorAll('.form-section');
        const steps = document.querySelectorAll('.progress-step');
        let current = 0;

        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            const iti = window.intlTelInput(phoneInput, {
                preferredCountries: ['in'],
                separateDialCode: true,
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js',
            });
            phoneInput.addEventListener('blur', () => {
                if (iti.isValidNumber()) {
                    phoneInput.value = iti.getNumber();
                }
            });
        }

        const updateSteps = () => {
            sections.forEach((section, index) => {
                section.classList.toggle('active', index === current);
            });
            steps.forEach((step, index) => {
                step.classList.toggle('active', index <= current);
            });
        };

        const validateSection = (index) => {
            const fields = sections[index].querySelectorAll('input[required]');
            let valid = true;
            fields.forEach((field) => {
                const errorHolder = sections[index].querySelector(`[data-error="${field.name}"]`);
                if (field.type === 'radio') {
                    const groupChecked = form.querySelector(`input[name="${field.name}"]:checked`);
                    if (!groupChecked) {
                        valid = false;
                        if (errorHolder) errorHolder.textContent = 'Please pick an option';
                    } else if (errorHolder) {
                        errorHolder.textContent = '';
                    }
                    return;
                }

                if (!field.value.trim() || (field.type === 'checkbox' && !field.checked)) {
                    field.classList.add('error');
                    if (errorHolder) errorHolder.textContent = 'This field is required';
                    valid = false;
                } else {
                    field.classList.remove('error');
                    if (errorHolder) errorHolder.textContent = '';
                }
            });
            return valid;
        };

        document.querySelectorAll('[data-next]').forEach(btn => {
            btn.addEventListener('click', () => {
                if (validateSection(current)) {
                    current = Math.min(sections.length - 1, current + 1);
                    updateSteps();
                }
            });
        });

        document.querySelectorAll('[data-prev]').forEach(btn => {
            btn.addEventListener('click', () => {
                current = Math.max(0, current - 1);
                updateSteps();
            });
        });

        form.addEventListener('submit', (event) => {
            if (!validateSection(current)) {
                event.preventDefault();
                return;
            }
            if (current !== sections.length - 1) {
                event.preventDefault();
                current = sections.length - 1;
                updateSteps();
            }
        });

        document.querySelectorAll('.role-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            card.addEventListener('click', () => {
                radio.checked = true;
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
                const errorHolder = document.querySelector('[data-error="user_type_id"]');
                if (errorHolder) errorHolder.textContent = '';
            });
        });
    });
</script>
</body>
</html>
