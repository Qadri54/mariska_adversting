@extends('layouts.admin')

@section('title', 'Edit Produk')

@push('styles')
<style>
    /* Preview gambar dengan ukuran tetap - tidak kedat-kedut */
    .product-preview-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        display: block;
        margin: 0 auto;
    }

    .image-upload-card {
        position: relative;
        overflow: hidden;
    }

    .image-upload-card .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        pointer-events: none;
    }

    .image-upload-card:hover .img-overlay {
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Produk</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            {{-- Form Edit --}}
            <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Kolom Kiri: Info Dasar --}}
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                                   value="{{ old('nama_produk', $product->nama_produk) }}" required>
                            @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori Layanan</label>
                                <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->service_id }}"
                                                {{ old('service_id', $product->service_id) == $service->service_id ? 'selected' : '' }}>
                                            {{ $service->nama_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Satuan</label>
                                <select name="unit_type" class="form-select @error('unit_type') is-invalid @enderror" required>
                                    <option value="m2" {{ old('unit_type', $product->unit_type) == 'm2' ? 'selected' : '' }}>m² (Meter Persegi)</option>
                                    <option value="pcs" {{ old('unit_type', $product->unit_type) == 'pcs' ? 'selected' : '' }}>Pcs (Satuan)</option>
                                    <option value="box" {{ old('unit_type', $product->unit_type) == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="unit" {{ old('unit_type', $product->unit_type) == 'unit' ? 'selected' : '' }}>Unit (Barang Jadi)</option>
                                    <option value="jasa" {{ old('unit_type', $product->unit_type) == 'jasa' ? 'selected' : '' }}>Jasa (Kustom/EO)</option>
                                </select>
                                @error('unit_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga Dasar (Rp)</label>
                            <input type="number" name="base_price" class="form-control @error('base_price') is-invalid @enderror"
                                   value="{{ old('base_price', $product->base_price) }}" min="0" required>
                            @error('base_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Produk</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Masukkan deskripsi produk (opsional)">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Gambar - FIXED --}}
                    <div class="col-md-4">
                        <div class="card bg-light border-0">
                            <div class="card-body text-center p-4">
                                <label class="form-label fw-bold mb-3 d-block">Gambar Produk</label>

                                {{-- Preview Gambar dengan ukuran tetap --}}
                                <div class="mb-3 image-upload-card">

                                    <img id="previewImage"
                                        src="{{ $product->image_url }}" {{-- <-- Menggunakan Accessor Model yang sudah diperbaiki --}}
                                        alt="{{ $product->nama_produk }}"
                                        class="product-preview-img"
                                        onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}'">

                                    <div class="img-overlay">
                                        <i class="bi bi-camera-fill"></i>
                                    </div>
                                </div>

                                {{-- Input File --}}
                                <input type="file"
                                       name="image"
                                       id="imageInput"
                                       class="form-control form-control-sm @error('image') is-invalid @enderror"
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       onchange="previewFile(this)">

                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Format: JPG, PNG, WEBP (Max 2MB)<br>
                                    Kosongkan jika tidak ingin mengganti
                                </small>

                                @error('image')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <div class="text-end">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Preview gambar sebelum upload (opsional, untuk UX lebih baik)
    function previewFile(input) {
        const preview = document.getElementById('previewImage');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
