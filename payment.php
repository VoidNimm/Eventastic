<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || !isset($_SESSION['user_id'])) {
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $amount = (float)$_POST['amount'];
        $payment_method = $_POST['payment_method'];

        // Validasi jumlah pembayaran
        $eventPrice = (float)$event['EventPricePerVariant'];
        if ($amount != $eventPrice) {
            echo "Error: Payment amount must be exactly Rp " . number_format($eventPrice, 2);
            exit();
        }

        // Cek duplikasi pembayaran
        $checkQuery = "SELECT * FROM payments WHERE user_id = ? AND event_id = ? AND created_at >= NOW() - INTERVAL 1 MINUTE";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $user_id, $event_id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "Error: A payment for this event was already processed recently.";
            exit();
        }

        // Simpan pembayaran
        $query = "INSERT INTO payments (user_id, event_id, amount, payment_method, status) 
                  VALUES (?, ?, ?, ?, 'success')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iids", $user_id, $event_id, $amount, $payment_method);

        if ($stmt->execute()) {
            // Simpan pesan sukses di session
            $_SESSION['payment_success'] = true;
            // Redirect ke halaman yang sama untuk menampilkan SweetAlert
            header("Location: payment.php?event_id=" . $event_id);
            exit();
        } else {
            echo "Payment failed. Please try again.";
        }
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
    <title>Payment - <?php echo htmlspecialchars($event['EventName']); ?></title>
    <link rel="stylesheet" href="css/payment-style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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

    <!-- Payment Section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="payment-card">
                    <h2 class="text-center">Payment for <?php echo htmlspecialchars($event['EventName']); ?></h2>
                    <form method="POST" id="paymentForm">
                        <div class="mb-3">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" value="Rp <?php echo number_format($event['EventPricePerVariant'], 2); ?>" readonly>
                            <input type="hidden" name="amount" value="<?php echo $event['EventPricePerVariant']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="payment_method">Payment Method</label>
                            <select id="payment_method" name="payment_method" required>
                                <option value="credit_card">Credit Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <button type="submit">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("paymentForm");
            form.addEventListener("submit", function() {
                const submitButton = form.querySelector("button[type='submit']");
                submitButton.disabled = true;
                submitButton.innerText = "Processing...";
            });
        });

        <?php if (isset($_SESSION['payment_success']) && $_SESSION['payment_success']): ?>
            Swal.fire({
                icon: 'success',
                title: 'Payment Successful!',
                text: 'Your payment has been processed successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php'; // Redirect ke home setelah mengklik OK
            });
            <?php unset($_SESSION['payment_success']); // Hapus session setelah digunakan ?>
        <?php endif; ?>
    </script>
</body>
</html>