<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Whitelist</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #ccc; 
    }
    /* Style khusus untuk tombol Google agar lebih rapi */
    .btn-google {
      background-color: #fff;
      color: #757575;
      border: 1px solid #ddd;
      box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
      transition: background-color .218s, border-color .218s, box-shadow .218s;
    }
    .btn-google:hover {
      box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
      background-color: #f8f9fa;
    }

    /* --- TAMBAHAN CSS BARU --- */
    /* Warna kustom untuk Footer */
    .bg-custom-dark {
      background-color: #02343F !important;
    }
    
    /* Warna kustom untuk Tombol Submit */
    .btn-custom-dark {
      background-color: #02343F;
      color: #ffffff;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-custom-dark:hover {
      background-color: #011d23; /* Warna sedikit lebih gelap saat di-hover */
      color: #ffffff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>

<section class="min-vh-100 d-flex flex-column">
  
  <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="row d-flex justify-content-center align-items-center w-100">
      
      <div class="col-12 col-md-9 col-lg-6 col-xl-5 text-center mb-5 mb-lg-0">
        <div class="position-relative d-inline-block">
          <img src="images/chest.png" class="img-fluid" alt="Chest">
          <img src="images/brown.png" class="position-absolute" style="width: 15%; bottom: 50%; left: 20%;" alt="Brown Potion">
          <img src="images/honey.png" class="position-absolute" style="width: 15%; bottom: 55%; left: 42.5%;" alt="Honey Potion">
          <img src="images/red.png" class="position-absolute" style="width: 15%; bottom: 50%; left: 65%;" alt="Red Potion">
        </div>
      </div>

      <div class="col-12 col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        
        <div class="mb-4 text-center text-lg-start">
          <h3 class="fw-bold mb-2">Masuk</h3>
          <p class="text-muted mb-4">Gunakan email yang sudah disetujui (di-ACC) oleh Admin.</p>
          
        <a href="" class="btn btn-google btn-lg w-100 d-flex align-items-center justify-content-center fw-bold rounded-pill">
          <img src="images/google.png" alt="Google Logo" style="width: 20px; margin-right: 10px;">
          Sign in with Google
        </a>
        </div>

        <div class="divider d-flex align-items-center my-4">
          <p class="text-center fw-bold mx-3 mb-0 text-muted">Belum Punya Akses?</p>
        </div>

        <form>
          <div class="mb-3">
            <h5 class="fw-bold mb-1">Daftar Whitelist</h5>
            <p class="small text-muted mb-3">Masukkan email Anda untuk meminta akses. Anda baru bisa login setelah Admin melakukan persetujuan.</p>
          </div>

          <div class="form-outline mb-4">
            <label class="form-label fw-bold" for="whitelistEmail">Alamat Email (Gmail)</label>
            <input type="email" id="whitelistEmail" class="form-control form-control-lg" placeholder="contoh@gmail.com" required />
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-custom-dark btn-lg w-100 rounded-pill" onclick="window.location.href='index.php'">Ajukan Email</button>
          </div>
        </form>

      </div>
      
    </div>
  </div>

  <div class="mt-auto d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-custom-dark">
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2024. All rights reserved.
    </div>
    <div>
      <!-- <a href="#!" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-twitter"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-google"></i></a>
      <a href="#!" class="text-white"><i class="fab fa-linkedin-in"></i></a> -->
    </div>
  </div>
  
</section>

</body>
</html>