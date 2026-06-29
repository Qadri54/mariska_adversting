@extends('layouts.admin')

@section('title', 'Manajemen Harga Jual (JOC)')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Manajemen Harga Jual (JOC)</h3>
        <p class="text-muted mb-0">Atur margin keuntungan dari harga modal perusahaan.</p>
    </div>

    {{-- Filter Kategori --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.joc.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label class="fw-bold">Filter Layanan:</label>
                    </div>
                    <div class="col-md-4">
                        <select name="service_id" class="form-select" onchange="this.form.submit()">
                            <option value="all">Semua Layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->service_id }}" {{ request('service_id') == $service->service_id ? 'selected' : '' }}>
                                    {{ $service->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel JOC --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th>Produk</th>
                        <th class="text-end">Harga Modal (HPP)</th>
                        <th style="width: 150px;">Margin (%)</th>
                        <th class="text-end">Profit (Rp)</th>
                        <th class="text-end bg-primary text-white">Harga Jual Final</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="fw-bold">{{ $product->nama_produk }} <br> <small class="text-muted">{{ $product->service->nama_layanan }}</small></td>

                        <td class="text-end">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>

                        {{-- Form Update Margin --}}
                        <td>
                            <form action="{{ route('admin.joc.update', $product->product_id) }}" method="POST" class="d-flex">
                                @csrf @method('PUT')
                                <input type="number" name="profit_margin" class="form-control form-control-sm text-center fw-bold" value="{{ $product->profit_margin }}" min="0">
                        </td>

                        <td class="text-end text-success">
                            + Rp {{ number_format($product->base_price * ($product->profit_margin / 100), 0, ',', '.') }}
                        </td>

                        <td class="text-end fw-bold fs-5 bg-light text-primary">
                            {{-- Ini pakai accessor yang kita buat tadi --}}
                            {{ $product->formatted_price }}
                        </td>

                        <td class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" title="Simpan Perubahan">
                                    <i class="bi bi-check-lg"></i> Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
