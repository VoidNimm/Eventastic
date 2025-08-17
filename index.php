<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Eventastic</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="img/fix1logotai_page-0001.jpg" alt="Eventastic Logo" style="height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php" style="color: #041562;">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="event.php" style="color: #041562;">Acara</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php" style="color: #041562;">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php" style="color: #041562;">Tentang Kami</a></li>
            </ul>
            <div class="d-flex">
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    echo '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" href="#" role="button" 
                            id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            ' . htmlspecialchars($_SESSION['username']) . '
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="payment_history.php">Riwayat Pembayaran</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Keluar</a></li>
                        </ul>
                    </div>';
                } else {
                    echo '<a class="btn btn-outline-primary ms-2" href="login.php">Masuk</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>


  <!-- Hero Section -->
  <header class="hero bg-light">
    <div class="container-fluid px-0">
      <div class="hero-wrapper">
        <img src="img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg" class="hero-img" alt="Acara 1">
        <img src="img/chuttersnap-Q_KdjKxntH8-unsplash.jpg" class="hero-img" alt="Acara 2">
        <img src="img/kate-trysh-ZUWls_bDgAk-unsplash.jpg" class="hero-img" alt="Acara 3">
        <!-- Duplicate images for the looping effect -->
        <img src="img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg" class="hero-img" alt="Acara 1">
        <img src="img/chuttersnap-Q_KdjKxntH8-unsplash.jpg" class="hero-img" alt="Acara 2">
        <img src="img/kate-trysh-ZUWls_bDgAk-unsplash.jpg" class="hero-img" alt="Acara 3">
      </div>
    </div>
  </header>

  <!-- How Event Works Section -->
  <section id="how-event-works" style="background-color: #f9f9f9; padding: 60px 0;">
    <div class="container">
      <div class="row justify-content-center text-center">
        <!-- Section Heading -->
        <div class="col-12 mb-5">
          <h2 style="font-size: 2.5rem; color: #041562;">Cara Kerja Eventastic</h2>
          <p style="font-size: 1.2rem; color: #555;">Mengatur acara tidak pernah semudah ini! Ikuti langkah-langkah sederhana ini untuk mengatur acara Anda secara online:</p>
        </div>

        <!-- Steps -->
        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm text-center py-4">
            <div class="card-body">
              <h4>1. Jelajahi Acara</h4>
              <p>Temukan berbagai macam acara, mulai dari pernikahan, acara perusahaan, hingga pesta pribadi. Kami memiliki acara untuk semua jenis kebutuhan!</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm text-center py-4">
            <div class="card-body">
              <h4>2. Pilih Acara Anda</h4>
              <p>Pilih acara yang sesuai dengan kebutuhan Anda. Jelajahi berdasarkan jenis, anggaran, atau lokasi, dan temukan yang paling cocok.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm text-center py-4">
            <div class="card-body">
              <h4>3. Pesan Online</h4>
              <p>Isi detail Anda dan selesaikan pemesanan acara dengan mudah. Sesederhana itu! Anda akan menerima konfirmasi instan.</p>
            </div>
          </div>
        </div>

        <!-- Button -->
        <div class="col-12">
          <a href="event.php" class="btn btn-primary btn-lg mt-4">Mulai Pesan Acara Anda Sekarang</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Know More About the Culture of Events Section -->
  <section id="culture-of-events" style="background-color: #11468F; color: white;" class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <!-- Image Section -->
        <div class="col-md-6">
          <img src="img/chuttersnap-Q_KdjKxntH8-unsplash.jpg" alt="Budaya Acara" class="img-fluid rounded">
        </div>
        <!-- Text Section -->
        <div class="col-md-6">
          <h2 class="mb-4" style="font-size: 2.5rem;">Kenali Lebih Dalam Budaya Acara</h2>
          <p class="mb-4" style="font-size: 1.2rem;">Kami memahami betapa pentingnya setiap acara bagi Anda. Mari jelajahi lebih dalam tentang budaya acara yang kami tawarkan.</p>
          
          <div class="feature mb-3">
            <h4>Host Acara Gratis</h4>
            <p>Nikmati fasilitas host acara gratis untuk memastikan acara Anda berjalan lancar dan sukses.</p>
          </div>
          
          <div class="feature mb-3">
            <h4>Platform Konferensi Video Terintegrasi</h4>
            <p>Manfaatkan platform konferensi video yang terintegrasi untuk acara hybrid atau virtual Anda.</p>
          </div>
          
          <div class="feature mb-3">
            <h4>Hubungkan Peserta dengan Acara</h4>
            <p>Kami membantu Anda menghubungkan peserta dengan acara secara efektif dan efisien.</p>
          </div>
          
          <div class="stats mt-5">
            <div class="row">
              <div class="col-md-6">
                <div class="stat-item text-center">
                  <div class="icon mb-3">
                    <span class="check-icon">&#10003;</span>
                  </div>
                  <h5>Pendapatan</h5>
                  <p>Rp 14.000.000</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="stat-item text-center">
                  <div class="icon mb-3">
                    <span class="check-icon">&#10003;</span>
                  </div>
                  <h5>Tiket Terjual</h5>
                  <p>1.200</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Explore Category Section -->
  <section id="explore-category" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4" style="font-size: 2.5rem; color: #ffffff;">Jelajahi Kategori</h2>
      <div class="row justify-content-center">
        <!-- Category 1: Wedding -->
        <div class="col-md-2 col-sm-4 mb-4">
          <div class="category-card">
            <img src="img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg" class="img-fluid" alt="Pernikahan">
            <div class="category-overlay">
              <h4>Pernikahan</h4>
            </div>
          </div>
        </div>
        <!-- Category 2: Business -->
        <div class="col-md-2 col-sm-4 mb-4">
          <div class="category-card">
            <img src="img/chuttersnap-Q_KdjKxntH8-unsplash.jpg" class="img-fluid" alt="Bisnis">
            <div class="category-overlay">
              <h4>Bisnis</h4>
            </div>
          </div>
        </div>
        <!-- Category 3: Career -->
        <div class="col-md-2 col-sm-4 mb-4">
          <div class="category-card">
            <img src="img/kate-trysh-ZUWls_bDgAk-unsplash.jpg" class="img-fluid" alt="Karir">
            <div class="category-overlay">
              <h4>Karir</h4>
            </div>
          </div>
        </div>
        <!-- Category 4: Conference -->
        <div class="col-md-2 col-sm-4 mb-4">
          <div class="category-card">
            <img src="img/andrea-mininni-VLlkOJdzLG0-unsplash.jpg" class="img-fluid" alt="Konferensi">
            <div class="category-overlay">
              <h4>Konferensi</h4>
            </div>
          </div>
        </div>
        <!-- Category 5: Sports -->
        <div class="col-md-2 col-sm-4 mb-4">
          <div class="category-card">
            <img src="img/rob-wingate-2Qf2_k0Q5T0-unsplash.jpg" class="img-fluid" alt="Olahraga">
            <div class="category-overlay">
              <h4>Olahraga</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Client Testimonials Section -->
  <section id="client-testimonials" class="py-5" style="background-color: #f9f9f9;">
    <div class="container">
      <h2 class="text-center mb-4" style="font-size: 2.5rem; color: #041562;">Apa Kata Klien Kami</h2>
      <p class="text-center mb-5" style="font-size: 1.2rem; color: #555;">Dengarkan pengalaman langsung dari klien kami yang telah menggunakan layanan Eventastic.</p>
      <div class="row">
        <!-- Testimonial 1 -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0">
            <div class="card-body">
              <div class="avatar mb-3">
                <img src="img/Memes i found on internet (1).jpg" alt="Jane Doe" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
              </div>
              <h5 class="card-title">Jane Doe</h5>
              <p class="text-muted">Chief Marketing Officer</p>
              <p class="card-text">"Layanan ini sangat membantu dalam mengatur acara perusahaan kami. Semuanya berjalan lancar!"</p>
              <div class="stars mb-2">
                <span>&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- 5 stars -->
              </div>
            </div>
          </div>
        </div>
        <!-- Testimonial 2 -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0">
            <div class="card-body">
              <div class="avatar mb-3">
                <img src="img/Memes i found on internet.jpg" alt="Jef Hardy" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
              </div>
              <h5 class="card-title">Jef Hardy</h5>
              <p class="text-muted">Chief Executive Officer</p>
              <p class="card-text">"Platform yang sangat intuitif dan mudah digunakan. Sangat direkomendasikan!"</p>
              <div class="stars mb-2">
                <span>&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- 5 stars -->
              </div>
            </div>
          </div>
        </div>
        <!-- Testimonial 3 -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0">
            <div class="card-body">
              <div class="avatar mb-3">
                <img src="img/teme.jpeg" alt="Matt Hardy" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
              </div>
              <h5 class="card-title">Matt Hardy</h5>
              <p class="text-muted">Manajer</p>
              <p class="card-text">"Eventastic membuat proses pengaturan acara menjadi sangat mudah dan efisien."</p>
              <div class="stars mb-2">
                <span>&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- 5 stars -->
              </div>
            </div>
          </div>
        </div>
        <!-- Testimonial 4 -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0">
            <div class="card-body">
              <div class="avatar mb-3">
                <img src="img/smile.jpg" alt="Patty O'Furniture" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
              </div>
              <h5 class="card-title">Patty O'Furniture</h5>
              <p class="text-muted">Chief Financial Officer</p>
              <p class="card-text">"Pelayanan yang ramah dan profesional. Acara kami sukses besar!"</p>
              <div class="stars mb-2">
                <span>&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- 5 stars -->
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Footer -->
  <footer class="text-white text-center py-3" style="background-color: #041562; margin-top:10rem;">
    <p>&copy; 2025 Eventastic. All Rights Reserved Indonesia</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // If the user clicks the logout button, show a SweetAlert confirmation
    document.getElementById("logoutBtn")?.addEventListener("click", function(event) {
        event.preventDefault();

        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan keluar dari akun.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Clear session and redirect to login page
                window.location.href = 'logout.php'; // Redirect to logout script
            }
        });
    });
  </script>
</body>
</html>