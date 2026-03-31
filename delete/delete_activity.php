<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Activity</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

        .table-container {
            max-width: 1400px;
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

    <div class="container-xxl mt-5">
        <h2 class="text-center">Rilis Berita</h2>
        
        <!-- Form Pencarian -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="">
                    <input type="hidden" name="page" value="delete_activity">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan title atau content..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="table-container">
            <?php
            include 'connect.php'; // Koneksi ke database

            // Proses penghapusan data
            if (isset($_GET['delete_id'])) {
                $id = intval($_GET['delete_id']);
                $sql = "DELETE FROM activity WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $id);
                
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success alert-top'>Data berhasil dihapus.</div>";
                    echo "<script>setTimeout(function() { window.location.href = 'admin.php?page=delete_activity'; }, 2000);</script>";
                } else {
                    echo "<div class='alert alert-danger alert-top'>Gagal menghapus data.</div>";
                }

                $stmt->close();
            }

            // Query untuk pencarian data
            $search = isset($_GET['search']) ? '%' . $conn->real_escape_string($_GET['search']) . '%' : '';
            if (!empty($search)) {
                $sql = "SELECT id, title, image, content, created_at FROM activity WHERE title LIKE ? OR content LIKE ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $search, $search);
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $sql = "SELECT id, title, image, content, created_at FROM activity";
                $result = $conn->query($sql);
            }

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td><img src='{$row['image']}' alt='{$row['title']}' style='width: 100px;'></td>
                            <td>{$row['content']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='admin.php?page=delete_activity&delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                            </td>
                          </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>Tidak ada data yang tersedia.</p>";
            }

            if (isset($stmt)) {
                $stmt->close();
            }
            $conn->close(); // Tutup koneksi
            ?>
        </div>
    </div>

    <div id="alert-container"></div>

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
