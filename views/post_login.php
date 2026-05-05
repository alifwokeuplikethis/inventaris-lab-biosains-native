<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lengkapi Data Pengguna</title>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .bg-custom-dark { background-color: #02343F !important; }

    .btn-custom-dark {
      background-color: #02343F;
      color: #fff;
      border: none;
      transition: 0.3s ease;
    }
    .btn-custom-dark:hover {
      background-color: #011d23;
      color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .card-custom {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
  </style>
</head>

<body class="bg-light">

<?php if( isset($_SESSION['success'])):?>
  <script>
Swal.fire({
    icon: 'success',
    title: 'Telah Disetujui!',
    text: '<?= $_SESSION['success']; ?>',
    showConfirmButton: false,
    timer: 5000, // 2 detik
    timerProgressBar: true
})
</script>
<?php unset($_SESSION['success']);?>
<?php endif;?>

<section class="min-vh-100 d-flex align-items-center justify-content-center">

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-12 col-md-8 col-lg-6">

        <div class="card card-custom p-4">

          <div class="text-center mb-4">
            <h3 class="fw-bold" style="color:#02343F;">
              <i class="fa-solid fa-user-pen me-2"></i>
              Lengkapi Data
            </h3>
            <p class="text-muted mb-0">Tambahkan data diri Anda sebelum lanjut menggunakan sistem</p>
          </div>

          <form method="POST" action="/inventory-revisi/?action=save_profile">
            <!-- No Telp -->
            <div class="mb-3">
              <label class="form-label fw-bold">No Telepon</label>
              <input type="text" name="no_telp" class="form-control form-control-lg rounded-pill" placeholder="08xxxxxxxxxx" required>
            </div>

            <!-- Gender -->
            <div class="mb-3">
              <label class="form-label fw-bold">Gender</label>
              <select name="gender" class="form-control form-control-lg rounded-pill" required>
                <option value="">-- Pilih Gender --</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
              <label class="form-label fw-bold">Alamat</label>
              <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..." required></textarea>
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-custom-dark btn-lg w-100 rounded-pill">
              Simpan & Lanjut
            </button>

          </form>

        </div>

      </div>

    </div>
  </div>

</section>

</body>
</html>