<?php
include "navbar.php";
include "sidebar.php";

// 1. Tentukan halaman utama yang jadi background
$halaman = isset($_GET['pages']) ? $_GET['pages'] : 'dashboard';
$daftar_halaman = ['dashboard', 'kadaluarsa', 'tambah_barang', 'laporan', 'akun_teknisi'];

// Bungkus main content dalam div agar tidak berantakan dengan sidebar
echo '<div class="main-content">'; 
if (in_array($halaman, $daftar_halaman)) {
    if (file_exists("pages/$halaman.php")) {
        include "pages/$halaman.php";
    } else {
        echo "<h2>Error 404: File tidak ditemukan!</h2>";
    }
} else {
    // Jika user mengakses pages=detail_bahan, kita paksa background-nya dashboard
    if ($halaman == 'detail_bahan') {
        include "pages/dashboard.php";
    } else {
        echo "<h2>Halaman Tidak Ditemukan!</h2>";
    }
}
echo '</div>';

// 2. LOGIKA MODAL (TIDAK BOLEH MASUK ELSE/IF DI ATAS)
// Modal harus di-include secara mandiri di paling bawah agar menumpuk di atas
if (isset($_GET['pages']) && $_GET['pages'] == 'detail_bahan') {
    if (file_exists("pages/detail_bahan.php")) {
        include "pages/detail_bahan.php";
    }
}
?>