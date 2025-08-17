<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil riwayat pembayaran user
$query = "SELECT p.*, e.EventName 
          FROM payments p 
          JOIN events e ON p.event_id = e.event_id 
          WHERE p.user_id = ? 
          ORDER BY p.created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Payment History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($payment = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['EventName']); ?></td>
                        <td>Rp <?php echo number_format($payment['amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        <td>
                            <?php if ($payment['status'] == 'success'): ?>
                                <span class="badge bg-success">Success</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($payment['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>