<?php
namespace Controllers;
use Models\TransaksiModel;
use Models\Database;
use PDO;

class TransaksiController {

    private PDO $conn;
    private TransaksiModel $laporanModel;

    public function __construct() {
        // Controller nggak nyentuh database sama sekali! Clean abis!
        $this->conn = (new Database())->getConnection();
        $this->laporanModel = new TransaksiModel($this->conn);
    }
public function index() {
        // 🔥 UPDATE DI SINI: Samakan default datenya dengan yang ada di View
        $filters = [
            'start'  => $_GET['start'] ?? date('Y-m-01'), // Default awal bulan
            'end'    => $_GET['end'] ?? date('Y-m-t'),    // Default akhir bulan
            'jenis'  => $_GET['jenis'] ?? '',
            'status' => $_GET['status'] ?? '',
            'rak'    => $_GET['rak'] ?? ''
        ];

        // Ambil data berdasarkan filter
        $dataLaporan = $this->laporanModel->getLaporanFlat($filters);

        require PAGES_PATH . 'laporan.php';
    }
}
?>