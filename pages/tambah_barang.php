<style>
  /* Styling Input & Select */
.input-custom {
  border: 1px solid #d1d9d9;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  background-color: #ffffff;
  transition: all 0.3s ease;
}

.input-custom:focus {
  border-color: #2b6766;
  box-shadow: 0 0 0 0.25rem rgba(43, 103, 102, 0.15);
  background-color: #ffffff;
}

/* Styling Tombol Simpan */
.btn-tambah {
  background-color: #2b6766;
  color: #ffffff;
  font-weight: 600;
  border: none;
  transition: all 0.3s ease;
}

.btn-tambah:hover {
  background-color: #20504f; /* Warna hijau sedikit lebih gelap */
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(43, 103, 102, 0.2);
}
</style>
<main class="mt-5 pt-3 form-tambah-barang">
  <div class="container-fluid">
    

    <section class="p-4 shadow-sm" style="background-color: #2b6766; border-radius: 15px;">

         <section class="p-3 shadow-sm mb-4 d-flex justify-content-between align-items-center" style="background-color: #ffffff; border-radius: 15px;">
      <div>
        <h2 class="mb-0 fw-bold" style="color: #2b6766; font-size: 1.4rem;">
          <i class="fa fa-plus-circle me-2 text-secondary opacity-50"></i>Tambah Barang
        </h2>
      </div>
      <div class="text-secondary fs-5 d-none d-sm-block">
        <i class="fa fa-angle-double-right opacity-50"></i>
        <i class="fa fa-home ms-2" style="color: #2b6766;"></i>
      </div>
    </section>

      <div class="card border-0 p-4 custom-scrollbar" style="border-radius: 12px; background-color: #f8faf9; max-height: 600px; overflow-y: auto;">
        
        <form action="" method="POST">
          <div class="row g-4">
            
            <div class="col-md-6">
              <h5 class="fw-bold mb-4" style="color: #2b6766; border-bottom: 2px solid #eef2f0; padding-bottom: 10px;">Identitas Barang</h5>
              
              <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">No. ID Barang</label>
                <input type="text" class="form-control input-custom" placeholder="Contoh: CHM-001" required>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Nama Bahan Kimia</label>
                <input type="text" class="form-control input-custom" placeholder="Masukkan nama bahan" required>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Rumus Kimia</label>
                <input type="text" class="form-control input-custom" placeholder="Contoh: CHCl₃">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Merk / Katalog</label>
                <input type="text" class="form-control input-custom" placeholder="Contoh: Merck / 102445">
              </div>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold mb-4" style="color: #2b6766; border-bottom: 2px solid #eef2f0; padding-bottom: 10px;">Data Stok & Penyimpanan</h5>
              
              <div class="row">
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Tanggal Penerimaan</label>
                  <input type="date" class="form-control input-custom">
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small text-danger">Tanggal Kadaluarsa</label>
                  <input type="date" class="form-control input-custom">
                </div>
              </div>

              <div class="row">
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Kuantitas</label>
                  <input type="number" class="form-control input-custom" placeholder="0">
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Satuan</label>
                  <select class="form-select input-custom">
                     <option selected disabled>Pilih satuan</option>
                     <option>Liter (L)</option>
                     <option>MiliLiter (ml)</option>
                     <option>Kilogram (kg)</option>
                     <option>Gram (g)</option>
                  </select>
                </div>
              </div>
              
              <div class="row">
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Rak Penyimpanan</label>
                  <select class="form-select input-custom">
                    <option selected disabled>Pilih lokasi</option>
                    <option>Lemari Asam - A1</option>
                    <option>Rak Reagen - B2</option>
                  </select>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Upload Foto</label>
                  <input type="file" class="form-control input-custom" id="fileInput" accept="image/*">
                </div>
              </div>
            </div>

          </div>

          <div class="d-flex justify-content-end align-items-center mt-4 pt-3" style="border-top: 1px solid #eef2f0;">
            <button type="button" class="btn btn-light px-4 py-2 me-2 rounded-pill fw-medium text-secondary">Batal</button>
            <button type="submit" class="btn btn-tambah px-4 py-2 rounded-pill shadow-sm">
              <i class="fa fa-save me-2"></i>Simpan Data Barang
            </button>
          </div>

        </form>
      </div>
    </section>
  </div>
</main>