<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Login - Layanan Lingkungan</title>
    <style>
        /* ===== LOGIN ADMIN STYLES ===== */
        :root {
            --cream: #E5D9B6;
            --sage: #A4BE7B;
            --green: #5F8D4E;
            --dark-green: #285430;
            --white: #ffffff;
            --text-dark: #2C3E50;
            --text-medium: #546E7A;
            --text-light: #78909C;
            --error-red: #e74c3c;
            --success-green: #27ae60;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--cream) 0%, #f1edd6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px rgba(40, 84, 48, 0.15);
            border: 1px solid rgba(229, 217, 182, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Decorative elements */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--sage), var(--green));
        }

        .login-card::after {
            content: '';
            position: absolute;
            top: 10px;
            right: 10px;
            width: 60px;
            height: 60px;
            background: rgba(164, 190, 123, 0.1);
            border-radius: 50%;
            z-index: 0;
        }

        /* Logo Section */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            border-radius: 18px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(95, 141, 78, 0.3);
        }

        .logo-wrapper i {
            font-size: 2.2rem;
            color: var(--white);
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-green);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--text-medium);
            font-size: 0.95rem;
        }

        /* Error Alert */
        .alert-message {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.9rem;
            animation: fadeIn 0.3s ease;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            color: var(--error-red);
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid rgba(39, 174, 96, 0.2);
            color: var(--success-green);
        }

        /* Form Styles */
        .login-form {
            position: relative;
            z-index: 1;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.6rem;
            padding-left: 0.3rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: var(--green);
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 3rem;
            font-size: 1rem;
            font-family: inherit;
            color: var(--text-dark);
            background: var(--white);
            border: 2px solid rgba(164, 190, 123, 0.3);
            border-radius: 10px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(164, 190, 123, 0.15);
        }

        .form-input.error {
            border-color: var(--error-red);
            background: rgba(231, 76, 60, 0.02);
        }

        .form-input::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Password Toggle Button */
        .password-toggle {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            padding: 0.5rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--green);
        }

        /* Remember Me */
        .remember-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.8rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            cursor: pointer;
        }

        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(164, 190, 123, 0.5);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .custom-checkbox.checked {
            background: var(--green);
            border-color: var(--green);
        }

        .custom-checkbox.checked i {
            color: var(--white);
            font-size: 0.8rem;
            display: block;
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: var(--text-medium);
            user-select: none;
        }

        .forgot-link {
            color: var(--green);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--dark-green);
            text-decoration: underline;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            color: var(--white);
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            box-shadow: 0 5px 15px rgba(95, 141, 78, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(95, 141, 78, 0.4);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn.loading {
            opacity: 0.8;
            cursor: not-allowed;
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(164, 190, 123, 0.2);
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.3s ease;
        }

        .login-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Back to Home Link */
        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: var(--dark-green);
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .back-home:hover {
            color: var(--green);
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem;
            }
            
            .login-title {
                font-size: 1.6rem;
            }
            
            .logo-wrapper {
                width: 60px;
                height: 60px;
                border-radius: 15px;
                margin-bottom: 1.2rem;
            }
            
            .logo-wrapper i {
                font-size: 1.8rem;
            }
            
            .remember-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 360px) {
            .login-card {
                padding: 1.5rem;
            }
            
            .form-input {
                padding: 0.8rem 0.9rem 0.8rem 2.8rem;
                font-size: 0.95rem;
            }
            
            .input-icon {
                left: 12px;
                font-size: 1rem;
            }
            
            .password-toggle {
                right: 12px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Back to Home Link -->
    <a href="/" class="back-home">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-wrapper">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="login-title">Admin Access</h1>
                <p class="login-subtitle">Masukkan kredensial untuk mengakses panel admin</p>
            </div>

            <!-- Error/Success Messages -->
            @if($errors->any())
                <div class="alert-message alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="alert-message alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-message alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Form -->
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Username/Email Field -->
                <div class="form-group">
                    <label class="form-label" for="email">Email atau Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            id="email"
                            name="email"
                            class="form-input @error('email') error @enderror"
                            placeholder="admin@example.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>
                    @error('email')
                        <div class="alert-message alert-error" style="margin-top: 0.5rem;">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>{{ $message }}</div>
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            class="form-input @error('password') error @enderror"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="alert-message alert-error" style="margin-top: 0.5rem;">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>{{ $message }}</div>
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-wrapper">
                    <div class="checkbox-wrapper" id="rememberMeWrapper">
                        <input type="checkbox" name="remember" id="remember" class="d-none" {{ old('remember') ? 'checked' : '' }}>
                        <div class="custom-checkbox {{ old('remember') ? 'checked' : '' }}" id="rememberCheckbox">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="checkbox-label">Ingat saya</span>
                    </div>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>© 2025 Layanan Lingkungan | Admin Panel v1.0</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-form');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const rememberMeWrapper = document.getElementById('rememberMeWrapper');
            const rememberCheckbox = document.getElementById('rememberCheckbox');
            const rememberInput = document.getElementById('remember');
            const loginButton = document.getElementById('loginButton');

            // Toggle Password Visibility
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle eye icon
                const eyeIcon = this.querySelector('i');
                eyeIcon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
            });

            // Remember Me Checkbox
            rememberMeWrapper.addEventListener('click', function(e) {
                e.preventDefault();
                const isChecked = rememberCheckbox.classList.contains('checked');
                
                if (isChecked) {
                    rememberCheckbox.classList.remove('checked');
                    rememberInput.checked = false;
                } else {
                    rememberCheckbox.classList.add('checked');
                    rememberInput.checked = true;
                }
            });

            // Form submission loading state
            loginForm.addEventListener('submit', function() {
                // Show loading state
                loginButton.classList.add('loading');
                loginButton.disabled = true;
                const buttonIcon = loginButton.querySelector('i');
                const buttonText = loginButton.querySelector('span');
                buttonIcon.className = 'fas fa-spinner fa-spin';
                buttonText.textContent = 'Memproses...';
            });

            // Auto-focus email field
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.focus();
            }

            // Input validation on blur
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });
                
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('error');
                    }
                });
            });

            // Forgot password link
            document.querySelector('.forgot-link')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Untuk reset password, silakan hubungi super admin atau gunakan fitur "Forgot Password" jika sudah dikonfigurasi.');
            });
        });
    </script>
</body>
</html>