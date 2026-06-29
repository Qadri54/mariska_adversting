<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan — Arya Advertising</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            margin: 30px 40px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 9pt;
            color: #333;
        }

        /* --- KOP SURAT --- */
        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo-col {
            width: 12%;
            text-align: left;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .company-col {
            width: 48%;
            text-align: left;
            padding-left: 10px;
        }
        /* Menggunakan Tema Warna Website */
        .company-name {
            font-size: 16pt;
            font-weight: 900;
            color: #27548A; /* Warna Accent Website */
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .company-sub {
            font-size: 10pt;
            font-weight: bold;
            color: #4682A9; /* Warna Primary Dark Website */
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }
        .company-address {
            font-size: 8pt;
            color: #4b5563;
            margin: 0;
            line-height: 1.4;
        }
        .title-col {
            width: 40%;
            text-align: right;
        }
        .report-title {
            font-size: 15pt;
            font-weight: 900;
            color: #27548A;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .report-period {
            font-size: 8.5pt;
            font-weight: bold;
            color: #4682A9;
            margin: 0;
        }

        /* --- GARIS PEMISAH --- */
        .separator {
            border-top: 3px solid #27548A;
            border-bottom: 1px solid #91C8E4;
            height: 2px;
            margin-bottom: 20px;
        }

        /* --- TABEL DATA --- */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .data-table th, .data-table td {
            padding: 10px 8px;
            border: 1px solid #cbd5e1;
        }
        
        /* Header Tabel */
        .data-table th {
            background-color: #27548A;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8.5pt;
            text-align: center;
        }

        /* Zebra Striping untuk baris */
        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .data-table td {
            font-size: 8.5pt;
            color: #374151;
        }

        /* Baris Total */
        .data-table .total-row td {
            background-color: #eef5f9;
            font-weight: bold;
            color: #27548A;
            border-top: 2px solid #27548A;
            font-size: 9.5pt;
        }

        /* --- AREA TANDA TANGAN --- */
        .signature-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            page-break-inside: avoid; /* Mencegah tanda tangan terpotong halaman */
        }
        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .sign-date {
            margin-bottom: 5px;
            font-size: 9pt;
        }
        .sign-space {
            height: 70px; /* Ruang untuk tanda tangan atau stempel */
        }
        .sign-name {
            font-weight: bold;
            text-decoration: underline;
            margin: 0;
            color: #27548A;
        }
        .sign-role {
            margin: 2px 0 0 0;
            font-size: 8.5pt;
            color: #4b5563;
        }

        /* --- FOOTER LAPORAN --- */
        footer {
            position: fixed;
            bottom: -15px;
            left: 0;
            right: 0;
            height: 30px;
            font-size: 8pt;
            color: #64748b;
            border-top: 1px solid #cbd5e1;
            padding-top: 5px;
        }
        .page-number:after { content: counter(page); }

        /* --- ALIGNMENT --- */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }

    </style>
</head>
<body>

    {{-- FOOTER diletakkan di atas agar merender di semua halaman oleh DOMPDF --}}
    <footer>
        <table style="width: 100%; border: none; padding: 0;">
            <tr>
                <td style="text-align: left; width: 50%; border: none;">
                    Dokumen dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
                </td>
                <td style="text-align: right; width: 50%; border: none;">
                    Sistem Informasi CV Arya Advertising | Halaman <span class="page-number"></span>
                </td>
            </tr>
        </table>
    </footer>

    {{-- Script untuk Convert Gambar ke Base64 (Anti-Error GD) --}}
    @php
        $imagePath = public_path('images/LOGO.jpg');
        $logoBase64 = '';
        if (file_exists($imagePath)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));
        }
    @endphp

    {{-- KOP SURAT --}}
    <table class="header-table">
        <tr>
            <td class="logo-col">
                @if($logoBase64 != '')
                    <img src="{{ $logoBase64 }}" class="logo" alt="Logo">
                @endif
            </td>
            
            <td class="company-col">
                <p class="company-name">CV ARYA ADVERTISING</p>
                <p class="company-sub">PERCETAKAN & PERIKLANAN</p>
                <p class="company-address">
                    Jl. Bajak II H No.114 H, Harjosari II, Kec. Medan Amplas, Kota Medan<br>
                    WA : 0821 - 6076 - 2279 | Email : aryaadvertising1@gmail.com
                </p>
            </td>

            <td class="title-col">
                <p class="report-title">LAPORAN PENJUALAN</p>
                <p class="report-period">
                    Periode: {{ \Carbon\Carbon::parse($summary['start_date'])->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($summary['end_date'])->translatedFormat('d M Y') }}
                </p>
            </td>
        </tr>
    </table>

    {{-- GARIS PEMISAH KOP SURAT --}}
    <div class="separator"></div>

    {{-- TABEL DATA PESANAN --}}
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="15%">TANGGAL</th>
                <th width="15%" class="text-left">ID PESANAN</th>
                <th width="35%" class="text-left">NAMA CUSTOMER</th>
                <th width="15%">STATUS</th>
                <th width="15%" class="text-right">NOMINAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $order)
            <tr>
                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                <td class="text-left fw-bold">#{{ $order->order_id }}</td>
                <td class="text-left">{{ $order->customer->nama_lengkap ?? '-' }}</td>
                <td class="text-center" style="font-style: italic;">{{ ucfirst($order->status) }}</td>
                <td class="text-right fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 25px; color: #9ca3af; font-style: italic;">
                    Tidak ada data penjualan pada periode ini.
                </td>
            </tr>
            @endforelse

            {{-- BARIS TOTAL --}}
            @if($orders->count() > 0)
            <tr class="total-row">
                <td colspan="5" class="text-right" style="padding-right: 15px;">TOTAL PENDAPATAN ({{ $summary['total_orders'] }} TRANSAKSI)</td>
                <td class="text-right">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- AREA TANDA TANGAN (KOLOM PENGESAHAN) --}}
    <table class="signature-table">
        <tr>
            <td>
                {{-- Kolom Kosong untuk format resmi (biasanya Admin/Pembuat) --}}
                <p class="sign-date">&nbsp;</p>
                <p>Dibuat Oleh,</p>
                <div class="sign-space"></div>
                <p class="sign-name">Admin Penjualan</p>
                <p class="sign-role">CV Arya Advertising</p>
            </td>
            <td>
                <p class="sign-date">Medan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Mengetahui,</p>
                <div class="sign-space"></div>
                <p class="sign-name">M. Hasan Pulungan</p>
                <p class="sign-role">Direktur Utama</p>
            </td>
        </tr>
    </table>

</body>
</html>