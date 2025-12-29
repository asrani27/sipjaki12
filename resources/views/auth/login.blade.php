<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPJAKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Background dengan gradien sama seperti header */
        body {
            background: linear-gradient(72deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* Pattern background overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            opacity: 0.3;
            z-index: -1;
        }

        /* Login container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Login card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 400px;
            width: 100%;
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.15), 0 15px 15px -5px rgba(0, 0, 0, 0.08);
        }

        /* Header section */
        .login-header {
            background: linear-gradient(135deg, rgba(51, 95, 185, 0.9) 0%, rgba(242, 143, 7, 0.9) 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            opacity: 0.2;
        }

        .login-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        /* Form section */
        .login-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: rgb(51, 95, 185);
            box-shadow: 0 0 0 3px rgba(51, 95, 185, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(72deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(51, 95, 185, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Link styling */
        .login-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .login-links a {
            color: rgb(51, 95, 185);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-links a:hover {
            color: rgb(242, 143, 7);
            text-decoration: underline;
        }

        /* Alert styling */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Icon styling */
        .input-icon {
            position: relative;
        }

        .input-icon svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
        }

        .input-icon .form-input {
            padding-left: 3rem;
        }

        /* Responsive design */
        @media (max-width: 640px) {
            .login-container {
                padding: 1rem;
            }

            .login-card {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .login-header {
                padding: 1.5rem;
            }

            .login-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <h1 class="login-title">SIPJAKI</h1>
                <p class="login-subtitle">Sistem Informasi Pembina Jasa Konstruksi</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $errors->first('username') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-input @error('username') error @enderror"
                                placeholder="Masukkan username"
                                value="{{ old('username') }}"
                                required
                                autocomplete="username"
                            >
                        </div>
                        @error('username')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input @error('password') error @enderror"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">
                        Masuk
                    </button>
                </form>

                <!-- Links -->
                <div class="login-links">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus on username field
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.getElementById('username');
            if (usernameField) {
                usernameField.focus();
            }
        });

        // Add loading state to submit button
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.btn-submit');
            submitBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Masuk...';
            submitBtn.disabled = true;
        });

        // Add spin animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
