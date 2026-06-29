@extends('layouts.app')

@section('title', 'Profil Saya — Arya Advertising')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%);
        height: 150px;
        position: relative;
        margin-bottom: 70px; /* Memberikan ruang untuk avatar yang menonjol ke bawah */
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid #fff;
        background: #fff;
        object-fit: cover;
        position: absolute;
        bottom: -60px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--primary-dark);
        overflow: hidden;
        padding: 0;
    }
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .info-label {
        font-size: 0.9rem;
        color: var(--muted);
        margin-bottom: 2px;
    }
    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 80px;"> {{-- Margin top agar tidak ketutup navbar --}}
    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            {{-- Alert Pesan Sukses (Opsional, untuk menampilkan notifikasi jika upload berhasil) --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Kartu Profil --}}
            <div class="card profile-card mb-4">
                
                {{-- Header Warna Biru --}}
                <div class="profile-header">
                    {{-- Avatar --}}
                    <div class="profile-avatar">
                        @if($customer->avatar)
                            <img src="{{ asset('storage/avatars/' . $customer->avatar) }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="bi bi-person-fill"></i>
                        @endif
                    </div>
                </div>

                <div class="card-body text-center pt-3 pb-4 px-4">
                    
                    {{-- Form Upload Foto (Dipindahkan ke dalam card-body agar rapi) --}}
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*" style="max-width: 200px;" required>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Upload</button>
                        </div>
                        @error('avatar')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </form>

                    <div class="mt-2">
                        <h3 class="fw-bold mb-1">{{ $customer->nama_lengkap }}</h3>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Member Customer</span>
                    </div>

                    <hr class="my-4 opacity-10">

                    {{-- Detail Informasi --}}
                    <div class="row text-start g-4 justify-content-center">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <div class="me-3 text-primary fs-4"><i class="bi bi-envelope"></i></div>
                                <div>
                                    <div class="info-label">Alamat Email</div>
                                    <div class="info-value">{{ $customer->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <div class="me-3 text-success fs-4"><i class="bi bi-whatsapp"></i></div>
                                <div>
                                    <div class="info-label">Nomor WhatsApp/Telepon</div>
                                    <div class="info-value">{{ $customer->phone_number ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <div class="me-3 text-warning fs-4"><i class="bi bi-calendar-event"></i></div>
                                <div>
                                    <div class="info-label">Bergabung Sejak</div>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($customer->created_at)->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        {{-- Tombol Riwayat Pesanan --}}
                        <a href="{{ route('customer.orders.index') }}" class="btn btn-primary-custom">
                            <i class="bi bi-clock-history me-2"></i> Lihat Riwayat Pesanan
                        </a>
                    </div>

                </div>
            </div>

            {{-- Tombol Logout --}}
            <div class="text-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none fw-bold">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar dari Akun
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection