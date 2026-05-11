<div class="modal fade" id="modalDetailRequest" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content shadow-lg" style="border-radius: 18px; border: none;">
      
      <div class="modal-header border-0 pb-0 pt-4 px-4">
        <div>
          <h5 class="modal-title fw-bold text-main">Detail Pengajuan Bahan</h5>
          <p class="text-muted mb-0">Teknisi: <strong id="modalNamaTeknisi">...</strong></p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body p-4">
        <div class="table-responsive border rounded-3">
          <table class="table table-hover align-middle mb-0" style="width: 100%;">
            <thead style="background: #f8faf9; font-size: 0.85rem; color: #495057;">
  <tr>
    <th width="50" class="ps-4 py-3">No</th>
    <th>Nama Bahan</th>
    <th>Jumlah Diminta</th>
    <th>Rincian Pengambilan Stok (FEFO)</th>
    <th>Status</th>
  </tr>
</thead>
            <tbody id="modalDetailBody">
              <tr>
                <td colspan="6" class="text-center py-5">
                  <div class="spinner-border text-secondary" role="status"></div>
                  <div class="mt-2 text-muted">Memuat data...</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="modal-footer border-0 pt-0 px-4 pb-4">
        <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius:10px;" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>