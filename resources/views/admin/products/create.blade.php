@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@push('styles')
<style>
    /* Preview gambar dengan ukuran tetap */
    .product-preview-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        display: block;
        margin: 0 auto;
        background: #f8f9fa;
    }

    .image-upload-card {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .image-upload-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .placeholder-icon {
        width: 200px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        margin: 0 auto;
        color: #adb5bd;
        font-size: 3rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-box-seam me-2"></i>Tambah Produk Baru
            </h3>
            <p class="text-muted mb-0 small">Lengkapi formulir di bawah untuk menambahkan produk.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- KOLOM KIRI: Form Data --}}
                    <div class="col-md-8">
                        <div class="row g-4">
                            {{-- Nama Produk --}}
                            <div class="col-12">
                                <label for="nama_produk" class="form-label fw-bold">
                                    Nama Produk <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="nama_produk"
                                       id="nama_produk"
                                       class="form-control @error('nama_produk') is-invalid @enderror"
                                       value="{{ old('nama_produk') }}"
                                       placeholder="Contoh: Spanduk MMT 340GSM"
                                       required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori & Satuan --}}
                            <div class="col-md-6">
                                <label for="service_id" class="form-label fw-bold">
                                    Kategori/Layanan <span class="text-danger">*</span>
                                </label>
                                <select name="service_id"
                                        id="service_id"
                                        class="form-select @error('service_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->service_id }}"
                                                {{ old('service_id') == $service->service_id ? 'selected' : '' }}>
                                            {{ $service->nama_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="unit_type" class="form-label fw-bold">
                                    Satuan <span class="text-danger">*</span>
                                </label>
                                <select name="unit_type"
                                        id="unit_type"
                                        class="form-select @error('unit_type') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Satuan --</option>
                                    <option value="m2" {{ old('unit_type') == 'm2' ? 'selected' : '' }}>m² (Meter Persegi)</option>
                                    <option value="pcs" {{ old('unit_type') == 'pcs' ? 'selected' : '' }}>Pcs (Satuan)</option>
                                    <option value="box" {{ old('unit_type') == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="unit" {{ old('unit_type') == 'unit' ? 'selected' : '' }}>Unit (Barang Jadi)</option>
                                    <option value="jasa" {{ old('unit_type') == 'jasa' ? 'selected' : '' }}>Jasa (Kustom/EO)</option>
                                </select>
                                @error('unit_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga Dasar --}}
                            <div class="col-12">
                                <label for="base_price" class="form-label fw-bold">
                                    Harga Dasar (Per Satuan) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Rp</span>
                                    <input type="number"
                                           step="1"
                                           name="base_price"
                                           id="base_price"
                                           class="form-control @error('base_price') is-invalid @enderror"
                                           value="{{ old('base_price', 0) }}"
                                           placeholder="0"
                                           required
                                           min="0">
                                </div>
                                <small class="text-muted">Masukkan harga per satuan yang dipilih di atas.</small>
                                @error('base_price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">
                                    Deskripsi Produk
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="5"
                                          placeholder="Masukkan spesifikasi, kelebihan, atau catatan tambahan produk...">{{ old('description') }}</textarea>
                                <small class="text-muted">Opsional - akan ditampilkan di halaman detail produk.</small>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Upload Gambar --}}
                    <div class="col-md-4">
                        <div class="card bg-light border-0 image-upload-card">
                            <div class="card-body text-center p-4">
                                <label class="form-label fw-bold mb-3 d-block">
                                    Gambar Produk
                                </label>

                                {{-- Preview Area --}}
                                <div class="mb-3">
                                    <div id="imagePreviewContainer" class="placeholder-icon">
                                        <i class="bi bi-camera-fill"></i>
                                    </div>
                                    <img id="imagePreview"
                                         class="product-preview-img d-none"
                                         alt="Preview">
                                </div>

                                {{-- Input File --}}
                                <input type="file"
                                       name="image"
                                       id="imageInput"
                                       class="form-control form-control-sm @error('image') is-invalid @enderror"
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       onchange="previewImage(this)">

                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Format: JPG, PNG, WEBP<br>
                                    Ukuran Max: 2MB<br>
                                    <em class="text-secondary">(Opsional)</em>
                                </small>

                                @error('image')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- Tombol Submit --}}
                <div class="text-end">
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4 me-2">
                        <i class="bi bi-x-lg me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                        <i class="bi bi-check-lg me-2"></i>Simpan Produk
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview gambar sebelum upload
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imagePreviewContainer');
        const file = input.files[0];

        if (file) {
            // Validasi ukuran file (2MB = 2097152 bytes)
            if (file.size > 2097152) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                input.value = '';
                return;
            }

            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.');
                input.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }

            reader.readAsDataURL(file);
        } else {
            // Reset jika file dihapus
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    }

    // Format input harga (opsional - tambah separator ribuan)
    document.getElementById('base_price').addEventListener('input', function(e) {
        // Bisa ditambahkan format ribuan di sini jika mau
    });
</script>
@endpush
