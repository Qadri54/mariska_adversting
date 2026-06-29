@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')

@push('styles')
<style>
    :root { 
        --primary: #91C8E4; 
        --primary-dark: #4682A9; 
        --accent: #27548A; 
    }
    .page-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%);
        padding: 30px;
        border-radius: 15px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(39, 84, 138, 0.2);
    }
    .card-table {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: none;
        overflow: hidden;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .avatar-circle {
        width: 40px;
        height: 40px;
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    
    {{-- Header Halaman --}}
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-1 fw-bold">Daftar Pelanggan</h3>
            <p class="mb-0 opacity-75">Kelola data pelanggan yang terdaftar di sistem.</p>
        </div>
        <div>
            <span class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm fs-6">
                Total: {{ $customers->count() }} Pelanggan
            </span>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="card card-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Pelanggan</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    {{-- Inisial Nama --}}
                                    <div class="avatar-circle me-3 shadow-sm">
                                        {{ strtoupper(substr($customer->nama_lengkap ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $customer->nama_lengkap ?? 'Tanpa Nama' }}</div>
                                        <div class="small text-muted">ID: #{{ $customer->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="bi bi-envelope text-muted me-2"></i> {{ $customer->email ?? '-' }}</div>
                                <div class="mt-1"><i class="bi bi-telephone text-muted me-2"></i> {{ $customer->no_telepon ?? '-' }}</div>
                            </td>
                            <td>
                                {{-- Memotong alamat jika terlalu panjang --}}
                                <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                    {{ $customer->alamat ?? 'Belum ada data alamat' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-calendar-check me-1"></i> 
                                    {{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d F Y') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                    Belum ada data pelanggan yang terdaftar.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection