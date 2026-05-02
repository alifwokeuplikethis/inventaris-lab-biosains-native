  <style>
    /* Anda bisa mengganti #478483 dengan warna ungu yang senada dengan bg-purple di sidebar jika ingin seragam */
    .navbar-style {
      background-color: #478483; 
    }
  </style>

  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm navbar-style">
    <div class="container-fluid">
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <a class="navbar-brand fw-bold text-white" href="index.html">E-Student</a>
      
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
              <li><a class="dropdown-item" href="#">Edit Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><button class="dropdown-item text-danger" onclick="window.location.href='/inventory-revisi/?action=logout'">Logout</button></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>