<?php
$servername = "localhost";
$username = "root"; // default username MySQL
$password = ""; // default password MySQL is empty
$dbname = "eventastic_db"; // nama database yang sudah Anda buat

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
