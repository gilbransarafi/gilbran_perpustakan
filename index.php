<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #007bff;
      padding: 1rem 0.5rem;
    }
    .navbar-brand, .nav-link, .nav-item {
      color: white !important;
    }
    .navbar-nav {
      gap: 15px;
    }
    .navbar-right {
      position: absolute;
      right: 2rem;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      gap: 15px;
    }
    .carousel-item img {
      height: 500px;
      object-fit: cover;
      width: 100%;
    }
    .category-section, .publisher-section {
      padding: 60px 20px;
      background-color: #fff;
      text-align: center;
    }
    .category-section h2, .publisher-section h2 {
      font-weight: bold;
      margin-bottom: 30px;
    }
    .category-card {
      border: 1px solid #ddd;
      padding: 30px 20px;
      border-radius: 12px;
      transition: 0.3s;
      background-color: #f9f9f9;
    }
    .category-card:hover {
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      background-color: #e9f3ff;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark position-relative">
  <div class="container-fluid">
    <a class="navbar-brand me-4" href="#">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="kategoriDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         <span data-lang-id="kategori">Kategori</span>
        </a>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#kategori-buku">Fisik</a></li>
            <li><a class="dropdown-item" href="#kategori-buku">Nonfisik</a></li>
            <li><a class="dropdown-item" href="#kategori-buku">Ensiklopedia</a></li>
            <li><a class="dropdown-item" href="#kategori-buku">Novel</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#data-penerbit">
            <span data-lang-id="data_penerbit">Data Penerbit</span>
           </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" data-bs-toggle="dropdown">
            <span data-lang-id="layanan">Layanan</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="peminjaman.php">Peminjaman</a></li>
            <li><a class="dropdown-item" href="pengembalian.php">Pengembalian</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><span data-lang-id="buku">Data Buku</span></a>
        </li>
      </ul>
    </div>
   
    <!-- Hanya Admin -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
        <li class="nav-item">
          <a class="nav-link" href="riwayat_pemesanan.php">Riwayat Pemesanan</a>
        </li>
        <?php } ?>
      </ul>

      <!-- Hanya Admin -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
<li class="nav-item">
  <a class="nav-link" href="riwayat_pengembalian.php">Riwayat Pengembalian</a>
</li>
<?php } ?>


    <div class="navbar-right">
      <a class="nav-link" href="login.php"><span data-lang-id="login">Login</span></a>
      <a class="nav-link" href="#" id="lang-switch" onclick="switchLanguage()">EN</a>
    </div>
  </div>
</nav>

<!-- SLIDESHOW -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/slide1.jpg" class="d-block w-100" alt="Slide 1">
    </div>
    <div class="carousel-item">
      <img src="assets/slide2.jpg" class="d-block w-100" alt="Slide 2">
    </div>
    <div class="carousel-item">
      <img src="assets/slide3.jpg" class="d-block w-100" alt="Slide 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- KATEGORI BUKU -->
<section class="category-section" id="kategori-buku">
  <h2 data-lang-id="judulKategori">Kategori Buku</h2>
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3">
        <div class="category-card">
          <h5>Fisik</h5>
          <p data-lang-id="fisikDesc">Buku-buku yang tersedia dalam bentuk cetak dan dapat dipinjam langsung di perpustakaan, Buku yang berbentuk nyata, bisa dipegang, memiliki halaman dari kertas.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <h5>Nonfisik</h5>
          <p data-lang-id="nonfisikDesc">Buku digital atau e-book yang dapat diakses secara daring oleh anggota, Buku dalam bentuk file digital, dibaca melalui perangkat elektronik.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <h5>Ensiklopedia</h5>
          <p data-lang-id="ensikDesc">Kumpulan informasi pengetahuan umum dalam bentuk buku atau digital, Buku referensi yang berisi kumpulan informasi atau penjelasan tentang berbagai topik, disusun secara sistematis (biasanya alfabetis).</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <h5>Novel</h5>
          <p data-lang-id="novelDesc">Koleksi cerita fiksi dari berbagai genre yang dapat dinikmati oleh pembaca, Buku yang berisi cerita fiksi panjang, menceritakan tokoh, konflik, dan alur tertentu.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Data Penerbit -->
