<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami - Eventastic</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/about-style.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    .team-card p {
      color: #EEEEEE;
    }
  </style>
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

  <!-- About Us Section -->
  <section class="about-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="head">Tentang <img src="img/fix1logotai_page-0001.jpg" alt="Eventastic Logo" style="height: 80px; box-shadow:0;"></h2>
          <p>
            Eventastic adalah platform terkemuka untuk menemukan dan memesan acara terbaik. Kami menyediakan berbagai macam acara, mulai dari pernikahan, acara perusahaan, hingga pesta pribadi. Dengan Eventastic, Anda dapat dengan mudah menemukan acara yang sesuai dengan kebutuhan Anda.
          </p>
          <p>
            Didirikan pada tahun 2025, Eventastic telah membantu ribuan orang dalam mengatur acara mereka dengan mudah dan efisien. Kami berkomitmen untuk memberikan pengalaman terbaik kepada pelanggan kami dengan layanan yang ramah dan profesional.
          </p>
        </div>
        <div class="col-md-6">
          <img src="img/andrea-mininni-VLlkOJdzLG0-unsplash.jpg" alt="Tentang Kami" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

          <!-- Image Slider Section -->
  <section class="slider-section py-5" style="background-color:#041562;">
    <div class="container">
      <h2 class="text-center mb-4" style="color:#EEEEEE;">Galeri Kami</h2>
      <div id="imageSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <!-- Indicators -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/kate-trysh-ZUWls_bDgAk-unsplash.jpg" class="d-block w-100" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="img/quan-nguyen-yDSe7sggb9Q-unsplash.jpg" class="d-block w-100" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="img/rob-wingate-2Qf2_k0Q5T0-unsplash.jpg" class="d-block w-100" alt="Slide 3">
          </div>
          <div class="carousel-item">
            <img src="img/md-duran-rE9vgD_TXgM-unsplash.jpg" class="d-block w-100" alt="Slide 4">
          </div>
          <div class="carousel-item">
            <img src="img/chuttersnap-cX2vElQ5aHk-unsplash.jpg" class="d-block w-100" alt="Slide 5">
          </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team-section" style="background-color:#11468F; color: #EEEEEE;">
    <div class="container">
      <h3 class="text-center" style="color: #EEEEEE;">Tim Kami</h3>
      <div class="row">
        <div class="col-md-3">
          <div class="team-card">
            <img src="img/smile.jpg" alt="Team Member 1">
            <h4>Ananta Raihan Janatan</h4>
            <p>CEO & Founder</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="team-card">
            <img src="img/teme.jpeg" alt="Team Member 2">
            <h4>Akmal Ghanim</h4>
            <p>Programmer</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="team-card">
            <img src="img/Memes i found on internet (1).jpg" alt="Team Member 3">
            <h4>Michael Johnson</h4>
            <p>CTO</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="team-card">
            <img src="img/Memes i found on internet.jpg" alt="Team Member 4">
            <h4>Sarah Lee</h4>
            <p>CMO</p>
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
    // Jika pengguna mengklik tombol logout, tampilkan SweetAlert konfirmasi
    document.getElementById("logoutBtn")?.addEventListener("click", function(event) {
        event.preventDefault();

        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan keluar dari akun.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman logout
                window.location.href = 'logout.php';
            }
        });
    });
  </script>
</body>
</html>