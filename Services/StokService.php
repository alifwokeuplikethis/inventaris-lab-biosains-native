<?php
namespace Services;

use Models\BahanModel;
use Models\TransaksiModel;
use Models\Database;
use PDO;
use Exception;

class StokService {

    private BahanModel $BahanModel;
    private TransaksiModel $TransaksiModel;
    private PDO $conn;

    public function __construct(PDO $db) { // Terima koneksi di sini
        $this->conn = $db; 
        $this->BahanModel = new BahanModel($this->conn);
        $this->TransaksiModel = new TransaksiModel($this->conn);
    }

    /* ================= TAMBAH STOK ================= */
    public function tambahStok($id_bahan, $dataBahan, $volume, $userId) {

        $this->conn->beginTransaction();

        try {
            // 1. insert stok
            $stokId = $this->BahanModel->insertStok([
                'tgl_penerimaan' => $dataBahan['tgl_penerimaan'],
                'tgl_kadaluarsa' => $dataBahan['tgl_kadaluarsa'],
                'volume' => $volume,
                'status' => 'gudang',
                'rak' => $dataBahan['rak']
            ], $id_bahan);

            // 2. transaksi
            $trxId = $this->TransaksiModel->insertTransaksi(
                $userId,
                date('Y-m-d'),
                $volume
            );
            $this->TransaksiModel->insertDetailTransaksi(
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
        // 🔥 TAMBAHKAN $trxId = null DI UJUNG PARAMETER
    public function kurangiStok($id_bahan, $jumlahKeluar, $volumePerBotol, $userId, $trxId = null) {

        if ($jumlahKeluar <= 0) {
            throw new Exception("Jumlah tidak valid");
        }

        // 🔥 LOGIKA CERDAS: Cek siapa yang mulai transaksi
        $isCreator = false; 
        if ($trxId === null) {
            $this->conn->beginTransaction();
            $isCreator = true; // Tandai bahwa fungsi ini jalan mandiri
        }

        try {
            $stokList = $this->BahanModel->getStokFEFO($id_bahan);
            if (!$stokList) {
                throw new Exception("Stok kosong");
            }

            $sisa = $jumlahKeluar;
            $tgl = date('Y-m-d');

            // 🔥 Jika $trxId kosong, buat Transaksi Baru (Cara Lama)
            // Jika $trxId ada isinya (dari Batch), JANGAN bikin transaksi baru!
            if ($trxId === null) {
                // Asumsi cara lamamu butuh jumlahKeluar
                $trxId = $this->TransaksiModel->insertTransaksi($userId, $tgl, $jumlahKeluar);
            }

            $stmt = $this->conn->prepare("UPDATE stok SET volume = ?, status = ? WHERE id = ?");
            $rakDipakai = [];

            foreach ($stokList as $stok) {
                if ($sisa <= 0) break;

                $current = (float)$stok['volume'];
                if ($current <= 0) continue;

                $ambil = min($current, $sisa);
                $remaining = $current - $ambil;

                $rakDipakai[] = [ 'rak' => $stok['rak'], 'stok_id' => $stok['id'], 'jumlah' => $ambil ];

                // --- LOGIKA PECAHAN BOTOL / ECERAN KAMU TETAP SAMA PERSIS ---
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
                                $this->BahanModel->insertStok([
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
                // --------------------------------------------------------

                // Pasti menggunakan $trxId yang sama, entah dari parameter atau bikinan baru
                $this->TransaksiModel->insertDetailTransaksi($trxId, $stok['id'], $ambil, 'pakai');

                $sisa -= $ambil;
            }

            if ($sisa > 0) {
                throw new Exception("Stok tidak cukup");
            }

            // 🔥 Jika fungsi ini yang mulai, dia juga yang commit
            if ($isCreator) {
                $this->conn->commit();
            }

            return [
                'success' => true,
                'trx_id' => $trxId,
                'rak_dipakai' => $rakDipakai
            ];

        } catch (\Throwable $e) {
            // 🔥 Jika error dan dia yang mulai, dia yang rollback
            if ($isCreator) {
                $this->conn->rollBack();
            }
            throw $e;
        }
    }

    
    public function previewKurangiStok($id_bahan, $jumlah) {

        $stokList = $this->BahanModel->getStokFEFO($id_bahan);

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

    /* ================= PERSETUJUAN REQUEST ================= */
    public function approveRequest($requestData, $adminId, $trxIdMaster = null) {
    try {
        // 1. Ambil ID Request yang benar dari array (biasanya 'id')
        $id_request = $requestData['id']; 

        // 2. Ambil data request menggunakan ID Request, BUKAN id_bahan
        $request = $this->BahanModel->getRequestById($id_request); 
        
        // Cek apakah data request benar-benar ada
        if (!$request || $request['status'] !== 'pending') {
            throw new Exception("Request ID $id_request tidak ditemukan atau sudah diproses.");
        }

        // 3. Ambil info bahan (id_bahan diambil dari hasil query $request di atas)
        $id_bahan = $request['id_bahan'];
        $infoBahan = $this->BahanModel->getBahanInfo($id_bahan);

        // 4. Jalankan pengurangan stok
        $result = $this->kurangiStok(
            $id_bahan,
            $request['total_volume'], // Ambil volume dari data database yang valid
            $infoBahan['volume_per_botol'],
            $request['id_pengguna'], 
            $trxIdMaster
        );

        // 5. Update status
        $this->BahanModel->updateRequestStatus($id_request, 'disetujui');
        
        return $result;

    } catch (\Throwable $e) {
        throw $e;
    }
}

    public function rejectRequest($id_request) {
        return $this->BahanModel->updateRequestStatus($id_request, 'ditolak');
    }

}