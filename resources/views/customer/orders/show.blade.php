@extends('layouts.app')

@section('title', 'Invoice #' . $order->order_number . ' — Arya Advertising')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- NOTIFIKASI SUKSES (Tampil dari OrderController@store) --}}
            @if(session('success'))
                <div class="alert alert-success text-center mb-4 rounded-4 shadow-sm">
                    <i class="bi bi-check-circle-fill fs-4 d-block mb-2"></i>
                    <strong>{{ session('success') }}</strong><br>
                    Mohon segera selesaikan pembayaran agar pesanan diproses.
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER TAGIHAN --}}
                <div class="card-header text-white p-4 text-center border-0" style="background: #ff6b35 !important;">
                    <h5 class="mb-0 opacity-75" style="font-size: 0.9rem; letter-spacing: 1px;">TOTAL TAGIHAN</h5>
                    <h1 class="fw-bold display-4 my-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h1>

                    {{-- Status Badge --}}
                    @php
                        $currentStatus = $order->status;

                        $badgeColor = match($currentStatus) {
                            'Pending' => 'bg-warning text-dark',
                            'Awaiting Approval' => 'bg-info text-white',
                            'Verified' => 'bg-info text-white',
                            'Processing' => 'bg-primary',
                            'Ready_for_pickup' => 'bg-success',
                            'Completed' => 'bg-secondary',
                            'Rejected' => 'bg-danger',
                            default => 'bg-secondary'
                        };

                        $statusText = match($currentStatus) {
                            'Pending' => 'MENUNGGU PEMBAYARAN',
                            'Awaiting Approval' => 'MENUNGGU VERIFIKASI ADMIN',
                            'Verified' => 'PEMBAYARAN DITERIMA',
                            'Processing' => 'SEDANG DIPRODUKSI',
                            'Ready_for_pickup' => 'SIAP DIAMBIL / DIKIRIM',
                            'Completed' => 'SELESAI',
                            'Rejected' => 'PEMBAYARAN DITOLAK',
                            default => 'UNKNOWN'
                        };
                    @endphp
                    <span class="badge {{ $badgeColor }} px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="card-body p-4 p-md-5">

                    {{-- KONDISI 1: JIKA SUDAH BAYAR --}}
                    @if($order->status !== 'Pending')
                        <div class="text-center py-4 mb-4">
                            @if($order->status == 'Awaiting Approval')
                                <i class="bi bi-clock-history text-warning" style="font-size: 3.5rem;"></i>
                                <h4 class="fw-bold mt-3">Bukti Pembayaran Diterima!</h4>
                                <p class="text-muted">Bukti pembayaran Anda sedang kami periksa.<br>Mohon menunggu verifikasi Admin.</p>

                            @elseif($order->status == 'Verified')
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
                                <h4 class="fw-bold mt-3">Pembayaran Terverifikasi!</h4>
                                <p class="text-muted">Pembayaran Anda telah diterima.<br>Pesanan sedang kami proses, silakan tunggu update via WhatsApp.</p>
                            @else
                                <i class="bi bi-hourglass-split text-primary" style="font-size: 3.5rem;"></i>
                                <h4 class="fw-bold mt-3">Terima Kasih!</h4>
                                <p class="text-muted">Status pesanan Anda: <strong>{{ $statusText }}</strong>.<br>Silakan tunggu update dari Admin kami.</p>
                            @endif
                        </div>

                    {{-- KONDISI 2: JIKA PENDING (TAMPILKAN REKENING & UPLOAD) --}}
                    @else
                        <div class="mb-4">
                            <p class="text-muted fw-bold mb-3 text-center" style="font-size: 0.9rem;">PILIH METODE PEMBAYARAN</p>

                            {{-- TAB TRANSFER / QRIS --}}
                            <ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active border rounded-pill px-4 me-2 fw-bold" id="pills-transfer-tab" data-bs-toggle="pill" data-bs-target="#pills-transfer" type="button">Transfer Bank</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border rounded-pill px-4 fw-bold" id="pills-qris-tab" data-bs-toggle="pill" data-bs-target="#pills-qris" type="button">Scan QRIS</button>
                                </li>
                            </ul>

                            <div class="tab-content border p-4 rounded-4 mb-4 shadow-sm" id="pills-tabContent">

                                {{-- KONTEN TRANSFER --}}
                                <div class="tab-pane fade show active" id="pills-transfer">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" width="80" alt="BCA">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold text-dark">8 4 3 0 - 1 5 2 - 5 7 3</h5>
                                            <small class="text-muted">CV.ARYA ADVERTISING</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill ms-2" onclick="navigator.clipboard.writeText('8430152573'); alert('No Rekening Disalin!')">
                                            <i class="bi bi-files"></i> Salin
                                        </button>
                                    </div>
                                </div>

                                {{-- KONTEN QRIS --}}
                                <div class="tab-pane fade" id="pills-qris">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="me-4">
                                            <img src="{{ asset('images/qris-arya.jpeg') }}" 
                                                 width="200" 
                                                 alt="QRIS Arya Advertising" 
                                                 class="img-fluid border p-2 rounded-3 shadow-sm">
                                        </div>
                                        <div class="text-start">
                                            <p class="fw-bold mb-1 fs-5 text-dark">Silakan Scan QRIS</p>
                                            <p class="text-muted small mb-0">Pembayaran akan otomatis masuk<br>ke sistem kami.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25 my-4">

                            {{-- FORM UPLOAD BUKTI BAYAR --}}
                            <div class="card border-primary border-2 border-dashed bg-light p-4 rounded-4 mb-4">
                                <h5 class="fw-bold text-center mb-3"><i class="bi bi-upload me-2"></i> Upload Bukti Pembayaran</h5>

                                <form action="{{ route('customer.orders.upload-payment', $order->order_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="file" name="payment_proof" class="form-control form-control-lg @error('payment_proof') is-invalid @enderror" accept="image/*,application/pdf" required>
                                        <div class="form-text mt-2 text-center">Format: JPG, PNG, PDF. Maksimal 5MB.</div>
                                        @error('payment_proof')
                                            <div class="invalid-feedback text-center">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm" style="background: #ff6b35; border: none; letter-spacing: 1px;">
                                        KIRIM BUKTI BAYAR
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif


                    {{-- DETAIL ORDER (Accordion) --}}
                    <div class="accordion border rounded-4 mb-4 overflow-hidden" id="accordionDetails">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" style="box-shadow: none;">
                                    <i class="bi bi-cart3 me-2 fs-5"></i> Lihat Rincian Pesanan
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionDetails">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush">
                                        @foreach($order->items as $item)
                                            @php
                                                $specs = json_decode($item->specifications, true);
                                            @endphp
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-4 border-top">
                                                <div>
                                                    <h6 class="mb-1 fw-bold text-dark">{{ $item->product_name }}</h6>
                                                    <div class="text-muted mb-1" style="font-size: 0.95rem;">
                                                        {{ $item->quantity }} m² x Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </div>
                                                    <div class="text-muted fst-italic" style="font-size: 0.85rem;">
                                                        @if($specs)
                                                            {{ $specs['length'] ?? '-' }} x {{ $specs['width'] ?? '-' }} m / {{ $specs['material'] ?? '-' }}
                                                            @if($specs['finishing'] ?? null)
                                                                / Finishing: {{ $specs['finishing'] }}
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="fw-bold fs-5 text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KONDISI: BARANG SIAP DIAMBIL --}}
                    @if($order->status == 'Ready_for_pickup')
                        <div class="text-center py-4 bg-success bg-opacity-10 rounded-4 mb-4 border border-success border-opacity-50">
                            <i class="bi bi-box-seam-fill text-success" style="font-size: 3.5rem;"></i>
                            <h4 class="fw-bold mt-3 text-success">Hore! Pesanan Selesai</h4>
                            <p class="text-muted mb-3">Pesanan Anda sudah selesai diproduksi.<br>Silakan cek WhatsApp, Admin kami akan menghubungi Anda untuk pengambilan/pengiriman.</p>

                            <a href="https://wa.me/6282160762279" class="btn btn-success fw-bold px-4 rounded-pill shadow-sm">
                                <i class="bi bi-whatsapp me-1"></i> Chat Admin
                            </a>
                        </div>
                    @endif

                    {{-- INFO PENGIRIMAN --}}
                    <div class="border p-4 rounded-4 mb-4">
                        <h6 class="fw-bold mb-4 text-dark text-center">
                            <i class="bi bi-truck me-2"></i> Informasi Pengambilan / Pengiriman
                        </h6>

                        <div class="row text-center">
                            <div class="col-md-6 mb-4 mb-md-0 border-end-md">
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Pemesan</small>
                                <p class="fw-bold mb-1 mt-1 text-dark fs-5">{{ $order->receiver_name }}</p>
                                
                                {{-- WA PENGALIR: Otomatis mengubah angka 0 di depan nomor telepon menjadi kode negara 62 saat diklik --}}
                                @php
                                    $formattedPhone = $order->receiver_phone;
                                    // Menghilangkan karakter non-angka
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $formattedPhone);
                                    // Jika diawali angka 0, ubah menjadi 62
                                    if (strpos($cleanPhone, '0') === 0) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                @endphp
                                <p class="mb-0">
                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="text-success fw-bold text-decoration-none">
                                        <i class="bi bi-whatsapp me-1"></i> {{ $order->receiver_phone }}
                                    </a>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">No. Pesanan</small>
                                <p class="fw-bold mb-1 mt-1 text-dark fs-5">{{ $order->order_number }}</p>
                                <p class="mb-0 text-muted">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- BUTUH BANTUAN --}}
                    <div class="text-center mt-2">
                        <a href="https://wa.me/6282160762279" target="_blank" class="text-decoration-none text-success fw-bold fs-6">
                            <i class="bi bi-whatsapp me-1"></i> Butuh Bantuan? Chat Admin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #dee2e6 !important;
        }
    }
</style>
@endsection