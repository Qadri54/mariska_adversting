@extends('layouts.admin')

@section('title', 'Laporan Penjualan & Keuangan')

@section('content')
<div class="container-fluid px-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="bi bi-clipboard-data me-2 text-primary"></i> Laporan Penjualan
            </h2>
            <p class="text-muted mb-0">Monitor dan analisis performa penjualan Anda</p>
        </div>
    </div>

    {{-- Filter Section dengan Desain Modern --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-4">
            <form action="{{ route('admin.reports.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold text-dark mb-2">
                            <i class="bi bi-calendar-event me-1"></i> Dari Tanggal
                        </label>
                        <input type="date" name="start_date" class="form-control form-control-lg"
                               style="border-radius: 10px;"
                               value="{{ request('start_date', $summary['start_date']) }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold text-dark mb-2">
                            <i class="bi bi-calendar-check me-1"></i> Sampai Tanggal
                        </label>
                        <input type="date" name="end_date" class="form-control form-control-lg"
                               style="border-radius: 10px;"
                               value="{{ request('end_date', $summary['end_date']) }}">
                    </div>
                    <div class="col-lg-2 col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius: 10px;">
                            <i class="bi bi-funnel me-2"></i> Tampilkan
                        </button>
                    </div>
                    @if(count($orders) > 0)
                    <div class="col-lg-2 col-md-6 d-flex align-items-end">
                        {{-- Tombol Export Excel --}}
                        <a href="{{ route('admin.reports.export_excel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                           class="btn btn-success btn-lg w-100" style="border-radius: 10px;">
                            <i class="bi bi-file-earmark-spreadsheet me-2"></i> Export CSV
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6 d-flex align-items-end">
                        {{-- Tombol Export PDF --}}
                        <a href="{{ route('admin.reports.export_pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                           class="btn btn-outline-danger btn-lg w-100" style="border-radius: 10px;" target="_blank">
                            <i class="bi bi-file-pdf me-2"></i> PDF
                        </a>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Ringkasan Statistik dengan Gradient Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-6 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="text-white">
                            <div class="text-uppercase mb-2" style="font-size: 0.85rem; opacity: 0.9; font-weight: 600; letter-spacing: 1px;">
                                Total Pendapatan
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 2rem;">
                                Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}
                            </h3>
                            <p class="mb-0" style="font-size: 0.9rem; opacity: 0.8;">
                                <i class="bi bi-calendar-range me-1"></i>
                                {{ $summary['start_date'] }} - {{ $summary['end_date'] }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="bi bi-wallet2 fs-2 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="text-white">
                            <div class="text-uppercase mb-2" style="font-size: 0.85rem; opacity: 0.9; font-weight: 600; letter-spacing: 1px;">
                                Total Pesanan Selesai
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 2rem;">
                                {{ number_format($summary['total_orders'], 0) }}
                            </h3>
                            <p class="mb-0" style="font-size: 0.9rem; opacity: 0.8;">
                                <i class="bi bi-cart-check me-1"></i>
                                Pesanan berhasil diselesaikan
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="bi bi-cart-check fs-2 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Laporan Bulanan --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-calendar3 me-2"></i> Laporan Per Bulan
            </h5>
        </div>
        <div class="card-body p-4">
            @php
                // Grouping data per bulan
                $monthlyData = [];
                foreach($orders as $order) {
                    $monthYear = $order->created_at->format('Y-m');
                    $monthName = $order->created_at->format('F Y');

                    if (!isset($monthlyData[$monthYear])) {
                        $monthlyData[$monthYear] = [
                            'name' => $monthName,
                            'revenue' => 0,
                            'orders' => 0
                        ];
                    }

                    $monthlyData[$monthYear]['revenue'] += $order->total_amount;
                    $monthlyData[$monthYear]['orders'] += 1;
                }

                // Sort by month
                ksort($monthlyData);
            @endphp

            @if(count($monthlyData) > 0)
            <div class="row g-4">
                @foreach($monthlyData as $data)
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 4px solid #667eea;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="fw-bold text-primary mb-0">{{ $data['name'] }}</h6>
                                </div>
                                <i class="bi bi-calendar-month text-primary opacity-50"></i>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Pendapatan</small>
                                <h5 class="fw-bold text-success mb-0">
                                    Rp {{ number_format($data['revenue'], 0, ',', '.') }}
                                </h5>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <small class="text-muted">Total Pesanan</small>
                                <span class="badge bg-primary rounded-pill">{{ $data['orders'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Summary Card --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-light border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                                        <i class="bi bi-graph-up-arrow fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Rata-rata Per Bulan</small>
                                        <h6 class="fw-bold mb-0 text-dark">
                                            Rp {{ number_format($summary['total_revenue'] / max(count($monthlyData), 1), 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-start border-end">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded p-3 me-3">
                                        <i class="bi bi-cart3 fs-4 text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Pesanan Per Bulan</small>
                                        <h6 class="fw-bold mb-0 text-dark">
                                            {{ number_format($summary['total_orders'] / max(count($monthlyData), 1), 1) }} Pesanan
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded p-3 me-3">
                                        <i class="bi bi-calculator fs-4 text-warning"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Rata-rata Nilai Pesanan</small>
                                        <h6 class="fw-bold mb-0 text-dark">
                                            Rp {{ number_format($summary['total_revenue'] / max($summary['total_orders'], 1), 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x fs-1 text-muted opacity-50 d-block mb-3"></i>
                <h6 class="text-muted">Tidak ada data bulanan</h6>
            </div>
            @endif
        </div>
    </div>

    {{-- Tabel Detail Transaksi dengan Desain Modern --}}
    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-list-ul me-2"></i> Detail Transaksi
                </h5>
                <span class="badge bg-white text-primary">
                    {{ $summary['start_date'] }} s/d {{ $summary['end_date'] }}
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                    <thead style="background-color: #f8f9fc;">
                        <tr>
                            <th class="py-3 px-4 fw-semibold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                ID Pesanan
                            </th>
                            <th class="py-3 px-4 fw-semibold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Tanggal & Waktu
                            </th>
                            <th class="py-3 px-4 fw-semibold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Customer
                            </th>
                            <th class="py-3 px-4 fw-semibold text-muted text-uppercase text-end" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Total Bayar
                            </th>
                            <th class="py-3 px-4 fw-semibold text-muted text-uppercase text-center" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td class="px-4 py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2" style="border-radius: 8px;">
                                    #{{ $order->order_id }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 text-muted me-2"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $order->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $order->customer->nama_lengkap ?? 'Guest' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <span class="fw-bold text-success" style="font-size: 1.05rem;">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $statusConfig = [
                                        'Completed' => ['class' => 'success', 'icon' => 'check-circle', 'text' => 'Selesai'],
                                        'Ready_for_pickup' => ['class' => 'success', 'icon' => 'bag-check', 'text' => 'Siap Diambil'],
                                        'Verified' => ['class' => 'info', 'icon' => 'shield-check', 'text' => 'Terverifikasi'],
                                        'Processing' => ['class' => 'info', 'icon' => 'arrow-repeat', 'text' => 'Diproses'],
                                        'Pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'Pending'],
                                        'Awaiting Approval' => ['class' => 'warning', 'icon' => 'hourglass-split', 'text' => 'Menunggu'],
                                    ];
                                    $status = $statusConfig[$order->status] ?? ['class' => 'secondary', 'icon' => 'question-circle', 'text' => $order->status];
                                @endphp
                                <span class="badge bg-{{ $status['class'] }} bg-opacity-10 text-{{ $status['class'] }} fw-semibold px-3 py-2"
                                      style="border-radius: 8px; font-size: 0.85rem;">
                                    <i class="bi bi-{{ $status['icon'] }} me-1"></i>
                                    {{ $status['text'] }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                    <h5 class="fw-semibold">Tidak Ada Data</h5>
                                    <p class="mb-0">Belum ada transaksi pada periode ini</p>
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

<style>
    .form-control:focus, .btn:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .badge {
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .btn {
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .alert {
        border: none !important;
    }
</style>
@endsection
