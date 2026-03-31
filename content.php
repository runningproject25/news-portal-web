<?php
include 'connect.php'; // Koneksi ke database

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan ID dari parameter URL
$id = intval($_GET['id']); // Menggunakan intval untuk menghindari serangan SQL Injection

// Query untuk mendapatkan data kegiatan berdasarkan ID
$sql = "SELECT title, image, content, created_at FROM activity WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detail Kegiatan</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Main CSS File -->
  <link href="assets/css/content.css" rel="stylesheet">
</head>

<body>
<?php
if ($row) {
    echo "<div class='content-container'>";
    echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
    if ($row['image']) {
        echo "<img src='" . htmlspecialchars($row['image']) . "' class='img-cover' alt='" . htmlspecialchars($row['title']) . "'>";
    }
    echo "<div class='meta-info'>";
    echo "<small>Dibuat pada: " . htmlspecialchars($row['created_at']) . "</small>";
    echo "</div>";
    echo "<p>" . htmlspecialchars($row['content']) . "</p>";
    echo "</div>";     
} else {
    echo "<p>Data tidak ditemukan.</p>";
}

$stmt->close();
$conn->close();
?>

</body>

</html>
