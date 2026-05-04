<?php  

require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>
<main class="py-4">
        <div class="container-fluid px-4">
            <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
                <div class="row g-4 mb-4">
                    <!-- untuk 3 card -->
                    <div class="col-12 col-md-4">
                        <div class="stat-pill pill-total">
                            <div class="ico"><i class="bi bi-people-fill"></i></div>
                            <div class="info">
                                <small>Total Teknisi</small>
                                <strong id="stat_total">xxx</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="stat-pill pill-aktif">
                            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
                            <div class="info">
                                <small>Aktif</small>
                                <strong id="stat_aktif">xxx</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="stat-pill pill-nonaktif">
                            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
                            <div class="info">
                                <small>Nonaktif</small>
                                <strong id="stat_nonaktif">xxx</strong>
                            </div>
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
                <div class="card card-wrapper" style="padding: 20px;">
                    <div class="section-label">Daftar Akun Teknisi</div>
                    <div class="teknisi-list" id="teknisiList">
                        <!-- data dummy   -->
                        <div class="card d-flex flex-row justify-content-between align-items-center p-3 mb-2"">
                            <div class=" left d-flex" style="gap: 10px; align-items: center;">
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

                    <div class="card d-flex flex-row justify-content-between align-items-center p-3 mb-2"">
                            <div class=" left d-flex" style="gap: 10px; align-items: center;">
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

                <div class="card d-flex flex-row justify-content-between align-items-center p-3 mb-2"">
                            <div class=" left d-flex" style="gap: 10px; align-items: center;">
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

        <div class="card d-flex flex-row justify-content-between align-items-center p-3 mb-2"">
                            <div class=" left d-flex" style="gap: 10px; align-items: center;">
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