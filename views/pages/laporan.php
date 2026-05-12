<?php
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";

// Tangkap nilai GET biar form tetap terisi sesuai pilihan terakhir user
$getStart  = $_GET['start'] ?? date('Y-m-01'); // Default awal bulan
$getEnd    = $_GET['end'] ?? date('Y-m-t');    // Default akhir bulan
$getJenis  = $_GET['jenis'] ?? '';
$getStatus = $_GET['status'] ?? '';
$getRak    = $_GET['rak'] ?? '';
?>

<style>
  /* --- SEMUA CSS LU ASLI NGGAK ADA YANG DIUBAH --- */
  body { background: #f7f5f6; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
  .text-main { color: #02343F; }
  .stat-pill { display: flex; align-items: center; gap: 15px; padding: 18px 20px; border-radius: 16px; background: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: none; }
  .stat-pill .ico { width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
  .pill-total .ico { background: #e3f2fd; color: #0d6efd; }
  .pill-aktif .ico { background: #d1e7dd; color: #198754; }
  .pill-nonaktif .ico { background: #f8d7da; color: #dc3545; }
  .pill-akhir .ico { background: #fff3cd; color: #ffc107; }
  .pill-expired .ico { background: #fce8e6; color: #dc3545; }
  .btn-circle { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #f1f5f4; border: none; }
  #table-dashboard { width: 100%; table-layout: fixed; }
  #table-dashboard thead th { background: #f8faf9 !important; border-bottom: 2px solid #eef2f0 !important; font-size: 0.85rem; font-weight: 600; color: #495057; padding: 12px 8px; }
  #table-dashboard tbody td { padding: 12px 8px; vertical-align: middle; }
  .p-3.border-bottom form { display: flex !important; flex-wrap: nowrap !important; align-items: center; gap: 10px; overflow-x: auto; white-space: nowrap; padding-bottom: 4px; }
  .p-3.border-bottom form::-webkit-scrollbar { height: 6px; }
  .p-3.border-bottom form::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
  .p-3.border-bottom input[type="date"], .p-3.border-bottom select { height: 34px; font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #dee2e6; background: #fff; flex-shrink: 0; }
  .p-3.border-bottom span { font-size: 11px; color: #6c757d; flex-shrink: 0; }
  .p-3.border-bottom button { height: 34px; padding: 0 14px; font-size: 12px; border-radius: 6px; flex-shrink: 0; }
  .p-3.border-bottom input:focus, .p-3.border-bottom select:focus { border-color: #2b6766; box-shadow: 0 0 0 2px rgba(43, 103, 102, 0.15); outline: none; }
  #table-dashboard th:nth-child(1), #table-dashboard td:nth-child(1) { width: 50px; text-align: center; }
  #table-dashboard th:nth-child(2), #table-dashboard td:nth-child(2) { width: 100px; }
  #table-dashboard th:nth-child(3), #table-dashboard td:nth-child(3) { width: 100px; } /* Disesuaikan dikit biar TRX muat */
  #table-dashboard th:nth-child(4), #table-dashboard td:nth-child(4) { width: 180px; }
  #table-dashboard th:nth-child(5), #table-dashboard td:nth-child(5) { width: 80px; text-align: center; }
  #table-dashboard th:nth-child(6), #table-dashboard td:nth-child(6) { width: 75px; text-align: center; }
  #table-dashboard th:nth-child(7), #table-dashboard td:nth-child(7) { width: 75px; text-align: center; }
  #table-dashboard th:nth-child(8), #table-dashboard td:nth-child(8) { width: 70px; text-align: center; }
  #table-dashboard th:nth-child(9),
#table-dashboard td:nth-child(9) {
    width: 90px;
    text-align: center;
}
  .badge.bg-light { background: #eef2f0 !important; color: #2b6766 !important; font-weight: 500; padding: 5px 10px; }
  div.dataTables_filter { display: none; }
  .table-responsive { overflow-x: auto; }
</style>

<main class="py-4">
  <div class="container-fluid px-4">

    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
      <div class="row g-3 mb-4">
        <div class="col">
        <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-box"></i></div>
            <div>
                <small>Total Transaksi</small>
                <strong><?= $totalTransaksi ?></strong>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-pill pill-aktif">
            <div class="ico"><i class="bi bi-arrow-down"></i></div>
            <div>
                <small>Total Masuk</small>
                <strong><?= $totalMasuk ?></strong>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-pill pill-nonaktif">
            <div class="ico"><i class="bi bi-arrow-up"></i></div>
            <div>
                <small>Total Keluar</small>
                <strong><?= $totalKeluar ?></strong>
            </div>
        </div>
    </div>
      </div>

      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h5 class="fw-bold text-main m-0">
            <i class="bi bi-box-seam me-2"></i>Rekap Mutasi Bahan Kimia
          </h5>
          <input type="text" id="searchInput" class="form-control" placeholder="Cari..." style="width:220px;">
        </div>

        <div class="p-3 border-bottom">
  <form method="GET" action="index.php" class="d-flex flex-wrap gap-3 align-items-center">
    
    <input type="hidden" name="action" value="laporan">

    <input type="date" name="start" value="<?= $getStart ?>" title="Tanggal Mulai" class="form-control" style="width:auto;">
    <span style="font-size:11px;color:var(--text-muted);">s/d</span>
    <input type="date" name="end" value="<?= $getEnd ?>" title="Tanggal Akhir" class="form-control" style="width:auto;">

    <select name="status" class="form-select" style="width:auto;">
      <option value="">Semua Transaksi</option>
      <option value="masuk" <?= ($getStatus == 'masuk') ? 'selected' : '' ?>>Barang Masuk</option>
      <option value="keluar" <?= ($getStatus == 'keluar') ? 'selected' : '' ?>>Barang Keluar</option>
    </select>

    <button type="submit" class="btn btn-primary" style="background:#2b6766; border:none;">Filter</button>
    <a href="?action=laporan" class="btn btn-light border">Reset</a>
  </form>
</div>

        <div class="card-body p-4 bg-white">
          <div class="table-responsive">
            <table id="table-dashboard" class="table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>ID</th>
                  <th>Nama Bahan</th>
                  <th>Kuantitas botol</th>
                  <th>Jenis</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                  <th>Rak</th>
                </tr>
              </thead>
              <tbody>
                
                <?php if (!empty($dataLaporan)): ?>
                  
                  <?php $no = 1; foreach ($dataLaporan as $row): ?>
                    <tr>
                      <td class="text-center"><?= $no++ ?></td>
                      <td><?= date('d/m/Y', strtotime($row['tgl_transaksi'])) ?></td>
                      <td>TRX-<?= str_pad($row['id_transaksi'], 3, '0', STR_PAD_LEFT) ?></td>
                      <td><strong><?= htmlspecialchars($row['nama_bahan']) ?></strong></td>
                      <td><strong><?= $row['quantity'] ?></strong></td>
                      
                      <td class="text-center">
                        <span class="badge bg-light"><?= htmlspecialchars($row['jenis']) ?></span>
                      </td>

                      <?php if ($row['status_transaksi'] === 'nambah'): ?>
                        <td class="text-success fw-bold text-center">+<?= $row['volume_item'] ?> <?= $row['satuan'] ?></td>
                        <td class="text-center text-muted">-</td>
                      <?php else: ?>
                        <td class="text-center text-muted">-</td>
                        <td class="text-danger fw-bold text-center">-<?= $row['volume_item'] ?> <?= $row['satuan'] ?></td>
                      <?php endif; ?>

                      <td class="text-center"><?= htmlspecialchars($row['rak']) ?></td>
                    </tr>
                  <?php endforeach; ?>

                <?php endif; ?>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>
</main>