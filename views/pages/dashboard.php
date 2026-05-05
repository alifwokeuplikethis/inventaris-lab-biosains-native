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
  
<?php if( isset($_SESSION['success'])):?>
  <script>
Swal.fire({
    icon: 'success',
    title: 'Selamat Datang!',
    text: '<?= $_SESSION['success']; ?>',
    showConfirmButton: false,
    timer: 5000, // 2 detik
    timerProgressBar: true
})
</script>
<?php unset($_SESSION['success']);?>
<?php endif;?>

<main class="py-4">
  <div class="container-fluid px-4">

    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
      
      <div class="row g-4 mb-4">
        
        <div class="col-12 col-md-4">
          <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-people-fill"></i></div>
            <div class="info">
              <small>Total Bahan</small>
              <strong>xxx</strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-aktif">
            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
            <div class="info">
              <small>Stok hampir habis</small>
              <strong>xxx</strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-nonaktif">
            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
            <div class="info">
              <small>Stok habis</small>
              <strong>xxx</strong>
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
                <span id="filterText">Rak</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item filter-item" href="#" data-value="">1</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Padat">2</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Cair">3</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Gas">4</a></li>
              </ul>
            </div>
            <!--  -->

            <div class="dropdown">
              <button class="btn btn-filter-dropdown dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-funnel me-1"></i> 
                <span id="filterText">Semua</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item filter-item" href="#" data-value="">Semua</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Padat">Padat</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Cair">Cair</a></li>
                <li><a class="dropdown-item filter-item" href="#" data-value="Gas">Gas</a></li>
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
                        <?= $row['jenis'] ?>
                      </span>
                    </td>

                    <td class="text-main fw-bold">
                      <?= number_format($row['qty'], 2) ?>
                    </td>

                    <td>
                      <?php if($row['foto_bahan']): ?>
                        <img src="images/uploads/<?= $row['foto_bahan'] ?>" width="200">
                      <?php else: ?>
                        <i class="bi bi-image text-muted"></i>
                      <?php endif; ?>
                    </td>

                    <td>
                      <?php if($row['qty'] > 0): ?>
                        <span class="badge bg-success bg-opacity-10 text-success px-3">Tersedia</span>
                      <?php else: ?>
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3">Habis</span>
                      <?php endif; ?>
                    </td>

                    <td>
                      <div class="d-flex gap-2">
                        <button class="btn-circle btn-detail"><i class="bi bi-eye"></i></button>
                        <button class="btn-circle btn-stok"><i class="bi bi-plus"></i></button>
                        <button class="btn-circle btn-hapus"><i class="bi bi-trash"></i></button>
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
include "modalDashboard.php";
?>
