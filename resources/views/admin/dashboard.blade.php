@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    :root { --primary: #91C8E4; --primary-dark: #4682A9; --accent: #27548A; --light-bg: #f8f9fa; }
    .dashboard-header { background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%); padding: 40px 30px; border-radius: 15px; color: white; margin-bottom: 30px; }
    
    /* Kartu Statistik */
    .stat-card { background: #fff; border-radius: 15px; padding: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s; display: block; text-decoration: none; position: relative; overflow: hidden; border-left: 5px solid; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    .stat-value { font-size: 1.6rem; font-weight: 800; color: #333; margin-bottom: 2px; }
    .stat-label { font-size: 0.8rem; color: #6c757d; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    
    /* Tabel & Badge */
    .table-card { background: #fff; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 25px; }
    .badge-status { padding: 5px 12px; border-radius: 50px; font-size: 0.70rem; font-weight: 700; text-transform: uppercase; }
    .bg-pending { background-color: #fff3cd; color: #856404; }
    .bg-processing { background-color: #cff4fc; color: #055160; }
    .bg-completed { background-color: #d1e7dd; color: #0f5132; }
    .bg-default { background-color: #e2e3e5; color: #383d41; }
</style>
@endpush

@section('content')
<div class="dashboard-header">
    <h2>Dashboard Admin</h2>
    <p class="mb-0">Selamat datang kembali, {{ Auth::user()->nama_lengkap ?? 'Admin' }}!</p>
</div>

{{-- KARTU STATISTIK --}}
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <a href="{{ route('admin.orders.index', ['status' => 'selesai', 'month' => now()->month, 'year' => now()->year]) }}" class="stat-card border-info">
            <div class="stat-value text-info">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Pendapatan Bulan Ini</div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="stat-card border-primary">
            <div class="stat-value text-primary">{{ $totalOrders ?? 0 }}</div>
            <div class="stat-label">Total Pesanan</div>
        </a>
    </div>
    {{-- RUTE DIPERBAIKI: Menggunakan 'proses' agar sinkron dengan controller --}}
    <div class="col-md-3">
        <a href="{{ route('admin.orders.index', ['status' => 'proses']) }}" class="stat-card border-warning">
            <div class="stat-value text-warning">{{ $ordersNeedingAttention ?? 0 }}</div>
            <div class="stat-label">Perlu Diproses</div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.customers.index') }}" class="stat-card border-success">
            <div class="stat-value text-success">{{ $totalCustomers ?? 0 }}</div>
            <div class="stat-label">Total Pelanggan</div>
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Tabel Pesanan Terbaru --}}
    <div class="col-lg-8">
        <div class="table-card h-100">
            <h5 class="mb-4">Pesanan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr><th>ID</th><th>Customer</th><th>Tanggal</th><th>Total</th><th>Status</th><th class="text-center">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td class="fw-bold text-muted">#{{ $order->order_id ?? $order->id }}</td>
                            <td>{{ $order->customer->nama_lengkap ?? 'Guest' }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                            <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = 'bg-default';
                                    if (in_array($order->status, ['Pending', 'Awaiting Approval'])) $statusClass = 'bg-pending';
                                    elseif (in_array($order->status, ['Processing', 'Verified', 'Ready_for_pickup'])) $statusClass = 'bg-processing';
                                    elseif ($order->status == 'Completed') $statusClass = 'bg-completed';
                                @endphp
                                <span class="badge-status {{ $statusClass }}">
                                    {{ str_replace('_', ' ', $order->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order->id ?? $order->order_id) }}" class="btn btn-sm btn-outline-secondary rounded-circle">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="col-lg-4">
        <div class="table-card h-100">
            <h5 class="mb-4"><i class="bi bi-activity me-2"></i> Aktivitas Terbaru</h5>
            <ul class="list-unstyled">
                @foreach($recentActivities as $activity)
                    <li class="mb-3 pb-2 border-bottom border-light">
                        <div class="fw-bold text-dark">{{ $activity['description'] }}</div>
                        <small class="text-muted">{{ $activity['time'] }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection