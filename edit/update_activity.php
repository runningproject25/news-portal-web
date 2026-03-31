<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jurusan = $_POST['jurusan'];
    $program_studi = $_POST['program_studi'];
    $akreditasi = $_POST['akreditasi'];
    $daya_tampung = $_POST['daya_tampung'];

    // Query untuk update data tanpa gambar
    $sql = "UPDATE jurusan SET jurusan = ?, program_studi = ?, akreditasi = ?, daya_tampung = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssii', $jurusan, $program_studi, $akreditasi, $daya_tampung, $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Data berhasil diupdate.</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
    }

    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman edit jurusan setelah update
    header('Location: admin.php?page=edit_jurusan');
    exit();
}
?>
