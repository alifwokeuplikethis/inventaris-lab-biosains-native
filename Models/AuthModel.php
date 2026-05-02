<?php
namespace Models;
use Models\Database;
use PDO;
use Exception;

class AuthModel{
    public function __construct(){
        $this->conn = (new Database())->getConnection();
            if (!$this->conn) {
        die("DATABASE GAGAL CONNECT");
    }
    }

    public function cekEmail($email){
        $stmt = $this->conn->prepare("SELECT * FROM detail_pengguna WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cekInfo($google_id){
        $stmt = $this->conn->prepare('SELECT * FROM detail_pengguna WHERE google_id = ?');
        $stmt->execute([$google_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertEmail($email){
    try {
        $this->conn->beginTransaction();

        $stmt1 = $this->conn->prepare("INSERT INTO detail_pengguna(email, status) VALUES(?, ?)");
        $stmt1->execute([$email, "pending"]);

        $id_detail = $this->conn->lastInsertId();

        $stmt2 = $this->conn->prepare("INSERT INTO pengguna(id_detail_pengguna) VALUES(?)");
        $stmt2->execute([$id_detail]);

        $this->conn->commit();

    } catch(Exception $e){
        $this->conn->rollBack();
        throw new Exception($e->getMessage());
    }
}

    public function insertProfile($nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $peran, $email){
        try{
            $this->conn->beginTransaction();
            $data = $this->cekEmail($email);
            $stmt1 = $this->conn->prepare("UPDATE detail_pengguna SET nama = ?, no_telp = ?, foto_pengguna = ?, gender = ?, alamat = ?, google_id = ? WHERE email= ?");
            $stmt1->execute([$nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $email]);

            $stmt2 = $this->conn->prepare("UPDATE pengguna SET peran = ? WHERE id_detail_pengguna = ?");
            $stmt2->execute([$peran, $data['id']]);
            $this->conn->commit();
        } catch(Exception $e){
            $this->conn->rollBack();
            throw new Exception($e->getMessage());
        }
    }

}
?>