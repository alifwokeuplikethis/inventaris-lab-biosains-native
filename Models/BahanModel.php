<?php
namespace Models;

use PDO;

class BahanModel {

    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    /* ================= DASHBOARD ================= */
    public function getDashboardBahan() {
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
            GROUP BY b.id
            ORDER BY b.nama_bahan ASC
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* ================= INSERT ================= */

    public function insertBahan($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO bahan 
            (nama_bahan, merk, jenis, volume_per_botol, satuan, foto_bahan, rumus)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['nama_bahan'],
            $data['merk'],
            $data['jenis'],
            $data['volume_per_botol'],
            $data['satuan'],
            $data['foto_bahan'],
            $data['rumus']
        ]);

        return $this->conn->lastInsertId();
    }

    public function insertStok($data, $id_bahan) {
        $stmt = $this->conn->prepare("
            INSERT INTO stok 
            (id_bahan, tgl_kadaluarsa, tgl_penerimaan, volume, status, rak)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $id_bahan,
            $data['tgl_kadaluarsa'] ?? null,
            $data['tgl_penerimaan'] ?? null,
            $data['volume'] ?? null,
            $data['status'] ?? null,
            $data['rak'] ?? null
        ]);

        return $this->conn->lastInsertId();
    }



    // ========= INFORMASI BAHAN =============
    public function getStatusKadaluarsa()
    {
        $stmt = $this->conn->prepare("
            SELECT
                stok.*,
                bahan.nama_bahan,

                CASE
                    WHEN stok.tgl_kadaluarsa < CURDATE()
                        THEN 'expired'

                    WHEN stok.tgl_kadaluarsa <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                        THEN 'hampir kadaluarsa'

                    ELSE 'aman'
                END AS status_kadaluarsa

            FROM stok

            JOIN bahan
                ON bahan.id = stok.id_bahan

            WHERE stok.volume > 0

            ORDER BY stok.tgl_kadaluarsa ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDashboardStats() {

        $stmt = $this->conn->prepare("
            SELECT 
                b.id,
                b.volume_per_botol,
                COALESCE(SUM(s.volume), 0) as total_volume
            FROM bahan b
            LEFT JOIN stok s ON s.id_bahan = b.id
            GROUP BY b.id
        ");

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalBahan = count($data);
        $hampirHabis = 0;
        $habis = 0;

        foreach ($data as $b) {
            if ($b['total_volume'] == 0) {
                $habis++;
            } elseif ($b['total_volume'] < $b['volume_per_botol']) {
                $hampirHabis++;
            }
        }

        return [
            'total_bahan' => $totalBahan,
            'stok_hampir_habis' => $hampirHabis,
            'stok_habis' => $habis
        ];
    }

    public function getBahanInfo($id) {
        $stmt = $this->conn->prepare("SELECT * FROM bahan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getStokFEFO($id_bahan) {
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

    /* ================= REQUEST BAHAN ================= */
    // Fungsi untuk menampilkan ringkasan di tabel Dashboard
    public function getAllRequestsGrouped() {
        $stmt = $this->conn->prepare("
            SELECT 
                r.id_pengguna,
                p.nama, 
                r.status,
                COUNT(r.id) as jumlah_item,
                -- Menggabungkan nama bahan menjadi teks (misal: Alkohol, Aquades, Beaker)
                GROUP_CONCAT(b.nama_bahan SEPARATOR ', ') as daftar_bahan
            FROM request_bahan r
            JOIN pengguna p ON r.id_pengguna = p.id
            JOIN bahan b ON r.id_bahan = b.id
            WHERE r.status = 'pending'
            GROUP BY r.id_pengguna, r.status
            ORDER BY 
                CASE WHEN r.status = 'pending' THEN 0 ELSE 1 END, 
                MAX(r.id) DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
// Fungsi untuk melihat detail bahan apa saja yang diajukan 1 user
    public function getRequestDetailsByUser($id_pengguna) {
        $stmt = $this->conn->prepare("
            SELECT 
                r.id, r.total_volume, r.status, r.id_bahan,
                b.nama_bahan, b.satuan, b.jenis, b.foto_bahan,
                p.nama as nama_teknisi
            FROM request_bahan r
            JOIN bahan b ON r.id_bahan = b.id
            JOIN pengguna p ON r.id_pengguna = p.id
            WHERE r.id_pengguna = ? AND r.status = 'pending'
            ORDER BY 
                CASE WHEN r.status = 'pending' THEN 0 ELSE 1 END,
                r.id DESC
        ");
        $stmt->execute([$id_pengguna]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Fungsi untuk mengambil semua ID request milik 1 user yang masih pending
    public function getPendingRequestsByUser($id_pengguna) {
        $stmt = $this->conn->prepare("SELECT * FROM request_bahan WHERE id_pengguna = ? AND status = 'pending'");
        $stmt->execute([$id_pengguna]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRequestById($id_request) {
        $stmt = $this->conn->prepare("SELECT * FROM request_bahan WHERE id = ?");
        $stmt->execute([$id_request]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRequestStatus($id_request, $status) {
        $stmt = $this->conn->prepare("
            UPDATE request_bahan 
            SET status = ?
            WHERE id = ?
        ");
        return $stmt->execute([$status, $id_request]);
    }

    public function insertRequestBahan($id_bahan, $id_pengguna, $total_volume) {
        // id_transaksi tidak dimasukkan karena status masih pending (belum ada transaksi fisik)
        $stmt = $this->conn->prepare("
            INSERT INTO request_bahan (id_bahan, id_pengguna, total_volume, status) 
            VALUES (?, ?, ?, 'pending')
        ");
        
        return $stmt->execute([$id_bahan, $id_pengguna, $total_volume]);
    }

    // DI DALAM BAHAN MODEL
    public function rejectAllPendingByUser($id_pengguna) {
        $stmt = $this->conn->prepare("UPDATE request_bahan SET status = 'ditolak' WHERE id_pengguna = ? AND status = 'pending'");
        return $stmt->execute([$id_pengguna]);
    }
}