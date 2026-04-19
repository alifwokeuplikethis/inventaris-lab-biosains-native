<main class="mt-5 pt-3 form-tambah-barang">
  <div class="container-fluid">
    <section class="p-3 shadow-sm mb-4" style="background-color: #fff; border-radius: 15px; border-left: 10px solid #2b6766;">
      <div class="d-flex justify-content-between align-items-center px-2">
        <h2 class="mb-0 fw-bold" style="color: #a06b4d; font-size: 24px;">Tambah Barang</h2>
        <div class="text-secondary fs-4">
          <i class="fa fa-angle-double-right opacity-50"></i>
          <i class="fa fa-home ms-2 text-dark"></i>
        </div>
      </div>
    </section>

    <section class="p-4 shadow-sm" style="background-color: #2b6766; border-radius: 15px;">
      <div class="card border-0 p-4 max-height: 500px; overflow-y: auto;" style="border-radius: 15px; background-color: #f1f4f5;">
        <form action="" method="POST">
          <div class="row g-4">
            
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Bahan Kimia</label>
                <input type="text" class="form-control input-custom">
              </div>
              <div class="mb-3">
                <label class="form-label">Rumus Kimia</label>
                <input type="text" class="form-control input-custom">
              </div>
              <div class="mb-3">
                <label class="form-label">Merk/Katalog</label>
                <input type="text" class="form-control input-custom">
              </div>
              <div class="mb-3">
                <label class="form-label">Satuan</label>
                <select class="form-select input-custom">
                   <option selected disabled>Pilih satuan</option>
                   <option>ml</option>
                   <option>gram</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Kuantitas</label>
                <input type="number" class="form-control input-custom">
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">No. ID</label>
                <input type="text" class="form-control input-custom">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Penerimaan</label>
                <input type="date" class="form-control input-custom">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" class="form-control input-custom">
              </div>
              
              <div class="row">
                <div class="col-6 mb-3">
                  <label class="form-label">Upload Foto</label>
                  <div class="file-upload-wrapper">
                    <input type="file" class="form-control input-custom" id="fileInput">
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label">Rak</label>
                  <select class="form-select input-custom">
                    <option selected disabled>Pilih rak</option>
                  </select>
                </div>
              </div>

              <div class="d-flex gap-3 mt-5 justify-content-end">
                <button type="submit" class="btn btn-tambah">Tambahkan barang</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </section>
  </div>
</main>