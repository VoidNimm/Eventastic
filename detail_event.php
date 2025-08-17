<?php
include 'config.php';
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $query = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        echo "Event not found.";
        exit();
    }
} else {
    echo "No event selected.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - <?php echo htmlspecialchars($event['EventName']); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .event-details {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .event-image {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }
        .event-info {
            margin-top: 20px;
        }
        .event-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        .btn-payment {
            background-color: #041562;
            color: #ffffff;
            padding: 10px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-payment:hover {
            background-color: #030d3d;
        }
    </style>
</head>
<body>
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

    <!-- Event Details Section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="event-details">
                    <h1 class="text-center mb-4"><?php echo htmlspecialchars($event['EventName']); ?></h1>
                    <img src="<?php echo htmlspecialchars($event['EventImage']); ?>" alt="Event Image" class="event-image">
                    <div class="event-info">
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($event['EventCategory']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($event['EventDescription']); ?></p>
                        <p><strong>Variant:</strong> <?php echo htmlspecialchars($event['EventVariant']); ?></p>
                        <p><strong>Price:</strong> Rp <?php echo number_format($event['EventPricePerVariant'], 2); ?></p>
                    </div>
                    <div class="text-center">
                        <a href="payment.php?event_id=<?php echo $event_id; ?>" class="btn-payment">Proceed to Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-white shadow-sm mt-5">
        <p class="mb-0">&copy; 2025 Eventastic. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>