<section id="data-penerbit" style="margin-top: 50px;">
    <div class="container">
        <h2 class="text-center" data-lang-id="data_penerbit" style="margin-bottom: 30px;">Data Penerbit</h2>
        <div class="row justify-content-center">

            <!-- Penerbit Andrea Hirata -->
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="penerbit_andrea.php" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title" data-lang-id="penerbit_andrea">Andrea Hirata</h5>
                            <p class="card-text" data-lang-id="info_penerbit_andrea">
                                Penulis dan penerbit buku terkenal, salah satunya seri Laskar Pelangi.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Penerbit Eka Kurniawan -->
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="penerbit_eka.php" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title" data-lang-id="penerbit_eka">Eka Kurniawan</h5>
                            <p class="card-text" data-lang-id="info_penerbit_eka">
                                Penerbit buku sastra modern dengan karya internasional.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Penerbit Raditya Dika -->
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="penerbit_raditya.php" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title" data-lang-id="penerbit_raditya">Raditya Dika</h5>
                            <p class="card-text" data-lang-id="info_penerbit_raditya">
                                Penerbit buku komedi, novel, dan karya populer lainnya.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- JS -->
<script>
  let currentLang = "id";
  const translations = {
    en: {
      kategori: "Category",
      penerbit: "Publisher Data",
      layanan: "Services",
      buku: "Books Data",
      login: "Login",
      judulKategori: "Book Categories",
      fisikDesc: "Books available in printed form, can be borrowed physically.",
      nonfisikDesc: "Digital books or e-books accessible online for members.",
      ensikDesc: "A collection of general knowledge in books or digital formats.",
      novelDesc: "Fiction stories in various genres for readers to enjoy.",
      judulPenerbit: "Publisher Data",
      penerbitA: "Andrea Hirata",
      penerbitADesc: "Famous book writer and publisher, one of which is the Laskar Pelangi series.",
      penerbitB: "Publisher B",
      penerbitBDesc: "Information about Publisher B.",
      penerbitC: "Publisher C",
      penerbitCDesc: "Information about Publisher C."
    },
    id: {
      kategori: "Kategori",
      penerbit: "Data Penerbit",
      layanan: "Layanan",
      buku: "Data Buku",
      login: "Login",
      judulKategori: "Kategori Buku",
      fisikDesc: "Buku-buku yang tersedia dalam bentuk cetak dan dapat dipinjam langsung di perpustakaan.",
      nonfisikDesc: "Buku digital atau e-book yang dapat diakses secara daring oleh anggota.",
      ensikDesc: "Kumpulan informasi pengetahuan umum dalam bentuk buku atau digital.",
      novelDesc: "Koleksi cerita fiksi dari berbagai genre yang dapat dinikmati oleh pembaca.",
      judulPenerbit: "Data Penerbit",
      penerbitA: "Penerbit A",
      penerbitADesc: "Penulis dan penerbit buku terkenal, salah satunya seri Laskar Pelangi.",
      penerbitB: "Penerbit B",
      penerbitBDesc: "Informasi tentang penerbit B.",
      penerbitC: "Penerbit C",
      penerbitCDesc: "Informasi tentang penerbit C."
    }
  };

<script>
  let currentLang = "id";
  const translations = {
    id: { kategori: "Kategori", penerbit: "Data Penerbit", layanan: "Layanan", buku: "Data Buku", login: "Login" },
    en: { kategori: "Category", penerbit: "Publisher Data", layanan: "Services", buku: "Book Data", login: "Login" }
  };

  function switchLanguage() {
    currentLang = currentLang === "id" ? "en" : "id";
    document.querySelectorAll("[data-lang-id]").forEach(el => {
      const key = el.getAttribute("data-lang-id");
      el.innerText = translations[currentLang][key] || el.innerText;
    });
    document.getElementById("lang-switch").innerText = currentLang === "id" ? "EN" : "ID";
  }

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      if (this.getAttribute("href") !== "#") {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
