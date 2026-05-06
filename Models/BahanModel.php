<?php
namespace Models;
use Models\Database;
use PDO;
use Exception;

class BahanModel{

    private PDO $conn;
    public function __construct(PDO $db){
        // $this->conn = (new Database())->getConnection();   
        $this->conn = $db; 
    }

    public function getDashboardBahan(){
    $stmt = $this->conn->prepare("
        SELECT 
            b.id,
            b.nama_bahan,
            b.satuan,
            b.jenis,
            b.volume_per_botol,
            b.foto_bahan,

            COALESCE(SUM(s.volume), 0) as total_volume,
            (COALESCE(SUM(s.volume), 0) / NULLIF(b.volume_per_botol, 0)) as qty

        FROM bahan b
        LEFT JOIN stok s ON s.id_bahan = b.id

        GROUP BY 
            b.id,
            b.nama_bahan,
            b.satuan,
            b.jenis,
            b.volume_per_botol,
            b.foto_bahan

        ORDER BY b.nama_bahan ASC
    ");

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getStokFIFO($id_bahan){
    $stmt = $this->conn->prepare("
        SELECT id, volume, tgl_kadaluarsa
        FROM stok
        WHERE id_bahan = ?
        ORDER BY tgl_kadaluarsa ASC
    ");
    $stmt->execute([$id_bahan]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getStokFEFO($id_bahan){
    // 🔥 UPDATE: Tambahkan tgl_penerimaan dan rak pada SELECT
    $stmt = $this->conn->prepare("
        SELECT id, volume, tgl_kadaluarsa, tgl_penerimaan, status, rak
        FROM stok
        WHERE id_bahan = ? AND volume > 0
        ORDER BY 
            CASE WHEN status = 'sisa' THEN 0 ELSE 1 END,
            tgl_kadaluarsa ASC
    ");
    $stmt->execute([$id_bahan]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getBahanInfo($id_bahan){
    $stmt = $this->conn->prepare("SELECT * FROM bahan WHERE id = ?");
    $stmt->execute([$id_bahan]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function insertBahan($dataBahan){
        if (!$this->conn) {
        die("Koneksi ke database hilang di Model!");
    }
        $stmt = $this->conn->prepare("
            INSERT INTO bahan 
            (nama_bahan, merk, jenis, volume_per_botol,  satuan, foto_bahan, rumus)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $dataBahan['nama_bahan'],
            $dataBahan['merk'],
            $dataBahan['jenis'],
            $dataBahan['volume_per_botol'],
            $dataBahan['satuan'],
            $dataBahan['foto_bahan'],
            $dataBahan['rumus']
        ]);

        return $this->conn->lastInsertId();
    }

    public function insertBahanStok($dataStok, $id_bahan){
        $stmt = $this->conn->prepare("
            INSERT INTO stok 
            (id_bahan, tgl_kadaluarsa, tgl_penerimaan, volume, status, rak)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $id_bahan,
            $dataStok['tgl_kadaluarsa'] ?? null,
            $dataStok['tgl_penerimaan'] ?? null,
            $dataStok['volume'] ?? null,
            $dataStok['status'] ?? null,
            $dataStok['rak'] ?? null
        ]);
        return $this->conn->lastInsertId();
    }


    // ======== detail transaksi =============
    public function insertTransaksi($id_pengguna, $tgl_transaksi, $total_volume){
        $stmt = $this->conn->prepare("
            INSERT INTO transaksi 
            (id_pengguna, tgl_transaksi, total_volume)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $id_pengguna,
            $tgl_transaksi,
            $total_volume
        ]);
        return $this->conn->lastInsertId();
    }

    public function insertDetailTransaksi($id_transaksi, $id_stok, $volume, $status_transaksi){
        $stmt = $this->conn->prepare("
            INSERT INTO detail_transaksi 
            (id_transaksi, id_stok, volume, status_transaksi)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $id_transaksi,
            $id_stok,
            $volume,
            $status_transaksi
        ]);
        
    }
    // ================================================
    
}
?>