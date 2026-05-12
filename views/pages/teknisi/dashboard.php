<?php  

require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>
  <style>
    /* ===== GLOBAL ===== */
    body { 
      background: #f5f7f6; 
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
    }
    .text-main { color: #02343F; }

    /* ===== STAT PILL (KOTAK PUTIH CLEAN) ===== */
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

    /* Warna Ikon Sesuai Kategori */
    .pill-total .ico { background: #e3f2fd; color: #0d6efd; }
    .pill-aktif .ico { background: #d1e7dd; color: #198754; }
    .pill-nonaktif .ico { background: #f8d7da; color: #dc3545; }

    .stat-pill .info small {
      color: #6c757d;
      font-weight: 500;
      display: block;
      margin-bottom: -2px;
    }
    .stat-pill .info strong {
      font-size: 22px;
      color: #212529;
    }

    /* ===== BUTTON ICON ===== */
    .btn-circle {
      width: 34px; height: 34px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      background: #f1f5f4;
      border: none;
      transition: 0.2s ease;
    }
    .btn-circle:hover { transform: scale(1.1); }
    .btn-detail:hover { background:#02343F; color:#fff; }
    .btn-stok:hover { background:#00796b; color:#fff; }
    .btn-hapus:hover { background:#e74c3c; color:#fff; }

    /* ===== INPUT & DROPDOWN ===== */
    .control {
      border-radius: 8px;
      border: 1px solid #dee2e6;
    }
    .control:focus {
      border-color: #02343F;
      box-shadow: 0 0 0 0.2rem rgba(2,52,63,0.15);
    }
    .btn-filter-dropdown {
      border-radius: 8px;
      border: 1px solid #06697f;
      background: #fff;
      color: #02343F;
      font-weight: 600;
    }
    .btn-filter-dropdown:hover {
      background: #02343F;
      color: #fff;
    }

    /* ===== TABEL CLEAN STYLING ===== */
    #table-dashboard thead th {
      background: #f8faf9 !important;
      border-bottom: 2px solid #eef2f0 !important;
      font-size: 0.85rem;
      font-weight: 600;
      color: #495057;
    }

    /* Styling Pagination bawaan Datatables */
    .dataTables_filter, .dataTables_length { display: none !important; }
    
    .dataTables_wrapper .page-link {
      border: none;
      border-radius: 8px;
      background: #f1f5f4;
      color: #02343F;
      margin: 0 3px;
      font-weight: 500;
    }
    .dataTables_wrapper .page-item.active .page-link {
      background: #02343F;
      color: #fff;
      box-shadow: 0 2px 4px rgba(2, 52, 63, 0.3);
    }
    .dataTables_info {
      color: #6c757d !important;
      font-size: 0.9rem;
    }
  </style>
  
  <?php if(isset($_SESSION['alert'])): ?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['alert']['icon']; ?>',
    title: '<?= $_SESSION['alert']['title']; ?>',
    text: '<?= $_SESSION['alert']['text']; ?>',
    showConfirmButton: false,
    timer: <?= $_SESSION['alert']['timer']; ?>,
    timerProgressBar: true
});
</script>
<?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<main class="py-4">
  <div class="container-fluid px-4">

    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
      
      <div class="row g-4 mb-4">
        
        <div class="col-12 col-md-4">
          <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-people-fill"></i></div>
            <div class="info">
              <small>Total Bahan</small>
              <strong><?= $stats['total_bahan'] ?></strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-aktif">
            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
            <div class="info">
              <small>Stok hampir habis</small>
              <strong><?= $stats['stok_hampir_habis'] ?></strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-nonaktif">
            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
            <div class="info">
              <small>Stok habis</small>
              <strong><?= $stats['stok_habis'] ?></strong>
            </div>
          </div>
        </div>

      </div>

      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="border-bottom: 1px solid #f0f0f0;">
          <h5 class="fw-bold text-main m-0">
            <i class="bi bi-box-seam me-2"></i>Data Bahan Baku
          </h5>

          <!--  -->
          <div class="d-flex gap-2">
            <div class="dropdown">
        <button class="btn btn-filter-dropdown dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-funnel me-1"></i> 
            <span id="filterStatusLabel">Semua Status</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><a class="dropdown-item filter-status" href="#" data-value="" data-column="7">Semua Status</a></li>
            <li><a class="dropdown-item filter-status" href="#" data-value="Habis" data-column="7">Habis</a></li>
            <li><a class="dropdown-item filter-status" href="#" data-value="Hampir Habis" data-column="7">Hampir Habis</a></li>
            <li><a class="dropdown-item filter-status" href="#" data-value="Tersedia" data-column="7">Tersedia</a></li>
        </ul>
    </div>

    <div class="dropdown">
        <button class="btn btn-filter-dropdown dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-funnel me-1"></i> 
            <span id="filterJenisLabel">Semua Jenis</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><a class="dropdown-item filter-jenis" href="#" data-value="" data-column="4">Semua</a></li>
            <li><a class="dropdown-item filter-jenis" href="#" data-value="Padat" data-column="4">Padat</a></li>
            <li><a class="dropdown-item filter-jenis" href="#" data-value="Cair" data-column="4">Cair</a></li>
            <li><a class="dropdown-item filter-jenis" href="#" data-value="Gas" data-column="4">Gas</a></li>
        </ul>
    </div>

    <div class="position-relative">
        <input type="text" id="searchInput" class="form-control control ps-3 shadow-sm" placeholder="Cari data..." style="width:220px;">
    </div>
</div>
        </div>

        <div class="card-body p-4 bg-white">
          <div class="table-responsive">
            <table id="table-dashboard" class="table table-hover align-middle mb-0" style="width: 100%;">
              <thead>
                <tr>
                  <th width="50">No</th>
                  <th>Nama Bahan</th>
                  <th>Satuan</th>
                  <th>Volume per botol</th>
                  <th>Jenis</th>
                  <th>Qty</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th width="120">Aksi</th>
                </tr>
              </thead>
              <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($data as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td class="fw-bold text-dark"><?= htmlspecialchars($row['nama_bahan']) ?></td>
                    <td><?= $row['satuan'] ?></td>
                    <td>
                      <span class="badge rounded-pill bg-light text-dark border">
                        <?= $row['volume_per_botol']; ?>
                      </span>
                    </td>
                    <td><?= $row['jenis'] ?></td>

                    <td class="text-main fw-bold">
                      <?= $row['qty']; ?>
                    </td>

                    <td>
                      <?php if($row['foto_bahan']): ?>
                        <img src="<?= BASE_URL ?>/images/uploads/<?= $row['foto_bahan'] ?>" width="200">
                      <?php else: ?>
                        <i class="bi bi-image text-muted"></i>
                      <?php endif; ?>
                    </td>

                    <td>
                      <?php if($row['total_volume'] == 0): ?>
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3">
                          Habis
                        </span>

                      <?php elseif($row['total_volume'] < $row['volume_per_botol']): ?>
                        <span class="badge bg-warning bg-opacity-10 text-warning px-3">
                          Hampir Habis
                        </span>

                      <?php else: ?>
                        <span class="badge bg-success bg-opacity-10 text-success px-3">
                          Tersedia
                        </span>
                      <?php endif; ?>
                    </td>

                    <td>
                      <div class="d-flex gap-2">
                        <button class="btn-circle btn-detail btn-view-batch" data-id="<?= $row['id'] ?>" title="Lihat detail bahan">
                            <i class="bi bi-eye"></i>
                        </button>
                        <a class="btn-circle btn-detail" title="Request bahan" href="?action=pengajuan_bahan&id_bahan=<?= $row['id'] ?>"><i class="bi bi-bag-plus-fill"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

  </div>
</main>



<?php
include PAGES_PATH . "Modal/modalDashboard.php";
?>
