<?php
namespace Services;

use Models\TeknisiModel;

class TeknisiService {
    private TeknisiModel $model;

    public function __construct() {
        $this->model = new TeknisiModel();
    }

    // Menghitung data untuk ditampilkan di Pill Widget (Total, Aktif, Nonaktif, Pending)
    public function getStatistikDashboard() {
        $data = $this->model->getAllTeknisi();
        
        $stats = [
            'total' => count($data),
            'aktif' => 0,
            'nonaktif' => 0,
            'pending' => 0,
            'ditolak' => 0
        ];

        foreach ($data as $row) {
            if ($row['status_pendaftaran'] == 'pending') {
                $stats['pending']++;
            } elseif ($row['status_pendaftaran'] == 'ditolak') {
                $stats['ditolak']++;
            } elseif ($row['status_pendaftaran'] == 'disetujui') {
                // Jika sudah disetujui, baru kita cek dia sedang aktif atau nonaktif bekerja
                if ($row['is_aktif'] == 1) {
                    $stats['aktif']++;
                } else {
                    $stats['nonaktif']++;
                }
            }
        }

        return $stats;
    }

    // Logika menyetujui akun: status jadi 'disetujui', dan langsung 'aktif' (1)
    public function setujuiAkun($id) {
        return $this->model->updateStatusPendaftaran($id, 'disetujui', 1);
    }

    // Logika menolak akun: status jadi 'ditolak', pastikan nonaktif (0)
    public function tolakAkun($id) {
        return $this->model->updateStatusPendaftaran($id, 'ditolak', 0);
    }

    // Logika membalik (toggle) status aktif -> nonaktif, atau nonaktif -> aktif
    public function toggleStatusOperasional($id, $status_saat_ini) {
        // Jika 1 jadikan 0, jika 0 jadikan 1
        $status_baru = ($status_saat_ini == 1) ? 0 : 1; 
        return $this->model->updateKeaktifan($id, $status_baru);
    }

    public function hapusAkun($id) {
        return $this->model->deleteTeknisi($id);
    }
}