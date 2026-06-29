@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_id)

@push('styles')
<style>
    /* Override untuk memastikan styles terbaca */
    .order-card {
        background: #fff !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08) !important;
        padding: 25px !important;
        border: 1px solid #e9ecef !important;
        margin-bottom: 20px !important;
    }

    /* Product image */
    .order-item-image {
        width: 80px !important;
        height: 80px !important;
        object-fit: cover !important;
        border-radius: 8px !important;
        border: 2px solid #dee2e6 !important;
    }

    /* Payment proof image */
    .proof-image {
        width: 100% !important;
        max-width: 400px !important;
        border-radius: 8px !important;
        border: 2px solid #dee2e6 !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: block !important;
        margin: 0 auto !important;
    }

    .proof-image:hover {
        transform: scale(1.02) !important;
        border-color: var(--primary-blue) !important;
        box-shadow: 0 4px 20px rgba(39, 84, 138, 0.2) !important;
    }

    /* Detail box styling */
    .rincian-box {
        background-color: #f8f9fa !important;
        border-radius: 8px !important;
        padding: 15px !important;
        margin-top: 12px !important;
        border: 1px solid #e0e0e0 !important;
    }

    .rincian-row {
        display: flex !important;
        justify-content: space-between !important;
        font-size: 0.9rem !important;
        margin-bottom: 8px !important;
        color: #495057 !important;
        align-items: center !important;
    }

    .rincian-row:last-child {
        margin-bottom: 0 !important;
    }

    .rincian-row strong {
        color: #212529 !important;
        font-weight: 600 !important;
    }

    /* Status badge custom */
    .status-badge {
        padding: 8px 16px !important;
        border-radius: 20px !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        display: inline-block !important;
    }

    /* Button improvements */
    .btn-action {
        padding: 12px 20px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        transition: all 0.3s ease !important;
    }

    .btn-action:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    /* Card headers */
    .card-header-custom {
        border-bottom: 2px solid #e9ecef !important;
        padding-bottom: 12px !important;
        margin-bottom: 20px !important;
    }

    /* Item border */
    .item-border {
        border-bottom: 1px solid #e9ecef !important;
        padding-bottom: 15px !important;
        margin-bottom: 15px !important;
    }

    .item-border:last-child {
        border-bottom: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }

    /* Price highlight */
    .price-highlight {
        font-size: 1.1rem !important;
        color: var(--primary-blue) !important;
        font-weight: 700 !important;
    }

    /* Quantity badge */
    .qty-badge {
        background-color: #e7f3ff !important;
        color: var(--primary-blue) !important;
        padding: 4px 12px !important;
        border-radius: 12px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
    }

    /* Custom CSS untuk tombol Lihat Desain */
    .btn-action-small {
        padding: 3px 8px !important;
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        border-radius: 6px !important;
    }
</style>
@endpush

