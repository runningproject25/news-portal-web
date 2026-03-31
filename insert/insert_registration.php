<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
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
            border-radius: 0; /* Membuat sudut pesan tidak melengkung */
        }
        .header {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
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
        <div class="section-title">
            <h2>Pendaftaran</h2>
        </div>
        
        <!-- Tempatkan elemen pesan di sini -->
        <?php
        include 'connect.php'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $created_at = $_POST['created_at'];

            // Proses unggah gambar
            $target_dir = "uploads/";
            $fileName = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $fileName;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validasi tipe file
            if ($fileType == "png" || $fileType == "jpg" || $fileType == "jpeg") {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;

                    // Prepared statement untuk menghindari SQL Injection
                    $stmt = $conn->prepare("INSERT INTO regis (title, content, created_at, image) VALUES (?, ?, ?, ?)");
                    if ($stmt === false) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }

                    $bind = $stmt->bind_param("ssss", $title, $content, $created_at, $image);
                    if ($bind === false) {
                        die('Bind failed: ' . htmlspecialchars($stmt->error));
                    }

                    $exec = $stmt->execute();
                    if ($exec) {
                        echo "<div class='alert alert-success alert-top' role='alert'>
                                  Informasi berhasil disimpan!
                              </div>";
                    } else {
                        echo "<div class='alert alert-danger alert-top' role='alert'>
                                  Gagal menyimpan informasi file ke database.
                              </div>";
                    }

                    $stmt->close();
                } else {
                    echo "<div class='alert alert-danger alert-top' role='alert'>
                              Gagal mengupload file.
                          </div>";
                }
            } else {
                echo "<div class='alert alert-danger alert-top' role='alert'>
                          Jenis file tidak diizinkan. Hanya PNG dan JPG yang diizinkan.
                      </div>";
            }
        }
        ?>
        
        <form action="admin.php?page=insert_registration" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Pendaftaran</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Pendaftaran</label>
                <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Isi Pendaftaran</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
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
