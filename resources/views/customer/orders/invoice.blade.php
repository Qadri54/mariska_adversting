@extends('layouts.app')

@section('title', 'Invoice #' . $order->order_number . ' — Arya Advertising')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- NOTIFIKASI SUKSES --}}
            @if(session('success'))
                <div class="alert alert-success text-center mb-4">
                    <i class="bi bi-check-circle-fill fs-4 d-block mb-2"></i>
                    <strong>{{ session('success') }}</strong><br>
                    Mohon segera selesaikan pembayaran agar pesanan diproses.
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER TAGIHAN --}}
                <div class="card-header text-white p-4 text-center" style="background: #ff6b35 !important;">
                    <h5 class="mb-0 opacity-75">TOTAL TAGIHAN</h5>
                    <h1 class="fw-bold display-4 my-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h1>

                    {{-- Status Badge --}}
                    @php
                        $badgeColor = match($order->status) {
                            'pending' => 'bg-warning text-dark',
                            'verified' => 'bg-info text-white',
                            'processing' => 'bg-primary',
                            'ready_for_pickup' => 'bg-success',
                            'completed' => 'bg-secondary',
                            'rejected' => 'bg-danger',
                            default => 'bg-secondary'
                        };

                        $statusText = match($order->status) {
                            'pending' => 'MENUNGGU PEMBAYARAN',
                            'verified' => 'PEMBAYARAN DITERIMA',
                            'processing' => 'SEDANG DIPRODUKSI',
                            'ready_for_pickup' => 'SIAP DIAMBIL / DIKIRIM',
                            'completed' => 'SELESAI',
                            'rejected' => 'PEMBAYARAN DITOLAK',
                            default => 'UNKNOWN'
                        };
                    @endphp
                    <span class="badge {{ $badgeColor }} px-3 py-2 rounded-pill border border-white">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="card-body p-5">

                    {{-- KONDISI 1: JIKA SUDAH VERIFIED (TAMPILKAN PESAN) --}}
                    @if($order->status != 'pending')
                        <div class="text-center py-4">
                            <i class="bi bi-hourglass-split text-primary" style="font-size: 3rem;"></i>
                            <h4 class="fw-bold mt-3">Terima Kasih!</h4>
                            <p class="text-muted">Pembayaran Anda telah diterima.<br>Pesanan sedang kami proses, silakan tunggu update via WhatsApp.</p>
                        </div>

                    {{-- KONDISI 2: JIKA PENDING (TAMPILKAN REKENING & UPLOAD) --}}
                    @else
                        <div class="text-center mb-4">
                            <p class="text-muted fw-bold mb-3">PILIH METODE PEMBAYARAN</p>

                            {{-- TAB TRANSFER / QRIS --}}
                            <ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active border rounded-pill px-4 me-2" id="pills-transfer-tab" data-bs-toggle="pill" data-bs-target="#pills-transfer" type="button">Transfer Bank</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border rounded-pill px-4" id="pills-qris-tab" data-bs-toggle="pill" data-bs-target="#pills-qris" type="button">Scan QRIS</button>
                                </li>
                            </ul>

                            <div class="tab-content border p-4 rounded-3 bg-light mb-4" id="pills-tabContent">

                                {{-- KONTEN TRANSFER --}}
                                <div class="tab-pane fade show active" id="pills-transfer">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" width="80" alt="BCA">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold text-dark">123-456-7890</h5>
                                            <small class="text-muted">a.n Arya Advertising</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-secondary" onclick="navigator.clipboard.writeText('1234567890'); alert('No Rekening Disalin!')"><i class="bi bi-files"></i> Salin</button>
                                    </div>
                                </div>

                                {{-- KONTEN QRIS --}}
                                <div class="tab-pane fade" id="pills-qris">
                                    <div class="text-center">
                                        {{-- Memanggil gambar QRIS asli dari folder public/images --}}
                                        <img src="{{ asset('images/qris-arya.jpeg') }}" width="250" alt="QRIS Arya Advertising" class="border p-2 bg-white rounded shadow-sm">
                                        
                                        {{-- Menyesuaikan teks dengan yang ada di gambar QRIS asli --}}
                                        <p class="mt-3 mb-0 fw-bold fs-5">ARYA ADVERTISING -QR</p>
                                        <small class="text-muted fw-bold">ID2025465649536</small>
                                    </div>
                                </div>

                        <hr>

                        {{-- FORM UPLOAD BUKTI BAYAR --}}
                        <div class="card border-primary border-2 border-dashed bg-light p-4 mb-4">
                            <h5 class="fw-bold text-center mb-3"><i class="bi bi-upload me-2"></i> Upload Bukti Pembayaran</h5>

                            <form action="{{ route('customer.orders.upload-payment', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" name="payment_proof" class="form-control" accept="image/*,application/pdf" required>
                                    <div class="form-text">Format: JPG, PNG, PDF. Maksimal 5MB.</div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" style="background: #ff6b35; border: none;">
                                    KIRIM BUKTI BAYAR
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- DETAIL ORDER (Accordion) --}}
                    <div class="accordion accordion-flush border rounded-3 mb-4" id="accordionDetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                    <i class="bi bi-cart3 me-2"></i> Lihat Rincian Pesanan
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionDetails">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach($order->items as $item)
                                            @php
                                                $specs = json_decode($item->specifications, true);
                                            @endphp
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $item->product_name }}</h6>
                                                    <small class="text-muted">
                                                        {{ $item->quantity }} m² x Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </small>
                                                    <br>
                                                    <small class="text-muted fst-italic" style="font-size: 0.8rem;">
                                                        @if($specs)
                                                            {{ $specs['length'] ?? '-' }} x {{ $specs['width'] ?? '-' }} m |
                                                            {{ $specs['material'] ?? '-' }}
                                                            @if($specs['finishing'] ?? null)
                                                                | Finishing: {{ $specs['finishing'] }}
                                                            @endif
                                                        @endif
                                                    </small>
                                                </div>
                                                <span class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KONDISI: BARANG SIAP DIAMBIL --}}
                    @if($order->status == 'ready_for_pickup')
                        <div class="text-center py-4 bg-success bg-opacity-10 rounded-4 mb-4 border border-success">
                            <i class="bi bi-box-seam-fill text-success" style="font-size: 3.5rem;"></i>
                            <h4 class="fw-bold mt-3 text-success">Hore! Pesanan Selesai</h4>
                            <p class="text-muted mb-3">Pesanan Anda sudah selesai diproduksi.<br>Silakan cek WhatsApp, Admin kami akan menghubungi Anda untuk pengambilan/pengiriman.</p>

                            <a href="https://wa.me/6282160762279" class="btn btn-success fw-bold px-4 rounded-pill">
                                <i class="bi bi-whatsapp me-1"></i> Chat Admin
                            </a>
                        </div>
                    @endif

                    {{-- INFO PENGIRIMAN --}}
                    <div class="bg-light p-4 rounded-3 mb-4 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-truck me-2"></i> Informasi Pengambilan / Pengiriman</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Pemesan</small>
                                <p class="fw-bold mb-0 text-dark">{{ $order->receiver_name }}</p>
                                <p class="mb-0 text-success"><i class="bi bi-whatsapp"></i> {{ $order->receiver_phone }}</p>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">No. Pesanan</small>
                                <p class="mb-0 fw-bold">{{ $order->order_number }}</p>
                                <p class="mb-0 text-muted">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://wa.me/6282160762279" target="_blank" class="text-decoration-none text-success fw-bold">
                            <i class="bi bi-whatsapp"></i> Butuh Bantuan? Chat Admin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
