<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPH - {{ $sph->sph_number }}</title>
    <style>
        @page { size: A4; margin: 2cm 2cm 1.5cm 2cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11pt; color: #000; line-height: 1.5; }

        /* KOP SURAT */
        .header-table { width: 100%; border-bottom: 3px double #000; margin-bottom: 20px; padding-bottom: 10px; }
        .logo { width: 100px; height: auto; }
        .company-name { font-size: 18pt; font-weight: bold; text-transform: uppercase; margin: 0; }
        .company-sub { font-size: 10pt; font-weight: bold; margin: 2px 0; }
        .company-address { font-size: 9pt; line-height: 1.2; }

        /* KONTEN */
        .meta-info { margin-bottom: 20px; }
        .recipient { margin-bottom: 20px; }
        .section-title { font-weight: bold; text-transform: uppercase; border-bottom: 1px solid #000; margin-top: 20px; margin-bottom: 10px; font-size: 11pt; }
        
        /* GAMBAR */
        .img-container { width: 100%; text-align: center; margin: 15px 0; }
        .img-container img { max-width: 100%; border: 1px solid #ddd; padding: 5px; }

        /* TANDA TANGAN */
        .signature-section { margin-top: 40px; width: 100%; }
        .signature-box { width: 250px; float: right; text-align: center; }
        .signature-space { height: 70px; }
        .signature-name { font-weight: bold; text-decoration: underline; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td width="20%" valign="top">
                @php
                    $path = public_path('images/arya.png');
                    // Cek apakah file ada, jika tidak, gunakan teks kosong agar tidak error
                    $logoBase64 = file_exists($path) 
                        ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) 
                        : '';
                @endphp
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" class="logo">
                @endif
            </td>
            <td width="80%" align="center">
                <div class="company-name">CV. Arya Advertising</div>
                <div class="company-sub">ADVERTISING & BRANDING SPECIALIST</div>
                <div class="company-address">
                    Jl. Bajak II H No. 114 F, Harjosari II, Medan Amplas, Medan - Sumatera Utara<br>
                    Email: perusahaan@aryaadvertising.com | HP/WA: 0821-6076-2279
                </div>
            </td>
        </tr>
    </table>

    <div class="meta-info">
        <table style="width: 100%;">
            <tr>
                <td width="15%">Nomor</td><td width="2%">:</td><td width="53%">{{ $sph->sph_number }}</td>
                <td width="30%" align="right">Medan, {{ \Carbon\Carbon::parse($sph->sph_date)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr><td>Lampiran</td><td>:</td><td>-</td></tr>
            <tr><td>Hal</td><td>:</td><td><strong>Surat Penawaran Harga (Quotation)</strong></td></tr>
        </table>
    </div>

    <div class="recipient">
        Kepada Yth,<br>
        <strong>{{ strtoupper($sph->client_name) }}</strong><br>
        @if($sph->client_up) UP: {{ $sph->client_up }}<br> @endif
        Di Tempat
    </div>

    <p><strong>Dengan Hormat,</strong></p>
    <p>Bersama surat ini, kami dari <strong>CV. Arya Advertising</strong> mengajukan penawaran pekerjaan <strong>"{{ $sph->job_title }}"</strong> dengan rincian sebagai berikut:</p>

    <div class="section-title">I. Spesifikasi Teknik dan Harga</div>
    <div class="img-container">
        @if($sph->rincian_image && file_exists(public_path('storage/' . $sph->rincian_image)))
            <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('storage/' . $sph->rincian_image))) }}">
        @else
            <p><i>Gambar tabel harga tidak tersedia.</i></p>
        @endif
    </div>

    <div class="section-title">II. Jangka Waktu</div>
    <p style="margin-left: 20px;">{{ $sph->terms_waktu }}</p>

    <div class="section-title">III. Sistem Pembayaran</div>
    <div style="margin-left: 20px;">
        @foreach(explode("\n", $sph->terms_pembayaran) as $line)
            @if(trim($line)) <div>- {{ trim($line) }}</div> @endif
        @endforeach
    </div>

    @if($sph->terms_notes)
        <p style="margin-top: 15px;"><i>Catatan: {{ $sph->terms_notes }}</i></p>
    @endif

    <p>Demikian surat penawaran ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>

    <div class="signature-section">
        <div class="signature-box">
            <div>Hormat Kami,</div>
            <div class="signature-space"></div>
            <div class="signature-name">{{ $sph->user->nama_lengkap ?? 'M. Hasan Pulungan, ST. Arch' }}</div>
            <div>Direktur Utama</div>
        </div>
        <div style="clear: both;"></div>
    </div>

    @if($sph->design_image && file_exists(public_path('storage/' . $sph->design_image)))
        <div class="page-break">
            <div class="section-title" style="text-align: center;">LAMPIRAN: GAMBAR DESAIN</div>
            <div class="img-container">
                <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('storage/' . $sph->design_image))) }}">
            </div>
        </div>
    @endif

</body>
</html>