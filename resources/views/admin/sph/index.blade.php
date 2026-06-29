@extends('layouts.admin')

@section('title', 'Daftar Surat Penawaran Harga (SPH)')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen SPH</h1>
        <a href="{{ route('admin.sph.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Buat SPH Baru
        </a>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar SPH Masuk</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.sph.index') }}" class="mb-4">
                <div class="form-row align-items-end">
                    <div class="col-md-4 mb-2">
                        <label>Cari (Nomor / Klien / Judul)</label>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter mr-1"></i> Filter</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Tanggal</th>
                            <th>Nomor SPH</th>
                            <th>Klien & Pekerjaan</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sphList as $index => $sph)
                        <tr>
                            <td>{{ $sphList->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($sph->sph_date)->format('d M Y') }}</td>
                            <td><span class="font-weight-bold text-primary">{{ $sph->sph_number }}</span></td>
                            <td>
                                <div class="font-weight-bold">{{ $sph->client_name }}</div>
                                <small class="text-muted">{{ $sph->job_title }}</small>
                            </td>
                            {{-- Tampilan Ikon Aksi yang Jelas --}}
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('admin.sph.show', $sph->sph_id) }}" class="text-info" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.sph.print', $sph->sph_id) }}" class="text-dark" target="_blank" title="Print"><i class="fas fa-print"></i></a>
                                    <a href="{{ route('admin.sph.edit', $sph->sph_id) }}" class="text-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                    
                                    <form action="{{ route('admin.sph.destroy', $sph->sph_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-danger border-0 bg-transparent delete-btn" title="Hapus" style="cursor:pointer;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Belum ada data SPH.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                {{ $sphList->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus SPH?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush