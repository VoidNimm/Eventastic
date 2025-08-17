<?php
session_start();
include 'config.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    
    $sql = "DELETE FROM events WHERE event_id = $event_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Event has been deleted.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'admin_dashboard.php';
            });
        </script>";
        exit();
    } else {
        echo "Error deleting event: " . $conn->error;
    }
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
