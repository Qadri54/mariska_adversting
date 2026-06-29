{{-- File: resources/views/customer/orders/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya')

@push('styles')
<style>
    /* Header Gradient (Konsisten dengan Invoice) */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 100px 0 60px;
        position: relative;
        overflow: hidden;
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        border-radius: 0 0 30px 30px;
    }
    .page-header h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; }

    /* Kartu Order */
    .order-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 20px;
        border: 1px solid #f0f0f0;
        transition: transform 0.2s;
    }
    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Item Image */
    .order-item-image {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .btn-detail {
        background-color: var(--accent);
        color: white;
        border-radius: 8px;
        padding: 8px 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-detail:hover {
        background-color: var(--primary-dark);
        color: white;
    }
</style>
@endpush

@section('content')

    <header class="page-header">
        <div class="container">
            <h1>Riwayat Pesanan</h1>
            <p class="opacity-75">Pantau status dan detail pesanan Anda di sini</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">

                    @if($orders->isEmpty())
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-3"></i>
                            <h4 class="text-muted">Belum ada pesanan</h4>
                            <p class="mb-4">Yuk mulai belanja kebutuhan promosi Anda sekarang!</p>
                            <a href="{{ route('produk.layanan') }}" class="btn btn-primary-custom px-4 py-2">Mulai Belanja</a>
                        </div>
                    @else
                        @foreach($orders as $order)
                            <div class="order-card">
                                {{-- Header Order (ID & Status) --}}
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-1">Order #{{ $order->order_id }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i> {{ $order->order_date->format('d M Y, H:i') }}
                                        </small>
                                    </div>

                                    <div>
                                        @php
                                    // Cek apakah ada bukti pembayaran yang diunggah
                                    $hasUploadedProof = !empty($order->payment_proof_url);

                                    // Logika Status yang Sederhana untuk Riwayat Customer
                                    $statusText = match($order->status) {
                                        'Awaiting Approval' => 'Menunggu Verifikasi Admin', // Status saat bukti sudah diupload
                                        'Verified' => 'Pembayaran Diterima',             // Status saat Admin sudah verifikasi
                                        'Processing' => 'Sedang Diproses',
                                        'Ready_for_pickup' => 'Siap Diambil/Kirim',       // Status baru
                                        'Completed' => 'Selesai',
                                        'Rejected' => 'Ditolak',
                                        'Cancelled' => 'Dibatalkan',
                                        default => 'Menunggu Pembayaran' // Status default jika benar-benar Pending dan belum ada aksi
                                    };

                                    // Logika Warna (Tergantung status yang sebenarnya dari DB)
                                    $statusBg = match($order->status) {
                                        'Awaiting Approval' => 'bg-info text-white',
                                        'Verified' => 'bg-success text-white',
                                        'Processing' => 'bg-primary text-white',
                                        'Ready_for_pickup' => 'bg-success text-white',
                                        'Completed' => 'bg-secondary text-white',
                                        'Rejected', 'Cancelled' => 'bg-danger text-white',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="status-badge {{ $statusBg }}">{{ $statusText }}</span>
                                    </div>
                                </div>

                                {{-- List Item (Max 2 item ditampilkan) --}}
                                @foreach($order->items->take(2) as $item)
                                    <div class="d-flex gap-3 mb-3">
                                        <img src="{{ $item->product->image_url ?? asset('images/default-product.png') }}"
                                            alt="{{ $item->product->nama_produk }}"
                                            class="order-item-image"
                                            onerror="this.src='{{ asset('images/default-product.png') }}'">

                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold text-dark">{{ $item->product->nama_produk }}</h6>

                                            {{-- Tampilkan Detail Custom (Ukuran/Bahan) --}}
                                            @php
                                                $details = json_decode($item->custom_details, true);
                                                // Asumsi harga satuan = total item / quantity (atau 1)
                                                $unitPrice = $item->calculated_price / ($item->quantity ?: 1);
                                            @endphp

                                            {{-- GABUNGKAN RINCIAN DI SINI --}}
                                            <small class="text-muted d-block">
                                                @if(isset($details['deskripsi_lengkap']))
                                                    {{ $details['deskripsi_lengkap'] }}
                                                @else
                                                    @if(isset($details['ukuran'])) {{ $details['ukuran'] ?? '' }} @endif
                                                    @if(isset($details['bahan'])) | {{ $details['bahan'] ?? '' }} @endif
                                                @endif
                                            </small>

                                            {{-- TAMPILAN HARGA SATUAN DAN JUMLAH --}}
                                            <div class="small text-dark fw-semibold mt-1">
                                                {{ $item->quantity }} pcs x Rp {{ number_format($unitPrice, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        {{-- Harga Total Item --}}
                                        <div class="fw-bold text-end align-self-center">
                                            Rp {{ number_format($item->calculated_price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach

                                @if($order->items->count() > 2)
                                    <div class="text-center mb-3">
                                        <small class="text-muted">+ {{ $order->items->count() - 2 }} produk lainnya</small>
                                    </div>
                                @endif

                                <hr class="my-3">

                                {{-- Footer Order (Total & Aksi) --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">Total Tagihan</small>
                                        <h5 class="fw-bold text-accent mb-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
                                    </div>

                                    <div class="d-flex gap-2">
                                        {{-- Tombol Batalkan (Hanya jika Pending & Belum Upload Bukti) --}}
                                        @if($order->status == 'Pending' && !$hasUploadedProof)
                                            <form action="{{ route('customer.orders.cancel', $order->order_id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 py-2">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Tombol "Bayar Sekarang" atau "Lihat Detail" --}}
                                        @php
                                            $showBayarSekarang = $order->status == 'Pending' && !$hasUploadedProof;
                                        @endphp
                                        <a href="{{ route('customer.orders.show', $order->order_id) }}"
                                           class="btn-detail"
                                           style="background-color: {{ $showBayarSekarang ? '#ff6b35' : 'var(--accent)' }};">

                                            @if($showBayarSekarang)
                                                Bayar Sekarang
                                            @else
                                                Lihat Detail
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Link untuk pagination --}}
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
