@extends('layouts.admin')

@section('title', 'Edit SPH')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.sph.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="h3 text-gray-800">Edit Penawaran</h1>
    </div>

    <form action="{{ route('admin.sph.update', $sph->sph_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">1. Informasi Klien</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label small font-weight-bold">Nomor SPH</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm bg-light" value="{{ $sph->sph_number }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label small font-weight-bold">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="sph_date" class="form-control form-control-sm"
                                       value="{{ old('sph_date', $sph->sph_date) }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Nama Klien</label>
                            <input type="text" name="client_name" class="form-control form-control-sm"
                                   value="{{ old('client_name', $sph->client_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">UP (Ditujukan Kepada)</label>
                            <input type="text" name="client_up" class="form-control form-control-sm"
                                   value="{{ old('client_up', $sph->client_up) }}">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Perihal / Judul</label>
                            <textarea name="job_title" class="form-control form-control-sm" rows="2" required>{{ old('job_title', $sph->job_title) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-warning">
                        <h6 class="m-0 font-weight-bold text-warning">2. Syarat & Ketentuan</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="small font-weight-bold">Waktu Pengerjaan</label>
                            <input type="text" name="terms_waktu" class="form-control form-control-sm"
                                   value="{{ old('terms_waktu', $sph->terms_waktu) }}">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Syarat Pembayaran</label>
                            <textarea name="terms_pembayaran" class="form-control form-control-sm" rows="3">{{ old('terms_pembayaran', $sph->terms_pembayaran) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-success">
                        <h6 class="m-0 font-weight-bold text-success">3. Update Lampiran</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group border p-3 rounded bg-light mb-3">
                            <label class="font-weight-bold text-dark mb-2">1. Gambar Tabel Harga</label>
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    @if($sph->rincian_image)
                                        <a href="{{ asset('storage/' . $sph->rincian_image) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $sph->rincian_image) }}" class="img-thumbnail" style="max-height: 80px;">
                                        </a>
                                        <div class="small text-success mt-1"><i class="fas fa-check-circle"></i> Ada</div>
                                    @else
                                        <span class="badge badge-danger">Kosong</span>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <input type="file" name="rincian_image" class="form-control-file small" accept="image/*">
                                    <small class="text-muted d-block mt-1">Upload baru jika ingin mengganti gambar ini.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group border p-3 rounded bg-light mb-4">
                            <label class="font-weight-bold text-dark mb-2">2. Gambar Desain (Opsional)</label>
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    @if($sph->design_image)
                                        <a href="{{ asset('storage/' . $sph->design_image) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $sph->design_image) }}" class="img-thumbnail" style="max-height: 80px;">
                                        </a>
                                        <div class="small text-success mt-1"><i class="fas fa-check-circle"></i> Ada</div>
                                    @else
                                        <span class="badge badge-secondary">Kosong</span>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <input type="file" name="design_image" class="form-control-file small" accept="image/*">
                                    <small class="text-muted d-block mt-1">Upload baru jika ingin mengganti/menambah.</small>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-warning btn-lg shadow">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
