<?php
define('BASE_PATH', dirname(__DIR__));

define('PAGES_PATH', BASE_PATH . '/views/pages/');
define('LAYOUT_PATH', BASE_PATH . '/views/components/');
use Controllers\AuthController;
use Controllers\BahanController;
return [

    // ===== AUTH =====
    'login' => fn() => (new AuthController())->login(),
    'callback' => fn() => (new AuthController())->callback(),
    'logout' => fn() => (new AuthController())->logout(),
    'register' => fn() => (new AuthController())->register(),
    'save_profile' => fn() => (new AuthController())->save_profile(),

    // ======= BAHAN =========
    'insert/tambah_bahan' => fn() => (new BahanController())->insert_bahan(),

    // ===== HALAMAN =====
    'login_page' => fn() => require 'views/login.php',
    'post_login' => fn() => require 'views/post_login.php',

    'dashboard' => fn() => (new BahanController())->dashboard(),
    'kadaluarsa' => fn() => require PAGES_PATH . 'kadaluarsa.php',
    'tambah_bahan' => fn() => require PAGES_PATH . 'tambah_bahan.php',
    'laporan' => fn() => require PAGES_PATH . 'laporan.php',
];
?>