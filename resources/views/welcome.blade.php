@extends('layouts.app')

@section('title', 'Beranda — Arya Advertising')

@push('styles')
<style>
    /* =============================
       HERO SECTION (Updated)
       ============================= */
    .hero-image-wrapper {
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
        margin-top: -80px; /* Kompensasi navbar */
        padding-top: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-slideshow { position: absolute; inset: 0; z-index: 0; }
    
    .hero-slide {
        position: absolute; inset: 0; width: 100%; height: 100%;
        object-fit: cover; object-position: center;
        opacity: 0; transition: opacity 1.5s ease-in-out;
        filter: brightness(0.45);
    }
    .hero-slide.active { opacity: 1; }

    .hero-content {
        position: relative; z-index: 2; text-align: center;
        color: #fff; max-width: 900px; width: 100%; padding: 0 20px;
    }

    .hero-content h1 {
        font-size: 3.5rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: 2px; text-shadow: 0 4px 15px rgba(0,0,0,0.6);
    }
    .hero-content .highlight { color: var(--primary); }

    /* =============================
       TRUST PILLARS (ICON GRID)
       ============================= */
    .trust-card {
        background: #ffffff; padding: 30px 20px; border-radius: 16px;
        text-align: center; height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-bottom: 4px solid var(--primary);
        transition: all 0.3s ease;
    }
    .trust-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-bottom-color: var(--accent);
    }
    .trust-card i {
        font-size: 3rem; color: var(--primary-dark);
        margin-bottom: 15px; display: inline-block; transition: 0.3s;
    }
    .trust-card:hover i { transform: scale(1.1); color: var(--accent); }
    .trust-card h6 { font-weight: 700; color: var(--dark); margin: 0; font-size: 1.1rem; }

    /* =============================
       PRODUK UNGGULAN
       ============================= */
    .products-preview { padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e8f4f8 100%); }
    .products-preview h2 { font-size: 2.5rem; font-weight: 800; color: var(--dark); margin-bottom: 20px; text-align: center; }
    .products-preview h2 .highlight { color: var(--primary-dark); }
    .products-preview .subtitle { text-align: center; color: var(--muted); font-size: 1.1rem; margin-bottom: 60px; }
    
    .products-scroll {
        display: flex; gap: 28px; overflow-x: auto; padding-bottom: 10px;
        scroll-behavior: smooth; scrollbar-width: none;
    }
    .products-scroll::-webkit-scrollbar { display: none; }
    .product-scroll-item { flex: 0 0 auto; width: 320px; }

    .product-card {
        background: #ffffff; border-radius: 20px; overflow: hidden;
        cursor: pointer; height: 100%; border: 2px solid transparent;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06); transition: all 0.35s ease;
    }
    .product-card:hover { transform: translateY(-8px); border-color: var(--primary); box-shadow: 0 20px 50px rgba(70,130,169,0.15); }
    
    .product-card .img-wrapper {
        height: 220px; overflow: hidden;
        background: linear-gradient(135deg, var(--primary-dark), var(--accent));
    }
    .product-card .img-wrapper img {
        width: 100%; height: 100%; object-fit: cover;
        transition: all 0.5s ease; opacity: 0.9;
    }
    .product-card:hover .img-wrapper img { transform: scale(1.1); opacity: 1; }
    
    .product-card .content { padding: 24px; }
    .product-card .content h5 { font-size: 1.2rem; font-weight: 700; color: var(--dark); margin-bottom: 12px; }
    .product-card .content .price { font-size: 1.3rem; font-weight: 800; color: var(--accent); margin-bottom: 12px; }
    .product-card .content .price small { font-size: 0.8rem; font-weight: 500; color: var(--muted); }
    .product-card .content p { color: var(--muted); font-size: 0.9rem; line-height: 1.6; }

    @media (max-width: 768px) {
        .product-scroll-item { width: 260px; }
        .products-preview h2 { font-size: 2rem; }
    }


    /* =============================
       PARTNER SLIDER
       ============================= */
    .partner-wrap { overflow: hidden; white-space: nowrap; padding: 50px 0; background: #ffffff; position: relative; }
    .partner-wrap::before, .partner-wrap::after {
        content: ""; position: absolute; top: 0; width: 150px; height: 100%; z-index: 2;
    }
    .partner-wrap::before { left: 0; background: linear-gradient(to right, #fff, transparent); }
    .partner-wrap::after { right: 0; background: linear-gradient(to left, #fff, transparent); }
    
    .partner-track { display: inline-block; animation: scrollPartner 35s linear infinite; }
    .partner-item { display: inline-block; width: 180px; margin: 0 40px; vertical-align: middle; }
    .partner-item img {
        width: 100%; height: auto; opacity: 1; filter: none; transition: 0.3s;
    }
    .partner-item:hover img { transform: scale(1.1); }
    @keyframes scrollPartner { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* =============================
       TESTIMONI SLIDER (NEW)
       ============================= */
    .testimoni-section { 
        padding: 80px 0; 
        background-color: #ffffff; 
        position: relative;
    }
    .testimoni-scroll {
        display: flex; 
        gap: 24px; 
        overflow-x: auto; 
        padding: 20px 5px;
        scroll-behavior: smooth; 
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE 10+ */
    }
    .testimoni-scroll::-webkit-scrollbar { display: none; /* Chrome/Safari */ }
    
    .testimoni-item { 
        flex: 0 0 auto; 
        width: 350px; 
    }
    
    .testimoni-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }
    
    .testimoni-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }

    .testimoni-stars {
        color: #ffc107;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .testimoni-text {
        font-style: italic;
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .client-info {
        display: flex;
        align-items: center;
        gap: 15px;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .client-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--primary-light);
        color: var(--primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .client-details h6 {
        margin: 0;
        font-weight: 700;
        color: var(--dark);
    }

    .client-details small {
        color: var(--muted);
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        .testimoni-item { width: 280px; }
    }

    /* FAQ SECTION */
    .faq-section { background: linear-gradient(135deg, var(--bg), #eef); }
    .faq-header {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        padding: 20px;
        font-weight: 600;
        color: var(--dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .faq-header:focus { box-shadow: none; }
    .faq-header:not(.collapsed) {
        color: var(--primary-dark);
        background-color: #f1f8fc;
    }
    .faq-body {
        padding: 0 20px 20px 20px;
        color: var(--muted);
        line-height: 1.6;
    }
    .accordion-item {
        border: 1px solid #eee;
        border-radius: 10px !important;
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    /* --- TEAM CARD STYLES (ORGANIZATION) --- */
    /* A. LEADER CARD (STYLE TETAP - JANGAN UBAH) */
    .leader-card {
        background: #fff;
        border-radius: 16px; 
        overflow: hidden;
        position: relative;
        transition: all 0.4s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
        display: flex; flex-direction: column;
    }
    .leader-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(145, 200, 228, 0.3);
    }
    /* Wrapper Foto */
    .leader-img-box {
        height: 280px; 
        width: 100%;
        overflow: hidden;
        position: relative;
        background: #e2e8f0; 
    }
    /* FIX WAJAH: object-position center 20% agar tidak ambil langit-langit */
    .leader-img-box img {
        width: 100%; height: 100%; object-fit: cover;
        object-position: center 20%; 
        transition: transform 0.5s ease;
    }
    .leader-card:hover .leader-img-box img { transform: scale(1.08); }
    /* Gradasi Putih Tipis di Bawah */
    .leader-img-box::after {
        content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 20%; 
        background: linear-gradient(to top, #ffffff 10%, transparent 100%); pointer-events: none;
    }
    .leader-info {
        padding: 20px; text-align: center; background: #fff; flex-grow: 1;
        display: flex; flex-direction: column; align-items: center;
    }
    .leader-role {
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        color: var(--primary); background: rgba(145, 200, 228, 0.1);
        padding: 6px 14px; border-radius: 50px; margin-bottom: 10px; display: inline-block;
    }
    .leader-name { font-size: 1.15rem; font-weight: 800; color: #1e293b; margin: 0; line-height: 1.4; }
    /* Garis Bawah Aksen */
    .leader-card::before {
        content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px;
        background: var(--primary); transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease;
    }
    .leader-card:hover::before { transform: scaleX(1); }
    
    /* B. ADMIN CARD (Kartu Menengah - Style Baru Vertikal) */
    .admin-card {
        background: #fff; padding: 25px; border-radius: 16px; text-align: center;
        border: 1px solid #f1f5f9; box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        transition: all 0.3s; height: 100%; position: relative; overflow: hidden;
    }
    .admin-card:hover {
        transform: translateY(-5px); border-color: #f59e0b; /* Warna Oranye */
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.1);
    }
    .admin-img {
        width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
        margin-bottom: 15px; border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        object-position: center 20%; 
    }
</style>
@endpush

@section('content')

    {{-- HERO HEADER (SLIDESHOW) --}}
    <div id="home" class="hero-image-wrapper">
        <div class="hero-slideshow">
            <img src="{{ asset('images/team/all.png') }}" class="hero-slide active">
            <img src="{{ asset('images/baliho.png') }}" class="hero-slide">
            <img src="{{ asset('images/EO.png') }}" class="hero-slide">
        </div>
        <div class="hero-content" data-aos="zoom-in">
            <h1>Percetakan & <span class="highlight">Advertising</span></h1>
            <p class="fs-4">Solusi Branding Terlengkap Sejak 2001</p>
            <div class="mt-4">
                <a href="#produk" class="btn btn-primary-custom btn-lg px-5 py-3">Lihat Produk</a>
            </div>
        </div>
    </div>

    {{-- 2. TENTANG KAMI & TRUST PILLARS --}}
    <section id="profile" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 style="color: var(--dark); font-weight:800;">Mengapa <span style="color: var(--primary-dark);"> Memilih Kami</span></h2>
                <p class="lead text-muted">Berpengalaman lebih dari 20 tahun melayani kebutuhan promosi Anda.</p>
            </div>
            
            {{-- PILAR DENGAN ICON --}}
            <div class="row g-4 justify-content-center">
                @php
                    $pillars = [
                        ['icon' => 'bi-emoji-smile', 'title' => 'Pelayanan Baik'],
                        ['icon' => 'bi-chat-dots', 'title' => 'Komunikasi Aktif'],
                        ['icon' => 'bi-award', 'title' => 'Kualitas Tinggi'],
                        ['icon' => 'bi-check-circle', 'title' => 'Produksi Rapi'],
                        ['icon' => 'bi-clock', 'title' => 'Tepat Waktu'],
                        ['icon' => 'bi-lightbulb', 'title' => 'Kreatif'],
                        ['icon' => 'bi-rocket', 'title' => 'Inovatif'],
                    ];
                @endphp
                @foreach($pillars as $index => $p)
                <div class="col-lg-3 col-md-4 col-6" data-aos="flip-left" data-aos-delay="{{ $index * 100 }}">
                    <div class="trust-card">
                        <i class="bi {{ $p['icon'] }}"></i>
                        <h6 class="fw-bold">{{ $p['title'] }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. PRODUK UNGGULAN --}}
    <section id="produk" class="products-preview">
        <div class="container py-5">
            <h2 data-aos="fade-down" data-aos-duration="1000"><span class="highlight">Produk</span> Unggulan Kami</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="200">Beberapa produk dan layanan terpopuler dengan kualitas terbaik</p>

            <div class="products-scroll">
                @forelse($featuredProducts as $product)
                    <div class="product-scroll-item" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                        <div class="product-card" onclick="window.location.href='{{ route('produk.detail', $product->product_id) }}'">
                            <div class="img-wrapper">
                                <img src="{{ $product->image_url ?? asset('images/default-product.png') }}" alt="{{ $product->nama_produk }}">
                            </div>
                            <div class="content">
                                <h5>{{ $product->nama_produk }}</h5>
                                <div class="price">
                                    @if($product->base_price > 0)
                                        {{ $product->formatted_price }} <small>/{{ $product->unit_type }}</small>
                                    @else
                                        <span class="text-success"><i class="bi bi-whatsapp"></i> Hubungi Admin</span>
                                    @endif
                                </div>
                                <p>{{ \Illuminate\Support\Str::limit($product->description ?? $product->service->nama_layanan, 80) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted w-100" data-aos="fade-in">Belum ada produk unggulan.</p>
                @endforelse
            </div>

            <div class="text-center mt-5" data-aos="zoom-in" data-aos-delay="300">
                <a href="{{ route('produk.layanan') }}" class="btn btn-accent btn-lg px-5 shadow">Lihat Semua Produk & Layanan</a>
            </div>
        </div>
    </section>

    {{-- 8. PARTNER LOGO --}}
    <section class="py-5 bg-white border-top">
        <div class="container">
            <h4 class="text-center fw-bold text-muted mb-4">MITRA & KLIEN KAMI</h4>
            <div class="partner-wrap">
                <div class="partner-track">
                    @for($i=0; $i<2; $i++)
                        @foreach($partners as $partner)
                        <div class="partner-item">
                            <img src="{{ $partner->logo_url }}" alt="Partner">
                        </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION: TESTIMONI KLIEN --}}
    <section class="testimoni-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 style="color: var(--dark); font-weight:800;">Apa Kata <span style="color: var(--primary-dark);">Mereka?</span></h2>
                <p class="lead text-muted">Pengalaman klien yang telah bekerjasama dengan kami.</p>
            </div>

            <div class="testimoni-scroll">
                @foreach($testimonials as $testi)
                <div class="testimoni-item" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="testimoni-card">
                        <div class="testimoni-stars">
                            @for($i = 0; $i < $testi->rating; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <p class="testimoni-text">"{{ $testi->content }}"</p>
                        <div class="client-info">
                            <div class="client-avatar">{{ $testi->initial }}</div>
                            <div class="client-details">
                                <h6>{{ $testi->name }}</h6>
                                <small>{{ $testi->role }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    
    {{-- 9. FAQ & CONTACT --}}
    <section id="contact" class="faq-section py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                {{-- FAQ --}}
                <div class="col-lg-8 mb-5">
                    <div class="text-center mb-5" data-aos="fade-up">
                        <h2 style="color: var(--dark); font-weight:800;">Pertanyaan <span style="color: var(--primary-dark);">Umum</span> (FAQ)</h2>
                        <p class="lead text-muted">Informasi singkat mengenai layanan kami.</p>
                    </div>

                    <div class="accordion accordion-flush" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button faq-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Q: Layanan apa saja yang tersedia di Arya Advertising?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body faq-body">
                                    A: Kami menyediakan jasa branding, percetakan, pembuatan booth event, neon box, rak display, serta furniture custom sesuai kebutuhan promosi bisnis.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button faq-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Q: Apakah bisa custom desain sesuai permintaan?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body faq-body">
                                    A: Ya, kami melayani desain dan produksi sesuai brief serta kebutuhan spesifik klien. Tim desain kami siap membantu mewujudkan ide visual Anda.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button faq-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Q: Apakah Arya Advertising hanya melayani perusahaan besar?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body faq-body">
                                    A: Tidak, kami melayani berbagai jenis klien, mulai dari UMKM, event organizer, hingga brand nasional. Setiap klien mendapatkan prioritas pelayanan yang sama.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTACT --}}
            <div class="text-center py-5 contact" style="background: var(--dark); color: white; border-radius: 16px;">
                <h2 class="mb-4" data-aos="zoom-in">Siap Meningkatkan Bisnis Anda?</h2>
                <div class="row justify-content-center g-4">
                    <div class="col-md-3">
                        <div class="p-4 border border-secondary rounded">
                            <i class="bi bi-whatsapp fs-1 text-success mb-3"></i>
                            <h5>WhatsApp</h5>
                            <a href="https://wa.me/6282160762279" class="text-white text-decoration-none">0821 6076 2279</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 border border-secondary rounded">
                            <i class="bi bi-envelope fs-1 text-warning mb-3"></i>
                            <h5>Email</h5>
                            <a href="mailto:aryaadvertising1@gmail.com" class="text-white text-decoration-none">Kirim Email</a>
                        </div>
                    </div>
                </div>
                <div class="mt-5 rounded overflow-hidden px-4 pb-4" data-aos="fade-up">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3002.2370766967156!2d98.7092175!3d3.5315155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30313a825e2d1837%3A0xd2c34a8985900261!2sArya%20Advertising!5e1!3m2!1sid!2sid!4v1762503236118!5m2!1sid!2sid" width="100%" height="400" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Efek Slideshow Hero
        const slides = document.querySelectorAll('.hero-slide');
        let index = 0;
        setInterval(() => {
            if(slides.length > 0) {
                slides[index].classList.remove('active');
                index = (index + 1) % slides.length;
                slides[index].classList.add('active');
            }
        }, 4000);

        // Initialize AOS Animation
        AOS.init({ 
            duration: 1000, 
            once: true,
            offset: 100
        });
    });
</script>
@endpush