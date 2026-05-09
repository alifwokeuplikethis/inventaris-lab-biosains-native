
<?php
// session_start();
// require "AuthModel.php";
// require "AuthController.php";

// $model = new AuthModel();
// $AuthController = new AuthController();
// // ===============FILE ROUTING======================
// $action = $_GET['action'] ?? null;
// $publicAction = ['login', 'callback', 'login_page', 'post_login'];
// if(!in_array($action, $publicAction)){
//     if(empty($_SESSION['is_logged_in']) || !$model->cekInfo($_SESSION['user']['id']) ){
//         header("Location: ?action=login_page");
//     }
// }

// if ($action === 'login') {
//     $AuthController->login();
//     exit;
// }

// if ($action === 'callback') {
//     $AuthController->callback();
//     exit;
// }

// // ✅ HALAMAN LOGIN
// if ($action === 'login_page') {
//     header("Location: login.php");
//     exit;
// }
// if ($action === 'post_login') {
//     header("Location: post_login.php");
//     exit;
// }
// if ($action === 'logout') {
//     $AuthController->logout();
// }
// // ==================

// if($action === 'register') {
//     $AuthController->register();
// }
// if($action === 'save_profile') {
//     $AuthController->save_profile();
// }

// // include "navbar.php";
// // include "sidebar.php";

// // 1. Tentukan halaman utama yang jadi background
// $halaman = isset($_GET['pages']) ? $_GET['pages'] : 'dashboard';
// $daftar_halaman = ['dashboard', 'kadaluarsa', 'tambah_barang', 'laporan', 'akun_teknisi', 'transaksi_stok', 'permintaan_teknisi'];

// // Bungkus main content dalam div agar tidak berantakan dengan sidebar
// echo '<div class="main-content">'; 
// if (in_array($halaman, $daftar_halaman)) {
//     if (file_exists("pages/$halaman.php")) {
//         include "pages/$halaman.php";
//     } else {
//         echo "<h2 class='py-4 px-4'>Error 404: File tidak ditemukan!</h2>";
//     }
// } else {
//     // Jika user mengakses pages=detail_bahan, kita paksa background-nya dashboard
//     if ($halaman == 'detail_bahan') {
//         include "pages/dashboard.php";
//     } else {
//         echo "<h2>Halaman Tidak Ditemukan!</h2>";
//     }
// }
// echo '</div>';

// // 2. LOGIKA MODAL (TIDAK BOLEH MASUK ELSE/IF DI ATAS)
// // Modal harus di-include secara mandiri di paling bawah agar menumpuk di atas
// if (isset($_GET['pages']) && $_GET['pages'] == 'detail_bahan') {
//     if (file_exists("pages/detail_bahan.php")) {
//         include "pages/detail_bahan.php";
//     }
// }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

define('BASE_PATH', __DIR__);
define('PAGES_PATH', BASE_PATH . '/views/pages/');
define('LAYOUT_PATH', BASE_PATH . '/views/components/');
define(
    'BASE_URL',
    (isset($_SERVER['HTTPS']) ? 'https' : 'http')
    . '://'
    . $_SERVER['HTTP_HOST']
    . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/')
);

require BASE_PATH . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Routes\Router;
use Models\AuthModel;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$routes = require BASE_PATH . '/Routes/web.php';

$router = new Router($routes);

$router->dispatch($_GET['action'] ?? 'dashboard');