@extends('layouts.admin')

@section('title', 'Buat SPH Baru')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.sph.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="h3 text-gray-800">Buat Penawaran (Template Gambar)</h1>
    </div>

    {{-- Tampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sph.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">1. Informasi Klien & Surat</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label small font-weight-bold">Nomor SPH</label>
                            <div class="col-sm-8">
                                <input type="text" name="sph_number" class="form-control form-control-sm bg-light"
                                       value="{{ old('sph_number', $sphNumber) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label small font-weight-bold">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="sph_date" class="form-control form-control-sm"
                                       value="{{ old('sph_date', date('Y-m-d')) }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Nama Klien / Perusahaan</label>
                            <input type="text" name="client_name" class="form-control" required placeholder="Contoh: PT. PARAGON">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">UP (Ditujukan Kepada)</label>
                            <input type="text" name="client_up" class="form-control" placeholder="Contoh: Bpk. Dharma">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Perihal / Judul Pekerjaan</label>
                            <textarea name="job_title" class="form-control" rows="2" required placeholder="Contoh: Pembuatan Neon Box..."></textarea>
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
                            <input type="text" name="terms_waktu" class="form-control" value="14 Hari Kerja">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Syarat Pembayaran</label>
                            <textarea name="terms_pembayaran" class="form-control" rows="3">DP 30% dari nilai pekerjaan. Pelunasan setelah selesai.</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow mb-4 h-100">
                    <div class="card-header py-3 border-left-success">
                        <h6 class="m-0 font-weight-bold text-success">3. Upload Lampiran</h6>
                    </div>
                    <div class="card-body text-center">

                        <div class="alert alert-info text-left small">
                            <i class="fas fa-info-circle"></i> <b>Petunjuk:</b> Upload screenshot tabel harga yang sudah lengkap (termasuk Total & PPN). Sistem akan menempelkan gambar ini ke dalam PDF.
                        </div>

                        <div class="form-group border p-4 rounded bg-light mb-3">
                            <i class="fas fa-file-invoice-dollar fa-3x text-gray-300 mb-3"></i>
                            <label class="d-block font-weight-bold text-dark">Gambar Tabel Harga (Wajib)</label>
                            <input type="file" name="rincian_image" class="form-control-file" accept="image/*" required>
                        </div>

                        <div class="form-group border p-4 rounded bg-light mb-4">
                            <i class="fas fa-drafting-compass fa-3x text-gray-300 mb-3"></i>
                            <label class="d-block font-weight-bold text-dark">Gambar Desain / Teknis (Opsional)</label>
                            <input type="file" name="design_image" class="form-control-file" accept="image/*">
                            <small class="text-muted">Akan muncul di halaman kedua (Lampiran).</small>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary btn-lg btn-block shadow">
                            <i class="fas fa-save mr-2"></i> Simpan & Cetak SPH
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
