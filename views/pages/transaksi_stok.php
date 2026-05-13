<?php  

require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>
<style>
  body { 
      background: #f5f7f6; 
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
    }
    .text-main { color: #02343F; }
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
}

.btn-tambah {
  background-color: #2b6766;
  color: #ffffff;
  font-weight: 600;
  border: none;
  transition: all 0.3s ease;
}
.btn-tambah:hover {
  background-color: #20504f;
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(43, 103, 102, 0.2);
}

.btn-toggle {
  background-color: #e6efee;
  border: none;
  color: #2b6766;
  padding: 0.5rem 1.5rem;
  border-radius: 50px;
  font-weight: 500;
  transition: all 0.3s ease;
}
.btn-toggle.active {
  background-color: #2b6766;
  color: white;
  box-shadow: 0 4px 10px rgba(43,103,102,0.2);
}

/* Info Box */
.info-box {
  background: #eef5f4;
  border-radius: 10px;
  padding: 15px;
}
</style>

<main class="py-4 ">
<div class="container-fluid px-4">

<section class="p-4 shadow-sm" style="background-color:#2b6766; border-radius:20px;">
 <section class="p-3 shadow-sm mb-4 d-flex justify-content-between align-items-center" style="background-color: #ffffff; border-radius: 15px;">
      <div>
        <h2 class="mb-0 fw-bold" style="color: #02343F; font-size: 1.4rem;">
          <i class="fa fa-plus-circle me-2 text-secondary opacity-50"></i>Transaksi Stok
        </h2>
      </div>
      <div class="text-secondary fs-5 d-none d-sm-block">
        <i class="fa fa-angle-double-right opacity-50"></i>
        <i class="fa fa-home ms-2" style="color: #2b6766;"></i>
      </div>
    </section>
<div class="card border-0 p-4" style="border-radius:12px;background:#f8faf9;">

<!-- INFO BARANG -->
<div class="info-box mb-4">
  <div class="row">
    <div class="col-md-6">
      <strong>Nama Barang:</strong> <?= $infoBahan['nama_bahan']; ?><br>
      <strong>Kode:</strong> <?= $infoBahan['merk']; ?>
    </div>
    <div class="col-md-6 text-md-end">
      <strong>Stok Saat Ini:</strong> 
      <span id="stokText" class="fw-bold text-success"><?php
      foreach ($data as $d) {
        if ($d['id'] == $id_bahan) {
            echo $d['total_volume'];
        }
    }
    ?> ml</span>
    </div>
  </div>
</div>

<!-- TOGGLE -->
<div class="d-flex mb-4">
  <button type="button" class="btn btn-toggle active me-2" id="btnTambah">Tambah</button>
  <button type="button" class="btn btn-toggle" id="btnKurangi">Kurangi</button>
</div>

<form id="formStok" method="POST" action="?action=prosesStok&id_bahan=<?= $_GET['id_bahan']; ?>">

<input type="hidden" name="aksi" id="aksi" value="tambah">

<div class="row">

<div class="col-md-6">

<!-- TAMBAH -->
<div id="formTambah">
  <label class="form-label small text-secondary">Jumlah Botol Masuk</label>
  <input type="number" name="qty" class="form-control input-custom mb-3">

  <label class="form-label small text-secondary">Tanggal Penerimaan</label>
  <input type="date" name="tgl_penerimaan" class="form-control input-custom">

  <label class="form-label small text-secondary">Tanggal Kadaluarsa</label>
  <input type="date" name="tgl_kadaluarsa" class="form-control input-custom">
  <label class="form-label fw-semibold text-secondary small">Lokasi / Rak Penyimpanan</label>
                  <select class="form-select input-custom" name="rak">
                    <option value="" selected disabled>Pilih lokasi rak</option>
                    <option value="Lemari Asam">Lemari Asam - A1</option>
                    <option value="Rak Reagen">Rak Reagen - B2</option>
                    <option value="Gudang Bawah">Gudang Bawah - C1</option>
                  </select>
</div>

<!-- KURANGI -->
<div id="formKurangi" style="display:none;">
  <label class="form-label small text-secondary">Jumlah Volume Keluar</label>
  <input type="number" name="jumlah_keluar" class="form-control input-custom mb-3">
<!-- 
  <label class="form-label small text-secondary">Alasan</label>
  <input type="text" name="alasan" class="form-control input-custom" placeholder="Contoh: Praktikum"> -->
</div>

</div>

</div>
<input type="hidden" name="id_bahan" value="<?= $_GET['id_bahan']; ?>">

<div class="d-flex justify-content-end mt-4 pt-3" style="border-top:1px solid #eef2f0;">
  <button type="button" id="formBtnKurang" class="btn btn-tambah px-4 py-2 rounded-pill d-none" onclick="previewStok()">
  <i class="fa fa-save me-2"></i>Simpan
</button>
  <button type="submit" id="formBtnTambah" class="btn btn-tambah px-4 py-2 rounded-pill">
  <i class="fa fa-save me-2"></i>Simpan
</button>
</div>

</form>
</div>
</section>
</div>
</main>

<script>
  let lastPreviewData = [];
function previewStok() {

    const form = document.getElementById('formStok');
    const formData = new FormData(form);

    const aksi = document.getElementById('aksi').value;

    console.log("AKSI:", aksi);

    // ➕ TAMBAH = langsung submit
    if (aksi === 'tambah') {
        form.submit();
        return;
    }

    // ➖ KURANG = preview dulu
fetch('?action=previewKurangiStok', {
    method: 'POST',
    body: formData
})
.then(res => {
    console.log("RAW RESPONSE:", res);
    return res.json(); // 🔥 WAJIB RETURN
})
.then(res => {
    lastPreviewData = res.data;
    console.log(res);

    if (res.status === 'error') {
        alert(res.message);
        return;
    }

    let html = `<ul class="list-group">`;

    res.data.forEach(item => {
        html += `
            <li class="list-group-item">
                Rak <b>${item.rak}</b> → ${item.diambil} ml
                <small class="text-muted">(exp: ${item.tgl_kadaluarsa})</small>
            </li>
        `;
    });

    html += `</ul>`;

      document.getElementById('previewBody').innerHTML = html;

      const modal = new bootstrap.Modal(
          document.getElementById('previewModal')
      );

      modal.show();
      document.getElementById('confirmBtn').onclick = function () {
      form.submit();
  };
});
}

const btnTambah = document.getElementById('btnTambah');
const btnKurangi = document.getElementById('btnKurangi');

const formBtnTambah = document.getElementById("formBtnTambah");
const formBtnKurang = document.getElementById("formBtnKurang");
const formTambah = document.getElementById('formTambah');
const formKurangi = document.getElementById('formKurangi');
const aksi = document.getElementById('aksi');

btnTambah.onclick = () => {

  btnTambah.classList.add('active');
  btnKurangi.classList.remove('active');

  formBtnTambah.classList.remove('d-none');
  formBtnKurang.classList.add('d-none');

  formTambah.style.display = 'block';
  formKurangi.style.display = 'none';

  aksi.value = 'tambah';
}

btnKurangi.onclick = () => {

  btnKurangi.classList.add('active');
  btnTambah.classList.remove('active');

  formBtnTambah.classList.add('d-none');
  formBtnKurang.classList.remove('d-none');

  formTambah.style.display = 'none';
  formKurangi.style.display = 'block';

  aksi.value = 'kurangi';
}
</script>
<?php
include "Modal/modalPreview.php";
?>