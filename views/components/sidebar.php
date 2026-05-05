

 <?php
 $halaman = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
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
            <a href="index.php?action=tambah_bahan" class="nav-link px-3 <?= ($halaman == 'tambah_bahan') ? 'active' : '' ?>">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Tambah Bahan</span>
            </a>
          </li>

          <li class="nav-link bordered px-3">
            <a href="index.php?action=kadaluarsa" class="nav-link px-3 <?= ($halaman == 'kadaluarsa') ? 'active' : '' ?>">
              <span class="me-2"><i class="bi bi-journal-text"></i></span>
              <span>Kadaluarsa</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="index.php?action=laporan" class="nav-link px-3 <?= ($halaman == 'laporan') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Laporan</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="index.php?action=akun_teknisi" class="nav-link px-3 <?= ($halaman == 'akun_teknisi') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Akun Teknisi</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="index.php?action=pengajuan" class="nav-link px-3 <?= ($halaman == 'pengajuan') ? 'active' : '' ?> ">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Permintaan Teknisi</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

