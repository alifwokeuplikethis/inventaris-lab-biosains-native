<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kadaluarsa</title>

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ================= BODY ================= */
    body {
      background-color: #e9ecef;
    }

    /* ================= WRAPPER HIJAU ================= */
    .main-box {
      background: linear-gradient(180deg, #2b6766, #3f8a87);
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* ================= CARD PUTIH ================= */
    .content-card {
      border-radius: 20px;
      overflow: hidden;
    }

    /* ================= HEADER ================= */
    .header-area {
      background: #ffffff;
      padding: 20px 30px;
      border-radius: 15px;
    }

    .title-text {
      color: #A0522D;
      font-weight: 700;
    }

    /* ================= SEARCH ================= */
    .search-box input {
      background-color: #dfe6e1;
      border-radius: 30px;
      padding-left: 20px;
      padding-right: 40px;
      border: none;
      width: 260px;
    }

    .search-icon {
      position: absolute;
      right: 15px;
      top: 8px;
      color: #444;
    }

    /* ================= TEXT TENGAH ================= */
    .table th,
    .table td {
      text-align: center;
      vertical-align: middle; /* biar rata tengah juga secara vertikal */
    }
    
    /* ================= TABLE AREA ================= */
    .table-wrapper {
      background: #ffffff;
      border-radius: 15px;
      padding: 15px;
      margin-top: 20px;
    }

    .table thead tr {
      background-color: #cfd8cf;
      border-radius: 10px;
    }

    .table thead th {
      border: none;
      font-weight: 600;
      padding: 15px;
    }

    .table tbody tr {
      background: #f2f4f3;
      border-radius: 10px;
    }

    .table tbody td {
      border: none;
      padding: 15px;
    }

    /* JARAK ANTAR ROW BIAR KAYAK CARD */
    .table {
      border-collapse: separate;
      border-spacing: 0 10px;
    }

    /* ================= ICON BOX ================= */
    .icon-box {
      width: 40px;
      height: 40px;
      background: #e9ecef;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ================= HOVER ================= */
    tbody tr:hover {
      background-color: #e6ebe9;
      transition: 0.2s;
    }

  </style>
</head>

<body>

<?php
/* ================= INCLUDE ================= */
include "sidebar.php";
?>

<!-- ================= MAIN ================= -->
<main class="mt-5 pt-3">
  <div class="container-fluid">

    <!-- HIJAU BESAR -->
    <section class="main-box">

      <div class="content-card">

        <!-- HEADER -->
        <div class="header-area d-flex justify-content-between align-items-center">

          <!-- JUDUL -->
          <h2 class="mb-0 title-text">Kadaluarsa</h2>

          <!-- SEARCH + ICON -->
          <div class="d-flex align-items-center gap-4">

            <!-- SEARCH -->
            <div class="position-relative search-box">
              <input type="text" id="searchInput" placeholder="Telusuri...">
              <i class="fa fa-search search-icon"></i>
            </div>

            <!-- ICON -->
            <div class="text-secondary fs-4 d-flex align-items-center">
              <i class="fa fa-angle-double-right opacity-50"></i>
              <i class="fa fa-home ms-2"></i>
            </div>

          </div>
        </div>

        <!-- TABLE -->
        <div class="table-wrapper">

          <div class="table-responsive" style="max-height: 420px; overflow-y: auto;">
            <table class="table align-middle" id="dataTable">

              <thead>
                <tr>
                  <th>No</th>
                  <th>id barang</th>
                  <th>Tanggal Masuk</th>
                  <th>Nama Bahan Kimia</th>
                  <th>Kategori</th>
                  <th>Tanggal Kadaluarsa</th>
                  <th>Jumlah</th>
                </tr>
              </thead>

              <tbody>

                <!-- ROW -->
                <tr>
                  <td>1.</td>
                  <td>100000</td>
                  <td>11/1/25</td>
                  <td>Clorin</td>
                  <td>gas</td>
                  <td>33/1/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>2.</td>
                  <td>200000</td>
                  <td>11/2/25</td>
                  <td>Carbondioksida</td>
                  <td>gas</td>
                  <td>33/2/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>3.</td>
                  <td>300000.</td>
                  <td>11/3/25</td>
                  <td>Clorin</td>
                  <td>gas</td>
                  <td>33/3/26</td>
                  <td>1000ml</td>
                </tr>

                <tr>
                  <td>4.</td>
                  <td>400000.</td>
                  <td>11/4/25</td>
                  <td>klorida</td>
                  <td>gas</td>
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

<!-- JS -->
<script src="js/jquery-3.5.1.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
/* ================= SEARCH ================= */
document.getElementById("searchInput").addEventListener("keyup", function() {
  let value = this.value.toLowerCase();
  let rows = document.querySelectorAll("#dataTable tbody tr");

  rows.forEach(row => {
    let text = row.innerText.toLowerCase();
    row.style.display = text.includes(value) ? "" : "none";
  });
});
</script>

</body>
</html>