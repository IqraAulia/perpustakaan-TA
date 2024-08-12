<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .hero-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        .hero-section img {
            max-width: 150px;
            height: auto;
        }
        .hero-section h1 {
            margin-top: 1rem;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
        }
        .status-message {
            color: green;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="hero-section">
            <img src="{{ asset('kaiadmin-lite-1.0.0/assets/img/examples/logo-pnp.jpg') }}" alt="image profile" class="avatar-img rounded" />
            <h1>SELAMAT DATANG DI PERPUSTAKAAN PSDKU TANAH DATAR</h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card p-4 shadow-lg login-card">
                <h3 class="text-center mb-4">Login</h3>

                @if(session('status'))
                    <div class="status-message text-center mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                            <span class="input-group-text">@</span>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const email = document.querySelector('#email');
            const loginForm = document.querySelector('#loginForm');

            togglePassword.addEventListener('click', function () {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('i').classList.toggle('bi-eye');
                this.querySelector('i').classList.toggle('bi-eye-slash');
            });

            loginForm.addEventListener('submit', function (e) {
                let isValid = true;
                
                // Reset error messages
                emailError.textContent = '';
                passwordError.textContent = '';

                // Validate email
                const emailValue = email.value;
                if (!validateEmail(emailValue)) {
                    emailError.textContent = 'Please enter a valid email address.';
                    isValid = false;
                }

                // Validate password
                const passwordValue = password.value;
                if (!validatePassword(passwordValue)) {
                    passwordError.textContent = 'Password must be at least 6 characters long.';
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault(); // Prevent form submission
                }
            });

            function validateEmail(email) {
                // Simple email validation regex
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            function validatePassword(password) {
                // Validate password length
                return password.length >= 6;
            }
        });
    </script>
</body>
</html>
