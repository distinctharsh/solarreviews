<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Reviews — Sign in</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(255, 229, 143, 0.45), transparent 55%), var(--bg);
            color: var(--text);
        }

        .auth-page {
            min-height: calc(100vh - 140px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem 0.85rem 2rem;
        }

        .auth-shell {
            width: min(480px, 100%);
            background: var(--card);
            border-radius: 18px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.12);
            display: block;
            overflow: hidden;
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

        button[type="submit"] {
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

        button[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(245, 184, 0, 0.35);
        }

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
<main class="auth-page">
<div class="auth-shell container-custom">

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

            <button type="submit">Login to dashboard</button>
        </form>

        <div class="register-callout">
            New to Solar Reviews? <a href="{{ route('register') }}">Create an account</a>
        </div>
    </div>
</div>
</main>

</body>
</html>
