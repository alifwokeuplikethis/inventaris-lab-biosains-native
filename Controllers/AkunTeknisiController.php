<?php
namespace Controllers;
use Models\TeknisiModel;
use Services\TeknisiService;

class AkunTeknisiController{

    public function  __construct(){
        $this->model = new TeknisiModel();
        $this->service = new TeknisiService();
    }

    public function getAkunTeknisi(){
        $daftar_teknisi = $this->model->getAllTeknisi();
        $statistik = $this->service->getStatistikDashboard();
        require PAGES_PATH . 'akun_teknisi.php';
    }

    // Aksi ketika tombol "Setujui" diklik
    public function setujui() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->service->setujuiAkun($id);
            $_SESSION['success'] = "Akun teknisi berhasil disetujui.";
        }
        header("Location: ?action=akun_teknisi"); // Sesuaikan dengan route Anda
        exit;
    }

    public function tolak() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->service->tolakAkun($id);
            $_SESSION['success'] = "Akun teknisi ditolak.";
        }
        header("Location: ?action=akun_teknisi");
        exit;
    }

    // Aksi ketika toggle "Aktif/Nonaktif" diklik
    public function toggle_status() {
        $id = $_GET['id'] ?? null;
        $current_status = $_GET['status'] ?? null; // Status is_aktif saat tombol diklik
        
        if ($id !== null && $current_status !== null) {
            $this->service->toggleStatusOperasional($id, $current_status);
        }
        
        // Catatan: Jika menggunakan Vanilla JS fetch/AJAX, kembalikan JSON. 
        // Jika menggunakan tag <a> biasa, pakai header location.
        header("Location: ?action=akun_teknisi");
        exit;
    }

    // Aksi hapus akun permanen
    public function hapus() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->service->hapusAkun($id);
            $_SESSION['success'] = "Akun berhasil dihapus.";
        }
        header("Location: ?action=akun_teknisi");
        exit;
    }
}
?>