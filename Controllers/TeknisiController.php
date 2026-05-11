<?php
namespace Controllers;

use Models\BahanModel;
use Models\Database;
use Models\TransaksiModel;
use Services\StokService;
use Exception;
use PDO;

class TeknisiController{

    private BahanModel $model;
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
        $this->BahanModel = new BahanModel($this->conn);
        $this->TransaksiModel = new TransaksiModel($this->conn);
        $this->service = new StokService();
    }

    /* ================= DASHBOARD ================= */
    public function dashboard() {
        $stats = $this->BahanModel->getDashboardStats();
        $data = $this->BahanModel->getDashboardBahan();
        require PAGES_PATH . 'teknisi/dashboard.php';
    }

    public function dashboardAdmin(){
        // Panggil fungsi Grouped yang baru kita buat
        $allRequests = $this->BahanModel->getAllRequestsGrouped();
        require PAGES_PATH . 'permintaan_teknisi.php';
    }
    // Fungsi khusus untuk merespons AJAX Modal
    // DI DALAM CONTROLLER
    public function detailRequestModal() {
        header('Content-Type: application/json'); // Wajib kasih tahu ini JSON
        $id_pengguna = $_GET['id_pengguna'] ?? null;
        
        if (!$id_pengguna) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }

        $detailRequests = $this->BahanModel->getRequestDetailsByUser($id_pengguna);
        echo json_encode(['status' => 'success', 'data' => $detailRequests]);
        exit;
    }
    // Fungsi baru untuk memproses persetujuan massal (1 klik banyak bahan)
    public function prosesRequestBatch() {
    $id_pengguna = $_GET['id_pengguna'];
    $aksi = $_GET['status'];
    $userId = $_SESSION['user']['id_normal'];
    $tgl = date('Y-m-d');

    try {
        $pendingRequests = $this->BahanModel->getPendingRequestsByUser($id_pengguna);
        
        if (empty($pendingRequests)) {
            throw new Exception("Tidak ada request pending untuk teknisi ini.");
        }

        if ($aksi === 'setuju') {
            
            $this->conn->beginTransaction();

            // 🔥 1. KITA HITUNG DULU TOTAL KESELURUHANNYA
            $totalSemuaBarang = 0;
            foreach ($pendingRequests as $req) {
                // Asumsi field jumlah di request bernama 'jumlah'
                $totalSemuaBarang += $req['total_volume']; 
            }

            // 🔥 2. SEKARANG MASUKIN TOTALNYA KE TRANSAKSI INDUK (Bukan 0 lagi)
            $trxIdMaster = $this->TransaksiModel->insertTransaksi($userId, $tgl, $totalSemuaBarang);

            // 3. Baru deh kita looping buat motong stoknya
            foreach ($pendingRequests as $req) {
                $this->service->approveRequest($req, $userId, $trxIdMaster);
            }
            
            $this->conn->commit();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Pengajuan Disetujui!',
                'text' => count($pendingRequests) . ' bahan berhasil diproses.',
            ];

        } elseif ($aksi === 'tolak') {
            // ... (kode tolak tetap sama)
        }
    } catch (\Exception $e) {
        if (isset($aksi) && $aksi === 'setuju' && $this->conn->inTransaction()) {
            $this->conn->rollBack();
        }

        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal Memproses!',
            'text' => $e->getMessage(),
        ];
    }

    header("Location: ?action=dashboard");
    exit;
}
    public function pengajuanBahan() {
    $id_bahan = $_GET['id_bahan'] ?? null;

    if (!$id_bahan) {
        die("ID Bahan tidak ditemukan!");
    }
    $infoBahan = $this->BahanModel->getBahanInfo($id_bahan);

    if (!$infoBahan) {
        die("Data bahan tidak ada di database!");
    }
    require PAGES_PATH .'teknisi/pengajuan.php';
}

    public function ajukanBahan() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // id_bahan didapat dari input hidden di form
        $id_bahan = $_POST['id_bahan'];
        $total_volume = $_POST['total_volume'];
        
        // Asumsi ID user teknisi disimpan di $_SESSION['user']['id'] saat login
        $id_pengguna = $_SESSION['user']['id_normal']; 
        
        try {
            // Panggil fungsi insert di BahanModel
            $this->BahanModel->insertRequestBahan($id_bahan, $id_pengguna, $total_volume);
            
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Pengajuan Terkirim!',
                'text' => 'Permintaan bahan Anda sedang menunggu persetujuan Admin.',
                'timer' => 3000
            ];
        } catch (\Exception $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Gagal Mengajukan!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'timer' => 5000
            ];
        }
        
        // Redirect kembali ke dashboard teknisi
        header("Location: ?action=halaman_teknisi"); 
        exit;
    }
}
}
?>