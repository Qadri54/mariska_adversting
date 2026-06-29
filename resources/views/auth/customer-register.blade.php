{{-- File: resources/views/auth/customer-register.blade.php --}}

@extends('layouts.app')

@section('title', 'Daftar Akun — Arya Advertising')

@push('styles')
<style>
    /* Latar belakang memenuhi layar, disesuaikan dengan tema warna Arya Advertising */
    .register-section {
        background: linear-gradient(135deg, var(--primary, #3b71ca) 0%, var(--primary-dark, #285192) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    /* Kartu form di tengah yang lebih lebar untuk menampung 2 kolom */
    .register-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Bagian header di dalam kartu */
    .register-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .register-header img {
        max-width: 100px;
        margin-bottom: 15px;
    }

    .register-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-dark, #1A3B5C);
        margin-bottom: 8px;
    }

    .register-header p {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control {
        padding: 10px 15px;
        border-radius: 6px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: var(--primary, #3b71ca);
        box-shadow: 0 0 0 0.2rem rgba(59, 113, 202, 0.25);
    }

    .btn-register {
        background-color: var(--primary, #3b71ca);
        color: white;
        padding: 12px;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        width: 100%;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background-color: var(--primary-dark, #285192);
        color: white;
    }
</style>
@endpush

@section('content')

    <section class="register-section">
        <div class="container">
            <div class="register-card">
                
                <div class="register-header">
                    {{-- Pastikan path gambar disesuaikan dengan logo CV Arya Advertising Anda --}}
                    <img src="{{ asset('images/LOGO.jpg') }}" alt="Logo Arya Advertising">
                    <h2>Pendaftaran Akun Baru</h2>
                    <p>Silakan isi data lengkap untuk membuat akun</p>
                </div>

                <form method="POST" action="{{ route('customer.register.submit') }}">
                    @csrf

                    <div class="row">
                        <!-- Baris 1 -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                   value="{{ old('nama_lengkap') }}" placeholder="Nama lengkap Anda" required autofocus>
                            @error('nama_lengkap')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email') }}" placeholder="email@example.com" required>
                            @error('email')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Baris 2 -->
                        <div class="col-md-12 mb-3">
                            <label for="phone_number" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                   value="{{ old('phone_number') }}" placeholder="08xxxxxxxxxx" required>
                            @error('phone_number')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Baris 3 -->
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Minimal 6 karakter" required>
                            @error('password')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-register">Daftar Akun</button>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" style="color: var(--primary-dark); font-weight: 600; text-decoration: none;">
                                Login di sini
                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection