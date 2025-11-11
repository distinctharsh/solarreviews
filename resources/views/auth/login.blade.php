<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SolarReviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-gray: #f3f4f6;
            --border-color: #e5e7eb;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            margin: 1rem;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            color: var(--primary-color);
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }
        
        .login-header p {
            color: #6b7280;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
        }
        
        .forgot-password {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        
        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .login-btn {
            width: 100%;
            padding: 0.85rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #9ca3af;
            font-size: 0.875rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
            margin: 0 0.75rem;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
            font-size: 0.95rem;
        }
        
        .register-link a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your SolarReviews account</p>
        </div>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="form-control" 
                    required 
                    autofocus 
                    autocomplete="email"
                    placeholder="Enter your email"
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    required 
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    Remember me
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">
                        Forgot Password?
                    </a>
                @endif
            </div>
            
            <button type="submit" class="login-btn">
                Sign In
            </button>
            
            <div class="divider">OR</div>
            
            <div class="register-link">
                Don't have an account? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Sign up</a>
                @else
                    <a href="#">Contact Support</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
