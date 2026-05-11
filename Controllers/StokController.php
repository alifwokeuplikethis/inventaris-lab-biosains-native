<?php
namespace Controllers;

use Services\StokService;
use Models\Database;
use Models\BahanModel;

class StokController {

    private $model;
    private $service;

    public function __construct() {
        $conn = (new Database())->getConnection();

        $this->model = new BahanModel($conn);
        $this->service = new StokService($conn);
    }

    /* ================= HALAMAN ================= */
    public function transaksiStok() {

        $id_bahan = $_GET['id_bahan'];

        $data = $this->model->getDashboardBahan(); // ✔ ini sekarang tidak null
        $infoBahan = $this->model->getBahanInfo($id_bahan);

        require PAGES_PATH . 'transaksi_stok.php';
    }

    /* ================= PROSES ================= */
    public function prosesStok() {
        $aksi = $_POST['aksi'];
        $id_bahan = $_GET['id_bahan'];
        $info = $this->model->getBahanInfo($id_bahan);

        // 🔥 BUNGKUS KEDUANYA DI DALAM TRY!
        try {
            
            // ================= PROSES TAMBAH =================
            if ($aksi === 'tambah') {
                $dataBahan = [
                    'tgl_penerimaan' => $_POST['tgl_penerimaan'],
                    'tgl_kadaluarsa' => $_POST['tgl_kadaluarsa'],
                    'rak' => $_POST['rak']
                ];
                
                $this->service->tambahStok(
                    $id_bahan,
                    $dataBahan,
                    $_POST['qty'] * $info['volume_per_botol'],
                    $_SESSION['user']['id_normal']
                );

                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Berhasil Menambahkan Data!',
                    'text' => 'Data ' . $info['nama_bahan'] . ' berhasil ditambahkan',
                    'timer' => 5000
                ];
            }

            // ================= PROSES KURANGI =================
            if ($aksi === 'kurangi') {
                $result = $this->service->kurangiStok(
                    $id_bahan,
                    $_POST['jumlah_keluar'],
                    $info['volume_per_botol'],
                    $_SESSION['user']['id_normal']
                );
                
                $_SESSION['success'] = [
                    'icon' => 'success',
                    'title' => 'Berhasil',
                    'timer' => 5000,
                    'text' => 'Stok diambil dari rak: ' . implode(', ', array_column($result['rak_dipakai'], 'rak'))
                ];
            }

        } catch (\Exception $e) {
            // 🔥 SEKARANG SEMUA ERROR PASTI KETANGKAP DI SINI!
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'GAGAL MEMPROSES!',
                'text' => 'Pesan Error Database: ' . $e->getMessage(),
                'timer' => 10000 // Aku lamain jadi 10 detik biar kamu sempat baca
            ];
        }
        
        header("Location: ?action=dashboard");
        exit;
    }

    public function previewKurangiStok() {

        header('Content-Type: application/json');

        try {

            $id_bahan = $_POST['id_bahan'];
            $jumlah = $_POST['jumlah_keluar'];

            $data = $this->service->previewKurangiStok($id_bahan, $jumlah);

            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);

        } catch (\Throwable $e) {

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }
    
}