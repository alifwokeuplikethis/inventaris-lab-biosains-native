<style>
  /* --- CUSTOM STYLING --- */
  /* 1. Custom Scrollbar untuk Tabel */
  .custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
  }
  .custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f5f4; 
    border-radius: 10px;
  }
  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #bdc3c7; 
    border-radius: 10px;
  }
  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #95a5a6; 
  }

  /* 2. Efek Hover pada Baris Tabel */
  .table-hover-custom tbody tr {
    transition: all 0.2s ease-in-out;
  }
  .table-hover-custom tbody tr:hover {
    background-color: #f8faf9;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  }

  /* 3. Badge Status Soft Modern */
  .badge-soft-success {
    background-color: #d1e7dd;
    color: #0f5132;
    font-weight: 600;
    letter-spacing: 0.5px;
  }

  /* 4. Efek Interaktif Input & Tombol */
  .search-input:focus, .btn-filter:focus, .btn-filter:hover {
    box-shadow: 0 0 0 0.2rem rgba(2, 52, 63, 0.15) !important;
    background-color: #fff !important;
    border: 1px solid #02343F !important;
    outline: none;
  }
/* --- STYLING TOMBOL MINIMALIS BULAT --- */
  .btn-icon-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%; /* Membuatnya bulat sempurna */
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
    background-color: #f1f5f4; /* Abu-abu terang */
    color: #666;
  }
  .btn-icon-circle:hover {
    transform: scale(1.1); /* Efek membesar dikit saat di-hover */
  }
  
  .btn-icon-circle.detail:hover { background-color: #02343F; color: #fff; box-shadow: 0 3px 6px rgba(2,52,63,0.3); }
  .btn-icon-circle.stok:hover { background-color: #00796b; color: #fff; box-shadow: 0 3px 6px rgba(0,121,107,0.3); }
  .btn-icon-circle.hapus:hover { background-color: #e74c3c; color: #fff; box-shadow: 0 3px 6px rgba(231,76,60,0.3); }


  /* Style Header Tabel agar text lebih rapi */
  .thead-modern th {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
  }
  
 /* --- STYLING DROPDOWN MENU MODERN --- */
.custom-dropdown-menu {
  border-radius: 16px !important;
  padding: 8px;
  border: 1px solid rgba(2, 52, 63, 0.1); /* Garis batas tipis warna tema */
  box-shadow: 0 10px 30px rgba(2, 52, 63, 0.15) !important; 
  min-width: 180px;
}

.custom-dropdown-menu .dropdown-item {
  border-radius: 10px;
  padding: 10px 16px;
  font-weight: 500;
  color: #444;
  transition: all 0.2s ease-in-out;
  display: flex;
  align-items: center;
}

/* Warna Ikon bawaan */
.custom-dropdown-menu .dropdown-item i {
  font-size: 1.1rem;
  width: 24px;
  transition: all 0.2s ease-in-out;
}

/* Efek Hover yang lebih mewah */
.custom-dropdown-menu .dropdown-item:hover {
  background-color: #d1e7dd;          /* Warna hijau soft dari badge kamu */
  color: #02343F;                     /* Teks warna gelap utama */
  font-weight: 600;
  transform: translateX(4px);         /* Geser kanan dikit */
}

/* Bikin ikon membesar saat barisnya di-hover */
.custom-dropdown-menu .dropdown-item:hover i {
  transform: scale(1.2);
  color: #02343F !important;
}

.custom-dropdown-menu .dropdown-divider {
  border-top-color: rgba(0,0,0,0.05);
  margin: 6px 0;
}
</style>

<main class="mt-5 pt-3 dashboard-content">
  
  <div class="container-fluid">
    <section class="p-3 p-md-4 shadow-sm" style="background-color: #2b6766; border-radius: 15px;">
      
      <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
        
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <h2 class="mb-0 fw-bold" style="color: #02343F; font-size: 24px;">
            <i class="fa fa-boxes-stacked me-2 opacity-75"></i>Data Bahan
          </h2>
          
          <div class="d-flex align-items-center gap-3">
            
            <div class="dropdown d-none d-md-block">
  <button id="filterBtn" class="btn btn-custom-filter rounded-pill px-4 py-2 d-flex align-items-center justify-content-between gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 140px;">
    <div class="d-flex align-items-center">
      <i class="bi bi-funnel-fill me-2"></i> 
      <span id="filterText" class="fw-semibold">Jenis</span>
    </div>
    <i class="bi bi-chevron-down ms-2" style="font-size: 0.8rem;"></i>
  </button>
  
  <ul class="dropdown-menu custom-dropdown-menu shadow border-0">
    <li>
      <a class="dropdown-item filter-pilihan py-2" href="#">
        <i class="bi bi-collection-fill text-secondary me-2"></i> Semua Jenis
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
      <a class="dropdown-item filter-pilihan py-2" href="#">
        <i class="bi bi-box-fill text-warning me-2"></i> Padat
      </a>
    </li>
    <li>
      <a class="dropdown-item filter-pilihan py-2" href="#">
        <i class="bi bi-droplet-fill text-info me-2"></i> Cair
      </a>
    </li>
    <li>
      <a class="dropdown-item filter-pilihan py-2" href="#">
        <i class="bi bi-cloud-fill text-success me-2"></i> Gas
      </a>
    </li>
  </ul>
</div>

            <div class="position-relative d-none d-md-block">
              <input type="text" class="form-control search-input rounded-pill px-4 py-2" 
                     placeholder="Telusuri barang..." style="background-color: #f1f5f4; border: 1px solid transparent; width: 260px;">
              <i class="fa fa-search position-absolute" style="right: 18px; top: 12px; color: #888;"></i>
            </div>

            <div class="text-secondary fs-5 d-flex align-items-center ms-2" style="cursor: pointer;">
              <i class="fa fa-home hover-primary" style="transition: color 0.2s;"></i>
            </div>

          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive custom-scrollbar" style="height: 60vh; overflow-y: auto;">
            <table class="table table-hover-custom align-middle border-0 mb-0 text-nowrap">
              
              <thead class="sticky-top" style="z-index: 10;">
                <tr class="thead-modern" style="background-color: #f8faf9; color: #555; border-bottom: 2px solid #eef2f0;">
                  <th class="py-3 text-center border-0" style="width: 5%">No</th>
                  <th class="py-3 border-0" style="width: 20%">Nama Barang</th> 
                  <th class="py-3 text-center border-0" style="width: 10%">Satuan</th>
                  <th class="py-3 text-center border-0" style="width: 10%">Jenis</th>
                  <th class="py-3 text-center border-0" style="width: 15%">Foto</th>
                  <th class="py-3 text-center border-0" style="width: 15%">Kuantitas</th>
                  <th class="py-3 text-center border-0" style="width: 10%">Status</th>
                  <th class="py-3 text-center border-0" style="width: 15%">Aksi</th>
                </tr>
              </thead>
              
              <tbody class="bg-white">
                <tr style="border-bottom: 1px solid #f1f5f4;">
                  <td class="text-center text-muted">1.</td>
                  <td>
                    <div class="fw-bold text-dark" style="font-size: 15px;">Clorin</div>
                    <small class="text-muted">Kode: CLR-001</small>
                  </td> 
                  <td class="text-center"><span class="badge bg-light text-secondary border px-2 py-1">ml</span></td>
                  <td class="text-center"><span class="text-muted">Gas</span></td>
                  <td class="text-center">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px; background-color: #f9fbfb;">
                      <i class="fa fa-flask text-info fs-5"></i>
                    </div>
                  </td>
                  <td class="text-center fw-bold" style="color: #02343F; font-size: 16px;">1.000</td>
                  <td class="text-center">
                    <span class="badge badge-soft-success rounded-pill px-3 py-2">TERSEDIA</span>
                  </td>
                  <td>
                   <div class="d-flex gap-2 justify-content-center">
  <button class="btn-icon-circle detail shadow-sm" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#contohModal">
    <i class="bi bi-eye-fill"></i>
  </button>
  
  <button class="btn-icon-circle stok shadow-sm" title="Tambah Stok" onclick="window.location.href='index.php?pages=transaksi_stok'">
    <i class="bi bi-plus-circle-fill"></i>
  </button>
  
  <button class="btn-icon-circle hapus shadow-sm" title="Hapus Data">
    <i class="bi bi-trash-fill"></i>
  </button>
</div>
                  </td>
                </tr>
                </tbody>
            </table>
          </div>
        </div>
        
      </div>
    </section>
  </div>
</main>



<!-- MODAL SECTION  -->
<div class="modal fade" id="contohModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 pt-1">
                <div class="row mb-4 align-items-center">
                    
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="https://via.placeholder.com/300x300?text=Foto+Chloroform" alt="Foto Chloroform" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; max-height: 280px; width: 100%;">
                    </div>
                    
                    <div class="col-md-7 ps-md-4">
                      <div class="d-flex align-items-center mb-4">
    <h3 class="fw-bold mb-0" style="color: #02343F;">Chloroform</h3>
    <button class="btn btn-sm btn-light rounded-circle ms-3 shadow-sm border" title="Edit Data Master" style="width: 36px; height: 36px;">
        <i class="bi bi-pencil-fill text-secondary"></i>
    </button>
</div>
                        
                        <table class="table table-borderless table-sm mb-0 fs-6">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="width: 40%; padding-bottom: 12px;">Rumus Kimia</td>
                                    <td style="padding-bottom: 12px;">CHCl₃</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Merk/Katalog</td>
                                    <td style="padding-bottom: 12px;">Merck / 102445</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Satuan</td>
                                    <td style="padding-bottom: 12px;">miliLiter (L)</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Rak Penyimpanan</td>
                                    <td style="padding-bottom: 12px;"><span class="badge bg-secondary rounded-pill px-3">Lemari Asam - A2</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

               <div class="p-3 rounded-4" style="background-color: #b2d3c2;">
                    <h6 class="fw-bold mb-3 ms-2" style="color: #01242c;">Rincian Stok per Lokasi</h6>
                    
                    <div class="table-responsive custom-scrollbar" style="max-height: 250px; overflow-y: auto; padding-right: 5px;">
                        <table class="table table-borderless table-sm mb-0 align-middle text-nowrap" style="background-color: transparent;">
                            
                            <thead style="position: sticky; top: 0; background-color: #b2d3c2; z-index: 2; border-bottom: 1px solid rgba(0,0,0,0.1);">
                                <tr style="color: #01242c;">
                                    <th class="fw-bold pb-2">Tipe</th>
                                    <th class="fw-bold pb-2">Tgl Penerimaan</th>
                                    <th class="fw-bold pb-2">Tgl Kadaluarsa</th>
                                    <th class="fw-bold pb-2 text-end">Jumlah</th>
                                </tr>
                            </thead>
                            
                            <tbody style="color: #1a1a1a;">
                                <tr>
                                    <td class="py-2 fw-medium">Stok Sisa 1</td>
                                    <td class="py-2">12 Jan 2025</td>
                                    <td class="py-2 text-danger fw-medium">12 Jan 2026</td>
                                    <td class="py-2 text-end fw-bold">2 mL</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-medium">Stok Gudang 2</td>
                                    <td class="py-2">05 Mar 2025</td>
                                    <td class="py-2">05 Mar 2027</td>
                                    <td class="py-2 text-end fw-bold">5 mL</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-medium">Stok Gudang 3</td>
                                    <td class="py-2">10 Apr 2025</td>
                                    <td class="py-2">10 Apr 2027</td>
                                    <td class="py-2 text-end fw-bold">3 mL</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-medium">Stok Gudang 4</td>
                                    <td class="py-2">15 Mei 2025</td>
                                    <td class="py-2">15 Mei 2027</td>
                                    <td class="py-2 text-end fw-bold">4 mL</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-medium">Stok Gudang 5</td>
                                    <td class="py-2">20 Jun 2025</td>
                                    <td class="py-2">20 Jun 2028</td>
                                    <td class="py-2 text-end fw-bold">10 mL</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-medium">Stok Gudang 6</td>
                                    <td class="py-2">25 Jul 2025</td>
                                    <td class="py-2">25 Jul 2028</td>
                                    <td class="py-2 text-end fw-bold">1 mL</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>