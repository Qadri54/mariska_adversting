@extends('layouts.admin')

@section('title', 'Tambah Mitra Baru')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Tambah Mitra</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Partner --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Mitra / Perusahaan</label>
                            <input type="text" name="partner_name" class="form-control" placeholder="Contoh: PT. Pertamina" required>
                        </div>

                        {{-- Upload Logo --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Logo Mitra</label>
                            <input type="file" name="logo" class="form-control" accept="image/*" required>
                            <div class="form-text">Format: PNG, JPG, SVG. Background transparan lebih baik.</div>
                        </div>

                        <hr>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">
                                <i class="bi bi-save me-2"></i> Simpan Mitra
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
