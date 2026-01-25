<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Reviews — Sign in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <style>
        :root {
            --primary: #f5b800;
            --primary-dark: #d29100;
            --text: #0f172a;
            --muted: #6b7280;
            --bg: #f8fafc;
            --card: #ffffff;
        }

        body {
            /* Bootstrap handles margin/box-sizing */
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif; /* Match site font */
            background: radial-gradient(circle at top, rgba(255, 229, 143, 0.45), transparent 55%), var(--bg);
            color: var(--text);
            /* Navbar adds padding-top: 72px via its internal style */
        }

        .page-wrapper {
            /* Subtract navbar height to avoid unnecessary scrollbar */
            min-height: calc(100vh - 72px);
            display: flex;
            flex-direction: column;
        }

        /* Fix button conflict with Bootstrap */
        .btn-auth-submit {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            background: var(--primary);
            color: #0f172a;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .btn-auth-submit:hover {
            background-color: #e6ac00; /* Darken slightly on hover */
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(245, 184, 0, 0.35);
        }

        .auth-page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem 0.85rem 2rem;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            width: 100%;
        }

        .auth-shell {
            width: min(480px, 100%);
            background: var(--card);
            border-radius: 18px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.12);
            display: block;
            overflow: hidden;
            margin: 0 auto; /* Ensure centering within flex container if needed */
        }

        .auth-hero {
            background: linear-gradient(135deg, #fde68a, #f97316);
            padding: clamp(2rem, 5vw, 4rem);
            color: #0f172a;
            position: relative;
        }

        .auth-hero h1 {
            font-size: clamp(2rem, 3vw, 2.8rem);
            margin: 0 0 1rem;
            line-height: 1.2;
        }

        .auth-hero p {
            margin: 0 0 1.5rem;
            font-size: 1rem;
        }

        .stat-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.25);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .benefits {
            margin: 2rem 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 0.85rem;
        }

        .benefits li {
            display: flex;
            gap: 0.6rem;
            font-weight: 500;
        }

        .benefits i {
            color: #0f172a;
        }

        .hero-cta {
            margin-top: 2rem;
        }

        .hero-cta a {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            color: #0f172a;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-form {
            padding: clamp(1.25rem, 4vw, 2rem);
        }

        .auth-form h2 {
            margin: 0 0 0.15rem;
            font-size: 1.35rem;
        }

        .auth-form p {
            margin: 0 0 1.25rem;
            color: var(--muted);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"] {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(245, 184, 0, 0.25);
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .actions label {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.95rem;
            color: var(--muted);
        }

        .actions a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
        }

        /* Removed generic button styling to depend on class */

        .register-callout {
            margin-top: 0.85rem;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .register-callout a {
            color: var(--primary-dark);
            font-weight: 600;
            text-decoration: none;
        }

    </style>
</head>
<body>
<div class="page-wrapper">
    @include('components.frontend.navbar')

    <main class="auth-page">
        <div class="auth-shell">
            <div class="auth-form">
                <h2>Welcome back</h2>
                <p>Enter your details to access the dashboard.</p>

                @if (session('status'))
                    <div style="padding:0.8rem 1rem;border-radius:12px;background:#ecfccb;color:#3f6212;margin-bottom:1rem;">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div style="padding:0.8rem 1rem;border-radius:12px;background:#fee2e2;color:#b91c1c;margin-bottom:1rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        >
                    </div>

                    <div class="actions">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-auth-submit">Login to dashboard</button>
                </form>

                <div style="display:flex;align-items:center;gap:12px;margin:1.25rem 0 0.75rem;color:#9ca3af;font-size:0.85rem;">
                    <span style="flex:1;height:1px;background:#e5e7eb;"></span>
                    <span>or</span>
                    <span style="flex:1;height:1px;background:#e5e7eb;"></span>
                </div>

                <a
                    href="{{ route('auth.google.login.redirect', ['redirect_to' => route('dashboard')]) }}"
                    style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:0.75rem;border-radius:10px;border:1px solid #e5e7eb;background:#fff;color:#111827;font-weight:700;text-decoration:none;"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285f4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34a853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#fbbc05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#ea4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continue with Google
                </a>

                <div class="register-callout">
                    New to Solar Reviews? <a href="{{ route('register') }}">Create an account</a>
                </div>
           
               
            </div>
        </div>
    </main>

    @include('components.frontend.footer')
</div>

</body>
</html>
