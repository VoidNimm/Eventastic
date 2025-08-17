<?php
session_start();
include 'config.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['event_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$event_id = $_GET['event_id'];
$result = $conn->query("SELECT * FROM events WHERE event_id = $event_id");

if ($result->num_rows == 0) {
    header("Location: admin_dashboard.php");
    exit();
}

$row = $result->fetch_assoc();

if (isset($_POST['updateEvent'])) {
    $eventName = $_POST['eventName'];
    $eventCategory = $_POST['eventCategory'];
    $eventDescription = $_POST['eventDescription'];
    $eventVariant = $_POST['eventVariant'];
    $eventPrice = $_POST['eventPrice'];

    $sql = "UPDATE events SET EventName='$eventName', EventCategory='$eventCategory',
            EventDescription='$eventDescription', EventVariant='$eventVariant', EventPricePerVariant='$eventPrice' 
            WHERE event_id=$event_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Event updated successfully!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'admin_dashboard.php';
            });
        </script>";
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="css/font-style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="text-center mb-4">Edit Event</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" class="form-control" name="eventName" value="<?php echo $row['EventName']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" name="eventCategory" value="<?php echo $row['EventCategory']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="eventDescription" required><?php echo $row['EventDescription']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Variant</label>
            <input type="text" class="form-control" name="eventVariant" value="<?php echo $row['EventVariant']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="eventPrice" value="<?php echo $row['EventPricePerVariant']; ?>" required>
        </div>
        <button type="submit" name="updateEvent" class="btn btn-success w-100">Update Event</button>
    </form>
</div>

</body>
</html>
