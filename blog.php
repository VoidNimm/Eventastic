<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - Eventastic</title>
  <link rel="stylesheet" href="css/blog-style.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
  <style>
    /* Hero Section */
.hero {
  position: relative;
  width: 100%;
  min-height: 60vh; /* Mengurangi tinggi agar tidak terlalu besar */
  margin-top: 0px; /* Menyesuaikan agar tidak tertutup navbar */
  overflow: hidden;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: blur(5px); /* Blur sedikit agar tulisan lebih jelas */
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* Overlay agar teks lebih terbaca */
}

.hero-text {
  position: relative;
  text-align: center;
  color: white;
  z-index: 2;
  padding: 20px;
}

.hero-text h1 {
  font-weight: bold;
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

<section class="hero">
    <div class="hero-background">
        <img src="img/quan-nguyen-yDSe7sggb9Q-unsplash.jpg" alt="Event background" class="hero-img">
        <div class="overlay"></div>
    </div>
    <div class="hero-text position-absolute top-50 start-50 translate-middle">
        <h1>Insights, stories, and updates from the world of Eventastic</h1>
    </div>
</section>

<section class="container my-5">
    <h2 class="text-center fw-bold mb-4">LATEST BLOG POSTS</h2>
    <div class="row g-4">
        <?php
        // Dummy data blog
        $blogs = [
            ["title" => "How to Travel Cheap: 16 Ways to Travel for Cheap or Free", "img" => "img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg", "link" => "blog-detail.php?id=1"],
            ["title" => "12 Ways to Avoid Staying in a Bad Hostel", "img" => "img/andrei-stratu-kcJsQ3PJrYU-unsplash.jpg", "link" => "blog-detail.php?id=2"],
            ["title" => "9 Destinations Under $50 A Day", "img" => "img/teemu-paananen-bzdhc5b3Bxs-unsplash.jpg", "link" => "blog-detail.php?id=3"],
            ["title" => "How to Eat Cheap Around the World", "img" => "img/pablo-heimplatz-ZODcBkEohk8-unsplash.jpg", "link" => "blog-detail.php?id=4"],
            ["title" => "The Secret to Long Term Traveling", "img" => "img/al-elmes-ULHxWq8reao-unsplash.jpg", "link" => "blog-detail.php?id=5"],
            ["title" => "Get Our Travel Journal to Record Your Travels!", "img" => "img/priscilla-du-preez-Q7wGvnbuwj0-unsplash.jpg", "link" => "blog-detail.php?id=6"]
        ];

        foreach ($blogs as $blog) {
            echo '
            <div class="col-md-4">
                <div class="card border-0">
                    <a href="' . $blog['link'] . '" class="text-decoration-none text-dark">
                        <img src="' . $blog['img'] . '" class="card-img-top rounded" alt="Blog Image">
                        <div class="mt-2 fw-bold">' . $blog['title'] . '</div>
                    </a>
                </div>
            </div>';
        }
        ?>
    </div>
</section>


  <!-- Footer -->
  <footer class="text-white text-center py-3" style="background-color: #041562; margin-top:10rem;">
    <p>&copy; 2025 Eventastic. All Rights Reserved Indonesia</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="js/login-resgiter.js"></script>

</body>
</html>
