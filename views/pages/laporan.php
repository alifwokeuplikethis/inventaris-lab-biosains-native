<?php
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>

<style>
  body {
    background: #f7f5f6;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
  }

  .text-main {
    color: #02343F;
  }

  .stat-pill {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 20px;
    border-radius: 16px;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border: none;
  }

  .stat-pill .ico {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
  }

  .pill-total .ico {
    background: #e3f2fd;
    color: #0d6efd;
  }

  .pill-aktif .ico {
    background: #d1e7dd;
    color: #198754;
  }

  .pill-nonaktif .ico {
    background: #f8d7da;
    color: #dc3545;
  }

  .pill-akhir .ico {
    background: #fff3cd;
    color: #ffc107;
  }

  .pill-expired .ico {
    background: #fce8e6;
    color: #dc3545;
  }

  .btn-circle {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f4;
    border: none;
  }

  /* PERBAIKAN: lebar kolom tetap dan konsisten */
  #table-dashboard {
    width: 100%;
    table-layout: fixed;
    /* Kunci lebar kolom */
  }

  #table-dashboard thead th {
    background: #f8faf9 !important;
    border-bottom: 2px solid #eef2f0 !important;
    font-size: 0.85rem;
    font-weight: 600;
    color: #495057;
    padding: 12px 8px;
  }

  #table-dashboard tbody td {
    padding: 12px 8px;
    vertical-align: middle;
  }

  /* Wrapper utama */
  .p-3.border-bottom form {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: center;
    gap: 10px;
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 4px;
  }

  /* Scroll biar gak jelek */
  .p-3.border-bottom form::-webkit-scrollbar {
    height: 6px;
  }

  .p-3.border-bottom form::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
  }

  /* Input & select konsisten */
  .p-3.border-bottom input[type="date"],
  .p-3.border-bottom select {
    height: 34px;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #dee2e6;
    background: #fff;
    flex-shrink: 0;
  }

  /* Span s/d */
  .p-3.border-bottom span {
    font-size: 11px;
    color: #6c757d;
    flex-shrink: 0;
  }

  /* Button */
  .p-3.border-bottom button {
    height: 34px;
    padding: 0 14px;
    font-size: 12px;
    border-radius: 6px;
    flex-shrink: 0;
  }

  /* Hover biar ada rasa hidup */
  .p-3.border-bottom input:focus,
  .p-3.border-bottom select:focus {
    border-color: #2b6766;
    box-shadow: 0 0 0 2px rgba(43, 103, 102, 0.15);
    outline: none;
  }

  /* Atur lebar spesifik tiap kolom */
  #table-dashboard th:nth-child(1),
  #table-dashboard td:nth-child(1) {
    width: 50px;
    text-align: center;
  }

  /* No */
  #table-dashboard th:nth-child(2),
  #table-dashboard td:nth-child(2) {
    width: 100px;
  }

  /* Tanggal */
  #table-dashboard th:nth-child(3),
  #table-dashboard td:nth-child(3) {
    width: 70px;
  }

  /* ID */
  #table-dashboard th:nth-child(4),
  #table-dashboard td:nth-child(4) {
    width: 180px;
  }

  /* Nama */
  #table-dashboard th:nth-child(5),
  #table-dashboard td:nth-child(5) {
    width: 80px;
  }

  /* Jenis */
  #table-dashboard th:nth-child(6),
  #table-dashboard td:nth-child(6) {
    width: 75px;
    text-align: center;
  }

  /* Masuk */
  #table-dashboard th:nth-child(7),
  #table-dashboard td:nth-child(7) {
    width: 75px;
    text-align: center;
  }

  /* Keluar */
  #table-dashboard th:nth-child(8),
  #table-dashboard td:nth-child(8) {
    width: 70px;
    text-align: center;
  }

  /* Rak */
  .badge.bg-light {
    background: #eef2f0 !important;
    color: #2b6766 !important;
    font-weight: 500;
    padding: 5px 10px;
  }

  div.dataTables_filter {
    display: none;
  }

  .table-responsive {
    overflow-x: auto;
  }
</style>

