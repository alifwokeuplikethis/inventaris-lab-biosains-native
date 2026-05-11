 <?php  
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
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
                  <th width="150">Jumlah Item</th>
                  <th>Daftar Bahan</th>
                  <th width="150">Status</th>
                  <th width="150">Aksi</th>
                </tr>
              </thead>
              <tbody>
                  <?php $no = 1; foreach ($allRequests as $req): ?>
                    
                    <?php 
                    // === LOGIKA WARNA BADGE STATUS ===
                    $statusClass = '';
                    if ($req['status'] === 'pending') {
                        $statusClass = 'bg-warning bg-opacity-10 text-warning border border-warning';
                    } elseif ($req['status'] === 'disetujui') {
                        $statusClass = 'bg-success bg-opacity-10 text-success border border-success';
                    } else {
                        $statusClass = 'bg-danger bg-opacity-10 text-danger border border-danger';
                    }
                    ?>

                    <tr>
                      <td><?= $no++; ?></td>
                      
                      <td class="fw-bold text-dark"><?= htmlspecialchars($req['nama']); ?></td>
                      
                      <td><span class="badge bg-secondary px-3 py-2 rounded-pill"><?= $req['jumlah_item']; ?> Item</span></td>
                      
                      <td class="text-muted" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= htmlspecialchars($req['daftar_bahan']); ?>
                      </td>
                      
                      <td>
                        <span class="badge px-3 py-2 rounded-pill <?= $statusClass; ?>">
                          <?= ucfirst($req['status']); ?>
                        </span>
                      </td>
                      
                      <td>
                        <div class="d-flex gap-2 align-items-center">
                          <button type="button" class="btn-circle btn-detail view-detail-btn" 
        data-id="<?= $req['id_pengguna']; ?>" 
        data-nama="<?= htmlspecialchars($req['nama']); ?>" 
        title="Lihat Rincian">
  <i class="bi bi-eye"></i>
</button>

                          <?php if ($req['status'] === 'pending'): ?>
                            
                            <a href="?action=prosesRequestBatch&id_pengguna=<?= $req['id_pengguna']; ?>&status=setuju" 
                               class="btn-circle btn-stok" title="Setujui Semua"
                               onclick="return confirm('Setujui <?= $req['jumlah_item']; ?> bahan dari <?= htmlspecialchars($req['nama']); ?>? Stok akan otomatis terpotong (FEFO).')">
                               <i class="bi bi-check-circle"></i>
                            </a>
                            
                            <a href="?action=prosesRequestBatch&id_pengguna=<?= $req['id_pengguna']; ?>&status=tolak" 
                               class="btn-circle btn-hapus" title="Tolak Semua"
                               onclick="return confirm('Yakin ingin menolak seluruh permintaan dari <?= htmlspecialchars($req['nama']); ?>?')">
                               <i class="bi bi-x-circle"></i>
                            </a>

                          <?php else: ?>
                            <span class="text-muted fw-bold" style="font-size: 0.8rem;">
                              <i class="bi bi-check2-all text-success fs-5"></i> Selesai
                            </span>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>

                  <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

  </div>
</main>

<?php require PAGES_PATH . 'Modal/modalRequest.php'; ?>
<script>
$(document).ready(function(){
  // 1. Inisialisasi DataTable
  const table = $('#table-dashboard').DataTable({
    pageLength: 8, 
    lengthChange: false, 
    info: true, 
    language: {
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ bahan",
      "infoEmpty": "Tidak ada data bahan",
      "infoFiltered": "(disaring dari total _MAX_ bahan)",
      "zeroRecords": "Bahan tidak ditemukan",
      // 👇 TAMBAHKAN BARIS INI UNTUK MENGHINDARI ERROR DATATABLES 👇
      "emptyTable": "Belum ada pengajuan bahan dari teknisi.", 
      "paginate": {
        "next": "›", 
        "previous": "‹" 
      }
    }
  });

  // 2. Fungsi Custom Search
  $('#searchInput').on('keyup', function(){
    table.search(this.value).draw();
  });

  // 3. Script AJAX Modal
  $('.view-detail-btn').on('click', function() {
      // Ambil data dari tombol yang diklik
      const idPengguna = $(this).data('id');
      const namaTeknisi = $(this).data('nama');
      
      $('#modalNamaTeknisi').text(namaTeknisi);
      $('#modalDetailRequest').modal('show');
      $('#modalDetailBody').html('<tr><td colspan="6" class="text-center py-5"><div class="spinner-border text-secondary" role="status"></div><div class="mt-2 text-muted">Memuat data...</div></td></tr>');
      
      // Jalankan AJAX
      $.ajax({
          url: '?action=detailRequestModal&id_pengguna=' + idPengguna,
          type: 'GET',
          dataType: 'json', 
          success: function(response) {
              if(response.status === 'success') {
                  let html = '';
                  let data = response.data;

                  if(data.length === 0) {
                      html = '<tr><td colspan="6" class="text-center py-4">Tidak ada data.</td></tr>';
                  } else {
                      let no = 1;
                      data.forEach(function(item) {
                          let statusClass = (item.status === 'pending') ? 'bg-warning bg-opacity-10 text-warning border-warning' : ((item.status === 'disetujui') ? 'bg-success bg-opacity-10 text-success border-success' : 'bg-danger bg-opacity-10 text-danger border-danger');
                          let jenisClass = (item.jenis === 'Padat') ? 'bg-light text-dark border' : 'bg-info bg-opacity-10 text-info border-info';
                          
                          let foto = item.foto_bahan 
                              ? `<img src="<?= BASE_URL ?>/images/uploads/${item.foto_bahan}" width="45" height="45" class="rounded object-fit-cover shadow-sm">` 
                              : `<div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width:45px; height:45px;"><i class="bi bi-image"></i></div>`;

                          let statusTeks = item.status.charAt(0).toUpperCase() + item.status.slice(1);

                          html += `
                              <tr>
                                  <td class="ps-4">${no++}</td>
                                  <td>${foto}</td>
                                  <td class="fw-bold text-dark">${item.nama_bahan}</td>
                                  <td><span class="badge rounded-pill ${jenisClass}">${item.jenis}</span></td>
                                  <td class="text-main fw-bold">${item.total_volume} <small class="text-muted fw-normal">${item.satuan}</small></td>
                                  <td><span class="badge px-3 py-2 rounded-pill border ${statusClass}">${statusTeks}</span></td>
                              </tr>
                          `;
                      });
                  }
                  $('#modalDetailBody').html(html);
              } else {
                  $('#modalDetailBody').html(`<tr><td colspan="6" class="text-center text-danger py-4">${response.message}</td></tr>`);
              }
          },
          error: function(xhr) {
              $('#modalDetailBody').html('<tr><td colspan="6" class="text-center text-danger py-4"><i class="bi bi-exclamation-triangle-fill fs-3 d-block mb-2"></i> Gagal memuat data dari server. Pastikan routing valid dan Controller bersih dari HTML.</td></tr>');
          }
      });
  });

});
</script>