<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
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
            <h2>Edit Activity</h2>
        </div>

        <?php
        include 'connect.php';

        // Validasi ID activity
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $id = $_GET['id'];

            // Ambil data activity berdasarkan ID
            $stmt = $conn->prepare("SELECT title, content, image FROM activity WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($title, $content, $image);
            $stmt->fetch();
            $stmt->close();

            // Proses update data
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
                $updated_at = date('Y-m-d H:i:s');

                // Validasi dan upload gambar jika ada
                if (!empty($_FILES["image"]["name"])) {
                    $target_dir = "uploads/";
                    $fileName = basename($_FILES["image"]["name"]);
                    $target_file = $target_dir . $fileName;
                    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if (in_array($fileType, ['png', 'jpg', 'jpeg'])) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image = $target_file;
                        } else {
                            echo "<div class='alert alert-danger alert-top' role='alert'>Gagal mengupload file.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger alert-top' role='alert'>Jenis file tidak diizinkan. Hanya PNG dan JPG yang diizinkan.</div>";
                    }
                }

                // Update data ke database
                $stmt = $conn->prepare("UPDATE activity SET title = ?, content = ?, image = ?, created_at = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $title, $content, $image, $updated_at, $id);

                if ($stmt->execute()) {
                    header('Location: admin.php?page=edit_activity'); // Redirect ke halaman edit_activity
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

        <form action="admin.php?page=edit_activity_process&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Isi Berita</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Berita</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if (!empty($image)): ?>
                    <img src="<?php echo $image; ?>" alt="Image" style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
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
