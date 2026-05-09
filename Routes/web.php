<?php

use Controllers\AuthController;
use Controllers\BahanController;
use Controllers\StokController;
use Controllers\KadaluarsaController;
use Controllers\AkunTeknisiController;
use Controllers\TeknisiController;

return [

    // AUTH
    [
        'route' => 'login_page',
        'view' => 'Auth/login.php',
        'public' => true
    ],
    [
        'route' => 'post_login',
        'view' => 'Auth/post_login.php',
        'public' => true
    ],

    [
        'route' => 'register',
        'controller' => [AuthController::class, 'register'],
        'public' => true
    ],
    [
        'route' => 'login',
        'controller' => [AuthController::class, 'login'],
        'public' => true
    ],
    [
        'route' => 'callback',
        'controller' => [AuthController::class, 'callback'],
        'public' => true
    ],
    [
        'route' => 'save_profile',
        'controller' => [AuthController::class, 'save_profile'],
        'public' => true
    ],

    [
        'route' => 'logout',
        'controller' => [AuthController::class, 'logout']
    ],

    // BAHAN/dashboard
    [
        'route' => 'dashboard',
        'controller' => [BahanController::class, 'dashboard'],
        'role' => 'admin'
    ],
    [
        'route' => 'tambah_bahan',
        'view' => 'tambah_bahan.php'
    ],

    [
        'route' => 'insert/tambah_bahan',
        'controller' => [BahanController::class, 'insert_bahan']
    ],

    // STOK
    [
        'route' => 'prosesStok',
        'controller' => [StokController::class, 'prosesStok']
    ],
    [
        'route' => 'transaksi_stok',
        'controller' => [StokController::class, 'transaksiStok']
    ],

    [
        'route' => 'previewKurangiStok',
        'controller' => [StokController::class, 'previewKurangiStok'],
        'api' => true
    ],

    //  Kadaluarsa
    [
        'route' => 'kadaluarsa',
        'controller' => [KadaluarsaController::class, 'getKadaluarsa']
    ],

    // Akun teknisi
    [
        'route' => 'akun_teknisi',
        'controller' => [AkunTeknisiController::class, 'getAkunTeknisi']
    ],
    [
        'route' => 'tolak',
        'controller' => [AkunTeknisiController::class, 'tolak']
    ],
    [
        'route' => 'toggle_status',
        'controller' => [AkunTeknisiController::class, 'toggle_status']
    ],
    [
        'route' => 'hapus',
        'controller' => [AkunTeknisiController::class, 'hapus']
    ],
    [
        'route' => 'setujui',
        'controller' => [AkunTeknisiController::class, 'setujui']
    ],

    // HALAMAN TEKNISI
    [
        'route' => 'halaman_teknisi',
        'controller' => [TeknisiController::class, 'dashboard']
    ]
];