<main class="py-4">
  <div class="container-fluid px-4">

    <!-- HEADER -->
    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">

      <!-- STAT PILL -->
      <div class="row g-4 mb-4">
        <div class="col">
          <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-box"></i></div>
            <div>
              <small>Stok Awal</small>
              <strong>248</strong>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="stat-pill pill-aktif">
            <div class="ico"><i class="bi bi-arrow-down"></i></div>
            <div>
              <small>Total Masuk</small>
              <strong>132</strong>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="stat-pill pill-nonaktif">
            <div class="ico"><i class="bi bi-arrow-up"></i></div>
            <div>
              <small>Total Keluar</small>
              <strong>87</strong>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="stat-pill pill-akhir">
            <div class="ico"><i class="bi bi-calculator"></i></div>
            <div>
              <small>Stok Akhir</small>
              <strong>293</strong>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="stat-pill pill-expired">
            <div class="ico"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
              <small>Kadaluarsa</small>
              <strong>12</strong>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD UTAMA -->
      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

        <!-- HEADER -->
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h5 class="fw-bold text-main m-0">
            <i class="bi bi-box-seam me-2"></i>Rekap Mutasi Bahan Kimia
          </h5>
          <input type="text" class="form-control" placeholder="Cari..." style="width:220px;">
        </div>

        <!-- FILTER -->
        <div class="p-3 border-bottom">

          <form method="GET" class="d-flex flex-wrap gap-3 align-items-center">

            <input type="date" name="start" value="2025-01-01" title="Tanggal Mulai">
            <span style="font-size:11px;color:var(--text-muted);">s/d</span>
            <input type="date" name="end" value="2026-04-30" title="Tanggal Akhir">

            <select name="jenis" class="form-select" style="width:auto;">
              <option value="">Semua</option>
              <option value="Padat">Padat</option>
              <option value="Cair">Cair</option>
              <option value="Gas">Gas</option>
            </select>

            <select name="status" class="form-select" style="width:auto;">
              <option value="">Semua</option>
              <option value="masuk">Masuk</option>
              <option value="keluar">Keluar</option>
            </select>

            <select name="rak" class="form-select" style="width:auto;">
              <option value="">Semua Rak</option>
              <option value="A">Rak A</option>
              <option value="B">Rak B</option>
              <option value="C">Rak C</option>
            </select>

            <select name="Jenis_Transaksi" class="form-select" style="width:auto;">
              <option value="Semua">Semua Transaksi</option>
              <option value="Pengadaan">Pengadaan</option>
              <option value="Pemakaian">Pemakaian</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
          </form>

        </div>

        <!-- BODY -->
        <div class="card-body p-4 bg-white">

          <!-- BODY -->
          <div class="card-body p-4 bg-white">
            <div class="table-responsive">
              <table id="table-dashboard" class="table table-hover align-middle mb-0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Rak</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">1</td>
                    <td>07/03/2025</td>
                    <td>001</td>
                    <td><strong>Ammonium Chloride</strong></td>
                    <td><span class="badge bg-light">Padat</span></td>
                    <td class="text-success fw-bold text-center">+5</td>
                    <td class="text-danger fw-bold text-center">-2</td>
                    <td class="text-center">A1</td>
                  </tr>
                  <tr>
                    <td class="text-center">2</td>
                    <td>20/04/2026</td>
                    <td>002</td>
                    <td><strong>N-Hexane</strong></td>
                    <td><span class="badge bg-light">Cair</span></td>
                    <td class="text-success fw-bold text-center">+3</td>
                    <td class="text-danger fw-bold text-center">-1</td>
                    <td class="text-center">B2</td>
                  </tr>
                  <tr>
                    <td class="text-center">3</td>
                    <td>15/03/2025</td>
                    <td>003</td>
                    <td><strong>Sodium Hydroxide</strong></td>
                    <td><span class="badge bg-light">Padat</span></td>
                    <td class="text-success fw-bold text-center">+8</td>
                    <td class="text-danger fw-bold text-center">-3</td>
                    <td class="text-center">C3</td>
                  </tr>
                  <tr>
                    <td class="text-center">4</td>
                    <td>10/03/2025</td>
                    <td>004</td>
                    <td><strong>Ethanol 96%</strong></td>
                    <td><span class="badge bg-light">Cair</span></td>
                    <td class="text-success fw-bold text-center">+12</td>
                    <td class="text-danger fw-bold text-center">-5</td>
                    <td class="text-center">D1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>
  </div>
</main>