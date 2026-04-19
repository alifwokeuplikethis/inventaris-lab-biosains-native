<main class="mt-5 pt-3 dashboard-content">
  <div class="container-fluid">
    <section class="p-3 shadow-sm" style="background-color: #2b6766; border-radius: 15px;">
      
      <div class="card border-0" style="border-radius: 12px; overflow: hidden;">
        
       <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4">
  <h2 class="mb-0 fw-bold" style="color: #a06b4d; font-size: 24px;">Dashboard</h2>
  
  <div class="d-flex align-items-center gap-3">
    
    <div class="dropdown d-none d-md-block">
      <button id="filterBtn" class="btn dropdown-toggle rounded-pill px-4 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #e2e7e3; color: #555; border: none;">
        <i class="fa fa-filter me-2"></i> Jenis
      </button>
      
      <ul class="dropdown-menu shadow-sm border-0" style="border-radius: 12px;">
        <li><a class="dropdown-item filter-pilihan" href="#">Semua Jenis</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item filter-pilihan" href="#">Padat</a></li>
        <li><a class="dropdown-item filter-pilihan" href="#">Cair</a></li>
        <li><a class="dropdown-item filter-pilihan" href="#">Gas</a></li>
      </ul>
    </div>

    <div class="position-relative d-none d-md-block">
      <input type="text" class="form-control rounded-pill border-0 px-4 py-2" 
             placeholder="Telusuri..." style="background-color: #e2e7e3; width: 250px;">
      <i class="fa fa-search position-absolute" style="right: 15px; top: 12px; color: #777;"></i>
    </div>

    <div class="text-secondary fs-4 d-flex align-items-center">
      <i class="fa fa-angle-double-right opacity-50" style="font-size: 1.2rem;"></i>
      <i class="fa fa-home ms-2"></i>
    </div>

  </div>
  </div>

        <div class="card-body p-4">
  <div class="table-responsive" style="height: 60vh; overflow-y: auto;">
    <table class="table align-middle border-0 mb-0 text-nowrap">
      
      <thead class="sticky-top" style="z-index: 10;">
        <tr style="background-color: #d7e0d8; color: #444;">
          <th class="py-3 text-center" style="width: 5%">No</th>
          <th class="py-3" style="width: 20%">Nama Barang</th> 
          <th class="py-3 text-center" style="width: 10%">Satuan</th>
          <th class="py-3 text-center" style="width: 10%">Jenis</th>
          <th class="py-3 text-center" style="width: 15%">Foto</th>
          <th class="py-3 text-center" style="width: 15%">Kuantitas</th>
          <th class="py-3 text-center" style="width: 10%">Status</th>
          <th class="py-3 text-center" style="width: 15%">Aksi</th>
        </tr>
      </thead>
      
      <tbody class="bg-white">
        <tr>
          <td class="text-center">1.</td>
          <td class="fw-bold text-dark">Clorin</td> 
          <td class="text-center"><span class="badge bg-light text-dark border">ml</span></td>
          <td class="text-center">Gas</td>
          <td class="text-center">
            <div class="bg-light rounded mx-auto d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
              <i class="fa fa-flask text-muted"></i>
            </div>
          </td>
          <td class="text-center fw-bold">1.000</td>
          <td class="text-center"><span class="badge bg-success rounded-pill px-3">TERSEDIA</span></td>
          <td>
            <div class="d-flex gap-2 justify-content-center">
              <a class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" style="min-width: 80px; font-size: 12px;" onclick="window.location.href='index.php?pages=detail_bahan'">
                <i class="bi bi-eye-fill me-1"></i> Detail
              </a>
              <button class="btn btn-info btn-sm text-white rounded-pill px-3 shadow-sm" style="min-width: 80px; font-size: 12px;">
                <i class="bi bi-plus-circle-fill me-1"></i> Stok
              </button>
              <button class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm" style="min-width: 80px; font-size: 12px;">
                <i class="bi bi-trash-fill me-1"></i> Hapus
              </button>
            </div>
          </td>
        </tr>
        </tbody>
</table>
          </div>
        </div>
        
        <div class="card-footer bg-white border-0 py-3"></div>
      </div>
    </section>
  </div>
</main>

<script>
  // Tunggu sampai seluruh halaman selesai dimuat
  document.addEventListener("DOMContentLoaded", function() {
    
    // Ambil tombol dan semua pilihan dropdown-nya
    const filterBtn = document.getElementById("filterBtn");
    const pilihanFilter = document.querySelectorAll(".filter-pilihan");

    // Looping untuk setiap pilihan yang ada
    pilihanFilter.forEach(function(pilihan) {
      pilihan.addEventListener("click", function(event) {
        event.preventDefault(); // Mencegah halaman scroll ke atas saat diklik (efek href="#")
        
        // Ambil teks dari pilihan yang diklik (misal: "Cair")
        const teksPilihan = this.innerText;

        // Ubah isi tombol dengan teks yang baru, tapi tetap pertahankan icon filter-nya
        filterBtn.innerHTML = '<i class="fa fa-filter me-2"></i> ' + teksPilihan;
      });
    });

  });
</script>