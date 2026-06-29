{{-- File: resources/views/produk/produk_detail.blade.php (Versi Hybrid: Bisa Varian & Satuan) --}}

@extends('layouts.app')

@section('title', $product->nama_produk . ' — Arya Advertising')

@push('styles')
<style>
    .product-preview { border-radius: 16px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
    .product-preview img { width: 100%; height: 400px; object-fit: cover; }
    .calculator-card { background: white; border-radius: 16px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
    .form-label { font-weight: 600; color: var(--dark); margin-bottom: 8px; }
    .price-preview { background: var(--accent); color: white; padding: 20px; border-radius: 12px; margin-top: 20px; }
    .price-preview .total { font-size: 2rem; font-weight: 700; }
    .btn-order { background: var(--primary-dark); border: none; color: white; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: all 0.3s; width: 100%; }
    .btn-order:hover { background: var(--accent); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(70,130,169,0.3); color: white; }

    /* Style untuk Opsi Material */
    .material-option { border: 2px solid #e5e7eb; padding: 15px; border-radius: 8px; margin-bottom: 10px; cursor: pointer; transition: all 0.3s; }
    .material-option:hover { border-color: var(--primary); }
    .material-option.active { border-color: var(--primary-dark); background: rgba(145,200,228,0.1); }

    .unit-price-info { background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef; margin-bottom: 20px; text-align: center; }
    .unit-price-info strong { color: var(--primary-dark); font-size: 1.2rem; }
</style>
@endpush

@section('content')
<div class="container py-5">

    <a href="{{ route('produk.layanan') }}" class="btn btn-outline-secondary mb-4">← Kembali ke Kategori</a>

    <div class="row g-4">
        {{-- Kiri: Gambar & Info --}}
        <div class="col-lg-6">
            <div class="product-preview">
                <img src="{{ $product->image_url ?? asset('images/default-product.png') }}"
                     alt="{{ $product->nama_produk }}"
                     onerror="this.src='{{ asset('images/default-product.png') }}'">
            </div>
            <div class="mt-4">
                <h4>{{ $product->nama_produk }}</h4>
                <span class="badge bg-info text-dark mb-2">{{ $product->service->nama_layanan ?? 'Layanan' }}</span>
                <p class="text-muted" style="white-space: pre-line;">{{ $product->description ?? 'Produk berkualitas tinggi.' }}</p>
            </div>
        </div>

        {{-- Kanan: Form Kalkulator/Konsultasi --}}
<div class="col-lg-6">

    @php
        // Logika identifikasi Kustom (Tersedia dari Controller Anda)
        // Controller Anda sudah mengirimkan $isConsultationRequired (True jika EO atau Product ID kustom)

        $waMessage = "Halo Admin, saya tertarik dengan produk kustom *{$product->nama_produk}*. Mohon info lebih lanjut untuk spesifikasi dan penawaran harga.";
    @endphp

    {{-- KONDISI UTAMA: JIKA MEMERLUKAN KONSULTASI (EO ATAU PRODUK CUSTOM) --}}
    @if($isConsultationRequired)
        {{-- ======================================================= --}}
        {{-- || KASUS JASA/KUSTOM (LANGSUNG KE WHATSAPP)           || --}}
        {{-- ======================================================= --}}
        <div class="calculator-card text-center py-5">
            <i class="bi bi-whatsapp display-4 text-success mb-3"></i>
            <h5 class="fw-bold mb-3">Layanan Konsultasi & Penawaran</h5>
            <p class="text-muted mb-4">
                Produk {{ $product->nama_produk }} memerlukan penawaran kustom. Silakan hubungi kami untuk mendiskusikan spesifikasi dan harga.
            </p>
            <a href="https://wa.me/6282160762279?text={{ urlencode($waMessage) }}"
               target="_blank"
               class="btn btn-success py-3 fw-bold fs-5 rounded-pill px-5">
                <i class="bi bi-whatsapp me-2"></i> Mulai Konsultasi
            </a>
        </div>

    @else
        {{-- ======================================================= --}}
        {{-- || KASUS PRODUK CETAK (KALKULATOR & KERANJANG)       || --}}
        {{-- ======================================================= --}}
        <div class="calculator-card">
            <h5 class="mb-4">Hitung Harga Pesanan</h5>

            {{-- TAMPILAN HARGA SATUAN (Jika tidak ada varian material) --}}
            @if(empty($product->material_options))
            <div class="unit-price-info">
                Harga per {{ $product->unit_type }}: <br>
                <strong>Rp {{ number_format($product->base_price, 0, ',', '.') }} /{{ $product->unit_type }}</strong>
            </div>
            @endif

            <form id="orderForm" method="POST" action="{{ route('customer.calculator.add-to-cart') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                {{-- Input Material Hidden/Radio Button (Sudah Ada) --}}
                @if(!empty($product->material_options))
                    {{-- ... (Material Options radio buttons) ... --}}
                @else
                    <input type="hidden" name="material" value="{{ $product->nama_produk }}_{{ $product->base_price }}" data-price="{{ $product->base_price }}">
                @endif

                {{-- ======================================================= --}}
                {{-- || INPUT DIMENSI: Bergantung pada Unit Type          || --}}
                {{-- ======================================================= --}}

                @if($product->unit_type == 'm2')
                    {{-- KASUS M2 (SPANDUK, CETAK LUASAN) --}}
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Panjang (meter)</label>
                            <input type="number" class="form-control" id="length" name="length" value="1" min="0.1" step="0.1" required oninput="calculatePrice()">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Lebar (meter)</label>
                            <input type="number" class="form-control" id="width" name="width" value="1" min="0.1" step="0.1" required oninput="calculatePrice()">
                        </div>
                        <input type="hidden" id="quantity" name="quantity" value="1">
                        <input type="hidden" id="length_value" name="length_value" value="1">
                        <input type="hidden" id="width_value" name="width_value" value="1">
                    </div>
                @elseif(in_array($product->unit_type, ['pcs', 'unit', 'box']))
                    {{-- KASUS PCS / SATUAN (STEMPEL OTOMATIS) --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Pesanan ({{ strtoupper($product->unit_type) }})</label>
                        <input type="number" class="form-control" id="quantity_input" name="quantity" value="1" min="1" step="1" required oninput="calculatePrice()">
                    </div>

                    {{-- Input Dimensi (HANYA untuk INFO Produksi) --}}
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Panjang (cm) <small class="text-muted">(Info Produksi)</small></label>
                            <input type="number" class="form-control" id="length_info" name="length_info" placeholder="5" min="0.1" step="0.1">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Lebar (cm) <small class="text-muted">(Info Produksi)</small></label>
                            <input type="number" class="form-control" id="width_info" name="width_info" placeholder="15" min="0.1" step="0.1">
                        </div>
                    </div>
                    <input type="hidden" id="quantity" name="quantity" value="1">
                    <input type="hidden" id="length_value" name="length_value" value="1">
                    <input type="hidden" id="width_value" name="width_value" value="1">
                @endif

                {{-- Finishing (Dinamis dari Database) --}}
                @if(!empty($product->finishing_options))
                    {{-- ... (Finishing radio buttons) ... --}}
                @endif

                {{-- Upload File (Sudah Ada) --}}
                <div class="mb-4">
                    <label class="form-label">Upload Desain</label>
                    <input type="file" class="form-control" name="design_file" accept=".jpg,.jpeg,.png,.pdf">
                    <div class="form-text">Max 10MB.</div>
                </div>

                {{-- Tombol Submit (JALUR CETAK) --}}
                <div class="price-preview">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-white-50 mb-1">Estimasi Total:</div>
                            <div class="total" id="totalPrice">Rp 0</div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-order">
                                <i class="bi bi-cart-plus"></i> + Keranjang
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endif
</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- LOGIKA JS PINTAR ---
    const marginPercent = {{ $product->profit_margin ?? 20 }};
    const unitType = '{{ $product->unit_type }}'; // Ambil unit type ke JS

    function selectMaterial(element) {
        document.querySelectorAll('.material-option').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
        element.querySelector('input[type="radio"]').checked = true;
        calculatePrice();
    }

    function calculatePrice() {
        let quantity = 1;
        let area = 1;

        // 1. Tentukan Basis Perhitungan (Quantity vs Area)
        if (unitType === 'm2') {
            const length = parseFloat(document.getElementById('length').value) || 0;
            const width = parseFloat(document.getElementById('width').value) || 0;
            area = length * width;
            quantity = area; // Quantity (yang dikirim ke keranjang) adalah area

            // Update input hidden quantity agar sesuai area
            document.getElementById('quantity').value = area.toFixed(2);
        } else {
            // Untuk PCS, UNIT, BOX, Quantity diambil dari input #quantity_input
            quantity = parseFloat(document.getElementById('quantity_input').value) || 0;
            area = 1; // Area di set 1 untuk mencegah perkalian ganda (Harga Dasar per pcs)
        }

        // 2. Cari Harga Jual (Modal + Margin)
        let selectedMaterial = document.querySelector('input[name="material"]:checked');
        if (!selectedMaterial) {
            selectedMaterial = document.querySelector('input[name="material"][type="hidden"]');
        }
        const modalPrice = selectedMaterial ? parseFloat(selectedMaterial.dataset.price) : 0;
        const sellingPrice = modalPrice + (modalPrice * marginPercent / 100);

        // 3. Hitung Total Bahan
        // Total = Harga Jual * Basis (Area/Quantity)
        let total = sellingPrice * quantity;

        // 4. Tambah Finishing
        document.querySelectorAll('input[name="finishing[]"]:checked').forEach(el => {
            let finishingPrice = parseFloat(el.dataset.price) || 0;
            // Biaya finishing dihitung per item atau per area
            total += finishingPrice * (unitType === 'm2' ? area : quantity); // Dikalikan dengan basis
        });

        // Update Tampilan
        document.getElementById('totalPrice').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Event Listeners (Dipisah berdasarkan unit type)
    if (unitType === 'm2') {
        document.getElementById('length').addEventListener('input', calculatePrice);
        document.getElementById('width').addEventListener('input', calculatePrice);
    } else if (document.getElementById('quantity_input')) {
        document.getElementById('quantity_input').addEventListener('input', calculatePrice);
    }

    // Hitung awal
    calculatePrice();
</script>
@endpush
