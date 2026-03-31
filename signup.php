<?php

session_start();
include 'connect.php'; // Koneksi ke database

// Cek apakah token di URL sesuai dengan token di sesi
// if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['signup_token']) {
//     echo "Akses ditolak! Token tidak valid.";
//     exit();
// }

// Mengecek apakah formulir telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data admin baru
    $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Pendaftaran admin berhasil!";
        // Redirect ke halaman login atau dashboard setelah berhasil signup
        header("Location: login.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/signup_login.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-container bg-light">
            <div class="login-header text-center">
                <h2>Signup</h2>
            </div>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
