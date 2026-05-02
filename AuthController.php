<?php
require_once 'Auth.php';
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class AuthController {
    private AuthManager $authManager;

    public function __construct() {
        $googleProvider = new GoogleOAuthProvider(
            $_ENV['GOOGLE_CLIENT_ID'],
            $_ENV['GOOGLE_CLIENT_SECRET'],
            $_ENV['GOOGLE_REDIRECT_URI']
        );

        $this->authManager = new AuthManager($googleProvider);
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

        // contoh: simpan ke session
        $_SESSION['is_logged_in'] = true;
$_SESSION['user'] = $result['profile'];

        echo "Login berhasil";
    }
}
?>