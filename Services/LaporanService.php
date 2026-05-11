<?php
namespace Services;

use Models\TransaksiModel;
use Models\Database;
use PDO;

class LaporanService {

    private TransaksiModel $TransaksiModel;
    private PDO $conn;

    public function __construct() {
        // Buka pipa 1 kali di Service
        $this->conn = (new Database())->getConnection();
        $this->TransaksiModel = new TransaksiModel($this->conn);
    }

    public function getLaporanGrouped($tglAwal = null, $tglAkhir = null) {
        $dataMentah = $this->TransaksiModel->getLaporanMentah($tglAwal, $tglAkhir);

        $hasilGroup = [];

        foreach ($dataMentah as $row) {
            $idTrx = $row['id_transaksi'];

            // 1. Bikin wadah Induk (Transaksi)
            if (!isset($hasilGroup[$idTrx])) {
                $hasilGroup[$idTrx] = [
                    'id_transaksi'   => $row['id_transaksi'],
                    'tgl_transaksi'  => $row['tgl_transaksi'],
                    'nama_pengguna'  => $row['nama_pengguna'],
                    'total_volume'   => $row['total_volume_induk'],
                    'detail_barang'  => [] 
                ];
            }

            // 2. Masukkan rincian barang (Detail Transaksi)
            $hasilGroup[$idTrx]['detail_barang'][] = [
                'nama_bahan'       => $row['nama_bahan'],
                'volume_item'      => $row['volume_item'],    
                'satuan'           => $row['satuan'],
                'rak'              => $row['rak'],
                'status_transaksi' => $row['status_transaksi']  
            ];
        }

        return $hasilGroup;
    }
}