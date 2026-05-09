<?php
namespace Controllers;
use Models\AuthModel;
use Services\GoogleOAuthProvider;
use Services\AuthManager;
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

class AuthController {
    private AuthManager $authManager;
    private AuthModel $model;

    public function __construct() {
        $googleProvider = new GoogleOAuthProvider(
            $_ENV['GOOGLE_CLIENT_ID'],
            $_ENV['GOOGLE_CLIENT_SECRET'],
            $_ENV['GOOGLE_REDIRECT_URI']
        );

        $this->authManager = new AuthManager($googleProvider);
        $this->model = new AuthModel();
    }

    public function login() {
        $url = $this->authManager->getLoginUrl();
        header("Location: " . $url);
        exit;
    }

    public function callback() {
        $code = $_GET['code'] ?? null;

        if (!$code) {
            echo "Code tidak ditemukan";
            return;
        }

        $result = $this->authManager->handleCallback($code);
        
        $data = $this->model->cekEmail($result['profile']['email']);
        $infoTech = $this->model->cekInfo($result['profile']['id']);
        
        if($data){
            // CEK STATUS PENDAFTARAN DULU
            if($data['status_pendaftaran'] == 'disetujui'){
                if($data['is_aktif'] == 0) {
                    $_SESSION['alert'] = [ // atau 'error' tergantung setup sweetalert Anda
                        'icon' => 'error',
                        'title' => 'Akun Nonaktif!',
                        'text' => 'Mohon maaf, akun Anda sedang dinonaktifkan oleh admin. Hubungi admin untuk info lebih lanjut.',
                        'timer' => 5000
                    ];
                    return header("Location: ?action=login_page");
                    exit;
                }
                // Jika sudah melengkapi info profil
                if($infoTech){

                    // Jika aktif dan disetujui -> BISA LOGIN
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user'] = $result['profile'];
                    $_SESSION['user']['id_normal'] = $data['id'];
                    $_SESSION['user']['peran'] = $data['peran'];
                    $_SESSION['alert'] = [
                        'icon' => 'success',
                        'title' => 'Login Berhasil',
                        'text' => 'Selamat datang sir ' . $_SESSION['user']['nama'],
                        'timer' => 3000
                    ];
                    return header("Location: ?pages=dashboard");
                    exit;

                } else {
                    // Jika disetujui TAPI belum isi biodata
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user'] = $result['profile'];
                    $_SESSION['user']['id_normal'] = $data['id'];
                    $_SESSION['user']['peran'] = "teknisi";
                    $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Selamat, akun anda disetujui!',
                    'text' => 'Tolong masukkan biodata anda',
                    'timer' => 5000
                    ];
                    return header("Location: ?action=post_login");
                    exit;
                }

            } elseif($data['status_pendaftaran'] == 'pending'){
                $_SESSION['alert'] = [
                    'icon' => 'warning',
                    'title' => 'Akun anda masih belum disetujui admin!',
                    'text' => 'Yang sabar ya',
                    'timer' => 5000
                    ];
                return header("Location: ?action=login_page");
                exit;

            } else { // Jika Ditolak
                $_SESSION['error'] = [
                    'icon' => 'warning',
                    'title' => 'WADUH!',
                    'text' => 'akunnya ditolak XD',
                    'timer' => 5000
                    ];
                return header("Location: ?action=login_page");
                exit;
            }

        } else {
            $_SESSION['alert'] = [
                    'icon' => 'question',
                    'title' => 'Register terlebih dulu!',
                    'text' => 'register dulu ya',
                    'timer' => 5000
                    ];
                return header("Location: ?action=login_page");
            exit;
        }
    }



    public function register(){
        $email = $_POST['email'] ?? null;

        if (!$email) {
            $_SESSION['alert'] = [
                    'icon' => 'question',
                    'title' => 'kosonh!',
                    'text' => 'isi email dulu ya',
                    'timer' => 5000
                    ];
            header('Location: /inventory-revisi/?action=login_page');
            exit;
        }

        try {
            if ($this->model->cekEmail($email)) {
                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'udah we',
                    'text' => 'email udah terisi, selalu lihat status dengan login ya',
                    'timer' => 5000
                ];
            } else {
                $this->model->insertEmail($email);
                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'BERHASL!',
                    'text' => 'email sudah didaftarkan!',
                    'timer' => 5000
                ];
            }
        } catch (Exception $e) {
                $_SESSION['alert'] = [
                    'icon' => 'question',
                    'title' => 'kosonh!',
                    'text' => $e->getMessage(),
                    'timer' => 5000
                ];
        }

        header('Location: /inventory-revisi/?action=login_page');
        exit;
    }

    public function save_profile(){
        try{
            $nama = $_SESSION['user']['nama'] ?? null;
            $google_id = $_SESSION['user']['id'] ?? null;
            $alamat = $_POST['alamat'] ?? null;
            $gender = $_POST['gender'] ?? null;
            $foto_pengguna = $_SESSION['user']['foto_pengguna'] ?? null;
            $no_telp = $_POST['no_telp'] ?? null;
            $email = $_SESSION['user']['email'] ?? null;

            $peran = $_SESSION['user']['peran'];
            // Memanggil model baru yang sudah menggunakan 1 tabel
            $this->model->insertProfile($nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $peran, $email);
            header("Location: ?pages=dashboard");
            exit;
        } catch(Exception $e){
            echo "Ada kesalahan: " . $e->getMessage();
        }
    }

    public function logout(){
        $_SESSION = [];
        session_destroy();
        header("Location: ?login_page");
        exit;
    }
}
?>