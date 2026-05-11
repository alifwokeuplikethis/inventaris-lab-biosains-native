<?php  
require LAYOUT_PATH . "sidebar.php";
require LAYOUT_PATH . "navbar.php";
?>

<style>
    .custom-form-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    
    .text-main {
        color: #02343F !important;
    }
    
    .custom-input {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }
    
    /* Efek ketika input sedang diisi (focus) senada dengan tema lab-biosains */
    .custom-input:focus {
        border-color: #478483;
        box-shadow: 0 0 0 0.25rem rgba(71, 132, 131, 0.25);
        outline: none;
    }
    
    .custom-input-group .custom-input {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
    }
    
    .custom-addon {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid #ced4da;
        border-left: none;
        padding: 0 20px;
    }
    
    .btn-custom-submit {
        background-color: #02343F;
        border-radius: 10px;
        padding: 14px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-custom-submit:hover {
        background-color: #034a5a; /* Warna sedikit lebih terang saat di-hover */
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(2, 52, 63, 0.2) !important;
    }

    .form-label-custom {
        font-weight: 500;
        font-size: 0.95rem;
        color: #6c757d;
    }
</style>

<main class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="?action=ajukanBahan" method="POST" class="p-4 p-md-5 bg-white custom-form-card">
                
                <div class="text-center mb-5">
                    <h4 class="fw-bold text-main mb-2">Form Permintaan Bahan</h4>
                    <p class="text-muted small">Silakan lengkapi jumlah bahan yang Anda butuhkan untuk keperluan laboratorium.</p>
                </div>
                
                <div class="mb-4">
                    <label class="form-label form-label-custom">Bahan yang Diajukan</label>
                    <input type="text" class="form-control custom-input fw-bold" 
                           value="<?= htmlspecialchars($infoBahan['nama_bahan']); ?> (<?= htmlspecialchars($infoBahan['jenis']); ?>)" 
                           readonly style="background-color: #f8f9fa; color: #495057; cursor: not-allowed;">
                </div>

                <input type="hidden" name="id_bahan" value="<?= htmlspecialchars($infoBahan['id']); ?>">

                <div class="mb-4">
                    <label class="form-label form-label-custom">Jumlah yang Dibutuhkan</label>
                    <div class="input-group custom-input-group shadow-sm" style="border-radius: 10px;">
                        <input type="number" name="total_volume" class="form-control custom-input" min="1" required placeholder="Contoh: 10...">
                        <span class="input-group-text bg-white fw-bold text-main custom-addon">
                            <?= htmlspecialchars($infoBahan['satuan']); ?>
                        </span>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn w-100 fw-bold text-white shadow btn-custom-submit">
                        <i class="bi bi-send-fill me-2"></i> Kirim Pengajuan
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</main>