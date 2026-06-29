@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')

@push('styles')
<style>
    /* Styling khusus untuk preview gambar di form edit */
    .gallery-preview-img {
        max-width: 100%;
        height: auto;
        max-height: 250px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        margin-bottom: 15px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Foto Galeri</h3>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    {{-- FORM EDIT DENGAN METHOD PUT --}}
                    <form action="{{ route('admin.gallery.update', $gallery->gallery_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk routing update --}}

                        {{-- Judul Foto --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Foto</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $gallery->title) }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Kategori Layanan --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Layanan</label>
                            <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->service_id }}"
                                            {{ old('service_id', $gallery->service_id) == $service->service_id ? 'selected' : '' }}>
                                        {{ $service->nama_layanan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Foto ini akan muncul di halaman layanan yang dipilih.</div>
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat (Opsional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                                      placeholder="Ceritakan sedikit tentang proyek ini...">{{ old('description', $gallery->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <hr>

                        {{-- Tampilan Gambar Lama --}}
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold d-block mb-3">Gambar Saat Ini</label>

                            @if($gallery->image_url)
                                {{-- Menggunakan asset() untuk URL storage. Asumsi kolom image_url menyimpan path relatif --}}
                                <img src="{{ asset('storage/' . $gallery->image_url) }}"
                                     alt="{{ $gallery->title }}"
                                     class="gallery-preview-img"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}';">
                                <small class="d-block text-muted">Abaikan kolom upload jika tidak ingin mengganti gambar.</small>
                            @else
                                <p class="text-muted small">Tidak ada gambar saat ini.</p>
                            @endif
                        </div>

                        {{-- Upload Foto Baru --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Ganti File Foto (Baru)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Format: JPG, PNG, WEBP. Max 5MB.</div>
                        </div>

                        <hr>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
