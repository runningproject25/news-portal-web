<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurusan</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .alert-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            width: 100%;
            opacity: 1;
            transition: opacity 0.5s ease-out;
            border-radius: 0;
        }
        .header {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header id="header" class="header sticky-top depth">
        <div class="branding d-flex align-items-center">
            <div class="container-xxl position-relative d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center me-auto text-decoration-none">
                    <img src="assets/img/logo.png" alt="">
                    <h1 class="sitename">Politeknik Negeri Ujung Pandang</h1>
                </a>
                <nav id="navmenu" class="navmenu">
                      <ul>
                          <li><a href="admin.php?page=home" class="nav-link">Home</a></li>
                          <li class="dropdown"><a href="#" class="text-decoration-none"><span>Tambah Info</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                          <ul>
                            <li><a href="admin.php?page=insert_activity" class="nav-link">Rilis Berita</a></li>
                            <li><a href="admin.php?page=insert_registration" class="nav-link">Pengumuman</a></li>
                            <li><a href="admin.php?page=insert_form_regis" class="nav-link">Formulir</a></li>
                            <li><a href="admin.php?page=insert_jurusan" class="nav-link">Jurusan</a></li>
                          </ul>
                          </li>  
                          <li class="dropdown"><a href="#" class="text-decoration-none"><span>Hapus Info</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                            <li><a href="admin.php?page=delete_activity" class="nav-link">Rilis Berita</a></li>
                            <li><a href="admin.php?page=delete_registration" class="nav-link">Pengumuman</a></li>
                            <li><a href="admin.php?page=delete_form_regis" class="nav-link">Formulir</a></li>
                            <li><a href="admin.php?page=delete_jurusan" class="nav-link">Jurusan</a></li>
                            </ul>
                            </li> 
                            <li class="dropdown"><a href="#" class="text-decoration-none"><span>Edit Info</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="admin.php?page=edit_activity" class="nav-link">Rilis Berita</a></li>
                                <li><a href="admin.php?page=edit_registration" class="nav-link">Pengumuman</a></li>
                                <li><a href="admin.php?page=edit_jurusan" class="nav-link">Jurusan</a></li>
                            </ul>
                            </li>          
                      </ul>
                      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                  </nav> 
                <a class="cta-btn d-none d-sm-block text-decoration-none" href="logout.php">LOGOUT</a>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="section-title">
            <h2>Edit Jurusan</h2>
        </div>

        <?php
        include 'connect.php';

        // Validasi ID jurusan
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $id = $_GET['id'];

            // Ambil data jurusan berdasarkan ID
            $stmt = $conn->prepare("SELECT jurusan, program_studi, akreditasi, daya_tampung FROM jurusan WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($jurusan, $program_studi, $akreditasi, $daya_tampung);
            $stmt->fetch();
            $stmt->close();

            // Proses update data
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $jurusan = filter_var($_POST['jurusan'], FILTER_SANITIZE_STRING);
                $program_studi = filter_var($_POST['program_studi'], FILTER_SANITIZE_STRING);
                $akreditasi = filter_var($_POST['akreditasi'], FILTER_SANITIZE_STRING);
                $daya_tampung = filter_var($_POST['daya_tampung'], FILTER_SANITIZE_NUMBER_INT);

                // Update data ke database
                $stmt = $conn->prepare("UPDATE jurusan SET jurusan = ?, program_studi = ?, akreditasi = ?, daya_tampung = ? WHERE id = ?");
                $stmt->bind_param("sssii", $jurusan, $program_studi, $akreditasi, $daya_tampung, $id);

                if ($stmt->execute()) {
                    header('Location: admin.php?page=edit_jurusan'); // Redirect ke halaman edit_jurusan
                    exit();
                } else {
                    echo "<div class='alert alert-danger alert-top' role='alert'>Gagal memperbarui data.</div>";
                }

                $stmt->close();
            }
        } else {
            echo "<div class='alert alert-danger alert-top' role='alert'>ID tidak valid.</div>";
        }

        $conn->close();
        ?>

        <form action="admin.php?page=edit_jurusan_process&id=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($jurusan); ?>" required>
            </div>
            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?php echo htmlspecialchars($program_studi); ?>" required>
            </div>
            <div class="mb-3">
                <label for="akreditasi" class="form-label">Akreditasi</label>
                <input type="text" class="form-control" id="akreditasi" name="akreditasi" value="<?php echo htmlspecialchars($akreditasi); ?>" required>
            </div>
            <div class="mb-3">
                <label for="daya_tampung" class="form-label">Daya Tampung</label>
                <input type="number" class="form-control" id="daya_tampung" name="daya_tampung" value="<?php echo htmlspecialchars($daya_tampung); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        // Menghilangkan pesan setelah 3 detik
        setTimeout(function() {
            const alert = document.querySelector('.alert-top');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Menghapus elemen dari DOM setelah transisi
            }
        }, 3000);
    </script>
</body>
</html>
