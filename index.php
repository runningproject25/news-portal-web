<?php
include 'connect.php'; // Koneksi ke database

// Ambil data kegiatan dari database
$sql_activity = "SELECT id, title, content, created_at, image FROM activity ORDER BY created_at DESC LIMIT 6";
$result_activity = $conn->query($sql_activity);

// Ambil data pendaftaran dari database
$sql_regis = "SELECT id, title, content, created_at, image FROM regis ORDER BY created_at DESC LIMIT 6";
$result_regis = $conn->query($sql_regis);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Medilab Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="kontainer d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">pnup@poliupg.ac.id</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 (411) 586043</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://x.com/PNUP_Official/?mx=2" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://web.facebook.com/PoltekNegeriUjungPandang-347781842302857/?_rdc=1&_rdr" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/poltek_upg/" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container-xxl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="assets/img/logo.png" alt="">
          <h1 class="sitename">Politeknik Negeri Ujung Pandang</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home<br></a></li>
            <li><a href="#services">Rilis Berita</a></li>
            <li><a href="#doctors">Pengumuman</a></li>
            <li class="move"><a href="#jurusan">Jurusan</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in" class="aos-init aos-animate">
    </section>
    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Rilis Berita</h2>
      </div><!-- End Section Title -->

      <div class="kontainer">

        <div class="row g-4">
          <?php
            if ($result_activity->num_rows > 0) {
              while ($row = $result_activity->fetch_assoc()) {
                $link = 'content_activity.php?id=' . $row['id'];
                echo "<div class='col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center' data-aos='fade-up' data-aos-delay='100'>";
                echo "<a href='" . htmlspecialchars($link) . "' class='team-member text-decoration-none'>";
                echo "<div class='pic'>";
                if ($row['image']) {
                  echo "<img src='" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='" . htmlspecialchars($row['title']) . "'>";
                }
                echo "</div>";
                echo "<div class='member-info'>";
                echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
              }
            } else {
              echo "<p>Tidak ada kegiatan yang tersedia.</p>";
            }
          ?>
        </div>
      </div>
      <div class="formulir d-flex align-items-center justify-content-between">
        <h4>Penerimaan Mahasiswa Baru Reguler UMPN-PNUP (UMPN-PNUP)</h4>
        <?php
          $sql_formulir = "SELECT * FROM formulir_pendaftaran ORDER BY id DESC LIMIT 1";
          $result_formulir = $conn->query($sql_formulir);

          if ($result_formulir === false) {
              echo "Error: " . $conn->error;
          } else {
              if ($result_formulir->num_rows > 0) {
                  $row = $result_formulir->fetch_assoc();
                  echo "<a href='" . htmlspecialchars($row['file_path']) . "' download>";
                  echo " <button type='submit' class='btn btn-primary'>FORMULIR PENDAFTARAN</button>";
                  echo "</a>";
              } else {
                  echo "<p>Tidak ada formulir pendaftaran yang tersedia.</p>";
              }
          }
        ?>
      </div>
    </section><!-- /Services Section -->

    <!-- Regis Section -->
    <section id="doctors" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pengumuman</h2>
        <h2></h2>
      </div><!-- End Section Title -->

      <div class="kontainer">

        <div class="row g-4">
            <?php
              if ($result_regis->num_rows > 0) {
                while ($row = $result_regis->fetch_assoc()) {
                  $link = 'content_regis.php?id=' . $row['id'];
                  echo "<div class='col-lg-4 col-md-8 col-sm-10 d-flex align-items-stretch' data-aos='fade-up' data-aos-delay='100'>";
                  echo "<a href='" . htmlspecialchars($link) . "' class='team-member text-decoration-none'>";
                  echo "<div class='pic'>";
                  if ($row['image']) {
                    echo "<img src='" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='" . htmlspecialchars($row['title']) . "'>";
                  }
                  echo "</div>";
                  echo "<div class='member-info'>";
                  echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                  echo "</div>";
                  echo "</a>";
                  echo "</div>";
                }
              } else {
                echo "<p>Tidak ada pendaftaran yang tersedia.</p>";
              }
            ?>
        </div>
      </div>
    </section><!-- /regis Section -->

    <!-- Tabel Section -->
    <section id="jurusan" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Jurusan</h2>
    </div><!-- End Section Title -->

    <div class="container">
        
        <?php
        include 'connect.php'; // Pastikan ini berisi koneksi ke database

        // Ambil semua jurusan unik
        $jurusan_sql = "SELECT DISTINCT jurusan FROM jurusan ORDER BY jurusan";
        $jurusan_result = $conn->query($jurusan_sql); 

        if ($jurusan_result->num_rows > 0) {
          // Loop melalui setiap jurusan
          while ($jurusan_row = $jurusan_result->fetch_assoc()) {
              $jurusan_name = htmlspecialchars($jurusan_row['jurusan']);
              echo "<h3 class='mt-4 fs-4 fw-bold text-primary text-capitalize'>$jurusan_name</h3>";
              
              // Ambil data berdasarkan jurusan saat ini
              $data_sql = "SELECT program_studi, akreditasi, daya_tampung FROM jurusan WHERE jurusan = ?";
              $stmt = $conn->prepare($data_sql);
              $stmt->bind_param("s", $jurusan_name);
              $stmt->execute();
              $data_result = $stmt->get_result();
      
              echo "<div class='table-responsive'>
                      <table class='table table-striped table-bordered'>
                          <thead>
                              <tr>
                                  <th class='text-center'>No</th>
                                  <th class='text-center'>Program Studi</th>
                                  <th class='text-center'>Akreditasi</th>
                                  <th class='text-center'>Daya Tampung</th>
                              </tr>
                          </thead>
                          <tbody>";
      
              if ($data_result->num_rows > 0) {
                  $no = 1;
                  while ($data_row = $data_result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td class='text-center'>" . $no++ . "</td>";
                      echo "<td>" . htmlspecialchars($data_row['program_studi']) . "</td>";
                      echo "<td class='text-center'>" . htmlspecialchars($data_row['akreditasi']) . "</td>";
                      echo "<td class='text-center'>" . htmlspecialchars($data_row['daya_tampung']) . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
              }
              
              echo "  </tbody>
                    </table>
                    </div>";
              
              $stmt->close();
          }
      } else {
          echo "<p>Tidak ada jurusan</p>";
      }
      
      

      // Tutup koneksi
      $conn->close();
      ?>
    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </section><!-- /tabel Section --> 
  </main>

  <footer id="footer" class="footer light-background">
    <div class="container footer-top">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Politeknik Negeri Ujung Pandang</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jalan Perintis Kemerdekaan KM.10 </p>
            <p>Tamalanrea , Makassar 90245</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 (411) 585365 | +62 (411) 585367 | +62 (411) 585368</span></p>
            <p><strong>Email:</strong> <span>pnup@poliupg.ac.id</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="https://x.com/PNUP_Official/?mx=2" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="https://web.facebook.com/PoltekNegeriUjungPandang-347781842302857/?_rdc=1&_rdr" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/poltek_upg/" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>