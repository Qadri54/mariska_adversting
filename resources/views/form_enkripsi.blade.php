<!DOCTYPE html>
<html>
<head>
    <title>AES Enkripsi Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Sistem Enkripsi Data Pelanggan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-5">
                <div class="card p-4">
                    <form action="/proses-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enkripsi & Simpan</button>
                    </form>
                </div>

                <a href="/download-data" class="btn btn-success mt-3 w-100">Download Laporan Excel (.CSV)</a>
            </div>

            <div class="col-md-7">
                <div class="card p-4">
                    <h5>Preview Database (Live)</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama (Hex)</th>
                                    <th>Email (Hex)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\CustomerSecret::latest()->limit(5)->get() as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td class="text-danger" style="font-family:monospace">{{ substr($d->encrypted_name, 0, 10) }}...</td>
                                    <td class="text-danger" style="font-family:monospace">{{ substr($d->encrypted_email, 0, 10) }}...</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
