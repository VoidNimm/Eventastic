<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventastic_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filterCategory = isset($_GET['category']) ? $_GET['category'] : '';
$sql = "SELECT * FROM events WHERE EventName LIKE '%$searchQuery%'";
if (!empty($filterCategory)) {
    $sql .= " AND EventCategory = '$filterCategory'";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event - Eventastic</title>
  <link rel="stylesheet" href="css/font-style.css">
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Hero Section */
.hero {
  position: relative;
  width: 100%;
  min-height: 30vh; /* Mengurangi tinggi agar tidak terlalu besar */
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

/* Event Cards Hover Animation */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px; /* Add space between the cards */
  }
  
  .card:hover {
    transform: scale(1.05); /* Slightly enlarges the card */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Adds shadow effect */
  }
  
  .card img {
    transition: transform 0.3s ease;
  }
  
  /* Adding a slight zoom effect to the image */
  .card:hover img {
    transform: scale(1.1); /* Zooms in on the image */
  }
  
  /* Optional: Add overlay effect to improve visual design */
  .card .card-body {
    position: relative;
    z-index: 1;
  }
  
  .card .card-body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1); /* Transparent overlay */
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
  }
  
  .card:hover .card-body::before {
    opacity: 1; /* Fade in overlay on hover */
  }
  
  /* Make the card images responsive */
  .card-img-top {
    width: 100%;
    height: auto;
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
        <img src="img/al-nik-J5XqX-qvEZE-unsplash.jpg" alt="Event background" class="hero-img">
        <div class="overlay"></div>
    </div>
    <div class="hero-text position-absolute top-50 start-50 translate-middle">
        <h1>Terlengkap, Tercepat, Termudah</h1>
    </div>
</section>

  <section class="py-5 bg-light">
    <div class="container">
        <!-- Search dan Filter Berdekatan -->
        <div class="d-flex align-items-center gap-2 mb-3" style="max-width: 500px;">
            <input type="text" id="search" class="form-control" placeholder="Search events...">
            <select id="filter" class="form-select">
                <option value="">All Categories</option>
                <option value="Wedding">Wedding</option>
                <option value="Bussines">Bussines</option>
                <option value="Conference">Conference</option>
                <option value="Concert">Concert</option>
                <option value="Sports">Sports</option>
                <option value="Birthday">Birthday</option>
            </select>
        </div>

        <!-- Judul Event -->
        <h2 id="eventTitle">All Events</h2>

<!-- Daftar Event -->
<div class="row" id="eventResults">
    <?php if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4'>
                    <a href='detail_event.php?event_id={$row['event_id']}' class='text-decoration-none' style='color: inherit;'>
                        <div class='card shadow-sm' style='cursor: pointer;'>
                            <img src='{$row['EventImage']}' class='card-img-top'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['EventName']}</h5>
                                <p class='card-text'>{$row['EventDescription']}</p>
                                <h4>{$row['EventPricePerVariant']} Rp</h4>
                                <button class='btn btn-danger w-100'>Details</button>
                            </div>
                        </div>
                    </a>
                  </div>";
        }
    } else {
        echo "<p class='text-center text-muted'>No events found.</p>";
    } ?>
</div>
    </div>
</section>

  <!-- Footer -->
  <footer class="text-white text-center py-3" style="background-color: #041562; margin-top:10rem;">
    <p>&copy; 2025 Eventastic. All Rights Reserved Indonesia</p>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
        function fetchEvents() {
            let search = $('#search').val();
            let category = $('#filter').val();
            let title = category ? category + " Events" : "All Events";
            $('#eventTitle').text(title);
            $.get('event.php', { search: search, category: category }, function (data) {
                $('#eventResults').html($(data).find('#eventResults').html());
            });
        }
        $('#search, #filter').on('input change', fetchEvents);
    });
  </script>
</body>
</html>
