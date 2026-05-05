<?php
namespace Controllers;
use Models\BahanModel;
use Models\Database;
use PDO;

class BahanController{
    private BahanModel $model;
    private PDO $conn;
    public function __construct(){
        $this->model = (new BahanModel());
        $this->conn = (new Database())->getConnection();
    }

    public function dashboard(){
        $data = $this->model->getDashboardBahan();

        require PAGES_PATH . 'dashboard.php';
    }
    
    public function insert_bahan(){
        $this->conn->beginTransaction();
        try {
        // ================insert data bahan only ==============
        $dataBahan = [
            'nama_bahan' => $_POST['nama_bahan'] ?? null,
            'rumus' => $_POST['rumus'] ?? null,
            'merk' => $_POST['merk'] ?? null,
            'satuan' => $_POST['satuan'] ?? null,
            'jenis' => $_POST['jenis'] ?? null,
            'volume_per_botol' => $_POST['volume_per_botol'] ?? null,
            'foto_bahan' => null
        ];

        // ================= UPLOAD FOTO =================
        if (!empty($_FILES['foto_bahan']['name'])) {
            $targetDir = "./images/uploads/";
            $fileName = time() . "_" . $_FILES['foto_bahan']['name'];
            $targetFile = $targetDir . $fileName;

            move_uploaded_file($_FILES['foto_bahan']['tmp_name'], $targetFile);
            $dataBahan['foto_bahan'] = $fileName;
        }
        // =================================================
        $id_bahan = $this->model->insertBahan($dataBahan);



        // =================insert data stok (opsional)===================

        $rak = $_POST['rak'] ?? null;
        $tgl_penerimaan = $_POST['tgl_penerimaan'] ?? null;
        $tgl_kadaluarsa = $_POST['tgl_kadaluarsa'] ?? null;
        $qty = $_POST['qty'] ?? null;
        $id_pengguna = $_SESSION['user']['id_normal'];
        $volume_per_botol = $_POST['volume_per_botol'];

        $volume = ($qty !== null && $volume_per_botol !== null) ? $qty * $volume_per_botol : null;
        $dataStok = null;

        if ($volume !== null) {
            $dataStok = [
                'id_bahan' => $id_bahan,
                'rak' => $rak,
                'tgl_penerimaan' => $tgl_penerimaan,
                'tgl_kadaluarsa' => $tgl_kadaluarsa,
                'volume' => $volume,
                'status' => 'gudang'
            ];
        }

        $id_stok = $this->model->insertBahanStok($dataStok, $id_bahan);

        // ========================================
        
        $tgl_transaksi = date('Y-m-d');
        // ======== insert transaksi ============
        $id_transaksi = $this->model->insertTransaksi($id_pengguna, $tgl_transaksi, $volume);
        // =======================================

        // ================= insert detail transaksi ================
        $this->model->insertDetailTransaksi($id_transaksi, $id_stok, $volume, "nambah");


        $_SESSION['success'] = "berhasil menambah data bahan" . $dataBahan['nama_bahan'];

        header("Location: ?action=dashboard");
        exit;

    } catch (Exception $e) {
        // response error
        $this->conn->rollBack();
        http_response_code(400);
    }
    }
}
?>