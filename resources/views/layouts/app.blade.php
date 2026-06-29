<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <title>@yield('title', 'Percetakan & Periklanan — Arya Advertising')</title>
    
    {{-- REVISI FAVICON: Fokus pada 1 gambar agar browser tidak bingung & tambah support untuk Apple/Mobile --}}
    <link rel="icon" type="image/png" href="{{ asset('images/arya.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/arya.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
      /* --- WARNA ASLI (TIDAK DIUBAH) --- */
      :root{
        --primary:#91C8E4;
        --primary-dark:#4682A9;
        --accent:#27548A;
        --accent-light:#F5EEDC;
        --muted:#6b7280;
        --bg:#f8f9fa;
        --dark:#0f1724;
      }
      
      *{box-sizing:border-box;margin:0;padding:0}
      
      body{
        font-family:'Poppins',sans-serif;
        background:var(--bg);
        color:#111;
        line-height:1.6;
        overflow-x:hidden;
      }
      
      a{text-decoration:none}

      /* ========================================
         PRELOADER ENHANCED
         ======================================== */
      #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%);
        z-index: 9999;
        transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
        display: flex;
        justify-content: center;
        align-items: center;
      }
      
      body.loaded #preloader {
        transform: translateY(-100%);
      }
      
      #preloader img {
        width: 300px;
        height: auto;
        animation: pulse 1.5s ease-in-out infinite;
      }
      
      @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
      }

      /* ========================================
         NAVBAR ENHANCED
         ======================================== */
      .navbar {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 20px 0;
        top: 0;
      }
      
      .navbar.scrolled {
        padding: 10px 0;
        box-shadow: 0 4px 30px rgba(0,0,0,0.15);
        background: rgba(255, 255, 255, 1);
      }
      
      /* LOGO DIPERBESAR */
      .navbar-brand {
        position: relative;
        display: flex;
        align-items: center;
      }
      
      .navbar-brand img {
        height: 160px !important;
        width: auto;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        margin-right: auto;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
      }
      
      .navbar.scrolled .navbar-brand img {
        height: 100px !important;
      }
      
      /* Hover effect pada logo */
      .navbar-brand:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 6px 12px rgba(70, 130, 169, 0.3));
      }

      /* MENU DI KANAN */
      .navbar-nav {
        margin-left: auto !important;
      }
      
      .nav-link {
        color: #333;
        margin: 0 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        position: relative;
        padding: 8px 0 !important;
      }
      
      /* Hover underline animation */
      .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 2px;
        transition: width 0.3s ease;
      }
      
      .nav-link:hover::before {
        width: 100%;
      }
      
      .nav-link:hover,
      .nav-link.active {
        color: var(--primary-dark);
      }
      
      /* Active state */
      .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 2px;
      }

      /* Mobile Toggle */
      .navbar-toggler {
        border: none;
        padding: 8px;
        background: transparent;
        transition: all 0.3s ease;
      }
      
      .navbar-toggler:focus {
        box-shadow: none;
      }
      
      .navbar-toggler:hover {
        background: rgba(70, 130, 169, 0.1);
        border-radius: 8px;
      }

      /* BUTTONS ENHANCED */
      .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        padding: 12px 28px;
        box-shadow: 0 4px 15px rgba(70, 130, 169, 0.3);
        position: relative;
        overflow: hidden;
      }
      
      .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
      }
      
      .btn-primary-custom:hover::before {
        width: 300px;
        height: 300px;
      }
      
      .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent) 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(70, 130, 169, 0.4);
      }
      
      .btn-outline-primary {
        border: 2px solid var(--primary);
        color: var(--primary-dark);
        font-weight: 600;
        border-radius: 50px;
        padding: 10px 26px;
        transition: all 0.3s ease;
        background: transparent;
      }
      
      .btn-outline-primary:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(145, 200, 228, 0.4);
      }
      
      .btn-accent {
        background: var(--accent);
        color: #fff;
      }
      
      .btn-accent:hover {
        background: var(--primary-dark);
        color: #fff;
      }

      /* CART ICON ENHANCED */
      .nav-link.position-relative i {
        font-size: 1.4rem;
        transition: all 0.3s ease;
      }
      
      .nav-link.position-relative:hover i {
        color: var(--primary-dark);
        transform: scale(1.1);
      }
      
      .badge {
        animation: bounce 2s infinite;
      }
      
      @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
      }

      /* DROPDOWN ENHANCED */
      .dropdown-menu {
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border-radius: 12px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        animation: slideDown 0.3s ease;
      }
      
      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .dropdown-item {
        padding: 10px 20px;
        transition: all 0.2s ease;
        font-weight: 500;
      }
      
      .dropdown-item:hover {
        background: linear-gradient(90deg, rgba(145, 200, 228, 0.1), transparent);
        color: var(--primary-dark);
        padding-left: 25px;
      }
      
      .dropdown-header {
        font-weight: 700;
        color: var(--primary-dark);
        padding: 12px 20px;
      }

      /* USER ICON ENHANCED */
      .bg-primary-subtle {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
        transition: all 0.3s ease;
      }
      
      .bg-primary-subtle i {
        color: white !important;
      }
      
      .nav-link.dropdown-toggle:hover .bg-primary-subtle {
        transform: rotate(360deg);
        box-shadow: 0 4px 15px rgba(70, 130, 169, 0.4);
      }

      /* ALERT MESSAGES ENHANCED */
      .alert {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        animation: slideInDown 0.5s ease;
      }
      
      @keyframes slideInDown {
        from {
          opacity: 0;
          transform: translateY(-20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        border-left: 4px solid #10b981;
      }
      
      .alert-danger {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border-left: 4px solid #ef4444;
      }

      /* FOOTER ENHANCED */
      footer {
        padding: 60px 0 30px;
        background: linear-gradient(135deg, var(--dark) 0%, #1a2332 100%);
        color: #d1d5db;
        position: relative;
        overflow: hidden;
      }
      
      footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -50%;
        width: 200%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary), transparent);
      }
      
      footer h5,
      footer h6 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
      }
      
      footer h6::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
      }
      
      footer a {
        color: #d1d5db;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
      }
      
      footer a:hover {
        color: var(--primary);
        padding-left: 8px;
      }
      
      footer .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
      }
      
      footer .btn-outline-light:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-3px) rotate(360deg);
        box-shadow: 0 6px 20px rgba(145, 200, 228, 0.4);
      }
      
      footer img {
        transition: all 0.3s ease;
      }
      
      footer img:hover {
        transform: scale(1.05);
        filter: brightness(0) invert(1) drop-shadow(0 0 10px rgba(145, 200, 228, 0.5));
      }

      /* SCROLL TO TOP BUTTON (BONUS) */
      #scrollTopBtn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(70, 130, 169, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
      }
      
      #scrollTopBtn.show {
        opacity: 1;
        visibility: visible;
      }
      
      #scrollTopBtn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(70, 130, 169, 0.5);
      }

      /* RESPONSIVE */
      @media(max-width:991px){
        .navbar-brand img {
          height: 100px !important;
        }
        
        .navbar.scrolled .navbar-brand img {
          height: 70px !important;
        }
        
        .navbar-collapse {
          background: white;
          padding: 20px;
          border-radius: 0 0 15px 15px;
          box-shadow: 0 10px 30px rgba(0,0,0,0.1);
          margin-top: 15px;
          animation: slideDown 0.3s ease;
        }
        
        .nav-link::after {
          display: none;
        }
        
        .nav-link {
          margin: 8px 0;
          padding: 10px 15px !important;
          border-radius: 8px;
          transition: all 0.3s ease;
        }
        
        .nav-link:hover {
          background: rgba(145, 200, 228, 0.1);
          padding-left: 20px !important;
        }
        
        .nav-link::before {
          display: none;
        }
        
        #scrollTopBtn {
          bottom: 20px;
          right: 20px;
          width: 45px;
          height: 45px;
        }
      }
      
      @media(max-width:576px){
        .navbar-brand img {
          height: 80px !important;
        }
        
        .navbar.scrolled .navbar-brand img {
          height: 60px !important;
        }
      }
      
      nav[role="navigation"] svg {
        width: 15px !important;  /* Paksa lebar kecil */
        height: 15px !important; /* Paksa tinggi kecil */
        color: var(--primary-dark); /* Sesuaikan warna */
        fill: currentColor;
    }

    /* Rapikan baris tombol */
    nav[role="navigation"] > div:last-child {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px;
    }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

    <div id="preloader">
        <img src="{{ asset('images/arya.png') }}" alt="Loading...">
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        
        {{-- LOGO DIPERBESAR --}}
        <a class="navbar-brand p-0" href="{{ route('home') }}">
          <img src="{{ asset('images/arya.png') }}" alt="Arya Advertising Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="bi bi-list fs-1 text-dark"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">PROFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ route('produk.layanan') }}">PRODUK</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('portfolio.index') ? 'active' : '' }}" href="{{ route('portfolio.index') }}">PORTFOLIO</a></li>
                
                <li class="nav-item ms-lg-3 d-none d-lg-block">|</li> 

                @guest('customer')
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('login') }}">Login</a>
                </li>
                @endguest
                @auth('customer')
                <li class="nav-item ms-lg-3">
                    <a class="nav-link position-relative fs-5" href="{{ route('customer.cart.index') }}">
                        <i class="bi bi-cart-fill"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ count(session('cart')) }}
                        </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="d-lg-none">{{ Str::limit(Auth::guard('customer')->user()->nama_lengkap, 15) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                        <li><h6 class="dropdown-header">{{ Auth::guard('customer')->user()->nama_lengkap }}</h6></li>
                        <li><a class="dropdown-item" href="{{ route('customer.profile.show') }}"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.orders.index') }}"><i class="bi bi-clock-history me-2"></i>Riwayat Pesanan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
      </div>
    </nav>

    <main>
        {{-- Alert Messages --}}
        <div class="container pt-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4">
            <img src="{{ asset('images/arya.png') }}" alt="Arya Logo Footer" style="height: 70px; filter: brightness(0) invert(1); margin-bottom: 20px;">
            <h5 class="mb-3">Arya Advertising</h5>
            <p>Solusi Percetakan & Periklanan Terpercaya di Medan sejak 2001.</p>
            <p class="small"><i class="bi bi-geo-alt me-2"></i> Jl. Bajak II H No.114H, Medan Amplas</p>
          </div>
          <div class="col-lg-2 col-6">
            <h6>Navigasi</h6>
            <ul class="list-unstyled">
                <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1"></i>Home</a></li>
                <li><a href="{{ route('home') }}#profile"><i class="bi bi-chevron-right me-1"></i>Tentang Kami</a></li>
                <li><a href="{{ route('produk.layanan') }}"><i class="bi bi-chevron-right me-1"></i>Produk & Layanan</a></li>
                <li><a href="{{ route('home') }}#portfolio"><i class="bi bi-chevron-right me-1"></i>Portfolio</a></li>
            </ul>
          </div>
           <div class="col-lg-3 col-6">
            <h6>Layanan & Bantuan</h6>
            <ul class="list-unstyled">
                <li><a href="#contact"><i class="bi bi-chevron-right me-1"></i>Hubungi Kami</a></li>
                <li><a href="#faq"><i class="bi bi-chevron-right me-1"></i>FAQ</a></li>
                @guest('customer')
                <li><a href="{{ route('customer.register') }}"><i class="bi bi-chevron-right me-1"></i>Daftar Member</a></li>
                @endguest
            </ul>
          </div>
          <div class="col-lg-3">
            <h6>Kontak Cepat</h6>
            <p class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i> 0821-6076-2279</p>
            <p><i class="bi bi-envelope me-2 text-warning"></i> aryaadvertising1@gmail.com</p>
            <div class="mt-3">
                <a href="https://www.instagram.com/aryaadvertisingmedan?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="btn btn-sm btn-outline-light rounded-circle me-1">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
          </div>
        </div>
        <div class="border-top border-secondary mt-5 pt-4 text-center small">
          © {{ date('Y') }} Arya Advertising. All rights reserved.
        </div>
      </div>
    </footer>

    {{-- SCROLL TO TOP BUTTON --}}
    <button id="scrollTopBtn" title="Kembali ke atas">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        
        // 1. PRELOADER & AOS
        setTimeout(() => document.body.classList.add('loaded'), 50);
        AOS.init({ duration: 800, once: true, offset: 100 });

        // VARIABEL UTAMA
        const navbar = document.querySelector('.navbar');
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section, header, div[id="home"]');
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        
        const isHomepage = {{ request()->is('/') ? 'true' : 'false' }};

        // 2. EVENT SCROLL
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;

            // A. EFEK NAVBAR
            if(scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // B. SCROLL SPY (HOMEPAGE)
            if (isHomepage) {
                let current = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (scrollY >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    
                    if (href.includes('#') || href === '{{ route('home') }}' || href === '/') {
                        link.classList.remove('active');
                        
                        if (current && href.includes('#' + current)) {
                            link.classList.add('active');
                        }
                        
                        if (scrollY < 150 && (href === '{{ route('home') }}' || href === '/')) {
                            link.classList.add('active');
                        }
                    }
                });
            }

            // C. SCROLL TO TOP BUTTON
            if (scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        // 3. SCROLL TO TOP FUNCTIONALITY
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // 4. SMOOTH SCROLL FOR ANCHOR LINKS
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offsetTop = target.offsetTop - 100;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

      });
    </script>
    @stack('scripts')
</body>
</html>