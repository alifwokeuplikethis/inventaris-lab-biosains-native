<?php  

require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>
  <style>
    /* Tambahkan ini untuk memastikan variabel CSS terbaca jika tidak ada di style.css */
    :root {
      --offcanvas-width: 270px;
    }

    /* Membungkus section agar masuk ke area konten di sebelah sidebar */
    main {
      margin-left: var(--offcanvas-width);
      padding-top: 20px;
      min-height: 100vh;
      transition: all 0.3s;
    }

    /* Container Hijau Gelap sesuai Foto */
    .section-teal {
      background-color: #2b6766;
      border-radius: 20px;
      padding: 25px;
      margin: 0 15px;
    }

    .outer-card {
      background-color: white;
      border-radius: 15px;
      overflow: hidden;
      border: none;
    }

    .header-title {
      color: #a06b4d;
      font-weight: 700;
      font-size: 24px;
    }

    /* Input Styling agar mirip foto (Soft Shadow) */
    .form-control-ui {
      border: none !important;
      background-color: #ffffff !important;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08) !important;
      border-radius: 10px !important;
      padding: 10px 15px;
      font-size: 14px;
    }

    .form-label {
      font-weight: 600;
      font-size: 13px;
      margin-bottom: 5px;
    }

    .ui-btn {
      background-color: #5f9e9a;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 25px;
      font-weight: 600;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 992px) {
      main { margin-left: 0; }
    }
  </style>
