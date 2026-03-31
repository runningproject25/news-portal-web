<?php
include 'connect.php';

$sql_activity = "SELECT id, title, content, created_at, image FROM activity ORDER BY created_at DESC LIMIT 6";
$result_activity = $conn->query($sql_activity);

$sql_regis = "SELECT id, title, content, created_at, image FROM regis ORDER BY created_at DESC LIMIT 6";
$result_regis = $conn->query($sql_regis);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PNUP - Politeknik Negeri Ujung Pandang</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    :root {
      --pnup-navy: #0a2342;
      --pnup-blue: #1a4a8a;
      --pnup-gold: #c8922a;
      --pnup-gold-light: #f0c060;
      --pnup-light: #f5f7fa;
      --pnup-white: #ffffff;
      --pnup-text: #1a1a2e;
      --pnup-muted: #6b7280;
      --pnup-border: #e5e7eb;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * { box-sizing: border-box; }

    body {
      font-family: 'DM Sans', sans-serif;
      color: var(--pnup-text);
      background: var(--pnup-white);
      overflow-x: hidden;
    }

    /* ── TOPBAR ── */
    .topbar {
      background: var(--pnup-navy);
      padding: 8px 0;
      font-size: 13px;
    }
    .topbar a { color: rgba(255,255,255,0.75); text-decoration: none; transition: var(--transition); }
    .topbar a:hover { color: var(--pnup-gold-light); }
    .topbar .bi { color: var(--pnup-gold); margin-right: 5px; }
    .topbar .social-links a {
      width: 28px; height: 28px;
      display: inline-flex; align-items: center; justify-content: center;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.2);
      color: rgba(255,255,255,0.75);
      margin-left: 6px;
      font-size: 12px;
      transition: var(--transition);
    }
    .topbar .social-links a:hover {
      background: var(--pnup-gold);
      border-color: var(--pnup-gold);
      color: white;
    }

    /* ── HEADER ── */
    #header {
      background: var(--pnup-white);
      border-bottom: 1px solid var(--pnup-border);
      box-shadow: 0 2px 20px rgba(10,35,66,0.08);
    }
    .branding { padding: 14px 0; }
    .logo img { height: 48px; margin-right: 12px; }
    .sitename {
      font-family: 'DM Serif Display', serif;
      font-size: 18px;
      color: var(--pnup-navy);
      margin: 0;
      line-height: 1.2;
    }

    /* ── NAV ── */
    .navmenu ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 4px; }
    .navmenu a {
      font-size: 14px;
      font-weight: 500;
      color: var(--pnup-navy);
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 6px;
      transition: var(--transition);
    }
    .navmenu a:hover, .navmenu .active { background: var(--pnup-light); color: var(--pnup-blue); }
    .navmenu .dropdown { position: relative; }
    .navmenu .dropdown ul {
      display: none; position: absolute; top: calc(100% + 8px); left: 0;
      background: white; border: 1px solid var(--pnup-border);
      border-radius: 10px; min-width: 200px;
      box-shadow: 0 10px 40px rgba(10,35,66,0.12);
      padding: 6px; z-index: 999; flex-direction: column; gap: 2px;
    }
    .navmenu .dropdown:hover ul { display: flex; }
    .navmenu .dropdown ul a { font-size: 13px; color: var(--pnup-text); border-radius: 6px; }
    .navmenu .dropdown ul a:hover { background: var(--pnup-light); color: var(--pnup-blue); }

    .cta-btn {
      background: var(--pnup-gold);
      color: white !important;
      padding: 9px 20px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: var(--transition);
    }
    .cta-btn:hover { background: var(--pnup-navy); transform: translateY(-1px); }

    /* ── HERO ── */
    .hero-section {
      position: relative;
      min-height: 520px;
      background: linear-gradient(135deg, var(--pnup-navy) 0%, var(--pnup-blue) 60%, #2563a8 100%);
      display: flex; align-items: center; overflow: hidden;
    }
    .hero-section::before {
      content: '';
      position: absolute; inset: 0;
      background: url('assets/img/hero-bg.jpg') center/cover no-repeat;
      opacity: 0.15;
    }
    .hero-pattern {
      position: absolute; right: -80px; top: -80px;
      width: 500px; height: 500px;
      border-radius: 50%;
      border: 60px solid rgba(200,146,42,0.12);
    }
    .hero-pattern-2 {
      position: absolute; left: -40px; bottom: -100px;
      width: 300px; height: 300px;
      border-radius: 50%;
      border: 40px solid rgba(255,255,255,0.05);
    }
    .hero-content { position: relative; z-index: 1; padding: 80px 0; }
    .hero-badge {
      display: inline-block;
      background: rgba(200,146,42,0.2);
      border: 1px solid var(--pnup-gold);
      color: var(--pnup-gold-light);
      font-size: 12px; font-weight: 500;
      padding: 5px 14px; border-radius: 20px;
      margin-bottom: 20px; letter-spacing: 1px;
      text-transform: uppercase;
    }
    .hero-title {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(32px, 5vw, 52px);
      color: white;
      line-height: 1.15;
      margin-bottom: 20px;
    }
    .hero-title span { color: var(--pnup-gold-light); font-style: italic; }
    .hero-desc { color: rgba(255,255,255,0.75); font-size: 16px; line-height: 1.7; max-width: 520px; margin-bottom: 32px; }
    .hero-stats { display: flex; gap: 32px; }
    .hero-stat-num {
      font-family: 'DM Serif Display', serif;
      font-size: 28px; color: var(--pnup-gold-light);
    }
    .hero-stat-label { font-size: 12px; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; }

    /* ── SECTION SHARED ── */
    .section-header { text-align: center; margin-bottom: 48px; }
    .section-label {
      display: inline-block;
      font-size: 12px; font-weight: 500;
      color: var(--pnup-gold);
      text-transform: uppercase; letter-spacing: 1.5px;
      margin-bottom: 10px;
    }
    .section-title-main {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(26px, 4vw, 38px);
      color: var(--pnup-navy);
      margin: 0 0 12px;
    }
    .section-divider {
      width: 50px; height: 3px;
      background: var(--pnup-gold);
      border-radius: 2px;
      margin: 0 auto;
    }

    /* ── NEWS SECTION ── */
    .news-section { padding: 80px 0; background: var(--pnup-white); }

    .news-card {
      background: white;
      border: 1px solid var(--pnup-border);
      border-radius: 14px;
      overflow: hidden;
      transition: var(--transition);
      height: 100%;
      text-decoration: none;
      display: flex; flex-direction: column;
    }
    .news-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 48px rgba(10,35,66,0.12);
      border-color: transparent;
    }
    .news-card-img {
      width: 100%; aspect-ratio: 16/9;
      object-fit: cover;
      background: var(--pnup-light);
    }
    .news-card-img-placeholder {
      width: 100%; aspect-ratio: 16/9;
      background: linear-gradient(135deg, var(--pnup-light), #e0e7f0);
      display: flex; align-items: center; justify-content: center;
    }
    .news-card-img-placeholder .bi { font-size: 36px; color: var(--pnup-blue); opacity: 0.3; }
    .news-card-body { padding: 20px 22px 22px; flex: 1; display: flex; flex-direction: column; }
    .news-card-tag {
      display: inline-block;
      font-size: 11px; font-weight: 500;
      color: var(--pnup-blue);
      background: #e8f0fb;
      padding: 3px 10px; border-radius: 20px;
      margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .news-card-title {
      font-family: 'DM Serif Display', serif;
      font-size: 17px; color: var(--pnup-navy);
      line-height: 1.4; margin-bottom: 10px;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .news-card-excerpt {
      font-size: 13px; color: var(--pnup-muted); line-height: 1.6;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
      flex: 1;
    }
    .news-card-footer {
      display: flex; align-items: center; justify-content: space-between;
      margin-top: 16px; padding-top: 14px;
      border-top: 1px solid var(--pnup-border);
    }
    .news-card-date { font-size: 12px; color: var(--pnup-muted); }
    .news-card-arrow {
      width: 30px; height: 30px;
      display: flex; align-items: center; justify-content: center;
      background: var(--pnup-navy);
      border-radius: 50%; color: white; font-size: 13px;
      transition: var(--transition);
    }
    .news-card:hover .news-card-arrow { background: var(--pnup-gold); }

    /* ── PENGUMUMAN SECTION ── */
    .pengumuman-section { padding: 80px 0; background: var(--pnup-light); }

    .regis-card {
      background: white;
      border: 1px solid var(--pnup-border);
      border-radius: 14px;
      overflow: hidden;
      transition: var(--transition);
      text-decoration: none;
      display: flex; flex-direction: column;
      height: 100%;
    }
    .regis-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 48px rgba(10,35,66,0.12);
      border-color: transparent;
    }
    .regis-card-img {
      width: 100%; aspect-ratio: 16/9;
      object-fit: cover;
    }
    .regis-card-placeholder {
      width: 100%; aspect-ratio: 16/9;
      background: linear-gradient(135deg, #e8f0fb, #c8d8f0);
      display: flex; align-items: center; justify-content: center;
    }
    .regis-card-placeholder .bi { font-size: 36px; color: var(--pnup-blue); opacity: 0.4; }
    .regis-card-body { padding: 20px 22px 22px; flex: 1; display: flex; flex-direction: column; }
    .regis-card-tag {
      display: inline-block;
      font-size: 11px; font-weight: 500;
      color: #7c3aed; background: #ede9fe;
      padding: 3px 10px; border-radius: 20px;
      margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .regis-card-title {
      font-family: 'DM Serif Display', serif;
      font-size: 17px; color: var(--pnup-navy);
      line-height: 1.4; margin-bottom: 8px;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .regis-card-excerpt {
      font-size: 13px; color: var(--pnup-muted); line-height: 1.6; flex: 1;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .regis-card-footer {
      display: flex; align-items: center; justify-content: space-between;
      margin-top: 16px; padding-top: 14px;
      border-top: 1px solid var(--pnup-border);
    }
    .regis-card-date { font-size: 12px; color: var(--pnup-muted); }
    .regis-card-arrow {
      width: 30px; height: 30px;
      display: flex; align-items: center; justify-content: center;
      background: #7c3aed; border-radius: 50%; color: white; font-size: 13px;
      transition: var(--transition);
    }
    .regis-card:hover .regis-card-arrow { background: var(--pnup-navy); }

    /* ── JURUSAN SECTION ── */
    .jurusan-section { padding: 80px 0; background: var(--pnup-white); }

    .jurusan-group { margin-bottom: 48px; }
    .jurusan-group-header {
      display: flex; align-items: center; gap: 14px;
      margin-bottom: 16px;
    }
    .jurusan-icon {
      width: 44px; height: 44px;
      background: linear-gradient(135deg, var(--pnup-navy), var(--pnup-blue));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 20px; flex-shrink: 0;
    }
    .jurusan-group-name {
      font-family: 'DM Serif Display', serif;
      font-size: 22px; color: var(--pnup-navy); margin: 0;
    }

    .jurusan-table {
      width: 100%; border-collapse: separate; border-spacing: 0;
      border: 1px solid var(--pnup-border); border-radius: 12px;
      overflow: hidden; font-size: 14px;
    }
    .jurusan-table thead tr { background: var(--pnup-navy); }
    .jurusan-table thead th {
      color: rgba(255,255,255,0.9); font-weight: 500;
      padding: 14px 18px; text-align: left; font-size: 13px;
      border: none;
    }
    .jurusan-table thead th:first-child { width: 50px; text-align: center; }
    .jurusan-table thead th:nth-child(3),
    .jurusan-table thead th:nth-child(4) { text-align: center; }
    .jurusan-table tbody tr {
      border-bottom: 1px solid var(--pnup-border);
      transition: var(--transition);
    }
    .jurusan-table tbody tr:last-child { border-bottom: none; }
    .jurusan-table tbody tr:hover { background: var(--pnup-light); }
    .jurusan-table td { padding: 14px 18px; color: var(--pnup-text); border: none; }
    .jurusan-table td:first-child { text-align: center; color: var(--pnup-muted); font-size: 13px; }
    .jurusan-table td:nth-child(3), .jurusan-table td:nth-child(4) { text-align: center; }

    .akreditasi-badge {
      display: inline-block; font-size: 12px; font-weight: 500;
      padding: 3px 12px; border-radius: 20px;
    }
    .akreditasi-badge.unggul { background: #d1fae5; color: #065f46; }
    .akreditasi-badge.baik-sekali, .akreditasi-badge.a { background: #dbeafe; color: #1e40af; }
    .akreditasi-badge.baik { background: #fef3c7; color: #92400e; }
    .akreditasi-badge.b { background: #f3f4f6; color: #374151; }
    .akreditasi-badge.default { background: #f3f4f6; color: #6b7280; }

    /* ── FOOTER ── */
    footer {
      background: var(--pnup-navy);
      color: rgba(255,255,255,0.75);
      padding: 50px 0 24px;
    }
    footer .sitename {
      color: white; font-size: 20px; margin-bottom: 12px; display: block;
    }
    footer p { font-size: 14px; line-height: 1.7; margin: 0; }
    footer strong { color: rgba(255,255,255,0.9); }
    footer .footer-divider {
      border-color: rgba(255,255,255,0.1);
      margin: 32px 0 20px;
    }
    footer .copyright { font-size: 13px; text-align: center; color: rgba(255,255,255,0.4); }
    footer .social-links a {
      width: 34px; height: 34px;
      display: inline-flex; align-items: center; justify-content: center;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.2);
      color: rgba(255,255,255,0.7);
      margin-right: 8px; margin-top: 14px;
      transition: var(--transition); font-size: 14px;
    }
    footer .social-links a:hover {
      background: var(--pnup-gold); border-color: var(--pnup-gold); color: white;
    }

    /* ── SCROLL TOP ── */
    #scroll-top {
      position: fixed; bottom: 24px; right: 24px;
      width: 42px; height: 42px;
      background: var(--pnup-navy); color: white;
      border-radius: 50%; display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 16px rgba(10,35,66,0.3);
      text-decoration: none; font-size: 18px;
      transition: var(--transition); z-index: 999;
      opacity: 0; pointer-events: none;
    }
    #scroll-top.active { opacity: 1; pointer-events: all; }
    #scroll-top:hover { background: var(--pnup-gold); transform: translateY(-2px); }

    @media (max-width: 768px) {
      .hero-stats { gap: 20px; flex-wrap: wrap; }
      .navmenu { display: none; }
      .branding .cta-btn { display: none; }
    }
  </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
      <span><i class="bi bi-envelope"></i><a href="mailto:pnup@poliupg.ac.id">pnup@poliupg.ac.id</a></span>
      <span class="d-none d-md-inline"><i class="bi bi-telephone"></i>+62 (411) 586043</span>
    </div>
    <div class="social-links">
      <a href="https://x.com/PNUP_Official/" target="_blank"><i class="bi bi-twitter-x"></i></a>
      <a href="https://web.facebook.com/PoltekNegeriUjungPandang-347781842302857/" target="_blank"><i class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/poltek_upg/" target="_blank"><i class="bi bi-instagram"></i></a>
    </div>
  </div>
</div>

<!-- Header -->
<header id="header" class="sticky-top">
  <div class="branding">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center text-decoration-none me-auto">
        <img src="assets/img/logo.png" alt="Logo PNUP">
        <h1 class="sitename">Politeknik Negeri Ujung Pandang</h1>
      </a>
      <nav class="navmenu">
        <ul>
          <li><a href="admin.php?page=home">Home</a></li>
          <li class="dropdown">
            <a href="#">Tambah Info <i class="bi bi-chevron-down" style="font-size:11px;"></i></a>
            <ul>
              <li><a href="admin.php?page=insert_activity">Rilis Berita</a></li>
              <li><a href="admin.php?page=insert_registration">Pengumuman</a></li>
              <li><a href="admin.php?page=insert_form_regis">Formulir</a></li>
              <li><a href="admin.php?page=insert_jurusan">Jurusan</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Hapus Info <i class="bi bi-chevron-down" style="font-size:11px;"></i></a>
            <ul>
              <li><a href="admin.php?page=delete_activity">Rilis Berita</a></li>
              <li><a href="admin.php?page=delete_registration">Pengumuman</a></li>
              <li><a href="admin.php?page=delete_form_regis">Formulir</a></li>
              <li><a href="admin.php?page=delete_jurusan">Jurusan</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Edit Info <i class="bi bi-chevron-down" style="font-size:11px;"></i></a>
            <ul>
              <li><a href="admin.php?page=edit_activity">Rilis Berita</a></li>
              <li><a href="admin.php?page=edit_registration">Pengumuman</a></li>
              <li><a href="admin.php?page=edit_jurusan">Jurusan</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <a href="logout.php" class="cta-btn ms-4">Logout</a>
    </div>
  </div>
</header>

<!-- Hero -->
<section class="hero-section">
  <div class="hero-pattern"></div>
  <div class="hero-pattern-2"></div>
  <div class="container hero-content">
    <div class="row align-items-center">
      <div class="col-lg-7" data-aos="fade-right">
        <span class="hero-badge">Akreditasi Baik Sekali</span>
        <h1 class="hero-title">Politeknik Negeri<br><span>Ujung Pandang</span></h1>
        <p class="hero-desc">Perguruan tinggi vokasi terkemuka di Sulawesi Selatan. Mencetak lulusan profesional siap industri sejak 1987.</p>
        <div class="hero-stats">
          <div>
            <div class="hero-stat-num">7</div>
            <div class="hero-stat-label">Jurusan</div>
          </div>
          <div>
            <div class="hero-stat-num">37</div>
            <div class="hero-stat-label">Program Studi</div>
          </div>
          <div>
            <div class="hero-stat-num">1987</div>
            <div class="hero-stat-label">Berdiri</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Rilis Berita -->
<section class="news-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Terkini</span>
      <h2 class="section-title-main">Rilis Berita</h2>
      <div class="section-divider"></div>
    </div>
    <div class="row g-4">
      <?php if ($result_activity && $result_activity->num_rows > 0):
        while ($row = $result_activity->fetch_assoc()):
          $link = 'content_activity.php?id=' . $row['id'];
          $date = date('d M Y', strtotime($row['created_at']));
          $excerpt = strip_tags($row['content']);
      ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <a href="<?= htmlspecialchars($link) ?>" class="news-card">
          <?php if ($row['image']): ?>
            <img src="<?= htmlspecialchars($row['image']) ?>" class="news-card-img" alt="<?= htmlspecialchars($row['title']) ?>">
          <?php else: ?>
            <div class="news-card-img-placeholder"><i class="bi bi-image"></i></div>
          <?php endif; ?>
          <div class="news-card-body">
            <span class="news-card-tag">Berita</span>
            <div class="news-card-title"><?= htmlspecialchars($row['title']) ?></div>
            <div class="news-card-excerpt"><?= htmlspecialchars($excerpt) ?></div>
            <div class="news-card-footer">
              <span class="news-card-date"><i class="bi bi-calendar3 me-1"></i><?= $date ?></span>
              <span class="news-card-arrow"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>
        </a>
      </div>
      <?php endwhile; else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-newspaper" style="font-size:48px; color:#d1d5db;"></i>
        <p class="mt-3" style="color:#9ca3af;">Belum ada berita tersedia.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Pengumuman -->
<section class="pengumuman-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label" style="color:#7c3aed;">Informasi</span>
      <h2 class="section-title-main">Pengumuman</h2>
      <div class="section-divider" style="background:#7c3aed;"></div>
    </div>
    <div class="row g-4">
      <?php if ($result_regis && $result_regis->num_rows > 0):
        while ($row = $result_regis->fetch_assoc()):
          $link = 'content_regis.php?id=' . $row['id'];
          $date = date('d M Y', strtotime($row['created_at']));
          $excerpt = strip_tags($row['content']);
      ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <a href="<?= htmlspecialchars($link) ?>" class="regis-card">
          <?php if ($row['image']): ?>
            <img src="<?= htmlspecialchars($row['image']) ?>" class="regis-card-img" alt="<?= htmlspecialchars($row['title']) ?>">
          <?php else: ?>
            <div class="regis-card-placeholder"><i class="bi bi-megaphone"></i></div>
          <?php endif; ?>
          <div class="regis-card-body">
            <span class="regis-card-tag">Pengumuman</span>
            <div class="regis-card-title"><?= htmlspecialchars($row['title']) ?></div>
            <div class="regis-card-excerpt"><?= htmlspecialchars($excerpt) ?></div>
            <div class="regis-card-footer">
              <span class="regis-card-date"><i class="bi bi-calendar3 me-1"></i><?= $date ?></span>
              <span class="regis-card-arrow"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>
        </a>
      </div>
      <?php endwhile; else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-megaphone" style="font-size:48px; color:#d1d5db;"></i>
        <p class="mt-3" style="color:#9ca3af;">Belum ada pengumuman tersedia.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Jurusan -->
<section class="jurusan-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Akademik</span>
      <h2 class="section-title-main">Program Studi</h2>
      <div class="section-divider"></div>
    </div>
    <?php
    include 'connect.php';
    $icons = [
      'Teknik Sipil' => 'bi-buildings',
      'Teknik Elektro' => 'bi-lightning-charge',
      'Teknik Kimia' => 'bi-eyedropper',
      'Teknik Mesin' => 'bi-gear',
      'Teknik Informatika' => 'bi-cpu',
      'Akuntansi' => 'bi-calculator',
      'Administrasi' => 'bi-briefcase',
    ];

    $jurusan_sql = "SELECT DISTINCT jurusan FROM jurusan ORDER BY jurusan ASC LIMIT 6";
    $jurusan_result = $conn->query($jurusan_sql);

    if ($jurusan_result && $jurusan_result->num_rows > 0):
      while ($jurusan_row = $jurusan_result->fetch_assoc()):
        $jurusan_name = $jurusan_row['jurusan'];

        $icon = 'bi-mortarboard';
        foreach ($icons as $key => $val) {
          if (stripos($jurusan_name, $key) !== false) { $icon = $val; break; }
        }

        $data_sql = "SELECT program_studi, akreditasi, daya_tampung FROM jurusan WHERE jurusan = ?";
        $stmt = $conn->prepare($data_sql);
        $stmt->bind_param("s", $jurusan_name);
        $stmt->execute();
        $data_result = $stmt->get_result();
    ?>
    <div class="jurusan-group" data-aos="fade-up">
      <div class="jurusan-group-header">
        <div class="jurusan-icon"><i class="bi <?= $icon ?>"></i></div>
        <h3 class="jurusan-group-name"><?= htmlspecialchars($jurusan_name) ?></h3>
      </div>
      <div class="table-responsive">
        <table class="jurusan-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Program Studi</th>
              <th>Akreditasi</th>
              <th>Daya Tampung</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($data_result->num_rows > 0):
              $no = 1;
              while ($data_row = $data_result->fetch_assoc()):
                $ak = strtolower(str_replace(' ', '-', $data_row['akreditasi']));
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($data_row['program_studi']) ?></td>
              <td><span class="akreditasi-badge <?= $ak ?>"><?= htmlspecialchars($data_row['akreditasi']) ?></span></td>
              <td><?= number_format($data_row['daya_tampung']) ?> mahasiswa</td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="4" style="text-align:center; color:#9ca3af; padding:20px;">Tidak ada data</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php $stmt->close(); endwhile; else: ?>
    <p class="text-center" style="color:#9ca3af;">Tidak ada jurusan tersedia.</p>
    <?php endif; $conn->close(); ?>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <span class="sitename" style="font-family:'DM Serif Display',serif;">Politeknik Negeri Ujung Pandang</span>
        <p>Jalan Perintis Kemerdekaan KM.10<br>Tamalanrea, Makassar 90245</p>
        <p class="mt-2"><strong>Telepon:</strong> +62 (411) 585365 | 585367 | 585368</p>
        <p><strong>Email:</strong> pnup@poliupg.ac.id</p>
        <div class="social-links">
          <a href="https://x.com/PNUP_Official/" target="_blank"><i class="bi bi-twitter-x"></i></a>
          <a href="https://web.facebook.com/PoltekNegeriUjungPandang-347781842302857/" target="_blank"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/poltek_upg/" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div>
    <hr class="footer-divider">
    <p class="copyright">© <?= date('Y') ?> Politeknik Negeri Ujung Pandang. All Rights Reserved. | Designed with <i class="bi bi-heart-fill" style="color:var(--pnup-gold);font-size:11px;"></i></p>
  </div>
</footer>

<a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
  AOS.init({ duration: 600, easing: 'ease-out', once: true });

  const scrollTop = document.getElementById('scroll-top');
  window.addEventListener('scroll', () => {
    scrollTop.classList.toggle('active', window.scrollY > 200);
  });
  scrollTop.addEventListener('click', e => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>
</body>
</html>