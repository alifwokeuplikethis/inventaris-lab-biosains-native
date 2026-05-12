<div class="modal fade" id="modalDetailBatch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> 
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 pt-1">
                <div class="row mb-4 align-items-center">
                    
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img id="mb-foto-bahan" src="https://via.placeholder.com/300x300?text=Loading..." alt="Foto Bahan" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; max-height: 280px; width: 100%;">
                    </div>
                    
                    <div class="col-md-7 ps-md-4">
                        <div class="d-flex align-items-center mb-4">
                            <h3 id="mb-nama-bahan" class="fw-bold mb-0" style="color: #02343F;">Memuat...</h3>
                            
                            <a href="#" id="mb-edit-btn" class="btn btn-sm btn-light rounded-circle ms-3 shadow-sm border d-flex align-items-center justify-content-center" title="Edit Data Master" style="width: 36px; height: 36px;">
                                <i class="bi bi-pencil-fill text-secondary"></i>
                            </a>
                        </div>
                        
                        <table class="table table-borderless table-sm mb-0 fs-6">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="width: 40%; padding-bottom: 12px;">Rumus Kimia</td>
                                    <td id="mb-rumus" style="padding-bottom: 12px;">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Merk/Katalog</td>
                                    <td id="mb-merk" style="padding-bottom: 12px;">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Satuan</td>
                                    <td id="mb-satuan" style="padding-bottom: 12px;">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-secondary" style="padding-bottom: 12px;">Total Stok</td>
                                    <td id="mb-total-stok" style="padding-bottom: 12px;"><span class="badge bg-secondary rounded-pill px-3">-</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

               <div class="p-3 rounded-4" style="background-color: #b2d3c2;">
                    <h6 class="fw-bold mb-3 ms-2" style="color: #01242c;">Rincian Stok per Lokasi</h6>
                    
                    <div class="table-responsive custom-scrollbar" style="max-height: 250px; overflow-y: auto; padding-right: 5px;">
                        <table class="table table-borderless table-sm mb-0 align-middle text-nowrap" style="background-color: transparent;">
                            
                            <thead style="position: sticky; top: 0; background-color: #b2d3c2; z-index: 2; border-bottom: 1px solid rgba(0,0,0,0.1);">
                                <tr style="color: #01242c;">
                                    <th class="fw-bold pb-2">Rak Penyimpanan</th>
                                    <th class="fw-bold pb-2">Tgl Penerimaan</th>
                                    <th class="fw-bold pb-2">Tgl Kadaluarsa</th>
                                    <th class="fw-bold pb-2 text-end">Jumlah</th>
                                </tr>
                            </thead>
                            
                            <tbody id="modalBatchBody" style="color: #1a1a1a;">
                                <tr>
                                    <td colspan="4" class="text-center py-4">Memuat data stok...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>