@extends('layouts.admin')

@section('title', 'Detail SPH - ' . $sph->sph_number)

@section('content')
@push('styles')
<style>
    .img-sph {
        transition: transform 0.3s ease;
        cursor: pointer;
        border: 1px solid #ddd;
        max-width: 100%;
        height: auto;
    }
    .img-sph:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

<div class="container-fluid">
    {{-- Header dengan Button Group yang Rapi --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penawaran</h1>
        <div class="btn-group shadow-sm">
            <a href="{{ route('admin.sph.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.sph.edit', $sph->sph_id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('admin.sph.print', $sph->sph_id) }}" target="_blank" class="btn btn-primary btn-sm">
                <i class="fas fa-print mr-1"></i> Cetak PDF
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif

    <div class="row">
        {{-- Kolom Informasi --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-left-primary">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Surat</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="text-muted font-weight-bold" width="40%">Nomor</td>
                            <td>{{ $sph->sph_number }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Tanggal</td>
                            <td>{{ \Carbon\Carbon::parse($sph->sph_date)->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Dibuat Oleh</td>
                            <td>{{ $sph->user->nama_lengkap ?? 'Admin' }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted d-block">Nama Klien:</small>
                        <strong class="text-dark">{{ $sph->client_name }}</strong><br>
                        @if($sph->client_up) <small class="text-muted">UP: {{ $sph->client_up }}</small> @endif
                    </div>
                    <div class="alert alert-light border shadow-sm">
                        <small class="text-muted d-block mb-1">Perihal:</small>
                        {{ $sph->job_title }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Lampiran --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-left-success">
                    <h6 class="m-0 font-weight-bold text-success">Lampiran / Gambar</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="font-weight-bold mb-2">1. Tabel Harga:</h6>
                        <div class="p-2 border bg-light rounded text-center">
                            @if($sph->rincian_image)
                                <img src="{{ asset('storage/' . $sph->rincian_image) }}" class="img-fluid rounded img-sph" alt="Tabel Harga">
                            @else
                                <div class="py-4 text-danger">Tidak ada gambar rincian.</div>
                            @endif
                        </div>
                    </div>

                    @if($sph->design_image)
                    <div>
                        <h6 class="font-weight-bold mb-2">2. Desain Teknis:</h6>
                        <div class="p-2 border bg-light rounded text-center">
                            <img src="{{ asset('storage/' . $sph->design_image) }}" class="img-fluid rounded img-sph" alt="Desain Teknis">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection