<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portofolio Baliho - Arya Advertising</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --primary:#91C8E4;
      --primary-dark:#4682A9;
      --accent:#27548A;
      --dark:#0f1724;
      --muted:#6b7280;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f8f9fa;
    }
    .container {
        padding-top: 50px;
        padding-bottom: 50px;
    }
    .page-title {
        color: var(--dark);
        font-weight: 700;
        margin-bottom: 30px;
    }
    /* Mengadaptasi style Category Card dari produk_layanan.php */
    .portfolio-card{
      background:#fff;
      border-radius:16px;
      overflow:hidden;
      transition:all .3s;
      box-shadow:0 2px 10px rgba(0,0,0,0.08);
      height:100%;
      cursor:pointer;
      text-decoration:none;
      color:inherit;
      display:block;
    }
    .portfolio-card:hover{
      transform:translateY(-8px);
      box-shadow:0 12px 35px rgba(0,0,0,0.15);
    }
    .portfolio-card .img-wrapper{
      position:relative;
      overflow:hidden;
      height:250px; /* Sedikit lebih pendek dari kartu utama */
      background:linear-gradient(135deg, var(--primary-dark), var(--accent));
    }
    .portfolio-card .img-wrapper img{
      width:100%;
      height:100%;
      object-fit:cover;
      transition:transform .5s;
    }
    .portfolio-card:hover .img-wrapper img{
      transform:scale(1.1);
    }
    .portfolio-card .card-body{
      padding:20px;
    }
    .portfolio-card .card-title{
      font-size:1.3rem;
      font-weight:700;
      color:var(--dark);
      margin-bottom:8px;
    }
    .portfolio-card .card-text{
      color:var(--muted);
      font-size:0.95rem;
      line-height:1.5;
    }
    .btn-primary-custom{
      background:var(--primary-dark);
      border:none;
      color:#fff;
      font-weight:600;
      border-radius:8px;
      transition:all .3s;
      padding:12px 30px;
      font-size:1.1rem;
    }
    .btn-primary-custom:hover{
      background:var(--accent);
      transform:translateY(-2px);
      box-shadow:0 6px 20px rgba(70,130,169,0.3);
      color:#fff;
    }
  </style>
</head>
<body>

  <div class="container">
    
    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary mb-4">← Kembali ke Produk</a>
    
    <h1 class="text-center page-title mb-5">Portofolio Desain Baliho</h1>
    <p class="text-center lead mb-5 text-muted">Lihat beragam proyek baliho yang telah kami kerjakan untuk berbagai industri.</p>

    <div class="row g-4">
      
      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-grabfood.png" alt="Baliho GrabFood Medan" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">GrabFood - Promosi Restoran</h5>
            <p class="card-text">Pemasangan baliho dengan ukuran besar di lokasi strategis (Jln. Setiabudi Medan) untuk kampanye promosi makanan.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-firstmedia.png" alt="Baliho First Media" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">First Media - First Wariors</h5>
            <p class="card-text">Baliho promosi event E-Sport yang didukung First Media, fokus pada desain visual yang menarik perhatian pengemudi.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-blibli.png" alt="Baliho Blibli Indonesia Open" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">Blibli - Indonesia Open</h5>
            <p class="card-text">Pemasangan baliho temporer untuk iklan event olahraga nasional, memastikan jangkauan luas selama masa kampanye.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-realestate.png" alt="Baliho Proyek Real Estate" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">Proyek Perumahan Elite</h5>
            <p class="card-text">Baliho dengan visual properti mewah dan info kontak yang jelas untuk menarik target pasar kelas atas.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-layanan-masyarakat.png" alt="Baliho Iklan Layanan Masyarakat" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">Kampanye Kesehatan Publik</h5>
            <p class="card-text">Desain baliho yang informatif dan persuasif untuk kampanye kesadaran kesehatan dari lembaga pemerintahan.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card">
          <div class="img-wrapper">
            <img src="images/baliho-produk-baru.png" alt="Baliho Peluncuran Produk" class="img-fluid">
          </div>
          <div class="card-body">
            <h5 class="card-title">Peluncuran Produk Minuman</h5>
            <p class="card-text">Baliho dengan warna cerah dan fokus pada visual produk untuk meningkatkan brand recall dan daya tarik.</p>
          </div>
        </div>
      </div>

    </div>
    <hr class="my-5">

    <div class="text-center">
      <h3 class="mb-3">Tertarik dengan Baliho Berkualitas Tinggi?</h3>
      <a href="checkout.php?kategori=baliho" class="btn btn-primary-custom">
        Pesan Baliho Custom Sekarang
      </a>
      <p class="text-muted mt-3 small">Kami siap membantu dari desain hingga pemasangan.</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>