<?php
namespace Models;
use Models\Database;
use PDO;
use Exception;

class AuthModel {
    private PDO $conn;

    public function __construct(){
        $this->conn = (new Database())->getConnection();
        if (!$this->conn) {
            die("DATABASE GAGAL CONNECT");
        }
    }

    public function cekEmail($email){
        // Ubah query ke tabel pengguna
        $stmt = $this->conn->prepare("SELECT * FROM pengguna WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cekInfo($google_id){
        // Ubah query ke tabel pengguna
        $stmt = $this->conn->prepare('SELECT * FROM pengguna WHERE google_id = ?');
        $stmt->execute([$google_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertEmail($email){
        try {
            // Cukup 1 query ke tabel pengguna. Default: status pending, is_aktif 0 (nonaktif)
            $stmt = $this->conn->prepare("INSERT INTO pengguna(email, status_pendaftaran, peran, is_aktif) VALUES(?, ?, ?, ?)");
            $stmt->execute([$email, "pending", "teknisi", 0]);
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function insertProfile($nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $peran, $email){
        try {
            // Cukup 1 query UPDATE ke tabel pengguna
            $stmt = $this->conn->prepare("UPDATE pengguna SET nama = ?, no_telp = ?, foto_pengguna = ?, gender = ?, alamat = ?, google_id = ?, peran = ? WHERE email = ?");
            $stmt->execute([$nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $peran, $email]);
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
?>