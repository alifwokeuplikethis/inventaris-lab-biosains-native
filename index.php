<!DOCTYPE html>
<html lang="en">



<body>

<?php
include "navbar.php";
include "sidebar.php";

?>



<!-- dashboard main -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <section class="p-3 shadow-sm" style="background-color: #2b6766; border-radius: 15px;">
      
      <div class="card border-0" style="border-radius: 12px; overflow: hidden;">
        
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4">
          <h2 class="mb-0 fw-bold" style="color: #a06b4d; font-size: 24px;">Dashboard</h2>
          
          <div class="d-flex align-items-center gap-3">
            <div class="position-relative">
              <input type="text" id="dummySearch" class="form-control rounded-pill border-0 px-4 py-2" 
                     placeholder="Telusuri..." style="background-color: #e2e7e3; width: 250px;">
              <i class="fa fa-search position-absolute" style="right: 15px; top: 12px; color: #777;"></i>
            </div>
            <div class="text-secondary fs-4 d-flex align-items-center">
              <i class="fa fa-angle-double-right opacity-50" style="font-size: 1.2rem;"></i>
              <i class="fa fa-home ms-2"></i>
            </div>
          </div>
        </div>

        <div class="card-body p-4 pt-0">
          <div class="table-responsive" style="max-height: 450px; overflow-y: auto; border-radius: 8px;">
            <table class="table align-middle border-0 mb-0">
              <thead class="sticky-top" style="z-index: 10;">
                <tr style="background-color: #d7e0d8;">
                  <th class="py-3 ps-3">No</th>
                  <th>Nama Barang</th>
                  <th>Satuan</th>
                  <th>Jenis</th>
                  <th>Foto Bahan</th>
                  <th>Total Kuantitas</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              
              <tbody class="bg-white">
                <tr>
                  <td class="ps-3">1.</td>
                  <td class="fw-semibold">Clorin</td>
                  <td>ml</td>
                  <td>gas</td>
                  <td><div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="fa fa-flask text-muted"></i></div></td>
                  <td>1000</td>
                  <td><span class="badge bg-success rounded-pill px-3">TERSEDIA</span></td>
                  <td>
                    <div class="d-flex gap-2 justify-content-center">
                      <button class="btn btn-primary btn-sm rounded-pill px-3">Detail</button>
                      <button class="btn btn-info btn-sm text-white rounded-pill px-3">Stok</button>
                      <button class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
                    </div>
                  </td>
                </tr>
                
                <tr>
                  <td class="ps-3">2.</td>
                  <td class="fw-semibold">Cesium Klorida</td>
                  <td>gram</td>
                  <td>padat</td>
                  <td><div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="fa fa-flask text-muted"></i></div></td>
                  <td>0</td>
                  <td><span class="badge bg-danger rounded-pill px-3">HABIS</span></td>
                  <td>
                    <div class="d-flex gap-2 justify-content-center">
                      <button class="btn btn-primary btn-sm rounded-pill px-3">Detail</button>
                      <button class="btn btn-info btn-sm text-white rounded-pill px-3">Stok</button>
                      <button class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="ps-3">3.</td>
                  <td class="fw-semibold">Asam Sulfat</td>
                  <td>liter</td>
                  <td>cair</td>
                  <td><div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="fa fa-flask text-muted"></i></div></td>
                  <td>500</td>
                  <td><span class="badge bg-success rounded-pill px-3">TERSEDIA</span></td>
                  <td>
                    <div class="d-flex gap-2 justify-content-center">
                      <button class="btn btn-primary btn-sm rounded-pill px-3">Detail</button>
                      <button class="btn btn-info btn-sm text-white rounded-pill px-3">Stok</button>
                      <button class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
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
<!-- end of dashboard main -->






  <script>
    $(document).ready(function () {
      $('#datatable').DataTable({
        paging: false,
        info: true,
        dom: 'Bfrtip',
        select: true,
        pageLength: 5,
        recordsTotal: 10,
      });
    });
  </script>
</body>

</html>