@section('content')
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="bi bi-receipt text-primary me-2"></i>
                Detail Pesanan #{{ $order->order_id }}
            </h2>
            <p class="text-muted mb-0 small">
                <i class="bi bi-calendar3 me-1"></i>
                Dibuat: {{ $order->order_date->format('d M Y, H:i') }} WIB
            </p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row g-4">
        {{-- ========================================== --}}
        {{-- KOLOM KIRI: Rincian Item & Data Customer --}}
        {{-- ========================================== --}}
        <div class="col-lg-7">

            {{-- 📦 RINCIAN ITEM --}}
            <div class="order-card">
                <h5 class="fw-bold text-primary card-header-custom">
                    <i class="bi bi-box-seam me-2"></i>Rincian Item Pesanan
                </h5>

                @foreach($order->items as $item)
                <div class="d-flex item-border">
                    {{-- Product Image --}}
                    {{-- Jika ingin menampilkan gambar produk, tambahkan di sini --}}
                    {{-- <img src="{{ $item->product->image_url ?? asset('images/default.png') }}" class="order-item-image me-3" alt="Produk"> --}}

                    {{-- Product Details --}}
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">{{ $item->product->nama_produk }}</h6>

                        @php
                            // FIX: Membaca dari kolom 'specifications' yang benar
                            $details = json_decode($item->specifications, true);
                        @endphp

                        @if(is_array($details))
                            {{-- Menampilkan material sebagai deskripsi singkat --}}
                            <small class="text-muted d-block mb-2">
                                Bahan: {{ $details['material'] ?? 'N/A' }}
                            </small>

                            {{-- BOX RINCIAN HARGA --}}
                            <div class="rincian-box">
                                {{-- FIX KEY: Menggunakan 'length' dan 'width' --}}
                                <div class="rincian-row">
                                    <strong><i class="bi bi-rulers me-1"></i>Ukuran:</strong>
                                    <span>{{ $details['length'] ?? 'N/A' }} x {{ $details['width'] ?? 'N/A' }} m</span>
                                </div>

                                {{-- FIX KEY: Menggunakan 'finishing' --}}
                                <div class="rincian-row">
                                    <strong><i class="bi bi-gear me-1"></i>Finishing:</strong>
                                    <span>{{ $details['finishing'] ?? 'Tidak Ada' }}</span>
                                </div>

                                <hr class="my-2 border-secondary border-opacity-25">

                                {{-- Harga per m² (diambil dari kolom 'price' item) --}}
                                <div class="rincian-row">
                                    <span>Harga per m²:</span>
                                    <span class="fw-semibold">Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                                {{-- Total Sub-Item (diambil dari kolom 'calculated_price' atau 'subtotal') --}}
                                <div class="rincian-row">
                                    <span>Total Item:</span>
                                    <span class="fw-semibold">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @else
                            <small class="text-muted d-block">Rincian kustom tidak tersedia.</small>
                        @endif

                        {{-- File Desain Customer --}}
                        @if(isset($details['design_file']))
                        @php
                            // Path file desain yang tersimpan (misalnya: designs/namafile.jpg)
                            $designFilePath = $details['design_file'];

                            // URL yang benar ke file di storage (Asumsi Storage::url sudah dikonfigurasi)
                            $designFileUrl = asset('storage/' . $designFilePath);
                        @endphp
                        <div class="mt-2 d-flex gap-2 align-items-center">
                            <small class="text-muted fw-bold">File Desain:</small>

                            {{-- TOMBOL 1: LIHAT DESAIN (Membuka di Tab Baru) --}}
                            <a href="{{ $designFileUrl }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary btn-action-small">
                                <i class="bi bi-eye me-1"></i>Lihat Desain
                            </a>

                            {{-- TOMBOL 2: DOWNLOAD FILE --}}
                            <a href="{{ $designFileUrl }}"
                                download
                                class="btn btn-sm btn-outline-info btn-action-small">
                                <i class="bi bi-download me-1"></i>Download
                            </a>
                        </div>
                        @endif
                    </div>

                    {{-- Price & Quantity --}}
                    <div class="text-end ms-3" style="min-width: 140px;">
                        <div class="price-highlight mb-2">
                            Rp {{ number_format($item->calculated_price ?? $item->subtotal, 0, ',', '.') }}
                        </div>
                        <div class="qty-badge">
                            <i class="bi bi-box"></i> Area: {{ $item->quantity }} m²
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- 👤 DETAIL CUSTOMER --}}
            <div class="order-card">
                <h5 class="fw-bold text-success card-header-custom">
                    <i class="bi bi-person-circle me-2"></i>Informasi Customer
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-person-fill text-muted me-2 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">Nama Lengkap</small>
                                <strong>{{ $order->customer->nama_lengkap ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-envelope-fill text-muted me-2 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <strong>{{ $order->customer->email ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>

                    {{-- PERBAIKAN: WHATSAPP LINK DI DETAIL CUSTOMER --}}
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-whatsapp text-success me-2 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">No. Handphone (Klik untuk WA)</small>

                                @php
                                    $phoneNumber = $order->customer->phone_number ?? '';
                                    // Membersihkan dan memformat nomor: mengubah '0' awal menjadi '62'
                                    $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
                                    if (substr($cleanNumber, 0, 1) === '0') {
                                        $whatsappNumber = '62' . substr($cleanNumber, 1);
                                    } else {
                                        $whatsappNumber = $cleanNumber;
                                    }
                                @endphp

                                @if($whatsappNumber)
                                    <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="fw-bold text-success text-decoration-none">
                                        <i class="bi bi-check-circle me-1"></i>{{ $order->customer->phone_number }}
                                    </a>
                                @else
                                    <strong>N/A</strong>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill text-muted me-2 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">Alamat Pengiriman</small>
                                <strong>{{ $order->shipping_address ?? 'Tidak Ada/Ambil Sendiri' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- KOLOM KANAN: Ringkasan & Aksi Admin --}}
        {{-- ========================================== --}}
        <div class="col-lg-5">
            <div class="order-card">

                {{-- 📊 RINGKASAN PESANAN --}}
                <h5 class="fw-bold card-header-custom">
                    <i class="bi bi-clipboard-check me-2"></i>Ringkasan Pesanan
                </h5>

                {{-- Status Badge --}}
                @php
                    $statusMapping = [
                        'Pending' => ['text' => 'Pending', 'color' => 'text-warning', 'bg' => 'bg-warning'],
                        'Awaiting Approval' => ['text' => 'Menunggu Verifikasi', 'color' => 'text-info', 'bg' => 'bg-info'],
                        'Verified' => ['text' => 'Pembayaran Diterima', 'color' => 'text-success', 'bg' => 'bg-success'],
                        'Processing' => ['text' => 'Sedang Diproduksi', 'color' => 'text-primary', 'bg' => 'bg-primary'],
                        'Ready_for_pickup' => ['text' => 'Siap Diambil', 'color' => 'text-success', 'bg' => 'bg-success'],
                        'Completed' => ['text' => 'Selesai', 'color' => 'text-secondary', 'bg' => 'bg-secondary'],
                        'Cancelled' => ['text' => 'Dibatalkan', 'color' => 'text-danger', 'bg' => 'bg-danger'],
                        'Rejected' => ['text' => 'Ditolak', 'color' => 'text-danger', 'bg' => 'bg-danger'],
                    ];
                    $currentStatus = $statusMapping[$order->status] ?? ['text' => 'UNKNOWN', 'color' => 'text-muted', 'bg' => 'bg-secondary'];
                @endphp

                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <div>
                        <small class="text-muted d-block mb-1">Status Pesanan</small>
                        <span class="badge {{ $currentStatus['bg'] }} {{ $currentStatus['color'] }} bg-opacity-25 px-3 py-2">
                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                            {{ $currentStatus['text'] }}
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">
                        <i class="bi bi-calendar3 me-1"></i>Tanggal Pesan
                    </span>
                    <strong>{{ $order->order_date->format('d M Y, H:i') }}</strong>
                </div>

                <hr class="my-3">

                {{-- 💰 RINCIAN PEMBAYARAN --}}
                @php
                    $biayaLayanan = 1000;
                    $subtotalBarang = $order->total_amount - $biayaLayanan;
                @endphp

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal Produk</span>
                    <strong>Rp {{ number_format($subtotalBarang, 0, ',', '.') }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Biaya Layanan</span>
                    <strong>Rp {{ number_format($biayaLayanan, 0, ',', '.') }}</strong>
                </div>

                <div class="p-3 bg-primary bg-opacity-10 rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Pembayaran</span>
                        <span class="h4 mb-0 text-primary fw-bold">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <hr class="my-4">

               {{-- 🧾 BUKTI PEMBAYARAN --}}
                <h5 class="fw-bold card-header-custom">
                    <i class="bi bi-receipt-cutoff me-2"></i>Bukti Pembayaran
                </h5>

                @if($order->payment_proof_url)
                    @php
                        // PATH RELATIF → buat URL penuh ke public_html
                        $fullProofUrl = url($order->payment_proof_url);
                    @endphp

                    <div class="text-center mb-3 p-2 border rounded">
                        <a href="{{ $fullProofUrl }}" target="_blank">
                            <img src="{{ $fullProofUrl }}"
                                alt="Bukti Pembayaran"
                                class="proof-image"
                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <small class="text-muted">
                            <i class="bi bi-clock-history me-1"></i>
                            Diunggah: {{ $order->updated_at->format('d M Y, H:i') }}
                        </small>

                        <a href="{{ route('admin.orders.download-payment', $order->order_id) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i>Download
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Belum Ada Bukti!</strong><br>
                            <small>Customer belum mengunggah bukti pembayaran.</small>
                        </div>
                    </div>
                @endif


                {{-- ============================================= --}}
                {{-- ⚡ AKSI VERIFIKASI PEMBAYARAN --}}
                {{-- ============================================= --}}
                @if(in_array($order->status, ['Pending', 'Awaiting Approval']))
                <div class="mt-4 pt-4 border-top">
                    <h5 class="fw-bold text-danger mb-3">
                        <i class="bi bi-shield-exclamation me-2"></i>Aksi Verifikasi
                    </h5>

                    @if($order->status == 'Awaiting Approval')
                        <div class="alert alert-danger d-flex align-items-start" role="alert">
                            <i class="bi bi-bell-fill me-2 fs-5 mt-1"></i>
                            <div>
                                <strong>ORDER BARU!</strong><br>
                                <small>Periksa bukti pembayaran di atas dan verifikasi sebelum diproses.</small>
                            </div>
                        </div>
                    @endif

                    <div class="d-grid gap-2">
                        {{-- Tombol VERIFIKASI DENGAN SWEETALERT --}}
                    <form action="{{ route('admin.orders.verify', $order->order_id) }}" method="POST" class="form-verify-order mb-1">                            @csrf
                            <button type="button" class="btn btn-success btn-action w-100 btn-verify">
                                <i class="bi bi-check-circle me-1"></i> Verifikasi Pembayaran
                            </button>
                            @if(!$order->payment_proof_url)
                                <small class="text-danger d-block mt-2 text-center">
                                    <i class="bi bi-info-circle me-1"></i>Tombol disarankan ditekan setelah bukti diunggah
                                </small>
                            @endif
                        </form>

                        {{-- Tombol TOLAK DENGAN SWEETALERT --}}
                        <form action="{{ route('admin.orders.reject', $order->order_id) }}" method="POST" class="form-reject-order">
                            @csrf
                            <input type="hidden" name="rejection_reason" value="Bukti pembayaran tidak valid atau pesanan dibatalkan oleh admin.">
                            <button type="button" class="btn btn-danger btn-action w-100 btn-reject">
                                <i class="bi bi-x-circle-fill me-2"></i>
                                Tolak Pesanan
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                {{-- ============================================= --}}
                {{-- 🔄 UPDATE STATUS PRODUKSI & AKSI WHATSAPP --}}
                {{-- ============================================= --}}
                @if(in_array($order->status, ['Verified', 'Processing', 'Ready_for_pickup']))
                <div class="mt-4 pt-4 border-top">
                    <h5 class="fw-bold text-success mb-3">
                        <i class="bi bi-arrow-repeat me-2"></i>Update Status Produksi
                    </h5>
                    <p class="small text-muted mb-3">
                        Ubah status pesanan sesuai progress produksi saat ini.
                    </p>

                    <form action="{{ route('admin.orders.update-status', $order->order_id) }}" method="POST">
                        @csrf
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="bi bi-flag-fill"></i>
                            </span>
                            <select name="status" class="form-select">
                                <option value="Verified" {{ $order->status == 'Verified' ? 'selected' : '' }}>
                                    ✅ Pembayaran Diterima
                                </option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>
                                    🔄 Sedang Diproduksi
                                </option>
                                <option value="Ready_for_pickup" {{ $order->status == 'Ready_for_pickup' ? 'selected' : '' }}>
                                    📦 Siap Diambil/Dikirim
                                </option>
                                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>
                                    ✔️ Selesai (Completed)
                                </option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2 me-1"></i>Update
                            </button>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Status saat ini: <strong>{{ $currentStatus['text'] }}</strong>
                        </small>
                    </form>

                    {{-- TOMBOL AKSI WHATSAPP KETIKA SIAP DIAMBIL --}}
                    @if($order->status == 'Ready_for_pickup')
                        @php
                            $customerName = $order->customer->nama_lengkap ?? 'Pelanggan Yth';
                            $firstName = explode(' ', $customerName)[0]; // Ambil nama depan
                            $orderId = $order->order_id;

                            // Template Pesan WhatsApp
                            $whatsappMessage = "Halo Kak $firstName,\n\nPesanan Anda #{$orderId} SUDAH SELESAI dan SIAP DIAMBIL.\n\nSilakan diambil di workshop CV Arya Advertising, atau diskusikan opsi pengiriman dengan kami.\n\nTerima kasih!";
                        @endphp

                        <div class="mt-4 border-top pt-3">
                            <h5 class="fw-bold text-warning mb-3">
                                <i class="bi bi-telephone-forward me-2"></i>Aksi Lanjutan (Siap Ambil)
                            </h5>
                            <p class="small text-muted">
                                Gunakan tombol di bawah ini untuk menginformasikan status selesai ke pelanggan.
                            </p>

                            <a href="https://wa.me/{{ $whatsappNumber ?? '' }}?text={{ urlencode($whatsappMessage) }}"
                                target="_blank"
                                class="btn btn-warning btn-action w-100 fw-bold"
                                {{ !isset($whatsappNumber) || !$whatsappNumber ? 'disabled' : '' }}>
                                <i class="bi bi-whatsapp me-2"></i> Chat WA Konfirmasi Pengambilan
                            </a>

                            @if(!isset($whatsappNumber) || !$whatsappNumber)
                            <small class="text-danger d-block mt-2 text-center">Nomor HP pelanggan tidak ditemukan untuk chat WA.</small>
                            @endif
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- TAMBAHKAN INI DI BAGIAN PALING BAWAH --}}
@push('scripts')
<!-- Panggil CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // --- 1. Pop-up Konfirmasi Verifikasi Pembayaran ---
        document.querySelectorAll('.btn-verify').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-verify-order');
                
                Swal.fire({
                    title: 'Yakin verifikasi pembayaran ini?',
                    text: "Status akan berubah menjadi VERIFIED dan pesanan akan diproses.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754', // Hijau bootstrap
                    cancelButtonColor: '#6c757d',  // Abu-abu bootstrap
                    confirmButtonText: '<i class="bi bi-check-circle me-1"></i> Ya, Verifikasi!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true, 
                    customClass: {
                        popup: 'rounded-4' // Agar sudut kartu membulat modern
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // --- 2. Pop-up Konfirmasi Tolak Pesanan ---
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-reject-order');
                
                Swal.fire({
                    title: 'Yakin TOLAK pesanan ini?',
                    text: "Status akan berubah menjadi REJECTED dan customer akan diberi tahu.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545', // Merah bootstrap
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-x-circle me-1"></i> Ya, Tolak!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    });
</script>
@endpush