</head>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mutasi Bahan Kimia</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ===== GLOBAL ===== */
    :root {
      --offcanvas-width: 270px;
      --topNavbarHeight: 56px;
      --teal-dark: #2b6766;
      --teal-mid: #478483;
      --teal-btn: #5f9e9a;
      --brown-accent: #a06b4d;
    }

    * { font-family: 'Poppins', sans-serif; }

    body { background-color: #F6F9FF; }

    a { text-decoration: none; }

    /* ===== MAIN LAYOUT ===== */
    main {
      margin-left: var(--offcanvas-width);
      padding-top: 20px;
      min-height: 100vh;
      transition: all 0.3s;
    }

    @media (max-width: 992px) {
      main { margin-left: 0; }
    }

    /* ===== SECTION HEADER (Teal) ===== */
    .section-teal {
      background-color: var(--teal-dark);
      border-radius: 20px;
      padding: 20px 25px;
      margin: 0 15px 20px;
    }

    .outer-card {
      background-color: #ffffff;
      border-radius: 15px;
      overflow: hidden;
      border: none;
      padding: 16px 20px;
    }

    /* ===== STATS ROW ===== */
    .stats-row {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .stat-item {
      background-color: #f0f7f7;
      border-radius: 10px;
      padding: 8px 16px;
      text-align: center;
      min-width: 90px;
    }

    .stat-item p {
      font-size: 11px;
      color: #6c757d;
      margin: 0;
      font-weight: 500;
    }

    .stat-item h4 {
      font-size: 18px;
      font-weight: 700;
      color: var(--teal-dark);
      margin: 0;
    }

    /* ===== SEARCH INPUT ===== */
    .search-mini {
      border: none !important;
      background-color: #ffffff !important;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08) !important;
      border-radius: 10px !important;
      padding: 10px 15px;
      font-size: 14px;
      max-width: 200px;
    }

    /* ===== CONTENT CARD ===== */
    .content-card {
      background: #ffffff;
      border-radius: 15px;
      border: none;
      box-shadow: 0 2px 12px rgba(0,0,0,0.06);
      overflow: hidden;
      margin: 0 15px;
    }

    /* ===== FILTER SECTION ===== */
    .filter-section {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      padding: 16px 20px;
      border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    .form-control-ui,
    .filter-section input[type="date"],
    .filter-section select {
      border: none !important;
      background-color: #f6f9ff !important;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
      border-radius: 10px !important;
      padding: 8px 13px;
      font-size: 13px;
      font-family: 'Poppins', sans-serif;
      color: #444;
      outline: none;
      cursor: pointer;
    }

    .filter-section input[type="date"] { max-width: 155px; }
    .filter-section select { max-width: 165px; }

    .btn-filter {
      background-color: var(--teal-btn);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 8px 20px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-filter:hover { background-color: var(--teal-dark); }

    /* ===== TABLE HEADER ===== */
    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 20px 10px;
    }

    .table-header h4 {
      font-size: 16px;
      font-weight: 700;
      color: var(--brown-accent);
      margin: 0;
    }

    .btn-export {
      background-color: var(--teal-btn);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 8px 18px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-export:hover { background-color: var(--teal-dark); }

    /* ===== TABLE ===== */
    .table-responsive { padding: 0 20px 20px; }

    .table {
      font-size: 13px;
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    .table thead tr th {
      background-color: var(--teal-dark);
      color: #fff;
      padding: 10px 12px;
      font-weight: 600;
      font-size: 12px;
      letter-spacing: 0.3px;
      white-space: nowrap;
    }

    .table thead tr th:first-child { border-radius: 10px 0 0 0; }
    .table thead tr th:last-child  { border-radius: 0 10px 0 0; }

    .table tbody tr { transition: background 0.15s; }

    .table tbody tr:hover { background-color: #f0f7f7; }

    .table tbody tr td {
      padding: 10px 12px;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      color: #444;
      vertical-align: middle;
    }

    /* Badge status */
    .badge-masuk  { background: #e1f5ee; color: #0f6e56; border-radius: 6px; padding: 3px 10px; font-weight: 600; font-size: 12px; }
    .badge-keluar { background: #faeeda; color: #854f0b; border-radius: 6px; padding: 3px 10px; font-weight: 600; font-size: 12px; }
    .badge-padat  { background: #e6f1fb; color: #185fa5; border-radius: 6px; padding: 3px 10px; font-weight: 600; font-size: 12px; }
    .badge-cair   { background: #eaf3de; color: #3b6d11; border-radius: 6px; padding: 3px 10px; font-weight: 600; font-size: 12px; }
    .badge-gas    { background: #fcebeb; color: #a32d2d; border-radius: 6px; padding: 3px 10px; font-weight: 600; font-size: 12px; }

    /* ===== ICONS in header ===== */
    .header-icons { color: rgba(255,255,255,0.7); font-size: 1.1rem; display: flex; align-items: center; gap: 10px; }
    .header-icons i { cursor: pointer; transition: color 0.2s; }
    .header-icons i:hover { color: #fff; }
  </style>
</head>

<body>

<main class="mt-5 pt-2 dashboard-content">
  <div class="container-fluid px-0">

    <!-- ===== SECTION HEADER TEAL ===== -->
    <section class="section-teal">
      <div class="outer-card">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">

          <!-- Stats -->
          <div class="stats-row flex-grow-1">
            <div class="stat-item">
              <p>Stok Awal</p>
              <h4>120</h4>
            </div>
            <div class="stat-item">
              <p>Total Masuk</p>
              <h4>45</h4>
            </div>
            <div class="stat-item">
              <p>Total Keluar</p>
              <h4>28</h4>
            </div>
            <div class="stat-item">
              <p>Stok Akhir</p>
              <h4>137</h4>
            </div>
            <div class="stat-item">
              <p>Bahan Expired</p>
              <h4>3</h4>
            </div>
          </div>

          <!-- Search -->
          <input type="text" class="search-mini" placeholder="Telusuri...">

          <!-- Icons -->
          <div class="header-icons">
            <i class="fa fa-angle-double-right"></i>
            <i class="fa fa-home"></i>
          </div>

        </div>
      </div>
    </section>

    <!-- ===== CONTENT CARD ===== -->
    <div class="content-card">

      <!-- Filter -->
      <form method="GET" class="filter-section">
        <input type="date" name="start">
        <input type="date" name="end">

        <select name="jenis">
          <option value="">Semua Jenis</option>
          <option value="Padat">Padat</option>
          <option value="Cair">Cair</option>
          <option value="Gas">Gas</option>
        </select>

        <select name="status">
          <option value="">Semua Status</option>
          <option value="masuk">Masuk</option>
          <option value="keluar">Keluar</option>
        </select>

        <select name="rak">
          <option value="">Semua Rak</option>
          <option value="A">Rak A</option>
          <option value="B">Rak B</option>
          <option value="C">Rak C</option>
        </select>

        <select name="Jenis_Transaksi">
          <option value="Semua">Semua Transaksi</option>
          <option value="Pengadaan">Pengadaan</option>
          <option value="Pemakaian">Pemakaian</option>
        </select>

        <button type="submit" class="btn-filter">
          <i class="fa fa-filter me-1"></i> Filter
        </button>
      </form>

      <!-- Table Header -->
      <div class="table-header">
        <h4>Rekap Mutasi Bahan Kimia</h4>
        <button class="btn-export">
          <i class="fa fa-file-excel me-1"></i> Export Excel
        </button>
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>ID</th>
              <th>Nama Bahan</th>
              <th>Jenis</th>
              <th>Expired</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Satuan</th>
              <th>Rak</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>07/03/2025</td>
              <td>001</td>
              <td><strong>Ammonium Chloride</strong></td>
              <td><span class="badge-padat">Padat</span></td>
              <td>21/04/2026</td>
              <td><span class="badge-masuk">5</span></td>
              <td><span class="badge-keluar">2</span></td>
              <td>Gram</td>
              <td>A1</td>
            </tr>
            <tr>
              <td>2</td>
              <td>20/04/2026</td>
              <td>002</td>
              <td><strong>N-Hexane</strong></td>
              <td><span class="badge-cair">Cair</span></td>
              <td>31/07/2026</td>
              <td><span class="badge-masuk">3</span></td>
              <td><span class="badge-keluar">1</span></td>
              <td>Liter</td>
              <td>B2</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
    <!-- end content-card -->

  </div>
</main>

</body>
</html>