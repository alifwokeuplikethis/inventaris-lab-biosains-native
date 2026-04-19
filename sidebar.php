 <?php
 $halaman = isset($_GET['pages']) ? $_GET['pages'] : 'dashboard';


 ?>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Admin Dashbaord</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
</head>


 <?php
 $current_page = basename($_SERVER['PHP_SELF']);
 ?>
 <!-- sidebar -->
  <div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header shadow-sm d-block text-center">
      <div class="offcanvas-title" id="offcanvasExampleLabel">
        <a class="navbar-brand fw-bold" href="index.html">lab-biosains</a>
      </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav sidenav">
          <li class="nav-link bordered px-3">
            <a href="index.php" class="nav-link px-3 <?= ($halaman == 'dashboard') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-link bordered px-3">
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button"
              aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-people-fill"></i>
              </span>
              <span>Students</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <div>
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="add-student.html" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-1-circle"></i></span>
                      <span>Add Student</span>
                    </a>
                  </li>
                  <li>
                    <a href="all-student.html" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-2-circle"></i></span>
                      <span>All Students</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li> -->
          <li class="nav-link bordered px-3">
            <a href="index.php?pages=tambah_barang" class="nav-link px-3 <?= ($halaman == 'tambah_barang') ? 'active' : '' ?>">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Tambah Barang</span>
            </a>
          </li>

          <li class="nav-link bordered px-3">
            <a href="index.php?pages=kadaluarsa" class="nav-link px-3 <?= ($halaman == 'kadaluarsa') ? 'active' : '' ?>">
              <span class="me-2"><i class="bi bi-journal-text"></i></span>
              <span>Kadaluarsa</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="index.php?pages=laporan" class="nav-link px-3 <?= ($halaman == 'laporan') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Laporan</span>
            </a>
          <li class="nav-link bordered px-3">
            <a href="index.php?pages=akun_teknisi" class="nav-link px-3 <?= ($halaman == 'akun_teknisi') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Akun Teknisi</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

    <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>