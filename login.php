<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginInput = trim($_POST['loginInput']); // Menghapus spasi tambahan
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $loginInput, $loginInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Pastikan password di database sudah di-hash
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['isLoggedIn'] = true;

            // Redirect sesuai role
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            header("Location: login.php?error=invalidpassword");
            exit();
        }
    } else {
        header("Location: login.php?error=invalidcredentials");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Eventastic</title>
  <link rel="stylesheet" href="css/login-register.css">
  <link rel="stylesheet" href="css/font-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light mb-4" style="background-color: #ffffff;">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img src="img/fix1logotai_page-0001.jpg" alt="Eventastic Logo" style="height: 70px;">
        </a>
      </div>
    </nav>

    <section id="login-section">
      <div class="card">
        <h2 class="mb-4">Login</h2>
        <form action="login.php" method="POST">
          <div class="mb-3">
            <label for="loginInput" class="form-label">Username / Email</label>
            <input type="text" id="loginInput" name="loginInput" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>        
        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
        <a href="index.php" class="mt-3 btn btn-outline-primary">Back</a>
        
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'invalidpassword') {
            echo "<p class='text-danger'>Invalid password. Please try again.</p>";
        } elseif (isset($_GET['error']) && $_GET['error'] == 'invalidcredentials') {
            echo "<p class='text-danger'>Invalid email/username or password. Please try again.</p>";
        }
        ?>
      </div>
    </section>
  </div>
</body>
</html>
