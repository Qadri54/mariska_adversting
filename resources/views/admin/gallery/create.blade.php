@extends('layouts.admin')

@section('title', 'Upload Foto Galeri')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Upload Foto Baru</h3>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul Foto --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Foto</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Pemasangan Billboard Wardah" required>
                        </div>

                        {{-- Kategori Layanan --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Layanan</label>
                            <select name="service_id" class="form-select" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->service_id }}">{{ $service->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Foto ini akan muncul di halaman layanan yang dipilih.</div>
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat (Opsional)</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Ceritakan sedikit tentang proyek ini..."></textarea>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">File Foto</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            <div class="form-text">Format: JPG, PNG, WEBP. Max 5MB.</div>
                        </div>

                        <hr>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">
                                <i class="bi bi-upload me-2"></i> Upload Foto
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
