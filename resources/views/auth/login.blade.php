{{-- File: resources/views/auth/login.blade.php --}}

@extends('layouts.app')

@section('title', 'Login — Arya Advertising')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ============================================================ */
    /* ATUR WARNA TEMA SESUAI BANNER WEBSITE (BIRU)                 */
    /* ============================================================ */
    :root {
        --primary-color: #4A82A6; 
        --primary-hover: #386685; 
        --focus-shadow: rgba(74, 130, 166, 0.25); 
    }

    main { padding: 0 !important; }

    .login-wrapper {
        background-color: var(--primary-color);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        transition: background-color 0.3s ease;
    }

    .login-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .login-card h3 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.6rem;
        margin-bottom: 8px;
    }

    .login-card p {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem var(--focus-shadow);
        outline: none;
    }

    .input-group-text {
        border-radius: 0 8px 8px 0;
        background-color: transparent;
        border-left: none;
        cursor: pointer;
        color: #6c757d;
    }
    
    .input-password {
        border-right: none;
    }

    .input-password:focus + .input-group-text {
        border-color: var(--primary-color);
    }

    .btn-login {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: var(--primary-hover);
        color: white;
    }

    .link-register {
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
    }

    .link-register:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')

    <section class="login-wrapper">
        <div class="login-card">

            <div class="text-center">
                <img src="{{ asset('images/LOGO.jpg') }}" alt="Logo Arya Advertising" style="height: 50px; max-width: 100%; object-fit: contain; margin-bottom: 20px;">
                <h3>Selamat Datang Kembali!</h3>
                <p>Silakan masuk ke akun Anda</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger text-center mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-center mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                {{-- Input Email/Username yang sudah diperbaiki --}}
                <div class="mb-3">
                    <label class="form-label">Email atau Username</label>
                    <input type="text" class="form-control" name="login_id" 
                           placeholder="Masukkan email atau username" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control input-password" name="password" id="passwordInput" placeholder="********" required>
                        <span class="input-group-text" onclick="togglePassword()">
                            <i class="far fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" style="cursor: pointer;">
                    <label class="form-check-label text-muted" for="remember" style="font-size: 0.9rem; cursor: pointer;">
                        Ingat saya
                    </label>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-login btn-lg">
                        Masuk <i class="fas fa-sign-in-alt"></i>
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">
                        Belum punya akun? 
                        <a href="{{ route('customer.register') }}" class="link-register">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush