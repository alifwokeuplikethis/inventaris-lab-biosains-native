
  <style>
    /* Tambahkan ini untuk memastikan variabel CSS terbaca jika tidak ada di style.css */
    :root {
      --offcanvas-width: 270px;
    }

    /* Membungkus section agar masuk ke area konten di sebelah sidebar */
    main {
      margin-left: var(--offcanvas-width);
      padding-top: 20px;
      min-height: 100vh;
      transition: all 0.3s;
    }

    /* Container Hijau Gelap sesuai Foto */
    .section-teal {
      background-color: #2b6766;
      border-radius: 20px;
      padding: 25px;
      margin: 0 15px;
    }

    .outer-card {
      background-color: white;
      border-radius: 15px;
      overflow: hidden;
      border: none;
    }

    .header-title {
      color: #a06b4d;
      font-weight: 700;
      font-size: 24px;
    }

    /* Input Styling agar mirip foto (Soft Shadow) */
    .form-control-ui {
      border: none !important;
      background-color: #ffffff !important;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08) !important;
      border-radius: 10px !important;
      padding: 10px 15px;
      font-size: 14px;
    }

    .form-label {
      font-weight: 600;
      font-size: 13px;
      margin-bottom: 5px;
    }

    .ui-btn {
      background-color: #5f9e9a;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 25px;
      font-weight: 600;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 992px) {
      main { margin-left: 0; }
    }
  </style>
</head>

<body>
<?php
include "navbar.php";
include "sidebar.php";
?>
  <main>
    <div class="container-fluid">
      
      <div class="section-teal">
        <div class="outer-card shadow-sm">
          
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4">
            <h1 class="header-title mb-0">Mensetujui Akun Teknisi</h1>
            <div class="header-icons text-secondary fs-4">
              <i class="fa fa-angle-double-right opacity-50"></i>
              <i class="fa fa-home ms-2 text-dark"></i>
            </div>
          </div>

          <div class="card-body p-4 pt-0">
            <form>
              <div class="row gx-5">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nama Bahan Kimia</label>
                  <input type="text" class="form-control-ui w-100">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">No. ID</label>
                  <input type="text" class="form-control-ui w-100">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Rumus Kimia</label>
                  <input type="text" class="form-control-ui w-100">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Penerimaan</label>
                  <input type="date" class="form-control-ui w-100">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Merk/Katalog</label>
                  <input type="text" class="form-control-ui w-100">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Kadaluarsa</label>
                  <input type="date" class="form-control-ui w-100">
                </div>
                
                <div class="col-md-6 mb-3">
                  <label class="form-label">Satuan</label>
                  <select class="form-control-ui w-100">
                    <option>ml</option>
                    <option>gram</option>
                  </select>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="row g-2 align-items-end">
                    <div class="col-8">
                      <label class="form-label">Upload Foto</label>
                      <div class="form-control-ui d-flex align-items-center">
                         <span class="badge bg-light text-dark border p-2 fw-normal" style="cursor:pointer">Pilih foto</span>
                      </div>
                    </div>
                    <div class="col-4">
                      <label class="form-label">Rak</label>
                      <div class="position-relative">
                        <input type="text" class="form-control-ui text-end">
                        <i class="fa fa-bars position-absolute" style="right: 12px; top: 13px; color: #aaa; font-size: 12px;"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label">Kuantitas</label>
                  <input type="number" class="form-control-ui w-100 text-end">
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="reset" class="ui-btn shadow-sm" style="background-color: #5f9e9a;">Bersihkan</button>
                <button type="submit" class="ui-btn shadow-sm">Tambahkan barang</button>
              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </main>

