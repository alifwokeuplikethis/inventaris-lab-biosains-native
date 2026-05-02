 <?php  
require "./navbar.php";
require "./sidebar.php";
?>
 <style>
    /* ===== GLOBAL ===== */
    body { 
      background: #f5f7f6; 
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
    }
    .text-main { color: #02343F; }

    /* ===== STAT PILL (KOTAK PUTIH CLEAN) ===== */
    .stat-pill {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 18px 20px;
      border-radius: 16px;
      background: white; 
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border: none;
    }

    .stat-pill .ico {
      width: 45px;
      height: 45px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
    }

    /* Warna Ikon Sesuai Kategori */
    .pill-total .ico { background: #e3f2fd; color: #0d6efd; }
    .pill-aktif .ico { background: #d1e7dd; color: #198754; }
    .pill-nonaktif .ico { background: #f8d7da; color: #dc3545; }

    .stat-pill .info small {
      color: #6c757d;
      font-weight: 500;
      display: block;
      margin-bottom: -2px;
    }
    .stat-pill .info strong {
      font-size: 22px;
      color: #212529;
    }

    /* ===== BUTTON ICON ===== */
    .btn-circle {
      width: 34px; height: 34px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      background: #f1f5f4;
      border: none;
      transition: 0.2s ease;
    }
    .btn-circle:hover { transform: scale(1.1); }
    .btn-detail:hover { background:#02343F; color:#fff; }
    .btn-stok:hover { background:#00796b; color:#fff; }
    .btn-hapus:hover { background:#e74c3c; color:#fff; }


    /* ===== TABEL CLEAN STYLING ===== */
    #table-dashboard thead th {
      background: #f8faf9 !important;
      border-bottom: 2px solid #eef2f0 !important;
      font-size: 0.85rem;
      font-weight: 600;
      color: #495057;
    }

    /* Styling Pagination bawaan Datatables */
    .dataTables_filter, .dataTables_length { display: none !important; }
    
    .dataTables_wrapper .page-link {
      border: none;
      border-radius: 8px;
      background: #f1f5f4;
      color: #02343F;
      margin: 0 3px;
      font-weight: 500;
    }
    .dataTables_wrapper .page-item.active .page-link {
      background: #02343F;
      color: #fff;
      box-shadow: 0 2px 4px rgba(2, 52, 63, 0.3);
    }
    .dataTables_info {
      color: #6c757d !important;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<main class="py-4">
  <div class="container-fluid px-4">

    <section class="p-4 shadow-sm" style="background:#2b6766; border-radius:20px;">
      
      <div class="row g-4 mb-4">
        
        <div class="col-12 col-md-4">
          <div class="stat-pill pill-total">
            <div class="ico"><i class="bi bi-people-fill"></i></div>
            <div class="info">
              <small>Total Bahan</small>
              <strong>xxx</strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-aktif">
            <div class="ico"><i class="bi bi-person-check-fill"></i></div>
            <div class="info">
              <small>Stok hampir habis</small>
              <strong>xxx</strong>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-pill pill-nonaktif">
            <div class="ico"><i class="bi bi-person-x-fill"></i></div>
            <div class="info">
              <small>Stok habis</small>
              <strong>xxx</strong>
            </div>
          </div>
        </div>

      </div>

      <div class="card border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">

        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="border-bottom: 1px solid #f0f0f0;">
          <h5 class="fw-bold text-main m-0">
            <i class="bi bi-box-seam me-2"></i>List Permintaan Teknisi
          </h5>

          <!--  -->
          <div class="d-flex gap-2">
            
            <div class="position-relative">
              <input type="text" id="searchInput" class="form-control control ps-3 shadow-sm" placeholder="Cari data..." style="width:220px;">
            </div>
          </div>
        </div>

        <div class="card-body p-4 bg-white">
          <div class="table-responsive">
            <table id="table-dashboard" class="table table-hover align-middle mb-0" style="width: 100%;">
              <thead>
                <tr>
                  <th width="50">No</th>
                  <th>Nama Teknisi</th>
                  <th>Satuan</th>
                  <th>Jenis</th>
                  <th>Qty</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th width="120">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <script>
                  for(let i=4; i<=12; i++){
                    let jenis = i % 2 === 0 ? "Padat" : "Cair";
                    document.write(`
                    <tr>
                      <td>${i}</td>
                      <td class="fw-bold text-dark">Teknisi ${i}</td>
                      <td>mL</td>
                      <td><span class="badge rounded-pill bg-light text-dark border">${jenis}</span></td>
                      <td class="text-main fw-bold">${i*15}</td>
                      <td><i class="bi bi-image text-muted"></i></td>
                      <td><span class="badge bg-success bg-opacity-10 text-success px-3">Tersedia</span></td>
                      <td>
                        <div class="d-flex gap-2">
                          <button class="btn-circle btn-detail" data-bs-toggle="modal" data-bs-target="#contohModal"><i class="bi bi-eye"></i></button>
                          <button class="btn-circle btn-stok"><i class="bi bi-plus"></i></button>
                          <button class="btn-circle btn-hapus"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>`);
                  }
                </script>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

  </div>
</main>


<script>
$(document).ready(function(){
  // Inisialisasi DataTable dengan Pagination aktif
  const table = $('#table-dashboard').DataTable({
    pageLength: 8, // Tampilkan 5 baris per halaman biar rapi
    lengthChange: false, // Hilangkan pilihan "Show X entries"
    info: true, // Munculkan teks "Menampilkan 1 sampai 5..."
    language: {
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ bahan",
      "infoEmpty": "Tidak ada data bahan",
      "infoFiltered": "(disaring dari total _MAX_ bahan)",
      "zeroRecords": "Bahan tidak ditemukan",
      "paginate": {
        "next": "›", // Icon next simple
        "previous": "‹" // Icon prev simple
      }
    }
  });

  // Fungsi Custom Search
  $('#searchInput').on('keyup', function(){
    table.search(this.value).draw();
  });

  
});
</script>
