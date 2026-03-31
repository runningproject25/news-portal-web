<?php
include 'connect.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil parameter page dari URL, jika tidak ada, default ke 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Default ke 'home'

// Switch case untuk menampilkan halaman berdasarkan parameter 'page'
switch ($page) {
    case 'home':
        include 'insert/home.php';
        break;
    case 'insert_activity':
        include 'insert/insert_activity.php';
        break;
    case 'insert_registration':
        include 'insert/insert_registration.php';
        break;
    case 'insert_form_regis':
        include 'insert/upload_file.php';
        break;
    case 'insert_jurusan':
        include 'insert/insert_jurusan.php';
        break;
    case 'delete_activity':
        include 'delete/delete_activity.php';
        break;
    case 'delete_registration':
        include 'delete/delete_registration.php';
        break;
    case 'delete_form_regis':
        include 'delete/delete_form.php';
        break;
    case 'delete_jurusan':
        include 'delete/delete_jurusan.php';
        break;
    case 'edit_activity':
        include 'edit/edit_activity.php';
        break;
    case 'edit_activity_process':
        include 'edit/edit_activity_process.php';
        break;
    case 'edit_registration':
        include 'edit/edit_registration.php';
        break;
    case 'edit_registration_process':
        include 'edit/edit_registration_process.php';
        break;
    case 'edit_jurusan':
        include 'edit/edit_jurusan.php';
        break;
    case 'edit_jurusan_process':
        include 'edit/edit_jurusan_process.php';
        break;
    default:
        include 'insert/home.php'; // Default fallback ke 'home.php'
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin_dashboard.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>
<body class="index-page">
    
    <!-- Dashboard Content -->
    <div id="content" class="row">
        <!-- Konten dinamis akan dimuat berdasarkan navigasi biasa -->
    </div>

    <!-- Menambahkan script di akhir halaman -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
