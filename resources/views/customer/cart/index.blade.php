@extends('layouts.app')

@section('title', 'Keranjang Belanja — Arya Advertising')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        color: #fff;
        text-align: center;
    }
    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 16px;
    }
    .cart-container {
        padding: 80px 0;
    }
    .cart-item {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 16px;
        border: 2px solid #f0f0f0;
        transition: all 0.3s;
    }
    .cart-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .cart-item-header {
        display: flex;
        gap: 20px;
        align-items: start;
    }
    .cart-item-checkbox {
        padding-top: 5px;
    }
    .cart-item-checkbox input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    .cart-item-image {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f0f0f0;
    }
    .cart-item-info {
        flex-grow: 1;
    }
    .cart-item-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }
    .cart-item-details {
        color: var(--muted);
        font-size: 0.9rem;
        margin-bottom: 12px;
        line-height: 1.6;
    }
    .cart-item-breakdown {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }
    .breakdown-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        color: var(--muted);
    }
    .breakdown-row.total {
        border-top: 1px dashed #ddd;
        margin-top: 8px;
        padding-top: 8px;
        font-weight: 700;
        color: var(--accent);
    }
    .cart-item-actions {
        text-align: right;
        padding-top: 10px;
    }
    .btn-remove {
        background: #ef4444;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-remove:hover {
        background: #dc2626;
        color: #fff;
    }
    .cart-summary {
        background: linear-gradient(135deg, var(--primary-dark), var(--accent));
        color: #fff;
        border-radius: 16px;
        padding: 30px;
        position: sticky;
        top: 160px; /* Jarak aman di bawah navbar saat halaman di-scroll */
        z-index: 10;  /* Mencegah card tertutup oleh elemen kontainer lain */
        box-shadow: 0 8px 24px rgba(39, 84, 138, 0.2);
        transition: top 0.3s ease;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .summary-row:last-child {
        border-bottom: none;
        font-size: 1.3rem;
        font-weight: 800;
        padding-top: 15px;
        margin-top: 10px;
        border-top: 2px solid rgba(255,255,255,0.3);
    }
    .btn-checkout {
        background: #fff;
        color: var(--accent);
        border: none;
        padding: 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.05rem;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-checkout:hover:not(:disabled) {
        background: var(--accent-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    .btn-checkout:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
    }
    .empty-cart {
        text-align: center;
        padding: 100px 20px;
    }
    .empty-cart-icon {
        font-size: 5rem;
        color: var(--muted);
        opacity: 0.5;
        margin-bottom: 20px;
    }
    @media(max-width: 991px) {
        .cart-summary {
            position: relative;
            top: auto;
            margin-top: 30px;
        }
    }
</style>
@endpush

@section('content')

<header class="page-header">
    <div class="container">
        <h1>🛒 Keranjang Belanja</h1>
        <p>Pilih produk yang ingin Anda checkout</p>
    </div>
</header>

<section class="cart-container">
    <div class="container">

        {{-- Cart Items Exist --}}
        @if(!empty($cartItems) && count($cartItems) > 0)

            <form action="{{ route('customer.orders.create') }}" method="GET" id="checkoutForm">

                <div class="row">

                    {{-- LEFT: Daftar Produk --}}
                    <div class="col-lg-8">

                        {{-- Select All --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label fw-bold" for="selectAll">
                                    Pilih Semua Produk ({{ count($cartItems) }})
                                </label>
                            </div>
                        </div>

                        {{-- Cart Items Loop --}}
                        @foreach($cartItems as $index => $item)
                        <div class="cart-item">
                            <div class="cart-item-header">

                                {{-- Checkbox --}}
                                <div class="cart-item-checkbox">
                                    <input class="form-check-input item-checkbox"
                                           type="checkbox"
                                           name="selected_items[]"
                                           value="{{ $item['id'] ?? $index }}"
                                           data-price="{{ $item['subtotal'] ?? 0 }}">
                                </div>

                                {{-- Image --}}
                                <img src="{{ $item['image_url'] ?? asset('images/default-product.png') }}"
                                 alt="{{ $item['product_name'] ?? 'Produk' }}"
                                 class="cart-item-image"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}'">

                                {{-- Info --}}
                                <div class="cart-item-info">
                                    <div class="cart-item-name">{{ $item['product_name'] ?? 'Produk Tanpa Nama' }}</div>

                                    <div class="cart-item-details">
                                        📏 <strong>Ukuran:</strong> {{ $item['length'] }} x {{ $item['width'] }} m (Area: {{ $item['area'] }} m²)<br>
                                        📦 <strong>Material:</strong> {{ $item['material'] ?? '-' }}<br>
                                        @if(!empty($item['finishing']))
                                            ✨ <strong>Finishing:</strong> {{ $item['finishing'] }}<br>
                                        @endif
                                        @if(!empty($item['design_file']))
                                            📁 <strong>File Desain:</strong> Ada<br>
                                        @endif
                                    </div>

                                    {{-- Breakdown Harga --}}
                                    <div class="cart-item-breakdown">
                                        <div class="breakdown-row">
                                            <span>Harga per m²</span>
                                            <strong>Rp {{ number_format($item['unit_price'] ?? 0, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="breakdown-row">
                                            <span>Area ({{ $item['area'] ?? 0 }} m²) × Harga</span>
                                            <strong>Rp {{ number_format(($item['area'] ?? 0) * ($item['unit_price'] ?? 0), 0, ',', '.') }}</strong>
                                        </div>
                                        @if(!empty($item['finishing']) && ($item['finishing_price'] ?? 0) > 0)
                                        <div class="breakdown-row">
                                            <span>{{ $item['finishing'] }}</span>
                                            <strong>Rp {{ number_format($item['finishing_price'] ?? 0, 0, ',', '.') }}</strong>
                                        </div>
                                        @endif
                                        <div class="breakdown-row total">
                                            <span>Subtotal</span>
                                            <strong>Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="cart-item-actions">
                                    <form action="{{ route('customer.cart.remove', $item['id']) }}" method="POST" style="display:inline;" class="form-delete-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-remove btn-delete-item">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        @endforeach

                    </div>

                    {{-- RIGHT: Ringkasan Belanja (Statis/Sticky) --}}
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h4 class="mb-4">Ringkasan Belanja</h4>

                            <div class="summary-row">
                                <span>Total Item</span>
                                <strong id="selectedCount">0</strong>
                            </div>

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <strong id="selectedTotal">Rp 0</strong>
                            </div>

                            <div class="summary-row">
                                <span>Total Pembayaran</span>
                                <strong id="grandTotal">Rp 0</strong>
                            </div>

                            <button type="submit" class="btn-checkout" id="checkoutBtn" disabled>
                                Lanjut ke Pembayaran
                            </button>

                            <p class="small text-center mt-3 mb-0" style="opacity: 0.8;">
                                Pilih minimal 1 produk untuk checkout
                            </p>
                        </div>
                    </div>

                </div>
            </form>

        {{-- Empty Cart --}}
        @else

            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h3 class="mt-4">Keranjang Belanja Kosong</h3>
                <p class="text-muted">Belum ada produk di keranjang Anda.</p>
                <a href="{{ route('produk.layanan') }}" class="btn btn-primary-custom btn-lg mt-3">
                    <i class="bi bi-shop me-2"></i> Mulai Belanja
                </a>
            </div>

        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
// 1. Logika untuk menghitung dan memperbarui ringkasan belanja
function updateSummary() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    let total = 0;
    let count = 0;

    checkboxes.forEach(cb => {
        const price = parseFloat(cb.dataset.price) || 0;
        total += price;
        count++;
    });

    // Update elemen text ringkasan
    document.getElementById('selectedCount').textContent = count + ' item';
    document.getElementById('selectedTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');

    // Aktifkan / Nonaktifkan tombol checkout
    const checkoutBtn = document.getElementById('checkoutBtn');
    if (count > 0) {
        checkoutBtn.disabled = false;
        checkoutBtn.textContent = '✓ Lanjut ke Pembayaran (' + count + ' item)';
    } else {
        checkoutBtn.disabled = true;
        checkoutBtn.textContent = 'Lanjut ke Pembayaran';
    }
}

// 2. Logika checkbox "Pilih Semua"
const selectAllCheckbox = document.getElementById('selectAll');
if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        updateSummary();
    });
}

// 3. Logika event listener untuk tiap-tiap checkbox produk
document.querySelectorAll('.item-checkbox').forEach(cb => {
    cb.addEventListener('change', updateSummary);
});

// Jalankan fungsi hitung otomatis saat halaman pertama kali dimuat
updateSummary();

// 4. Integrasi SweetAlert2 untuk konfirmasi hapus item dari keranjang
document.querySelectorAll('.btn-delete-item').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('.form-delete-item');
        
        Swal.fire({
            title: 'Hapus Produk?',
            text: "Produk ini akan dihapus dari keranjang belanja Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', 
            cancelButtonColor: '#6b7280',  
            confirmButtonText: 'Ya, Hapus!',
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
</script>
@endpush