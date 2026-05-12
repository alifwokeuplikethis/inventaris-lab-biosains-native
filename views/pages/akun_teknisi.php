<?php
// Pastikan file ini dipanggil dari Controller sehingga variabel $statistik dan $daftar_teknisi sudah tersedia.
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>

<head>
    <link rel="stylesheet" href="css/akun_teknisi.css">
    <style>
        .profile-img {
            width: 50px; 
            height: 50px; 
            border-radius: 50%; 
            object-fit: cover;
        }
    </style>
</head>
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
                            <small>Total Teknisi</small>
                            <strong id="stat_total"><?= $statistik['total'] ?? 0 ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="stat-pill pill-aktif">
                        <div class="ico"><i class="bi bi-person-check-fill"></i></div>
                        <div class="info">
                            <small>Aktif</small>
                            <strong id="stat_aktif"><?= $statistik['aktif'] ?? 0 ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="stat-pill pill-nonaktif">
                        <div class="ico"><i class="bi bi-person-x-fill"></i></div>
                        <div class="info">
                            <small>Nonaktif</small>
                            <strong id="stat_nonaktif"><?= $statistik['nonaktif'] ?? 0 ?></strong>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card card-wrapper" style="padding: 20px; border-radius: 16px;">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="section-label mb-0">Daftar Akun Teknisi</div>
                    <div class="position-relative">
                        <input type="text"
                            class="form-control ps-3 shadow-sm"
                            placeholder="Cari akun teknisi..."
                            style="width:220px;">
                    </div>
                </div>

                <div class="teknisi-list" id="teknisiList">
                    
                    <?php if (empty($daftar_teknisi)): ?>
                        <div class="text-center py-4 text-muted">
                            Belum ada data teknisi.
                        </div>
                    <?php else: ?>
                        
                        <?php foreach($daftar_teknisi as $teknisi): ?>
                            
                            <?php 
                                $foto = !empty($teknisi['foto_pengguna']) ? htmlspecialchars($teknisi['foto_pengguna']) : 'images/default-avatar.png'; 
                            ?>

                            <div class="card d-flex flex-row justify-content-between align-items-center p-3 mb-2 shadow-sm">
                                
                                <div class="left d-flex" style="gap: 15px; align-items: center;">
                                    <img src="<?= $foto ?>" alt="foto" class="profile-img">
                                    <div>
                                        <p style="font-weight: 800; margin: 0;">
                                            <?= htmlspecialchars($teknisi['nama'] ?? 'Belum Isi Biodata') ?>
                                        </p>
                                        <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">
                                            <?= htmlspecialchars($teknisi['email']) ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                    
                                    <p style="margin-bottom: 0; margin-right: 15px; font-size: 0.9rem;">
                                        <i class="bi bi-telephone"></i> <?= htmlspecialchars($teknisi['no_telp'] ?? '-') ?>
                                    </p>

                                    <?php if($teknisi['status_pendaftaran'] == 'pending'): ?>
                                        
                                        <span class="badge text-bg-warning">Pending</span>
                                        <a href="?pages=akun_teknisi&action=setujui&id=<?= $teknisi['id'] ?>" class="btn btn-sm btn-success" title="Setujui">
                                            <i class="bi bi-check-lg"></i>
                                        </a>
                                        <a href="?pages=akun_teknisi&action=tolak&id=<?= $teknisi['id'] ?>" class="btn btn-sm btn-outline-danger" title="Tolak" onclick="return confirm('Yakin ingin menolak akun ini?');">
                                            <i class="bi bi-x-lg"></i>
                                        </a>

                                    <?php elseif($teknisi['status_pendaftaran'] == 'ditolak'): ?>
                                        
                                        <span class="badge text-bg-secondary">Ditolak</span>
                                        <a href="?pages=akun_teknisi&action=setujui&id=<?= $teknisi['id'] ?>" class="btn btn-sm btn-outline-success" title="Batal Tolak & Setujui">
                                            <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                        </a>

                                    <?php elseif($teknisi['status_pendaftaran'] == 'disetujui'): ?>
                                        
                                        <?php if($teknisi['is_aktif'] == 1): ?>
                                            <span class="badge text-bg-success">Aktif</span>
                                            <a href="?pages=akun_teknisi&action=toggle_status&id=<?= $teknisi['id'] ?>&status=1" class="btn btn-sm btn-light border-0" title="Nonaktifkan">
                                                <i class="bi bi-toggle-on text-success fs-5"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="badge text-bg-danger">Nonaktif</span>
                                            <a href="?pages=akun_teknisi&action=toggle_status&id=<?= $teknisi['id'] ?>&status=0" class="btn btn-sm btn-light border-0" title="Aktifkan">
                                                <i class="bi bi-toggle-off text-danger fs-5"></i>
                                            </a>
                                        <?php endif; ?>

                                        <button
    type="button"
    class="btn btn-sm btn-warning btnEdit"

    data-bs-toggle="modal"
    data-bs-target="#modalTeknisi"

    data-id="<?= $teknisi['id'] ?? '' ?>"
    data-nama="<?= htmlspecialchars($teknisi['nama'] ?? '') ?>"
    data-email="<?= htmlspecialchars($teknisi['email'] ?? '') ?>"
    data-telp="<?= htmlspecialchars($teknisi['no_telp'] ?? '') ?>"
    data-alamat="<?= htmlspecialchars($teknisi['alamat'] ?? '') ?>"
    data-kelamin="<?= htmlspecialchars($teknisi['jenis_kelamin'] ?? '') ?>"
    data-foto="<?= htmlspecialchars($foto ?? '') ?>"
    data-status="<?= $teknisi['is_aktif'] ?? 0 ?>">

    <i class="bi bi-info"></i>

</button>

                                    

                                        <a href="?pages=akun_teknisi&action=hapus&id=<?= $teknisi['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus permanen?');">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </div>
</main>

<?php
include "Modal/modalAkunTeknisi.php";
?>