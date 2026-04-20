<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acc Akun Teknisi</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
    :root {
      --offcanvas-width: 270px;
      --teal-dark:  #2b6766;
      --teal-mid:   #3d7f7e;
      --teal-soft:  #5f9e9a;
      --brown:      #a06b4d;
      --bg:         #eef2f1;
      --card-r:     16px;
    }
 
    * { box-sizing: border-box; }
 
    body {
      background-color: var(--bg);
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
    }
 
    main {
      margin-left: var(--offcanvas-width);
      padding: 90px 24px 40px;
      min-height: 100vh;
      transition: margin 0.3s;
    }
 
    @media (max-width: 992px) { main { margin-left: 0; } }
 
    .shell {
      background: linear-gradient(to right, #02343F, #3E807D, #47918E);
      border-radius: 22px;
      padding: 22px;
    }
 
    .main-card {
      background: #fff;
      border-radius: var(--card-r);
      overflow: hidden;
    }
 
    .card-topbar {
      padding: 22px 28px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #f0f0f0;
    }
 
    .card-topbar h1 {
      font-size: 22px;
      font-weight: 700;
      color: var(--brown);
      margin: 0;
    }
 
    .topbar-icons { color: #aaa; font-size: 18px; display:flex; gap:10px; align-items:center; }
 
    .card-body-pad { padding: 24px 28px 30px; }
 
    /* Stats */
    .stats-row {
      display: flex;
      gap: 14px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }
 
    .stat-pill {
      flex: 1;
      min-width: 100px;
      /* background: linear-gradient(135deg, var(--teal-dark), var(--teal-soft)); */
      color: #fff;
      border-radius: 12px;
      padding: 14px 18px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .stat-pill:nth-child(1) {
    background: linear-gradient(135deg, #02343F, #3E807D);
    }

    .stat-pill:nth-child(2) {
    background: linear-gradient(135deg, #26d119, #86e57f);
    }

    .stat-pill:nth-child(3) {
    background: linear-gradient(135deg, #d11919, #ea9999);
    }
 
    .stat-pill .ico {
      width: 38px; height: 38px;
      background: rgba(255,255,255,.2);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
 
    .stat-pill .info small { font-size: 11px; opacity: .8; display:block; }
    .stat-pill .info strong { font-size: 22px; font-weight: 700; display:block; line-height:1.1; }
 
    /* Action bar */
    .action-bar {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }
 
    .search-wrap {
      position: relative;
      flex: 1;
      min-width: 200px;
    }
 
    .search-wrap input {
      width: 100%;
      padding: 10px 16px 10px 42px;
      border: 1.5px solid #dde4e3;
      border-radius: 10px;
      font-size: 14px;
      background: #f7fafa;
      color: #333;
      outline: none;
      transition: border 0.2s, box-shadow 0.2s;
    }
 
    .search-wrap input:focus {
      border-color: var(--teal-soft);
      box-shadow: 0 0 0 3px rgba(95,158,154,.15);
      background: #fff;
    }
 
    .search-wrap .si {
      position: absolute;
      left: 14px; top: 50%;
      transform: translateY(-50%);
      color: #aaa; font-size: 15px;
    }

    .btn-cari {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: var(--teal-mid);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      white-space: nowrap;
    }

    .btn-cari:hover { background: var(--teal-soft); transform: translateY(-1px); }


    .btn-add {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: var(--teal-dark);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      white-space: nowrap;
    }
 
    .btn-add:hover { background: var(--teal-mid); transform: translateY(-1px); }
 
    /* Section label */
    .section-label {
      font-size: 13px;
      font-weight: 700;
      color: #555;
      text-transform: uppercase;
      letter-spacing: .6px;
      margin-bottom: 12px;
    }

  </style>
</head>
<body>
<?php
include "navbar.php";
include "sidebar.php";
?>

<main>
    <div class="container-fluid px-0">
        <div class="shell">
            <div class="main-card shadow-sm">
                <!-- topbar -->
                <div class="card-topbar">
                    <h1>Akun Teknisi</h1>
                    <div class="topbar-icons">
                        <i class="fa fa-angle-double-right"></i>
                        <i class="fa fa-home text-dark"></i>
                    </div>
                </div>
                <div class="card-body-pad">
                    <!-- stats -->
                    <div class="stats-row">
                        <div class="stat-pill">
                            <div class="ico"><i class="bi bi-people-fill"></i></div>
                            <div class="info">
                                <small>Total Teknisi</small>
                                <strong id="stat_total">0</strong>
                            </div>
                        </div>
                        <div class="stat-pill style="background:linier-gradient(135deg,#27ae60,#6fcf97);">
                            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
                            <div class="info">
                                <small>Aktif</small>
                                <strong id="stat_aktif">0</strong>
                            </div>
                        </div>
                        <div class="stat-pill style="background:linier-gradient(135deg,#c0392b,#e87070);">
                            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
                            <div class="info">
                                <small>Nonaktif</small>
                                <strong id="stat_nonaktif">0</strong>
                            </div>
                        </div>
                    </div>
                    <!-- search+tambah -->
                     <div class="action-bar">
                        <div class="search-wrap">
                            <i class="bi bi-search si"></i>
                            <input type="text" id="searchinput" placeholder="Cari nama atau akun teknisi..." oninput="renderList()">
                        </div>
                        <button class="btn-cari" onclick="openModal()">
                            <i class="bi bi-search si"></i>
                            Cari
                        </button>
                        <button class="btn-add" onclick="openModal()">
                            <i class="bi bi-person-plus-fill"></i>
                            Tambah teknisi
                        </button>
                     </div>

                     <div class="section-label">Daftar Akun Teknisi</div>
                     <div class="teknisi-list" id="teknisiList" style="gap: 10px;">
                        <div class="card" style="padding: 10px; display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <div class="left-a">
                                    <img src="images/alif 2.jpeg" alt="gambar tidak ada" srcset="" style="width: 50px; border-radius: 100px;">
                                </div>
                                <div class="left-b">
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0; gap: 10px;"><i class="bi bi-telephone"></i>082727272727</p>
                                <span class="badge text-bg-success">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <div class="card" style="padding: 10px; display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <div class="left-a">
                                    <img src="images/alif 2.jpeg" alt="gambar tidak ada" srcset="" style="width: 50px; border-radius: 100px;">
                                </div>
                                <div class="left-b">
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0; gap: 10px;"><i class="bi bi-telephone"></i>082727272727</p>
                                <span class="badge text-bg-success">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <div class="card" style="padding: 10px; display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <div class="left-a">
                                    <img src="images/alif 2.jpeg" alt="gambar tidak ada" srcset="" style="width: 50px; border-radius: 100px;">
                                </div>
                                <div class="left-b">
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0; gap: 10px;"><i class="bi bi-telephone"></i>082727272727</p>
                                <span class="badge text-bg-success">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <div class="card" style="padding: 10px; display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <div class="left-a">
                                    <img src="images/alif 2.jpeg" alt="gambar tidak ada" srcset="" style="width: 50px; border-radius: 100px;">
                                </div>
                                <div class="left-b">
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0; gap: 10px;"><i class="bi bi-telephone"></i>082727272727</p>
                                <span class="badge text-bg-success">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <div class="card" style="padding: 10px; display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="left d-flex" style="gap: 10px; align-items: center;">
                                <div class="left-a">
                                    <img src="images/alif 2.jpeg" alt="gambar tidak ada" srcset="" style="width: 50px; border-radius: 100px;">
                                </div>
                                <div class="left-b">
                                    <p style="font-weight: 800; margin: 0;">Rahmah Qoonitah Azmillah</p>
                                    <p style="margin: 0;">rahmahazmillah03@gmail.com</p>
                                </div>
                            </div>
                            <div class="right" style="align-items: center; display: flex; gap: 10px;">
                                <p style="margin-bottom: 0; gap: 10px;"><i class="bi bi-telephone"></i>082727272727</p>
                                <span class="badge text-bg-success">Aktif</span>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <!-- <table class="table table-bordered">
                            <tr>
                                <th>no</th>
                                <th>no</th>
                                <th>no</th>
                                <th>no</th>
                                <th>no</th>
                            </tr>
                            <tr>
                                <td>isi</td>
                                <td>isi</td>
                                <td>isi</td>
                                <td>isi</td>
                                <td>isi</td>
                            </tr>
                        </table> -->
                     </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>