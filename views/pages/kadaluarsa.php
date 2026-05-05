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
                <strong>1</strong>
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
                <strong>xxx</strong>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- ===== CARD ===== -->
      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

        <!-- HEADER -->
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">

          <h5 class="fw-bold text-main m-0">
            <i class="bi bi-clock-history me-2"></i>Data Kadaluarsa
          </h5>

          <!-- SEARCH -->
          <input type="text" id="searchInput" 
            class="form-control control shadow-sm" 
            placeholder="Cari data..." 
            style="width:220px;">

        </div>

        <!-- TABLE -->
        <div class="card-body p-4 bg-white">
          <div class="table-responsive">

            <table id="table-dashboard" class="table table-hover align-middle">

              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Barang</th>
                  <th>Tanggal Masuk</th>
                  <th>Nama Bahan</th>
                  <th>Kategori</th>
                  <th>Kadaluarsa</th>
                  <th>Jumlah</th>
                </tr>
              </thead>

              <tbody>

                <tr>
                  <td>1</td>
                  <td>100000</td>
                  <td>11/1/25</td>
                  <td>Clorin</td>
                  <td>Gas</td>
                  <td>33/1/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>2</td>
                  <td>200000</td>
                  <td>11/2/25</td>
                  <td>Carbondioksida</td>
                  <td>Gas</td>
                  <td>33/2/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>3</td>
                  <td>300000</td>
                  <td>11/3/25</td>
                  <td>Clorin</td>
                  <td>Gas</td>
                  <td>33/3/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>4</td>
                  <td>400000</td>
                  <td>11/4/25</td>
                  <td>Klorida</td>
                  <td>Gas</td>
                  <td>33/4/26</td>
                  <td>1000ml</td>
                </tr>

              </tbody>

            </table>

          </div>
        </div>

      </div>

    </section>

  </div>
</main>

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
  let value = this.value.toLowerCase();
  let rows = document.querySelectorAll("#table-dashboard tbody tr");

  rows.forEach(row => {
    let text = row.innerText.toLowerCase();
    row.style.display = text.includes(value) ? "" : "none";
  });
});
</script>