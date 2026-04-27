  <style>
    body {
      background-color: #f5f7f6;
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

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

    /* Styling Area Upload Foto */
    .upload-box {
      border: 2px dashed #cbd5d5;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      background-color: #ffffff;
      transition: all 0.3s ease;
      position: relative;
      cursor: pointer;
    }
    .upload-box:hover {
      border-color: #2b6766;
      background-color: #f1f5f4;
    }
    .upload-box input[type="file"] {
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
      opacity: 0;
      cursor: pointer;
    }
    .upload-icon {
      font-size: 2rem;
      color: #2b6766;
      margin-bottom: 10px;
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
      background-color: #20504f;
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(43, 103, 102, 0.2);
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
      width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1; 
      border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #c1c1c1; 
      border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8; 
    }
  </style>
</head>
<body>

<main class="mt-4 pt-3 form-tambah-barang mb-5">
  <div class="container-fluid px-4">
    
    <section class="p-4 shadow-sm" style="background-color: #2b6766; border-radius: 20px;">

      <section class="p-3 shadow-sm mb-4 d-flex justify-content-between align-items-center" style="background-color: #ffffff; border-radius: 15px;">
        <div>
          <h2 class="mb-0 fw-bold" style="color: #2b6766; font-size: 1.4rem;">
            <i class="fa fa-plus-circle me-2 text-secondary opacity-50"></i>Tambah Data Barang
          </h2>
        </div>
        <div class="text-secondary fs-5 d-none d-sm-block">
          <i class="fa fa-angle-double-right opacity-50"></i>
          <i class="fa fa-home ms-2" style="color: #2b6766;"></i>
        </div>
      </section>

      <div class="card border-0 p-4 custom-scrollbar shadow-lg" style="border-radius: 16px; background-color: #fcfdfd; max-height: 650px; overflow-y: auto;">
        
        <form action="" method="POST">
          <div class="row g-5">
            
            <div class="col-md-6 border-end-md">
              <h5 class="fw-bold mb-4" style="color: #2b6766; border-bottom: 2px solid #eef2f0; padding-bottom: 10px;">
                <i class="fa fa-box-open me-2"></i>Identitas Barang
              </h5>
              
              <div class="row mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold text-secondary small">No. ID Barang</label>
                  <input type="text" class="form-control input-custom" placeholder="Contoh: CHM-001" required>
                </div>
                <div class="col-sm-6 mt-3 mt-sm-0">
                  <label class="form-label fw-semibold text-secondary small">Satuan Utama</label>
                  <select class="form-select input-custom" required>
                     <option value="" selected disabled>Pilih satuan...</option>
                     <option>Liter (L)</option>
                     <option>MiliLiter (ml)</option>
                     <option>Kilogram (kg)</option>
                     <option>Gram (g)</option>
                     <option>Pcs / Botol</option>
                  </select>
                </div>
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Nama Bahan Kimia</label>
                <input type="text" class="form-control input-custom" placeholder="Masukkan nama bahan" required>
              </div>
              
              <div class="row mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold text-secondary small">Rumus Kimia</label>
                  <input type="text" class="form-control input-custom" placeholder="Cth: CHCl₃">
                </div>
                <div class="col-sm-6 mt-3 mt-sm-0">
                  <label class="form-label fw-semibold text-secondary small">Merk / Katalog</label>
                  <input type="text" class="form-control input-custom" placeholder="Cth: Merck">
                </div>
              </div>

              <div class="mb-2 mt-4">
                <label class="form-label fw-semibold text-secondary small">Upload Foto Bahan</label>
                <div class="upload-box" id="uploadArea">
                  <i class="fa fa-cloud-upload-alt upload-icon" id="uploadIcon"></i>
                  <p class="mb-0 text-muted small fw-medium" id="uploadText">Klik atau Drag & Drop foto di sini</p>
                  <p class="text-muted" style="font-size: 0.75rem;" id="uploadSubText">Format didukung: JPG, PNG, WEBP (Maks 2MB)</p>
                  
                  <input type="file" id="fileInput" accept="image/*">
                  <img id="previewImage" src="" alt="Preview" style="display: none; max-height: 140px; max-width: 100%; border-radius: 8px; margin: 0 auto; object-fit: contain;">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold mb-4" style="color: #2b6766; border-bottom: 2px solid #eef2f0; padding-bottom: 10px;">
                <i class="fa fa-warehouse me-2"></i>Data Stok & Penyimpanan
              </h5>
              
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Tanggal Penerimaan</label>
                  <input type="date" class="form-control input-custom" required>
                </div>
                <div class="col-sm-6 mb-3">
                  <label class="form-label fw-bold small text-danger">Tanggal Kadaluarsa</label>
                  <input type="date" class="form-control input-custom" style="border-color: #f8d7da; background-color: #fff9fa;" required>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Kuantitas Awal</label>
                  <input type="number" class="form-control input-custom" placeholder="0" min="0" required>
                </div>
                <div class="col-sm-6 mb-3">
                  <label class="form-label fw-semibold text-secondary small">Lokasi / Rak Penyimpanan</label>
                  <select class="form-select input-custom" required>
                    <option value="" selected disabled>Pilih lokasi rak</option>
                    <option>Lemari Asam - A1</option>
                    <option>Rak Reagen - B2</option>
                    <option>Gudang Bawah - C1</option>
                  </select>
                </div>
              </div>

              <div class="mb-3 mt-2">
                <label class="form-label fw-semibold text-secondary small">Catatan / Keterangan Khusus (Opsional)</label>
                <textarea class="form-control input-custom" rows="5" placeholder="Tambahkan catatan khusus mengenai kondisi barang, instruksi penyimpanan, link MSDS, dsb..."></textarea>
              </div>

            </div>
          </div>

          <div class="d-flex justify-content-end align-items-center mt-3 pt-4" style="border-top: 1px solid #eef2f0;">
            <button type="reset" class="btn btn-light px-4 py-2 me-3 rounded-pill fw-medium text-secondary border" onclick="resetForm()">Reset</button>
            <button type="submit" class="btn btn-tambah px-5 py-2 rounded-pill shadow-sm">
              <i class="fa fa-save me-2"></i>Simpan Data
            </button>
          </div>

        </form>
      </div>
    </section>
  </div>
</main>
<script>
  // Preview Image Logic
  document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    
    if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const previewImage = document.getElementById('previewImage');
        const icon = document.getElementById('uploadIcon');
        const text = document.getElementById('uploadText');
        const subText = document.getElementById('uploadSubText');

        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
        
        icon.style.display = 'none';
        text.style.display = 'none';
        subText.style.display = 'none';
      };

      reader.readAsDataURL(file);
    }
  });

  // Reset Form Image Preview Logic
  function resetForm() {
    const previewImage = document.getElementById('previewImage');
    const icon = document.getElementById('uploadIcon');
    const text = document.getElementById('uploadText');
    const subText = document.getElementById('uploadSubText');

    previewImage.src = '';
    previewImage.style.display = 'none';
    
    icon.style.display = 'block';
    text.style.display = 'block';
    subText.style.display = 'block';
  }
</script>

</body>
</html>