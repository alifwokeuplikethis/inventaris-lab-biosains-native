<?php
namespace Models;
use Models\Database;
use PDO;
use Exception;

class TeknisiModel {
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
        if (!$this->conn) {
            die("DATABASE GAGAL CONNECT");
        }
    }

    // Mengambil semua data pengguna dengan peran 'teknisi'
    public function getAllTeknisi() {
        $stmt = $this->conn->prepare("SELECT * FROM pengguna WHERE peran = 'teknisi' ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengubah status pendaftaran (Pending -> Disetujui/Ditolak) sekaligus set is_aktif
    public function updateStatusPendaftaran($id, $status_pendaftaran, $is_aktif) {
        $stmt = $this->conn->prepare("UPDATE pengguna SET status_pendaftaran = ?, is_aktif = ? WHERE id = ? AND peran = 'teknisi'");
        return $stmt->execute([$status_pendaftaran, $is_aktif, $id]);
    }

    // Mengubah status operasional (Aktif/Nonaktif) untuk akun yang sudah disetujui
    public function updateKeaktifan($id, $is_aktif) {
        $stmt = $this->conn->prepare("UPDATE pengguna SET is_aktif = ? WHERE id = ? AND peran = 'teknisi'");
        return $stmt->execute([$is_aktif, $id]);
    }

    // Menghapus akun (opsional untuk tombol tong sampah)
    public function deleteTeknisi($id) {
        $stmt = $this->conn->prepare("DELETE FROM pengguna WHERE id = ? AND peran = 'teknisi'");
        return $stmt->execute([$id]);
    }
}