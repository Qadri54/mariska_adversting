@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manajemen Layanan</h3>
            <p class="text-muted mb-0">Kelola daftar layanan dan kategori pekerjaan.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
        </a>
    </div>

    {{-- Tabel Layanan --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Jml Produk</th>
                            <th class="text-center">Jml Galeri</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#{{ $service->service_id }}</td>
                            <td class="fw-bold text-dark">{{ $service->nama_layanan }}</td>
                            <td class="text-muted">{{ Str::limit($service->deskripsi, 50) }}</td>
                            
                            {{-- Jml Produk --}}
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">
                                    {{ $service->products_count ?? 0 }}
                                </span>
                            </td>

                            {{-- Jml Galeri --}}
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-10 text-info px-3 rounded-pill">
                                    {{ $service->galleries_count ?? 0 }}
                                </span>
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.products.index', ['service_id' => $service->service_id]) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                   Lihat Produk <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                                <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 ms-1" 
                                            onclick="confirmDelete(this)">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada layanan yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Skrip Konfirmasi Hapus SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(button) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit();
        }
    });
}

{{-- Notifikasi Sukses/Error --}}
@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
@endif
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Oops...', text: '{{ session('error') }}' });
@endif
</script>
@endsection