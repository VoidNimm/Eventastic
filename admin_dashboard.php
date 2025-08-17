<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil semua event
$result = $conn->query("SELECT * FROM events");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Eventastic</title>
    <link rel="stylesheet" href="css/font-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="img/fix1logotai_page-0001.jpg" alt="Eventastic Logo" style="height: 50px;">
        </a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="text-center">Admin Panel</h2>
    <a href="admin_add_event.php" class="btn btn-primary mb-3">Add New Event</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['EventName']) ?></td>
                    <td><?= htmlspecialchars($row['EventDescription']) ?></td>
                    <td><?= htmlspecialchars($row['EventPricePerVariant']) ?> Rp</td>
                    <td><img src="<?= htmlspecialchars($row['EventImage']) ?>" width="100"></td>
                    <td>
                        <a href="admin_edit_event.php?event_id=<?= $row['event_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin_delete_event.php?event_id=<?= $row['event_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<footer class="footer text-center py-3" style="background-color: #041562;">
    <p class="text-white">&copy; 2025 Eventastic. All Rights Reserved Indonesia</p>
</footer>

</body>
</html>
