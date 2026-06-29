@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@push('styles')
<style>
    .stat-card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.2s; cursor: pointer; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
    .active-card { background-color: #eef2ff !important; border: 2px solid #6366f1 !important; }
    .icon-box { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    .table-card { background: #fff; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: none; overflow: hidden; }
    .table thead th { background-color: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.6px; padding: 15px; border-bottom: 1px solid #e2e8f0; }
    .table tbody td { padding: 18px 15px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
    
    /* Pagination Spacing */
    .pagination-wrapper { padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manajemen Pesanan</h3>
            <p class="text-muted mb-0">Pantau dan kelola semua transaksi customer.</p>
        </div>
    </div>

    {{-- Statistik Widget --}}
    @php $currentStatus = request('status', 'all'); @endphp
    <div class="row g-3 mb-4">
        @foreach(['all' => ['Total Order', 'basket-fill', 'primary'], 'pending' => ['Pending', 'hourglass-split', 'warning'], 'proses' => ['Proses', 'gear-fill', 'info'], 'selesai' => ['Selesai', 'check-circle-fill', 'success']] as $key => $val)
        <div class="col-md-3">
            <a href="{{ route('admin.orders.index', ['status' => $key]) }}" class="text-decoration-none">
                <div class="card stat-card {{ $currentStatus == $key ? 'active-card' : '' }}">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-{{ $val[2] }} bg-opacity-10 text-{{ $val[2] }} me-3">
                            <i class="bi bi-{{ $val[1] }}"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase fw-bold">{{ $val[0] }}</h6>
                            <h3 class="mb-0 fw-bold text-dark">{{ $statusCounts[$key] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Tabel Pesanan --}}
    <div class="card table-card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
            <h6 class="m-0 fw-bold text-dark">Daftar Transaksi Terbaru</h6>
            <form class="d-flex gap-2" method="GET" action="{{ route('admin.orders.index') }}">
                <input type="hidden" name="status" value="{{ $currentStatus }}">
                <input type="date" name="date_filter" class="form-control form-control-sm" value="{{ request('date_filter') }}">
                <button type="submit" class="btn btn-sm btn-primary px-3">Filter</button>
                @if(request()->has('date_filter'))
                    <a href="{{ route('admin.orders.index', ['status' => $currentStatus]) }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID Order</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 fw-bold text-primary">#{{ $order->order_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                            <td>{{ $order->customer->nama_lengkap ?? 'Guest' }}</td>
                            <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td><span class="badge bg-{{ $order->status_badge }} px-3 py-2 rounded-pill">{{ $order->status }}</span></td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.orders.show', $order->order_id) }}" class="btn btn-sm btn-outline-primary rounded-pill">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-4">Tidak ada data transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Wrapper --}}
            <div class="pagination-wrapper d-flex justify-content-center">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection