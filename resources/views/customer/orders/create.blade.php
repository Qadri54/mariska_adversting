@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan — Arya Advertising')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Konfirmasi Pesanan</h2>
        <p class="text-muted">Periksa kembali pesanan Anda sebelum melanjutkan.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- CARD RINGKASAN PESANAN --}}
            <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-light p-4">
                    <h5 class="fw-bold m-0 text-dark"><i class="bi bi-cart-check me-2"></i> Rincian Item</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @php $total = 0; @endphp
                        @forelse($cart as $item)
                            @php $total += $item['subtotal']; @endphp
                            <li class="list-group-item p-4 d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-start gap-3 flex-grow-1">
                                    {{-- Gambar Design File --}}
                                    <div style="width: 70px; height: 70px; background: #f0f0f0; border-radius: 10px; overflow: hidden; flex-shrink: 0;">
                                        @if(!empty($item['design_file']))
                                            <img src="{{ asset('storage/' . $item['design_file']) }}" style="width:100%; height:100%; object-fit:cover;" alt="{{ $item['product_name'] }}">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Info Produk --}}
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2">{{ $item['product_name'] }}</h6>
                                        <div class="text-muted small mb-2">
                                            <span class="badge bg-secondary">{{ $item['area'] }} m²</span>
                                            <span class="badge bg-secondary">{{ $item['length'] }} x {{ $item['width'] }} m</span>
                                            <span class="badge bg-secondary">{{ $item['material'] ?? '-' }}</span>
                                        </div>
                                        @if(!empty($item['finishing']))
                                            <div class="text-success small fst-italic">
                                                <i class="bi bi-check-circle me-1"></i>Finishing: {{ $item['finishing'] }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Harga --}}
                                <div class="text-end ms-3">
                                    <span class="fw-bold text-dark">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-5 text-muted">
                                <i class="bi bi-inbox"></i> Keranjang kosong
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted fs-5">Total Tagihan</span>
                        <span class="fw-bold fs-3 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- FORM DATA PEMESAN (Simpel) --}}
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-person-check me-2"></i>Data Pemesan</h5>
                <p class="text-muted small mb-4">
                    <i class="bi bi-info-circle me-1"></i>
                    Pengiriman dan jadwal produksi dapat didiskusikan dengan Admin melalui WhatsApp setelah pesanan dibuat.
                </p>

                <form action="{{ route('customer.orders.store') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Pemesan</label>
                            <input type="text" name="receiver_name" class="form-control"
                                   value="{{ Auth::guard('customer')->user()->nama_lengkap ?? '' }}" required>
                            @error('receiver_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nomor WhatsApp</label>
                            <input type="text" name="receiver_phone" class="form-control"
                                   placeholder="08xxxxxxxxxx" value="{{ Auth::guard('customer')->user()->phone_number ?? '' }}" required>
                            @error('receiver_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Hidden fields untuk session cart --}}
                    <input type="hidden" name="items_json" value="{{ json_encode($cart) }}">

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-primary py-3 fw-bold fs-5 shadow-sm" style="background: #ff6b35; border: none;">
                            Lanjut ke Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        <a href="{{ route('customer.cart.index') }}" class="btn btn-outline-secondary py-2">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
