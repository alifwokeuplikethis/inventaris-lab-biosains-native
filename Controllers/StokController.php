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
                    'title' => 'Berhasil Menambahkan Stok!',
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
                
                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Berhasil Mengurangi Stok!',
                    'text' => 'Data ' . $info['nama_bahan'] . ' berhasil ditambahkan',
                    'timer' => 5000
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
    public function detailBatchModal() {
    // 1. SAPU JAGAT: Bersihkan semua "sampah" / spasi gaib sebelum mencetak JSON
    if (ob_get_level() == 0) ob_start();
    ob_clean();

    // 2. Paksa format JSON
    header('Content-Type: application/json');
    
    $id_bahan = $_GET['id_bahan'] ?? null;

    if (!$id_bahan) {
        echo json_encode(['status' => 'error', 'message' => 'ID Bahan tidak valid']);
        exit; // HARUS EXIT, JANGAN RETURN
    }

    try {
        // Ambil info master bahan
        $infoBahan = $this->model->getBahanInfo($id_bahan);
        
        // Ambil list batch stok (FEFO)
        $listBatch = $this->model->getStokFEFO($id_bahan);

        if (!$infoBahan) {
            echo json_encode(['status' => 'error', 'message' => 'Data bahan tidak ditemukan']);
            exit; // HARUS EXIT
        }

        // Cetak data JSON yang bersih
        echo json_encode([
            'status' => 'success',
            'info'   => $infoBahan,
            'batch'  => $listBatch
        ]);

    } catch (\Throwable $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit; // HARUS EXIT
    }
    
    exit; // HARUS EXIT
}
    
}