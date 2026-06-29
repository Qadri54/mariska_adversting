@extends('layouts.admin')

@section('title', 'Manajemen Mitra')

@push('styles')
<style>
    .partner-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: #fff;
        position: relative;
    }
    .partner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .partner-logo {
        max-width: 100%;
        max-height: 80px;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }
    .partner-card:hover .partner-logo { filter: grayscale(0%); }
    
    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 0, 0, 0.1);
        color: red;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
        cursor: pointer;
    }
    .partner-card:hover .delete-btn { opacity: 1; }
</style>
{{-- Import CSS SweetAlert2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Daftar Mitra</h3>
            <p class="text-muted mb-0">Kelola logo klien dan partner kerjasama.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i> Tambah Mitra
        </a>
    </div>

    <div class="row g-4">
        @forelse($partners as $partner)
            <div class="col-md-3 col-sm-4 col-6">
                <div class="partner-card">
                    {{-- Form Hapus dengan Class delete-form --}}
                    <form action="{{ route('admin.partners.destroy', $partner->partner_id) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="button" class="delete-btn delete-btn-trigger" data-name="{{ $partner->partner_name }}" title="Hapus">
                            <i class="bi bi-x"></i>
                        </button>
                    </form>

                    <img src="{{ asset($partner->logo_url) }}" alt="{{ $partner->partner_name }}" class="partner-logo mb-3">
                    <h6 class="fw-bold text-dark mb-0 text-center">{{ $partner->partner_name }}</h6>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 text-muted bg-white rounded-4 shadow-sm">
                    <i class="bi bi-people fs-1 d-block mb-3 opacity-25"></i>
                    <p class="mb-0">Belum ada data mitra.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn-trigger').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            const name = this.getAttribute('data-name');
            
            Swal.fire({
                title: 'Hapus Mitra?',
                text: "Yakin ingin menghapus '" + name + "'? Tindakan ini tidak dapat dibatalkan.",
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