<?php
namespace Services;

use Models\BahanModel;
use PDO;
use Exception;

class StokService {

    private BahanModel $model;
    private PDO $conn;

    public function __construct(BahanModel $model, PDO $conn) {
        $this->model = $model;
        $this->conn = $conn;
    }

    /* ================= TAMBAH STOK ================= */
    public function tambahStok($id_bahan, $dataBahan, $volume, $userId) {

        $this->conn->beginTransaction();

        try {
            // 1. insert stok
            $stokId = $this->model->insertStok([
                'tgl_penerimaan' => $dataBahan['tgl_penerimaan'],
                'tgl_kadaluarsa' => $dataBahan['tgl_kadaluarsa'],
                'volume' => $volume,
                'status' => 'gudang',
                'rak' => $dataBahan['rak']
            ], $id_bahan);

            // 2. transaksi
            $trxId = $this->model->insertTransaksi(
                $userId,
                date('Y-m-d'),
                $volume
            );

            $this->model->insertDetailTransaksi(
                $trxId,
                $stokId,
                $volume,
                'nambah'
            );

            $this->conn->commit();
            return true;

        } catch (\Throwable $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    /* ================= KURANGI STOK (FEFO FULL LOGIC) ================= */
        public function kurangiStok($id_bahan, $jumlahKeluar, $volumePerBotol, $userId) {

            if ($jumlahKeluar <= 0) {
                throw new Exception("Jumlah tidak valid");
            }

            $this->conn->beginTransaction();

            try {
                $stokList = $this->model->getStokFEFO($id_bahan);

                if (!$stokList) {
                    throw new Exception("Stok kosong");
                }

                $sisa = $jumlahKeluar;
                $tgl = date('Y-m-d');

                $trxId = $this->model->insertTransaksi($userId, $tgl, $jumlahKeluar);

                $stmt = $this->conn->prepare("
                    UPDATE stok SET volume = ?, status = ? WHERE id = ?
                ");

                // 🔥 TAMBAHAN: tracking rak yang dipakai
                $rakDipakai = [];

                foreach ($stokList as $stok) {

                    if ($sisa <= 0) break;

                    $current = (float)$stok['volume'];
                    if ($current <= 0) continue;

                    $ambil = min($current, $sisa);
                    $remaining = $current - $ambil;

                    // 🔥 catat rak
                    $rakDipakai[] = [
                        'rak' => $stok['rak'],
                        'stok_id' => $stok['id'],
                        'jumlah' => $ambil
                    ];

                    if ($remaining <= 0) {
                        $stmt->execute([0, 'habis', $stok['id']]);
                    } else {

                        if ($volumePerBotol > 0) {

                            $botolUtuh = floor($remaining / $volumePerBotol);
                            $eceran = fmod($remaining, $volumePerBotol);

                            if ($eceran == 0) {
                                $stmt->execute([$remaining, 'gudang', $stok['id']]);
                            } else {

                                if ($botolUtuh > 0) {

                                    $volumeGudang = $botolUtuh * $volumePerBotol;

                                    $stmt->execute([$volumeGudang, 'gudang', $stok['id']]);

                                    $this->model->insertStok([
                                        'tgl_penerimaan' => $stok['tgl_penerimaan'],
                                        'tgl_kadaluarsa' => $stok['tgl_kadaluarsa'],
                                        'volume' => $eceran,
                                        'status' => 'sisa',
                                        'rak' => $stok['rak']
                                    ], $id_bahan);

                                } else {
                                    $stmt->execute([$remaining, 'sisa', $stok['id']]);
                                }
                            }

                        } else {
                            $stmt->execute([$remaining, 'gudang', $stok['id']]);
                        }
                    }

                    $this->model->insertDetailTransaksi(
                        $trxId,
                        $stok['id'],
                        $ambil,
                        'pakai'
                    );

                    $sisa -= $ambil;
                }

                if ($sisa > 0) {
                    throw new Exception("Stok tidak cukup");
                }

                $this->conn->commit();

                // 🔥 RETURN LEBIH KAYA
                return [
                    'success' => true,
                    'trx_id' => $trxId,
                    'rak_dipakai' => $rakDipakai
                ];

            } catch (\Throwable $e) {
                $this->conn->rollBack();
                throw $e;
            }
        }

    
    public function previewKurangiStok($id_bahan, $jumlah) {

        $stokList = $this->model->getStokFEFO($id_bahan);

        $sisa = $jumlah;
        $hasil = [];

        foreach ($stokList as $stok) {
            if ($sisa <= 0) break;

            $ambil = min($stok['volume'], $sisa);

            $hasil[] = [
                'id_stok' => $stok['id'],
                'rak' => $stok['rak'],
                'diambil' => $ambil,
                'tgl_kadaluarsa' => $stok['tgl_kadaluarsa']
            ];

            $sisa -= $ambil;
        }

        return $hasil;
    }

}