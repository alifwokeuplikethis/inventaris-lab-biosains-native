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
        $this->model = (new AuthModel());
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
            if($data['status'] == 'disetujui'){
                if($infoTech){
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user'] = $result['profile'];
                    $_SESSION['user']['id_normal'] = $data['id'];
                    $_SESSION['success'] = 'Selamat datang sir .' . $_SESSION['user']['nama'];
                    return header("Location: ?pages=dashboard");
                    exit;
                }else{
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user'] = $result['profile'];
                    $_SESSION['user']['id_normal'] = $data['id'];
                    $_SESSION['success'] = 'Selamat, anda telah disetujui admin, tolong isi data diri anda';
                    return header("Location: ?action=post_login");
                    exit;
                }
            }elseif($data['status'] == 'pending'){
                echo "<script>
                alert('Mohon maaf, akun belum disetujui oleh admin!');
                window.location.href='?action=login_page'</script>";
                exit;
            }else{
                echo "<script>
                alert('Mohon maaf, akun ditolak oleh admin:)');
                window.location.href='?action=login_page'</script>";
                exit;
            }
        } else{
            echo "<script>
            alert('Mohon maaf, ajukan registrasi email anda terlebih dahulu');
            window.location.href='?action=login_page'</script>";
            exit;
        }
        
        // return header("Location: /");
        // exit;
    }

    public function register(){
    $email = $_POST['email'] ?? null;

    if (!$email) {
        $_SESSION['error'] = "Email kosong";
        header('Location: /inventory-revisi/?action=login_page');
        exit;
    }

    try {
        if ($this->model->cekEmail($email)) {
            $_SESSION['success'] = 'Email sudah terdaftar, selalu cek dengan mencoba login :D';
        } else {
            $this->model->insertEmail($email);
            $_SESSION['success'] = 'Email berhasil diajukan';
        }

    } catch (Exception $e) {
        $_SESSION['error'] = "Terjadi error sistem";
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

            $peran = "teknisi";
            $query = $this->model->insertProfile($nama, $no_telp, $foto_pengguna, $gender, $alamat, $google_id, $peran, $email);
            $_SESSION['success'] = 'Selamat datang sir ' . $nama;   
            header("Location: ?pages=dashboard");
            exit;
        }catch(Exception $e){
            echo "ada kesalahan: " . $e->getMessage();
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