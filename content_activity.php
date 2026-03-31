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
    <style>
        h4 {
            font-weight: 500;
            text-align: left; 
        }
        .meta-info {
            color: #6c757d; 
            margin-bottom: 50px;
        }

        .content-container img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            height: auto;
            margin-bottom: 50px;
        }
    </style>
</head>
<body class="index-page">
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
                            <li><a href="admin.php?page=insert_activity" class="nav-link">Kegiatan</a></li>
                            <li><a href="admin.php?page=insert_registration" class="nav-link">Pendaftaran</a></li>
                            <li><a href="admin.php?page=insert_form_regis" class="nav-link">Formulir</a></li>
                            <li><a href="admin.php?page=insert_jurusan" class="nav-link">Jurusan</a></li>
                        </ul>
                        </li>  
                        <li class="dropdown"><a href="#" class="text-decoration-none"><span>Hapus Info</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="admin.php?page=delete_activity" class="nav-link">Kegiatan</a></li>
                            <li><a href="admin.php?page=delete_registration" class="nav-link">Pendaftaran</a></li>
                            <li><a href="admin.php?page=delete_form_regis" class="nav-link">Formulir</a></li>
                            <li><a href="admin.php?page=delete_jurusan" class="nav-link">Jurusan</a></li>
                        </ul>
                        </li>   
                        <li class="dropdown"><a href="#" class="text-decoration-none"><span>Edit Info</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="admin.php?page=edit_activity" class="nav-link">Kegiatan</a></li>
                            <li><a href="admin.php?page=edit_registration" class="nav-link">Pendaftaran</a></li>
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
    
    <main class="main">
    <section id="services" class="services section">

        <div class="container" data-aos="fade-up">
        <?php
            include 'connect.php';

            // Mengecek koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Mendapatkan ID dari parameter URL
            $id = intval($_GET['id']);

            // Query untuk mendapatkan data kegiatan berdasarkan ID
            $sql = "SELECT title, image, content, created_at FROM activity WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                echo "<div class='content-container'>";
                echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                echo "<div class='meta-info'>";
                echo "<small>Dibuat pada: " . htmlspecialchars($row['created_at']) . "</small>";
                echo "</div>";
                if ($row['image']) {
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "'>";
                }
                echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                echo "</div>";
            } else {
                echo "<p>Data tidak ditemukan.</p>";
            }

            $stmt->close();
            $conn->close();
        ?>
        </div>
    </section>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
