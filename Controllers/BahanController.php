<?php
namespace Controllers;

use Models\BahanModel;
use Models\TransaksiModel;
use Models\Database;
use Exception;

class BahanController {

    private BahanModel $BahanModel;
    private TransaksiModel $TransaksiModel;
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
        $this->BahanModel = new BahanModel($this->conn);
        $this->TransaksiModel = new TransaksiModel($this->conn);
    }

    /* ================= DASHBOARD ================= */
    public function dashboard() {
        $stats = $this->BahanModel->getDashboardStats();
        $data = $this->BahanModel->getDashboardBahan();
        require PAGES_PATH . 'dashboard.php';
    }

    /* ================= INSERT BAHAN ================= */
    public function insert_bahan() {

        try {
            $this->conn->beginTransaction();

            // 1. DATA BAHAN
            $dataBahan = $_POST;

            // upload gambar
            $dataBahan['foto_bahan'] = null;
            if (!empty($_FILES['foto_bahan']['name'])) {
                $targetDir = BASE_PATH . "/images/uploads/";
                $fileName = time() . '_' . uniqid() . '.' . pathinfo($_FILES['foto_bahan']['name'], PATHINFO_EXTENSION);

                move_uploaded_file($_FILES['foto_bahan']['tmp_name'], $targetDir . $fileName);
                $dataBahan['foto_bahan'] = $fileName;
            }

            $id_bahan = $this->BahanModel->insertBahan($dataBahan);

            // 2. STOK
            $volume = $_POST['qty'] * $_POST['volume_per_botol'];

            $stokId = $this->BahanModel->insertStok([
                'tgl_penerimaan' => $_POST['tgl_penerimaan'],
                'tgl_kadaluarsa' => $_POST['tgl_kadaluarsa'],
                'volume' => $volume,
                'status' => 'gudang',
                'rak' => $_POST['rak']
            ], $id_bahan);

            // 3. TRANSAKSI
            $trxId = $this->TransaksiModel->insertTransaksi(
                $_SESSION['user']['id_normal'],
                date('Y-m-d'),
                $volume
            );

            $this->TransaksiModel->insertDetailTransaksi($trxId, $stokId, $volume, 'nambah');

            $this->conn->commit();
            $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'SUkes!',
            'text' => 'Data berhasil disimpan!',
            'timer' => 5000
            ];
            
            header("Location: ?action=dashboard");
            exit;

        } catch (Exception $e) {
            $this->conn->rollBack();
            die($e->getMessage());
        }
    }
}