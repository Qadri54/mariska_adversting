@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@push('styles')
<style>
    .gallery-card { border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: transform 0.3s ease; height: 100%; }
    .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .gallery-img-wrapper { height: 200px; overflow: hidden; position: relative; }
    .gallery-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .gallery-card:hover .gallery-img { transform: scale(1.1); }
    .gallery-badge { position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.9); padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #4682A9; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .gallery-body { padding: 15px; }
    .gallery-title { font-weight: 700; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
</style>
{{-- Import SweetAlert2 CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Galeri Foto</h3>
            <p class="text-muted mb-0">Kelola portofolio dan dokumentasi pekerjaan.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-upload me-2"></i> Upload Foto
        </a>
    </div>

    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-md-4 col-lg-3 col-sm-6">
                <div class="gallery-card bg-white">
                    <div class="gallery-img-wrapper">
                        <img src="{{ asset($gallery->image_url) }}" class="gallery-img" alt="{{ $gallery->title }}">
                        <span class="gallery-badge">{{ $gallery->service->nama_layanan ?? 'Umum' }}</span>
                    </div>
                    <div class="gallery-body">
                        <h6 class="gallery-title text-dark" title="{{ $gallery->title }}">{{ $gallery->title }}</h6>
                        <p class="small text-muted mb-3">{{ Str::limit($gallery->description, 40) ?? 'Tidak ada deskripsi' }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $gallery->created_at->format('d M Y') }}</small>
                            <div class="btn-group">
                                <a href="{{ route('admin.gallery.edit', $gallery->gallery_id) }}" class="btn btn-sm btn-outline-warning border-0">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- FORM HAPUS MODERN --}}
                                <form action="{{ route('admin.gallery.destroy', $gallery->gallery_id) }}" method="POST" class="delete-form d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger border-0 delete-btn" data-title="{{ $gallery->title }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Belum ada foto di galeri.</div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            const title = this.getAttribute('data-title');
            
            Swal.fire({
                title: 'Hapus Foto?',
                text: "Yakin ingin menghapus foto '" + title + "'? Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-4 shadow' // Membuat tampilan kartu modern
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