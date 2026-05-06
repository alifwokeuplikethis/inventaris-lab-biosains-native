<?php
namespace Controllers;
use Models\BahanModel;
use Models\Database;
use PDO;
use Exception;

class BahanController{
    private BahanModel $model;
    private PDO $conn;
    public function __construct(){
$this->conn = (new Database())->getConnection();
        
        // 2. Oper koneksi tersebut ke dalam model
        $this->model = new BahanModel($this->conn);
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
            $targetDir = BASE_PATH . "/images/uploads/";
            $originalName = $_FILES['foto_bahan']['name'];
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

            // nama aman (tanpa karakter aneh)
            $fileName = time() . '_' . uniqid() . '.' . $extension;
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


        $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Success',
        'text' => 'Data ' . $dataBahan['nama_bahan'] . ' berhasil disimpan',
        'timer' => 3000
        ];
        $this->conn->commit();
        header("Location: ?action=dashboard");
        exit;

    } catch (Exception $e) {
        // response error
        $this->conn->rollBack();
        http_response_code(400);
    }
    }

    public function transaksiStok(){
        $id_bahan = $_GET['id_bahan'];
        $data = $this->model->getDashboardBahan();
        $infoBahan = $this->model->getBahanInfo($id_bahan);
        require PAGES_PATH . 'transaksi_stok.php';
    }

    public function prosesStok(){
        $aksi = $_POST['aksi'];
        $id_pengguna = $_SESSION['user']['id_normal'];

        if($aksi === 'tambah'){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id_bahan = $_GET['id_bahan'] ?? null;
                $infoBahan = $this->model->getBahanInfo($id_bahan);
                $dataBahan = [
                'volume' => $_POST['qty'] * $infoBahan['volume_per_botol'],
                'tgl_penerimaan' => $_POST['tgl_penerimaan'] ?? null,
                'tgl_kadaluarsa' => $_POST['tgl_kadaluarsa'] ?? null,
                'rak' => $_POST['rak'] ?? null,
                'status' => 'gudang'
            ];
                $infoBahan = $this->model->getBahanInfo($id_bahan);


                $result = $this->model->insertBahanStok($dataBahan, $id_bahan);
                        // ======== insert transaksi ============
                $id_transaksi = $this->model->insertTransaksi($id_pengguna, $dataBahan['tgl_penerimaan'], $dataBahan['volume']);
                // =======================================

                // ================= insert detail transaksi ================
                $this->model->insertDetailTransaksi($id_transaksi, $result, $dataBahan['volume'], "nambah");

                if($result){
                    $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => 'Data ' . $infoBahan['nama_bahan'] . ' berhasil disimpan',
                    'timer' => 3000
                    ];
                    header("Location: ?action=dashboard");
                    exit;
                } else {
                    echo "Gagal menyimpan stok";
                }
            }
        } else {
            // ================= KURANGI =================
if ($aksi === 'kurangi') {

    $this->conn->beginTransaction();

    try {
        $total_volume = (float) ($_POST['jumlah_keluar'] ?? 0);
        $id_bahan = $_GET['id_bahan'] ?? 0;

        if ($total_volume <= 0) {
            throw new Exception("Jumlah keluar tidak valid");
        }

        $info = $this->model->getBahanInfo($id_bahan);
        $volume_per_botol = (float) $info['volume_per_botol'];

        $stokList = $this->model->getStokFEFO($id_bahan);

        if (!$stokList) {
            throw new Exception("Stok kosong");
        }

        $sisa = $total_volume;
        $tgl = date('Y-m-d');

        $id_transaksi = $this->model->insertTransaksi(
            $id_pengguna,
            $tgl,
            $total_volume
        );

        $stmtUpdate = $this->conn->prepare("
            UPDATE stok 
            SET volume = ?, status = ?
            WHERE id = ?
        ");

        foreach ($stokList as $stok) {

            if ($sisa <= 0) break;

            $current = (float) $stok['volume'];
            if ($current <= 0) continue;

            $ambil = min($current, $sisa);
            $remaining = $current - $ambil;

            // 🔥 LOGIKA SPLIT RECORD UNTUK SISA BOTOL TERBUKA
            if ($remaining <= 0) {
                // Stok pada batch ini benar-benar habis
                $stmtUpdate->execute([0, 'habis', $stok['id']]);
                
            } else {
                // Cegah division by zero jika volume_per_botol tidak diatur
                if ($volume_per_botol > 0) {
                    $jumlah_botol_utuh = floor($remaining / $volume_per_botol);
                    $volume_sisa_eceran = fmod($remaining, $volume_per_botol); 

                    if ($volume_sisa_eceran == 0) {
                        // Sisa pas berupa botol utuh (misal sisa 50, per botol 10)
                        $stmtUpdate->execute([$remaining, 'gudang', $stok['id']]);
                        
                    } else {
                        if ($jumlah_botol_utuh > 0) {
                            // SPLIT RECORD: Ada botol utuh dan ada eceran (botol terbuka)
                            $volume_gudang = $jumlah_botol_utuh * $volume_per_botol;
                            
                            // 1. Update record saat ini menjadi botol utuh ('gudang')
                            $stmtUpdate->execute([$volume_gudang, 'gudang', $stok['id']]);
                            
                            // 2. Buat record baru khusus untuk eceran/botol terbuka ('sisa')
                            $dataSisa = [
                                'volume' => $volume_sisa_eceran,
                                'tgl_penerimaan' => $stok['tgl_penerimaan'], // dari fetch update
                                'tgl_kadaluarsa' => $stok['tgl_kadaluarsa'],
                                'rak' => $stok['rak'],                       // dari fetch update
                                'status' => 'sisa'
                            ];
                            $this->model->insertBahanStok($dataSisa, $id_bahan);
                            
                        } else {
                            // Hanya sisa eceran (volume total sudah kurang dari 1 botol utuh)
                            $stmtUpdate->execute([$remaining, 'sisa', $stok['id']]);
                        }
                    }
                } else {
                    // Fallback jika database tidak memiliki informasi volume_per_botol
                    $stmtUpdate->execute([$remaining, 'gudang', $stok['id']]);
                }
            }

            // Insert detail transaksi
            $this->model->insertDetailTransaksi(
                $id_transaksi,
                $stok['id'],
                $ambil,
                'pakai'
            );

            $sisa -= $ambil;
        }

        if ($sisa > 0) {
            throw new Exception("Stok fisik di database tidak mencukupi untuk dikeluarkan sejumlah tersebut.");
        }

        $this->conn->commit();

        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Stok berhasil dikurangi',
            'timer' => 3000
        ];

        header("Location: ?action=dashboard");
        exit;

    } catch (\Throwable $e) { // <-- Ganti Exception menjadi \Throwable
    $this->conn->rollBack();
    die("Sistem Error: " . $e->getMessage());
}
}
        }
        
    }

    
}
?>