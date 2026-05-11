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
    private TransaksiModel $TransaksiModel;
    private StokService $service;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
        $this->BahanModel = new BahanModel($this->conn);
        $this->TransaksiModel = new TransaksiModel($this->conn);
        $this->service = new StokService($this->conn);
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
    header('Content-Type: application/json');
    $id_pengguna = $_GET['id_pengguna'] ?? null;
    
    if (!$id_pengguna) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
        return;
    }

    try {
        // 1. Ambil detail request seperti biasa
        $detailRequests = $this->BahanModel->getRequestDetailsByUser($id_pengguna);
        
        $resultData = [];

        foreach ($detailRequests as $req) {
            $itemResult = [
                'nama_bahan'   => $req['nama_bahan'],
                'total_volume' => $req['total_volume'],
                'satuan'       => $req['satuan'],
                'status'       => $req['status'],
                'fefo_preview' => [],
                'stok_kurang'  => false
            ];

            // 2. Jika statusnya pending, hitung preview potong stok FEFO
            if ($req['status'] === 'pending') {
                $stokList = $this->BahanModel->getStokFEFO($req['id_bahan']);
                $sisa = $req['total_volume'];

                foreach ($stokList as $stok) {
                    if ($sisa <= 0) break;
                    
                    $ambil = min($stok['volume'], $sisa);
                    
                    $itemResult['fefo_preview'][] = [
                        'rak' => $stok['rak'],
                        'diambil' => $ambil,
                        'tgl_kadaluarsa' => $stok['tgl_kadaluarsa']
                    ];
                    
                    $sisa -= $ambil;
                }

                // Jika setelah looping stok FEFO ternyata masih ada sisa (stok gudang tidak cukup)
                if ($sisa > 0) {
                    $itemResult['stok_kurang'] = true;
                }
            }

            $resultData[] = $itemResult;
        }

        echo json_encode(['status' => 'success', 'data' => $resultData]);

    } catch (\Throwable $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
    // Fungsi baru untuk memproses persetujuan massal (1 klik banyak bahan)
    public function prosesRequestBatch() {
    $id_pengguna = $_GET['id_pengguna'] ?? null;
    $aksi = $_GET['status'] ?? null;
    $userId = $_SESSION['user']['id_normal'] ?? null;
    $tgl = date('Y-m-d');

    try {
        $pendingRequests = $this->BahanModel->getPendingRequestsByUser($id_pengguna);
        
        if (empty($pendingRequests)) {
            throw new Exception("Tidak ada request pending untuk teknisi ini.");
        }

        if ($aksi === 'setuju') {
            $this->conn->beginTransaction();

            // 1. Hitung total volume keseluruhan untuk header transaksi
            $totalSemuaBarang = 0;
            foreach ($pendingRequests as $req) {
                $totalSemuaBarang += $req['total_volume']; 
            }

            // 2. Insert ke tabel transaksi (Master)
            $trxIdMaster = $this->TransaksiModel->insertTransaksi($userId, $tgl, $totalSemuaBarang);

            // 3. Loop untuk proses tiap item dan potong stok
            foreach ($pendingRequests as $req) {
                // Di sini fungsi approveRequest akan melempar Exception jika stok kurang
                $this->service->approveRequest($req, $userId, $trxIdMaster);
            }
            
            $this->conn->commit();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => count($pendingRequests) . ' bahan telah disetujui dan stok dipotong.',
                'timer' => 3000
            ];

        } elseif ($aksi === 'tolak') {
            // Logika tolak bisa diletakkan di sini
        }

    } catch (Exception $e) {
        // JIKA ERROR (Termasuk Stok Tidak Cukup), batalkan semua perubahan database
        if ($this->conn->inTransaction()) {
            $this->conn->rollBack();
        }

        // KIRIM PESAN ERROR KE DASHBOARD
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal Memproses!',
            'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'timer' => 5000
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