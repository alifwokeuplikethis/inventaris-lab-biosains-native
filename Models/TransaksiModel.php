<?php
namespace Models;
use Models\Database;

use PDO;
use Exception;

class TransaksiModel{
    private PDO $conn;

    public function __construct(PDO $db){
        $this->conn = $db;
    }

    public function insertTransaksi($userId, $tgl, $volume) {
        $stmt = $this->conn->prepare("
            INSERT INTO transaksi 
            (id_pengguna, tgl_transaksi, total_volume)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([$userId, $tgl, $volume]);

        return $this->conn->lastInsertId();
    }

    public function insertDetailTransaksi($trxId, $stokId, $volume, $status) {
        $stmt = $this->conn->prepare("
            INSERT INTO detail_transaksi 
            (id_transaksi, id_stok, volume, status_transaksi)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$trxId, $stokId, $volume, $status]);
    }

    public function getLaporanFlat($filters = []) {
        $sql = "
            SELECT 
                t.id AS id_transaksi, 
                t.tgl_transaksi, 
                b.nama_bahan, 
                b.jenis,
                b.satuan,
                dt.volume AS volume_item,
                dt.status_transaksi,
                s.rak
            FROM detail_transaksi dt
            JOIN transaksi t ON dt.id_transaksi = t.id
            JOIN stok s ON dt.id_stok = s.id
            JOIN bahan b ON s.id_bahan = b.id
            WHERE 1=1
        ";

        $params = [];

        // Filter Tanggal
        if (!empty($filters['start']) && !empty($filters['end'])) {
            $sql .= " AND t.tgl_transaksi BETWEEN ? AND ?";
            $params[] = $filters['start'];
            $params[] = $filters['end'];
        }

        // Filter Jenis Bahan (Padat/Cair/Gas)
        if (!empty($filters['jenis'])) {
            $sql .= " AND b.jenis = ?";
            $params[] = $filters['jenis'];
        }

        // Filter Status Transaksi (Masuk/Keluar)
        // Catatan: di form lu valuenya "masuk" & "keluar", kita konversi ke DB "nambah" & "pakai"
        if (!empty($filters['status'])) {
            $statusDb = ($filters['status'] == 'masuk') ? 'nambah' : 'pakai';
            $sql .= " AND dt.status_transaksi = ?";
            $params[] = $statusDb;
        }

        // Filter Rak
        if (!empty($filters['rak'])) {
            $sql .= " AND s.rak = ?";
            $params[] = $filters['rak'];
        }

        $sql .= " ORDER BY t.tgl_transaksi DESC, dt.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}?>