<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imagePath = '';

    // Proses upload gambar jika ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $imageName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    // Query untuk update
    if ($imagePath) {
        $sql = "UPDATE regis SET title = ?, content = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $title, $content, $imagePath, $id);
    } else {
        $sql = "UPDATE regis SET title = ?, content = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $content, $id);
    }

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Data berhasil diupdate.</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
    }

    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman data setelah update
    header('Location: admin.php?page=edit_registration');
    exit();
}
?>
