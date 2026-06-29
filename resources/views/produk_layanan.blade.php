{{-- BARIS PERTAMA LANGSUNG @extends. JANGAN ADA YANG LAIN DI ATASNYA --}}
@extends('layouts.app')

{{-- Set judul halaman --}}
@section('title', 'Kategori Produk & Layanan — Arya Advertising')

{{-- Kirim CSS khusus halaman ini ke layout --}}
@push('styles')
<style>
    /* PAGE HEADER */
    .page-header{background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);padding:120px 0 80px;position:relative;overflow:hidden;color:#fff}
    .page-header::before{content:'';position:absolute;top:-10%;right:-5%;width:400px;height:400px;background:rgba(255,255,255,0.05);border-radius:50%;z-index:0}
    .page-header .container{position:relative;z-index:1}
    .page-header h1{font-size:2.8rem;font-weight:800;margin-bottom:16px}
    .page-header p{font-size:1.1rem;opacity:0.95;max-width:700px;margin:0 auto}

    /* CATEGORY TABS */
    .category-tabs{margin-bottom:50px}
    .category-tabs .nav-pills{flex-wrap:wrap;justify-content:center}
    .category-tabs .nav-pills .nav-link{border-radius:30px;padding:12px 28px;margin:8px;font-weight:600;color:var(--muted);background:#fff;border:2px solid #e5e7eb;transition:all .3s}
    .category-tabs .nav-pills .nav-link:hover{border-color:var(--primary);color:var(--primary)}
    .category-tabs .nav-pills .nav-link.active{background:var(--accent);color:#fff;border-color:var(--accent);transform:translateY(-2px);box-shadow:0 4px 15px rgba(39,84,138,0.3)}

    /* CATEGORY LIST */
    .category-item{background:#fff;border-radius:16px;padding:20px;display:flex;align-items:center;gap:20px;transition:all .3s;cursor:pointer;border:2px solid #f0f0f0;margin-bottom:16px}
    .category-item:hover{background:#f8f9fa;border-color:var(--primary);transform:translateX(5px);box-shadow:0 8px 25px rgba(0,0,0,0.08)}
    .category-item .img-box{width:80px;height:80px;border-radius:12px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg, var(--primary-dark), var(--accent))}
    .category-item .img-box img{width:100%;height:100%;object-fit:cover}
    .category-item .info{flex-grow:1}
    .category-item .info h5{font-size:1.2rem;font-weight:700;color:var(--dark);margin-bottom:4px}
    .category-item .info .count{font-size:0.9rem;color:var(--muted)}
    .category-item .arrow{font-size:1.5rem;color:var(--muted)}
    .category-item .price {
        font-size: 0.9rem;
        color: var(--primary-dark);
        font-weight: 600;
        margin-top: 4px;
    }

    /* CSS Tambahan untuk Responsif */
    @media(max-width:991px){
      .page-header{padding:100px 0 60px}
      .page-header h1{font-size:2.2rem}
      .category-item{padding:16px}
      .category-item .img-box{width:60px;height:60px}
      .category-item .info h5{font-size:1.1rem}
    }
</style>
@endpush


{{-- Ini adalah konten utama halaman Anda --}}
@section('content')

    {{-- HEADER DENGAN ANIMASI ZOOM-IN --}}
    <header class="page-header"> 
      <div class="container text-center" data-aos="zoom-in" data-aos-duration="1000">
        <h1>Kategori Produk</h1>
        <p>Pilih kategori untuk melihat produk yang tersedia</p>
      </div>
    </header>

    <section class="category-section" style="padding: 80px 0;">
        <div class="container">

            @if(isset($services) && $services->count() > 0)

            <div class="category-tabs">

                {{-- Bagian TABS (Tombol Kategori) Dinamis DENGAN ANIMASI FADE UP --}}
                <ul class="nav nav-pills justify-content-center mb-5" id="categoryTabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
                    @foreach($services as $service)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="{{ Str::slug($service->nama_layanan) }}-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#{{ Str::slug($service->nama_layanan) }}"
                                    type="button"
                                    role="tab">
                                {{ $service->nama_layanan }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                {{-- Bagian KONTEN TABS (Daftar Produk) Dinamis --}}
                <div class="tab-content" id="categoryTabsContent">

                    @foreach($services as $service)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="{{ Str::slug($service->nama_layanan) }}"
                            role="tabpanel">

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto">

                                    @php
                                        // FIX 1: Pindahkan deklarasi di sini agar masuk scope layanan
                                        // ASUMSI: ID Produk Custom = 8, 9, 10 (Sesuaikan dengan Database Anda)
                                        $CUSTOM_CONSULT_IDS = [8, 9, 10];
                                    @endphp

                                    @forelse($service->products as $product)

                                        @php
                                            // FIX 2: Cek Custom Consultation
                                            $isCustomConsultation = in_array($product->product_id, $CUSTOM_CONSULT_IDS);
                                        @endphp

                                        {{-- LIST ITEM DENGAN ANIMASI FADE UP BERGANTIAN --}}
                                        <div class="category-item" 
                                             onclick="window.location.href='{{ url('/produk/' . $product->product_id) }}'"
                                             data-aos="fade-up" 
                                             data-aos-delay="{{ $loop->iteration * 100 }}">
                                             
                                            <div class="img-box">
                                                <img src="{{ $product->image_url ?? asset('images/default-product.png') }}" alt="{{ $product->nama_produk }}">
                                            </div>
                                            <div class="info">
                                                <h5>{{ $product->nama_produk }}</h5>
                                                <p class="count">{{ $service->nama_layanan }}</p>

                                                {{-- KONDISI HARGA: FIX DISINI --}}
                                                <div class="price">
                                                    @if($isCustomConsultation || $product->base_price == 0)
                                                        <span class="text-danger fw-bold">HUBUNGI UNTUK HARGA</span>
                                                    @else
                                                        Mulai 
                                                        <span class="fw-bold text-success">
                                                            Rp {{ number_format($product->base_price, 0, ',', '.') }}
                                                        </span>
                                                        /{{ $product->unit_type }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="arrow">›</div>
                                        </div>
                                    @empty
                                        <div class="text-center p-4" data-aos="fade-in">
                                            <p class="text-muted">Belum ada produk untuk kategori ini.</p>
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- TOMBOL HUBUNGI KAMI --}}
                <div class="text-center mt-5" data-aos="zoom-in" data-aos-delay="300">
                  <p class="text-muted">Punya pertanyaan tentang produk kami?</p>
                  <a href="{{ route('home') }}#contact" class="btn btn-accent btn-lg mt-3">Hubungi Kami</a>
                </div>

            </div>

            @else
            <div class="text-center py-5">
                <h4 class="text-muted">Belum Ada Kategori Produk</h4>
                <p class="text-muted">Silakan hubungi administrator untuk menambahkan produk.</p>
            </div>
            @endif

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Inisialisasi Ulang AOS Saat Tab Berubah
        // (Penting agar animasi jalan lagi saat pindah kategori)
        document.addEventListener('shown.bs.tab', function (e) {
            AOS.refresh();
        });
    </script>
@endpush