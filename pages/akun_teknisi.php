<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acc Akun Teknisi</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/akun_teknisi.css">
  
</head>
<body>

<main>
    <div class="container-fluid px-0">
        <div class="shell">
            <div class="main-card shadow-sm">

                <!-- topbar -->
                <div class="card-topbar">
                    <h1>Akun Teknisi</h1>
                    <div class="topbar-icons">
                        <i class="fa fa-angle-double-right"></i>
                        <i class="fa fa-home text-dark"></i>
                    </div>
                </div>

                <div class="card-body-pad">

                    <!-- stats -->
                    <div class="stats-row">
                        <div class="stat-pill total">
                            <div class="ico"><i class="bi bi-people-fill"></i></div>
                            <div class="info">
                                <small>Total Teknisi</small>
                                <strong id="stat_total">0</strong>
                            </div>
                        </div>
                        <div class="stat-pill aktif">
                            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
                            <div class="info">
                                <small>Aktif</small>
                                <strong id="stat_aktif">0</strong>
                            </div>
                        </div>
                        <div class="stat-pill nonaktif">
                            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
                            <div class="info">
                                <small>Nonaktif</small>
                                <strong id="stat_nonaktif">0</strong>
                            </div>
                        </div>
                    </div>

                    <!-- search+tambah -->
                    <div class="action-bar">
                        <div class="search-wrap">
                            <i class="bi bi-search si"></i>
                            <input type="text" id="searchinput" placeholder="Cari nama atau akun teknisi..." oninput="renderList()">
                        </div>
                        <button class="btn-cari" onclick="openModal()">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                        <button class="btn-add" onclick="openModal()">
                            <i class="bi bi-person-plus-fill"></i>
                            Tambah teknisi
                        </button>
                    </div>

                    <!-- list teknisi -->
                    <div class="section-label">Daftar Akun Teknisi</div>
                    <div class="teknisi-list" id="teknisiList">
                            <!-- data dummy   -->
                        <div class="card">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <img src="images/azminihbos.jpeg" alt="foto" style="width: 50px; border-radius: 100px;">
                                <div>
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0;"><i class="bi bi-telephone"></i> 082727272727</p>
                                <span class="badge text-bg-success" id="badge_1">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-light" onclick="toggleStatus(this, 'badge_1')">
                                    <i class="bi bi-toggle-on text-success fs-5"></i>
                                </button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <img src="images/azminihbos.jpeg" alt="foto" style="width: 50px; border-radius: 100px;">
                                <div>
                                    <p style="font-weight: 800; margin: 0;">Nabila Rizky</p>
                                    <p style="margin: 0;">nabila@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0;"><i class="bi bi-telephone"></i> 082727272727</p>
                                <span class="badge text-bg-success" id="badge_2">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-light" onclick="toggleStatus(this, 'badge_2')">
                                    <i class="bi bi-toggle-on text-success fs-5"></i>
                                </button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <img src="images/azminihbos.jpeg" alt="foto" style="width: 50px; border-radius: 100px;">
                                <div>
                                    <p style="font-weight: 800; margin: 0;">Ahnaf Nur Azmi</p>
                                    <p style="margin: 0;">Ahnaf25@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0;"><i class="bi bi-telephone"></i> 082727272727</p>
                                <span class="badge text-bg-danger" id="badge_3">Nonaktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-light" onclick="toggleStatus(this, 'badge_3')">
                                    <i class="bi bi-toggle-off text-danger fs-5"></i>
                                </button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <img src="images/azminihbos.jpeg" alt="foto" style="width: 50px; border-radius: 100px;">
                                <div>
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0;"><i class="bi bi-telephone"></i> 082727272727</p>
                                <span class="badge text-bg-success" id="badge_4">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-light" onclick="toggleStatus(this, 'badge_4')">
                                    <i class="bi bi-toggle-on text-success fs-5"></i>
                                </button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
function toggleStatus(btn, badgeId) {
    const icon = btn.querySelector('i');
    const badge = document.getElementById(badgeId);

    if (icon.classList.contains('bi-toggle-on')) {
        icon.classList.remove('bi-toggle-on', 'text-success');
        icon.classList.add('bi-toggle-off', 'text-danger');
        badge.classList.remove('text-bg-success');
        badge.classList.add('text-bg-danger');
        badge.innerText = 'Nonaktif';
    } else {
        icon.classList.remove('bi-toggle-off', 'text-danger');
        icon.classList.add('bi-toggle-on', 'text-success');
        badge.classList.remove('text-bg-danger');
        badge.classList.add('text-bg-success');
        badge.innerText = 'Aktif';
    }
}
</script>
</body>
</html>