@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@push('styles')
<style>
    /* Styling Tabel dan Kartu */
    .product-img-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: transform 0.2s ease;
    }
    .product-img-thumbnail:hover { transform: scale(1.1); border-color: #0d6efd; cursor: pointer; }
    .table-card { border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: none; overflow: hidden; }
</style>
{{-- CSS SweetAlert2 untuk tampilan kartu modern --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="bi bi-box-seam me-2"></i>Daftar Produk</h3>
            <p class="text-muted mb-0 small">Kelola data produk dan layanan CV Arya Advertising.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i> Tambah Produk
        </a>
    </div>

    {{-- Filter Section --}}
    <div class="card border-0 shadow-sm mb-4 rounded-4">
        <div class="card-body">
            <form action="{{ route('admin.products.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <select name="service_id" class="form-select" onchange="this.form.submit()">
                        <option value="all">-- Semua Kategori --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->service_id }}" {{ request('service_id') == $service->service_id ? 'selected' : '' }}>
                                {{ $service->nama_layanan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama produk..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Produk --}}
    <div class="card table-card shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ $product->image_url }}" class="product-img-thumbnail" 
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}';">
                            </td>
                            <td class="fw-bold">{{ $product->nama_produk }}</td>
                            <td><span class="badge bg-info bg-opacity-10 text-info rounded-pill">{{ $product->service->nama_layanan ?? '-' }}</span></td>
                            <td class="fw-bold text-success">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ strtoupper($product->unit_type) }}</span></td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" class="delete-form d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-name="{{ $product->nama_produk }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-5">Belum ada data produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            const productName = this.getAttribute('data-name');
            
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Yakin ingin menghapus produk '" + productName + "'? Data tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    popup: 'rounded-4 shadow' // Membuat konfirmasi berbentuk kartu modern
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