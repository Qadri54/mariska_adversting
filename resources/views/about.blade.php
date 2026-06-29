@extends('layouts.app')

@section('title', 'Tentang Kami — Arya Advertising')

@push('styles')
<style>
    /* --- 1. HERO HEADER STYLE --- */
    .about-hero {
        position: relative;
        height: 60vh;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%);
        display: flex; align-items: center; justify-content: center; text-align: center;
        color: white; margin-top: -80px; padding-top: 80px; overflow: hidden;
    }
    .about-hero::before {
        content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
        animation: pulse 8s ease-in-out infinite;
    }
    @keyframes pulse { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; } }
    .about-hero h1 { font-size: 3.5rem; font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
    .about-hero p { font-size: 1.25rem; font-weight: 300; }

    /* --- 2. GENERAL SECTION STYLE --- */
    .section-title { position: relative; display: inline-block; margin-bottom: 1rem; }
    .section-title::after {
        content: ""; position: absolute; bottom: -8px; left: 0; width: 60px; height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent)); border-radius: 2px;
    }
    .quote-box {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-left: 5px solid var(--primary);
        padding: 1.5rem; border-radius: 12px; margin-top: 2rem;
    }

    /* --- 3. TEAM CARD STYLES --- */
    
    /* A. LEADER CARD (STYLE BARU: BULAT & CLEAN) */
    .leader-card {
        background: transparent; /* Hilangkan kotak putih */
        border: none;
        box-shadow: none;
        text-align: center;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .leader-card:hover {
        transform: translateY(-10px); /* Efek naik dikit pas hover */
    }

    /* Wrapper Foto Bulat */
    .leader-img-box {
        width: 200px; /* Ukuran Lingkaran */
        height: 200px;
        border-radius: 50%; /* Membuat Bulat */
        overflow: hidden;
        margin: 0 auto 20px; /* Posisi Center */
        border: 5px solid #fff; /* List Putih */
        box-shadow: 0 10px 25px rgba(0,0,0,0.15); /* Bayangan foto */
        position: relative;
        background: #e2e8f0;
    }

    .leader-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top; /* Fokus ke wajah bagian atas */
        transition: transform 0.5s ease;
    }

    .leader-card:hover .leader-img-box img { transform: scale(1.1); }

    .leader-info {
        padding: 0 10px;
    }

    /* Jabatan */
    .leader-role {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        display: block;
        margin-bottom: 5px;
    }

    /* Nama */
    .leader-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Garis Penghubung Hirarki */
    .hierarchy-connector {
        width: 2px;
        height: 40px;
        background-color: #cbd5e1;
        margin: 0 auto;
    }
    
    /* B. ADMIN & STAFF CARD (GRID BIASA - KOTAK) */
    .admin-card {
        background: #fff; padding: 25px; border-radius: 16px; text-align: center;
        border: 1px solid #f1f5f9; box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        transition: all 0.3s; height: 100%; position: relative; overflow: hidden;
    }
    .admin-card:hover {
        transform: translateY(-5px); border-color: #f59e0b;
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.1);
    }
    .admin-img {
        width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
        margin-bottom: 15px; border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        object-position: center 20%; 
    }

    /* --- 4. OTHER SECTIONS --- */
    .company-photo-wrapper { position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); transition: transform 0.3s ease; }
    .company-photo-wrapper:hover { transform: translateY(-10px); }
    .company-photo-wrapper img { width: 100%; height: auto; display: block; }
    .photo-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); color: white; }
    
    .trust-section { background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); }
    .trust-item { background: white; padding: 2rem 1.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); height: 100%; border-top: 4px solid transparent; transition: all 0.3s ease; position: relative; overflow: hidden; }
    .trust-item::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--primary), var(--accent)); transform: scaleX(0); transition: transform 0.3s ease; }
    .trust-item:hover { transform: translateY(-8px); box-shadow: 0 12px 35px rgba(0,0,0,0.15); }
    .trust-item:hover::before { transform: scaleX(1); }
    .trust-icon { width: 70px; height: 70px; background: linear-gradient(135deg, var(--primary-dark), var(--primary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 2rem; color: white; transition: transform 0.3s ease; }
    .trust-item:hover .trust-icon { transform: rotate(360deg); }

    .service-box { background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.1); height: 100%; border: 2px solid #f1f5f9; transition: all 0.3s ease; position: relative; overflow: hidden; }
    .service-box::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--primary), var(--accent)); }
    .service-box:hover { border-color: var(--primary); transform: translateY(-5px); box-shadow: 0 15px 45px rgba(0,0,0,0.15); }
    .service-box h4 { font-size: 1.5rem; margin-bottom: 1.5rem; font-weight: 700; }
    .service-list-item { padding: 0.75rem 0; border-bottom: 1px solid #e2e8f0; font-size: 1rem; color: #475569; display: flex; align-items: center; transition: all 0.2s ease; }
    .service-list-item:last-child { border-bottom: none; }
    .service-list-item:hover { color: var(--primary); padding-left: 10px; }
    .service-list-item i { color: var(--primary); margin-right: 12px; font-size: 1.2rem; font-weight: bold; }

    .partner-section { background: #ffffff; padding: 50px 0; }
    .partner-wrap { overflow: hidden; white-space: nowrap; position: relative; }
    .partner-wrap::before, .partner-wrap::after { content: ""; position: absolute; top: 0; width: 150px; height: 100%; z-index: 2; }
    .partner-wrap::before { left: 0; background: linear-gradient(to right, #fff, transparent); }
    .partner-wrap::after { right: 0; background: linear-gradient(to left, #fff, transparent); }
    .partner-track { display: inline-block; animation: scrollPartner 35s linear infinite; }
    .partner-item { display: inline-block; width: 180px; margin: 0 40px; vertical-align: middle; }
    .partner-item img { width: 100%; height: auto; transition: 0.3s; }
    @keyframes scrollPartner { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    .contact-item { display: flex; align-items: flex-start; margin-bottom: 2rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; transition: all 0.3s ease; }
    .contact-item:hover { background: white; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transform: translateX(10px); }
    .contact-icon { width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1.5rem; flex-shrink: 0; color: white; font-size: 1.5rem; }
    .map-wrapper { border-radius: 16px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.15); }
    
    /* Responsive */
    @media (max-width: 768px) {
        .about-hero { height: 50vh; }
        .about-hero h1 { font-size: 2rem; }
        .leader-img-box { width: 160px; height: 160px; } /* Kecilkan dikit di HP */
    }
</style>
@endpush

@section('content')

    {{-- 1. HERO SECTION --}}
    <header class="about-hero">
        <div class="container" data-aos="zoom-in">
            <h1 class="display-3 fw-bold">Profil Perusahaan</h1>
            <p class="fs-5">Percetakan & Periklanan Terpercaya Sejak 2001</p>
        </div>
    </header>
    
    
    {{-- 2. COMPANY PHOTO --}}
    <section class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold section-title">Keluarga Besar <span style="color: var(--primary);">Arya Advertising</span></h2>
                <p class="text-muted fs-5 mt-3">Bersinergi memberikan layanan terbaik untuk kesuksesan bisnis Anda</p>
            </div>
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="col-lg-10">
                    <div class="company-photo-wrapper shadow-lg rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset('images/team/all.png') }}" alt="Keluarga Besar Arya Advertising" class="w-100 d-block" onerror="this.src='https://via.placeholder.com/1200x600?text=Tim+Arya+Advertising'">
                        <div class="photo-overlay position-absolute bottom-0 start-0 w-100 p-4 text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                            <h4 class="fw-bold mb-0">Tim Profesional Arya Advertising</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
     {{-- 3. PROFIL PERUSAHAAN --}}
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <img src="{{ asset('images/team/all.png') }}" class="img-fluid rounded-4" alt="Kantor Arya Advertising" onerror="this.src='https://via.placeholder.com/600x800?text=Arya+Office'">
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <h4 class="text-primary fw-bold text-uppercase mb-3">Tentang Kami</h4>
                    <h2 class="fw-bold mb-4 display-6">Lebih dari 20 Tahun Melayani dengan Dedikasi</h2>
                    <p class="text-muted" style="text-align: justify; line-height: 1.8;">
                        <strong>ARYA ADVERTISING</strong> didirikan pada <strong>18 Mei 2001</strong>. Kantor pusat kami berlokasi di Jl. Bajak II H No.114 H, Harjosari II, Kec. Medan Amplas, Kota Medan.
                    </p>
                    <div class="p-4 bg-light rounded-3 border-start border-5 border-primary mt-4">
                        <p class="mb-0 fw-bold fst-italic text-dark">
                            "Kepuasan pelanggan adalah prioritas utama kami melalui pelayanan yang cepat, tepat, dan berkualitas tinggi."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
     {{-- 4. 7 LANGKAH TRUST --}}
    <section class="py-5 trust-section">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold section-title">7 Langkah Menciptakan <span style="color: var(--primary);">TRUST</span></h2>
                <p class="text-muted fs-5 mt-3">Prinsip kerja yang menjadi fondasi kepercayaan klien kepada kami</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100"><div class="trust-item"><div class="trust-icon"><i class="bi bi-emoji-smile"></i></div><h5 class="fw-bold text-center">Pelayanan Yang Baik</h5><p class="text-muted text-center small mb-0">Ramah, responsif, dan siap membantu setiap kebutuhan Anda</p></div></div>
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150"><div class="trust-item"><div class="trust-icon"><i class="bi bi-chat-dots"></i></div><h5 class="fw-bold text-center">Membangun Komunikasi</h5><p class="text-muted text-center small mb-0">Komunikasi efektif untuk hasil yang sesuai harapan</p></div></div>
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200"><div class="trust-item"><div class="trust-icon"><i class="bi bi-award"></i></div><h5 class="fw-bold text-center">Produksi Berkualitas</h5><p class="text-muted text-center small mb-0">Material premium dan teknologi terkini</p></div></div>
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250"><div class="trust-item"><div class="trust-icon"><i class="bi bi-check-circle"></i></div><h5 class="fw-bold text-center">Produksi Yang Rapi</h5><p class="text-muted text-center small mb-0">Finishing detail dan presisi di setiap produk</p></div></div>
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300"><div class="trust-item"><div class="trust-icon"><i class="bi bi-clock-history"></i></div><h5 class="fw-bold text-center">Tepat Waktu</h5><p class="text-muted text-center small mb-0">Komitmen deadline yang dapat diandalkan</p></div></div>
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350"><div class="trust-item"><div class="trust-icon"><i class="bi bi-lightbulb"></i></div><h5 class="fw-bold text-center">Kreatif</h5><p class="text-muted text-center small mb-0">Ide segar dan desain yang eye-catching</p></div></div>
<div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400"><div class="trust-item"><div class="trust-icon"><i class="bi bi-rocket-takeoff"></i></div><h5 class="fw-bold text-center">Inovatif</h5><p class="text-muted text-center small mb-0">Selalu mengikuti tren dan teknologi terbaru</p></div></div>
            </div>
        </div>
    </section>
    
    

   
    
     {{-- 5. LAYANAN & PRODUK --}}
    <section class="py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold section-title">Layanan & <span style="color: var(--primary);">Produk Kami</span></h2>
                <p class="text-muted fs-5 mt-3">Solusi lengkap untuk kebutuhan branding dan promosi bisnis Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right"><div class="service-box"><h4><i class="bi bi-printer me-2 text-primary"></i>Produk Percetakan</h4><ul class="list-unstyled mb-0"><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Spanduk & Umbul-Umbul</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Vertical Banner & Giant Banner</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Branding Mobil & Branding Venue</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Branding Outlet</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Rak Display & Thinplate</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Shop Panel & Letter Timbul</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Brosur, Poster, & Kartu Nama</li></ul></div></div>
                <div class="col-lg-6" data-aos="fade-left"><div class="service-box"><h4><i class="bi bi-megaphone me-2" style="color: var(--accent);"></i>Layanan Periklanan</h4><ul class="list-unstyled mb-0"><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Billboard</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Baliho</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Neon Box</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Neon Sign</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Shop Sign</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Vertical Banner</li><li class="service-list-item"><i class="bi bi-check-circle-fill"></i> Umbul-Umbul</li></ul></div></div>
            </div>
        </div>
    </section>

    {{-- 4. STRUKTUR ORGANISASI --}}
    <section class="py-5" style="background: linear-gradient(180deg, #f1f5f9 0%, #fff 100%);">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">OUR PROFESSIONAL TEAM</span>
                <h2 class="fw-bold display-5">Meet Our Team</h2>
                <p class="text-muted fs-5">Struktur Team Arya Advertising</p>
            </div>

            @php
                // === A. HIRARKI PIMPINAN (PIRAMIDA) ===
                $leaders_top = [
                    ['nama' => 'M.Hasan Pulungan', 'jabatan' => 'Direktur Utama', 'img' => 'hasan.png']
                ];
                $leaders_mid = [
                    ['nama' => 'Rizqi Aryahafiz Pulungan', 'jabatan' => 'Marketing Director', 'img' => 'RIZQI.png']
                ];
                $leaders_bot = [
                    ['nama' => 'Nurmaida Hasibuan', 'jabatan' => 'Kepala Divisi Keuangan', 'img' => 'NURMAIDA.png'],
                    ['nama' => 'Khairul Saleh Situmorang S.H', 'jabatan' => 'Kepala Divisi Umum', 'img' => 'KHAIRUL.png'],
                    ['nama' => 'Alfi R. Situmorang', 'jabatan' => 'HRD (Human Resources)', 'img' => 'ALFI.png']
                ];

                // === B. STAFF LAINNYA (DIPISAH 3 KELOMPOK) ===
                
                // 1. ADMIN & PROJECT
                $admin_project = [
                    ['nama' => 'Reza Ardiansyah Saragih', 'jabatan' => 'Project Officer', 'img' => 'REZA.png'],
                    ['nama' => 'Rike Fadilah Pratiwi', 'jabatan' => 'Admin Penagihan', 'img' => 'RIKE.png'],
                    ['nama' => 'Fitri Rezeki Amiriani S.T.', 'jabatan' => 'Admin Inventaris', 'img' => 'FITRI.png'],
                    ['nama' => 'Ismawati', 'jabatan' => 'Logistic', 'img' => 'ISMAWATI.png'],
                ];

                // 2. TIM WORKSHOP
                $workshop = [
                    ['nama' => 'Yudo Baskoro', 'jabatan' => 'Workshop Team', 'img' => 'YUDO.png'],
                    ['nama' => 'Amri Hasibuan', 'jabatan' => 'Workshop Team', 'img' => 'AMRI.png'],
                    ['nama' => 'Dika Atmaja', 'jabatan' => 'Workshop Team', 'img' => 'DIKA.png'],
                    ['nama' => 'Edi Irwanto', 'jabatan' => 'Workshop Team', 'img' => 'EDI_IRWANTO.png'],
                    ['nama' => 'Edi Prayetno', 'jabatan' => 'Workshop Team', 'img' => 'EDI_PRAYETNO.png'],
                    ['nama' => 'Firman Prianto', 'jabatan' => 'Workshop Team', 'img' => 'FIRMAN.png'],
                ];

                // 3. SECURITY & OB
                $support = [
                    ['nama' => 'Misnan', 'jabatan' => 'Security', 'img' => 'MISNAN.png'],
                    ['nama' => 'Ramlan', 'jabatan' => 'Office Boy', 'img' => 'RAMLAN.png'],
                ];
            @endphp

            {{-- --- BAGIAN 1: LEADERS (PIRAMIDA - FOTO BULAT) --- --}}
            
            {{-- LEVEL 1: DIREKTUR --}}
            <div class="row justify-content-center" data-aos="fade-up">
                @foreach($leaders_top as $l)
                <div class="col-lg-3 col-md-6">
                    <div class="leader-card">
                        <div class="leader-img-box">
                            <img src="{{ asset('images/team/' . $l['img']) }}" 
                                 alt="{{ $l['nama'] }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Direktur&background=0D8ABC&color=fff&size=500&font-size=0.35'">
                        </div>
                        <div class="leader-info">
                            <span class="leader-role">{{ $l['jabatan'] }}</span>
                            <h5 class="leader-name">{{ $l['nama'] }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row justify-content-center"><div class="col-auto"><div class="hierarchy-connector"></div></div></div>

            {{-- LEVEL 2: MARKETING DIRECTOR --}}
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                @foreach($leaders_mid as $l)
                <div class="col-lg-3 col-md-6">
                    <div class="leader-card">
                        <div class="leader-img-box">
                            <img src="{{ asset('images/team/' . $l['img']) }}" 
                                 alt="{{ $l['nama'] }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($l['nama']) }}&background=0D8ABC&color=fff&size=500&font-size=0.35'">
                        </div>
                        <div class="leader-info">
                            <span class="leader-role">{{ $l['jabatan'] }}</span>
                            <h5 class="leader-name">{{ $l['nama'] }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row justify-content-center"><div class="col-auto"><div class="hierarchy-connector"></div></div></div>

            {{-- LEVEL 3: 3 KEPALA DIVISI --}}
            <div class="row justify-content-center g-4 mb-5" data-aos="fade-up" data-aos-delay="200">
                @foreach($leaders_bot as $l)
                <div class="col-lg-3 col-md-6">
                    <div class="leader-card">
                        <div class="leader-img-box">
                            <img src="{{ asset('images/team/' . $l['img']) }}" 
                                 alt="{{ $l['nama'] }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($l['nama']) }}&background=0D8ABC&color=fff&size=500&font-size=0.35'">
                        </div>
                        <div class="leader-info">
                            <span class="leader-role">{{ $l['jabatan'] }}</span>
                            <h5 class="leader-name">{{ $l['nama'] }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- DIVIDER --}}
            <div class="row justify-content-center mb-5 mt-5"><div class="col-8 border-top"></div></div>

            {{-- === BAGIAN 2: ADMINISTRASI & PROJECT (GRID KOTAK) === --}}
            <div class="text-center mb-4" data-aos="fade-up">
                <h4 class="fw-bold text-muted">Administrasi & Project</h4>
            </div>
            <div class="row justify-content-center g-4 mb-5">
                @foreach($admin_project as $staff)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="admin-card">
                        <img src="{{ asset('images/team/' . $staff['img']) }}" class="admin-img" alt="{{ $staff['nama'] }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($staff['nama']) }}&background=f59e0b&color=fff'">
                        <h6 class="fw-bold mb-1 text-dark">{{ $staff['nama'] }}</h6>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">{{ $staff['jabatan'] }}</small>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- === BAGIAN 3: WORKSHOP & OPERASIONAL (GRID KOTAK) === --}}
            <div class="text-center mb-4" data-aos="fade-up">
                <h4 class="fw-bold text-muted">Tim Workshop & Produksi</h4>
            </div>
            <div class="row justify-content-center g-4 mb-5">
                @foreach($workshop as $op)
                <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="admin-card">
                        <img src="{{ asset('images/team/' . $op['img']) }}" class="admin-img" alt="{{ $op['nama'] }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($op['nama']) }}&background=22c55e&color=fff'">
                        <h6 class="fw-bold mb-1 text-dark" style="font-size: 0.85rem;">{{ $op['nama'] }}</h6>
                        <small class="text-success fw-bold" style="font-size: 0.65rem;">{{ $op['jabatan'] }}</small>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- === BAGIAN 4: SUPPORT & KEAMANAN (GRID KOTAK) === --}}
            <div class="text-center mb-4" data-aos="fade-up">
                <h4 class="fw-bold text-muted">Support & Keamanan</h4>
            </div>
            <div class="row justify-content-center g-4">
                @foreach($support as $sup)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="admin-card">
                        <img src="{{ asset('images/team/' . $sup['img']) }}" class="admin-img" alt="{{ $sup['nama'] }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($sup['nama']) }}&background=6c757d&color=fff'">
                        <h6 class="fw-bold mb-1 text-dark">{{ $sup['nama'] }}</h6>
                        <small class="text-muted fw-bold" style="font-size: 0.7rem;">{{ $sup['jabatan'] }}</small>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- 5. MITRA & KLIEN --}}
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container">
            <h4 class="text-center fw-bold text-muted mb-4">MITRA & KLIEN KAMI</h4>
            <div class="partner-wrap">
                <div class="partner-track">
                    @for($i=0; $i<2; $i++)
                        @foreach($partners as $partner)
                        <div class="partner-item">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                        </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </section>

    {{-- 6. HUBUNGI KAMI --}}
    <section class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold section-title">Hubungi <span style="color: var(--primary);">Kami</span></h2>
                <p class="text-muted fs-5 mt-3">Kami siap melayani kebutuhan percetakan dan periklanan Anda</p>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="contact-info">
                            <h5>Alamat Workshop</h5>
                            <p>Jl. Bajak II H Komplek ITM No.114H, Medan Amplas, Sumatera Utara</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-whatsapp"></i></div>
                        <div class="contact-info">
                            <h5>WhatsApp</h5>
                            <p><a href="https://wa.me/6282160762279" class="text-decoration-none">+62 821 6076 2279</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div class="contact-info">
                            <h5>Email</h5>
                            <p>aryaadvertising1@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.123456789012!2d98.705123!3d3.535123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMzInMDYuNCJOIDk4wrQ0MicyOC40IkU!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    AOS.init({ duration: 1000, once: true, offset: 100 });
</script>
@endpush