<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .alert-top {
            position: fixed;
            top: 100px;
            left: 0;
            right: 0;
            z-index: 9999;
            width: 100%;
            opacity: 1;
            transition: opacity 0.5s ease-out;
            border-radius: 0;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #alert-container {
            margin-top: 20px;
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
                            <li><a href="admin.php?page=edit_form_regis" class="nav-link">Formulir</a></li>
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
        <h2 class="text-center">Formulir Pendaftaran</h2>
        <div class="form-container">
            <form action="admin.php?page=insert_form_regis" method="post" enctype="multipart/form-data"> <!-- Submit standar -->
                <div class="mb-3">
                    <label for="formulir_file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="formulir_file" name="formulir_file" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
    </div>

    <div id="alert-container"></div>

    <?php
    include 'connect.php'; // Koneksi ke database

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['formulir_file'])) {
        $file = $_FILES['formulir_file'];
        
        // Validasi ukuran dan jenis file
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        if (in_array($file['type'], $allowedTypes)) {
            if ($file['size'] <= $maxSize) {
                $fileName = basename($file['name']);
                $targetDir = "uploads_file/";
                $targetFile = $targetDir . $fileName;
                
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    // Simpan informasi file ke database
                    $sql = "INSERT INTO formulir_pendaftaran (file_name, file_path) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $fileName, $targetFile);
                    
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success alert-top'>File berhasil diupload dan disimpan ke database.</div>";
                    } else {
                        echo "<div class='alert alert-danger alert-top'>Gagal menyimpan informasi file ke database.</div>";
                    }

                    $stmt->close();
                } else {
                    echo "<div class='alert alert-danger alert-top'>Gagal mengupload file.</div>";
                }
            } else {
                echo "<div class='alert alert-warning alert-top'>Ukuran file terlalu besar. Maksimum 5MB.</div>";
            }
        } else {
            echo "<div class='alert alert-warning alert-top'>Jenis file tidak diizinkan. Hanya PDF dan Word yang diizinkan.</div>";
        }
    }
    ?>
    <script>
        // Menghilangkan pesan alert setelah 3 detik
        setTimeout(function() {
            const alert = document.querySelector('.alert-top');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Menghapus elemen setelah transisi
            }
        }, 3000);
    </script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
