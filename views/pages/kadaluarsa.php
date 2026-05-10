<?php  
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>

<style>
  body { 
    background: #f5f7f6; 
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
  }

  .text-main { color: #02343F; }

  /* STAT */
  .stat-pill {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 20px;
    border-radius: 16px;
    background: white; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }

  .stat-pill .ico {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
  }

  .pill-total .ico { background:#e3f2fd; color:#0d6efd; }
  .pill-warning .ico { background:#fff3cd; color:#ffc107; }
  .pill-danger .ico { background:#f8d7da; color:#dc3545; }

  /* CONTROL */
  .control {
    border-radius: 8px;
    border: 1px solid #dee2e6;
  }

  /* TABLE */
  #table-dashboard thead th {
    background: #f8faf9;
    border-bottom: 2px solid #eef2f0;
    font-size: 0.85rem;
    text-align: center;
  }

  #table-dashboard td {
    text-align: center;
    vertical-align: middle;
  }

  tbody tr:hover {
    background-color: #f1f5f4;
  }

  div.dataTables_filter {
    display: none !important;
  }

</style>

<main class="py-4">
  <div class="container-fluid px-4">

    <!-- WRAPPER -->
    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
      
      <!-- ===== STAT (INI YANG KAMU MAU) ===== -->
      <div class="row g-4 mb-4">

        <div class="col-md-4">
          <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-box"></i></div>
            <div>
              <small>Total Data</small>
              <div>
                <strong>4</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="stat-pill pill-warning">
            <div class="ico"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
              <small>Akan Kadaluarsa</small>
              <div>
                <strong><?= $totalHampir ?></strong>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="stat-pill pill-danger">
            <div class="ico"><i class="bi bi-x-circle"></i></div>
            <div>
              <small>Sudah Kadaluarsa</small>
              <div>
                <strong><?= $totalExpired ?></strong>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- ===== CARD ===== -->
      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

       <!-- HEADER -->
<div class="card-header bg-white p-3">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <h5 class="fw-bold text-main m-0">
            <i class="bi bi-clock-history me-2"></i>
            Data Kadaluarsa
        </h5>

        <div class="d-flex align-items-center gap-2">

            <!-- FILTER -->
            <div class="dropdown">

                <button 
                    class="btn btn-outline-secondary shadow-sm dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                >
                    <i class="bi bi-funnel me-1"></i>
                    <span id="filterText">Semua Status</span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                    <li>
                        <a class="dropdown-item filter-item" href="#" data-value="" data-column="7">
                            Semua
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item filter-item" href="#" data-value="expired" data-column="7">
                            Expired
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item filter-item" href="#" data-value="hampir kadaluarsa" data-column="7"> 
                            Hampir Kadaluarsa
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item filter-item" href="#" data-value="aman" data-column="7"> 
                            Aman
                        </a>
                    </li>

                </ul>

            </div>

            <!-- SEARCH -->
            <input 
                type="text"
                id="searchInput"
                class="form-control control shadow-sm"
                placeholder="Cari data..."
                style="width:220px;"
            >

        </div>

    </div>

</div>

        <!-- TABLE -->
        <div class="card-body p-4 bg-white">
          <div class="table-responsive">

            <table id="table-dashboard" class="table table-hover align-middle">

              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Bahan</th>
                  <th>Nama Bahan</th>
                  <th>Tanggal Penerimaan</th>
                  <th>Kadaluarsa</th>
                  <th>Rak</th>
                  <th>Status</th>
                  <th>Status Kadaluarsa</th>
                </tr>
              </thead>

              <tbody>
                <?php $no = 0;?>
            <?php foreach ($dataKadaluarsa as $item): ?>
              <?php
                $no++;
                
                if ($item['status_kadaluarsa'] === 'expired') {
                    $badgeClass = 'bg-danger';

                } elseif ($item['status_kadaluarsa'] === 'hampir kadaluarsa') {
                    $badgeClass = 'bg-warning';

                } else {
                    $badgeClass = 'bg-success';
                }
?>

<tr data-status="<?= trim(strtolower($item['status_kadaluarsa'])) ?>">
 
                    <td><?= $no; ?></td>
                    <td><?= $item['id_bahan'] ?></td>
                    <td><?= $item['nama_bahan'] ?></td>
                    <td><?= $item['tgl_penerimaan'] ?></td>
                    <td><?= $item['tgl_kadaluarsa'] ?></td>
                    <td><?= $item['rak'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td>            <span class="badge <?= $badgeClass ?>">
                <?= $item['status_kadaluarsa'] ?>
            </span></td>
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
