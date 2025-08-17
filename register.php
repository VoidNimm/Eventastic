<?php
session_start();

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

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $role = $_POST['role'];

    // Cek apakah email sudah digunakan
    $sqlCheck = "SELECT * FROM users WHERE email = '$email'";
    $resultCheck = $conn->query($sqlCheck);
    
    if ($resultCheck->num_rows > 0) {
        echo "<script>
                alert('Email sudah digunakan!');
              </script>";
    } else {
        // Masukkan data ke dalam database
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire({
                        title: 'Register Berhasil!',
                        text: 'Invalid email/username or password.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                  </script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Eventastic</title>
  <link rel="stylesheet" href="css/login-register.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">



  <div class="wrapper">
    <!-- Register Section -->
    <section id="register-section">
      <div class="card">
        <h2 class="mb-4">Register</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-control" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
        </form>             
        <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
        <a href="index.php" id="backButton" class="mt-3 btn btn-outline-primary">Back</a>
      </div>
    </section>
  </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
