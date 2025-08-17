<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventastic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form jika disubmit
if (isset($_POST['addEvent'])) {
    $eventName = $_POST['eventName'];
    $eventCategory = $_POST['eventCategory'];
    $eventDescription = $_POST['eventDescription'];
    $eventVariant = $_POST['eventVariant'];
    $eventPrice = $_POST['eventPrice'];

    // Menangani upload file gambar
    $targetDir = "img/"; // Folder untuk menyimpan gambar
    $targetFile = $targetDir . basename($_FILES["eventImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek jika gambar benar-benar file gambar
    if (getimagesize($_FILES["eventImage"]["tmp_name"]) !== false) {
        if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $targetFile)) {
            // Insert event data ke database
            $sql = "INSERT INTO events (EventName, EventImage, EventCategory, EventDescription, EventVariant, EventPricePerVariant)
                    VALUES ('$eventName', '$targetFile', '$eventCategory', '$eventDescription', '$eventVariant', '$eventPrice')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Event added successfully!'); window.location.href='admin_dashboard.php';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }

    if ($conn->query($sql) === TRUE) {
      echo "<script>
          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Event added successfully!',
              showConfirmButton: false,
              timer: 2000
          }).then(() => {
              window.location.href = 'admin_dashboard.php';
          });
      </script>";
      exit();
  }
  
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Event - Eventastic</title>
  <link rel="stylesheet" href="css/login-register.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center mb-4">Add New Event</h2>

    <!-- Add Event Form -->
    <form action="admin_add_event.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="eventName" class="form-label">Event Name</label>
        <input type="text" class="form-control" id="eventName" name="eventName" required>
      </div>

      <div class="mb-3">
        <label for="eventCategory" class="form-label">Event Category</label>
        <select class="form-select" id="eventCategory" name="eventCategory" required>
          <option value="wedding">Wedding</option>
          <option value="business">Business</option>
          <option value="conference">Conference</option>
          <option value="concert">Concert</option>
          <option value="sports">Sports</option>
          <option value="birthday">Birthday</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="eventDescription" class="form-label">Event Description</label>
        <textarea class="form-control" id="eventDescription" name="eventDescription" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label for="eventImage" class="form-label">Event Image</label>
        <input type="file" class="form-control" id="eventImage" name="eventImage" required>
      </div>

      <div class="mb-3">
        <label for="eventVariant" class="form-label">Event Variant</label>
        <input type="text" class="form-control" id="eventVariant" name="eventVariant" required>
      </div>

      <div class="mb-3">
        <label for="eventPrice" class="form-label">Event Price per Variant</label>
        <input type="number" step="0.01" class="form-control" id="eventPrice" name="eventPrice" required>
      </div>

      <button type="submit" class="btn btn-primary w-100" name="addEvent" href="index.php">Add Event</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
