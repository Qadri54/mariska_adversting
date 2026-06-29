<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-blue: #27548A; /* Biru Logo Arya */
            --dark-header: #212529;  /* Hitam Navbar */
            --sidebar-bg: #ffffff;   /* Sidebar Putih */
            --content-bg: #f4f6f9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* --- 1. HEADER (NAVBAR ATAS) --- */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            display: flex;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Bagian Kiri (Logo) - Biru */
        .header-brand {
            width: var(--sidebar-width);
            background-color: var(--primary-blue);
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-weight: 700;
            font-size: 1.2rem;
            text-decoration: none;
            transition: width 0.3s;
        }
        .header-brand:hover { color: #e0e0e0; }

        /* Bagian Kanan (Menu Logout) - Hitam */
        .header-nav {
            flex-grow: 1;
            background-color: var(--dark-header);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: white;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: rgba(255,255,255,0.1);
            border-color: #fff;
        }

        /* --- 2. SIDEBAR (MENU KIRI) --- */
        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            padding-top: 20px;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            transition: margin-left 0.3s;
            z-index: 1020;
        }

        .nav-link {
            color: #495057;
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            color: #adb5bd;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--primary-blue);
            border-left-color: #ced4da;
        }

        .nav-link.active {
            background-color: #eef2f7;
            color: var(--primary-blue);
            border-left-color: var(--primary-blue);
            font-weight: 600;
        }
        .nav-link.active i { color: var(--primary-blue); }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #adb5bd;
            font-weight: 700;
            padding: 20px 20px 10px;
            letter-spacing: 0.5px;
        }

        /* --- 3. KONTEN UTAMA --- */
        .main-content {
            margin-top: var(--header-height);
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
            transition: margin-left 0.3s;
        }

        /* --- RESPONSIVE (HP) --- */
        @media (max-width: 768px) {
            .sidebar { margin-left: calc(var(--sidebar-width) * -1); }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; }
            .header-brand { width: auto; padding-right: 15px; }
            .toggle-btn { display: block !important; color: white; font-size: 1.5rem; cursor: pointer; margin-right: 15px; }
        }
        .toggle-btn { display: none; }
    </style>
    @stack('styles')
</head>
<body>

    {{-- HEADER ATAS --}}
    <header class="admin-header">
        <a href="{{ route('admin.dashboard') }}" class="header-brand">
            <img src="{{ asset('images/arya.png') }}" alt="Logo" style="height: 30px; margin-right: 10px; filter: brightness(0) invert(1);">
            Arya Admin
        </a>

        <nav class="header-nav">
            <div class="d-flex align-items-center">
                <i class="bi bi-list toggle-btn" onclick="document.querySelector('.sidebar').classList.toggle('active')"></i>
                </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout ({{ Auth::user()->nama_lengkap ?? 'Admin' }})
                </button>
            </form>
        </nav>
    </header>

    {{-- SIDEBAR KIRI --}}
    <nav class="sidebar">
        <div class="nav flex-column">
            <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="sidebar-heading">Transaksi</div>
            <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-cart3"></i> Pesanan Masuk
            </a>
            <a class="nav-link {{ request()->is('admin/sph*') ? 'active' : '' }}" href="{{ route('admin.sph.index') }}">
                <i class="bi bi-file-text"></i> Penawaran (SPH)
            </a>

            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
            <i class="bi bi-clipboard-data"></i> Laporan & Analisis
             </a>

            <div class="sidebar-heading">Master Data</div>
            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>

            <a class="nav-link {{ request()->is('admin/joc*') ? 'active' : '' }}" href="{{ route('admin.joc.index') }}">
            <i class="bi bi-cash-stack"></i> Harga Jual (JOC)
            </a>

            <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                <i class="bi bi-grid"></i> Layanan
            </a>
            <a class="nav-link {{ request()->is('admin/gallery*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">
                <i class="bi bi-images"></i> Galeri Foto
            </a>
            <a class="nav-link {{ request()->is('admin/partners*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                <i class="bi bi-people"></i> Mitra Kami
            </a>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="main-content">

        {{-- Alert Global --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
