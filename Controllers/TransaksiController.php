<?php
namespace Controllers;
use Models\TransaksiModel;
use Models\Database;
use PDO;

class TransaksiController {

    private PDO $conn;
    private TransaksiModel $laporanService;

    public function __construct() {
        // Controller nggak nyentuh database sama sekali! Clean abis!
        $this->conn = (new Database())->getConnection();
        $this->laporanModel = new TransaksiModel($this->conn);
    }
public function index() {
        // Ambil semua parameter filter dari URL
        $filters = [
            'start'  => $_GET['start'] ?? '',
            'end'    => $_GET['end'] ?? '',
            'jenis'  => $_GET['jenis'] ?? '',
            'status' => $_GET['status'] ?? '',
            'rak'    => $_GET['rak'] ?? ''
        ];

        // Ambil data flat
        $dataLaporan = $this->laporanModel->getLaporanFlat($filters);

        require PAGES_PATH . 'laporan.php';
    }
}
?>