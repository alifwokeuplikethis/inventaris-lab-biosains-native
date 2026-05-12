// Gunakan var agar tidak ada error redeclare
var table; 

// Fungsi Global taruh di luar
function formatDate(dateString) {
    if (!dateString) return '-';
    const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
    let d = new Date(dateString);
    return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
}

window.resetForm = function() {
    $('#previewImage').attr('src', '').hide();
    $('#uploadIcon, #uploadText, #uploadSubText').show();
};

// ==========================================
// KODE YANG BERJALAN SAAT HALAMAN DILOAD
// ==========================================
$(document).ready(function() {
    
    // 1. Inisialisasi DataTable
    if ($('#table-dashboard').length) {
        if ($.fn.DataTable.isDataTable('#table-dashboard')) {
            $('#table-dashboard').DataTable().destroy();
        }

        table = $('#table-dashboard').DataTable({
            pageLength: 8,
            lengthChange: false,
            info: true,
            language: {
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": { "next": "›", "previous": "‹" }
            }
        });
    }

    // 2. Filter Tabel
    $(document).on('click', '.filter-status', function(e) {
        e.preventDefault();
        var val = $(this).attr('data-value'); 
        $('#filterStatusLabel').text($(this).text().trim());
        if(table) table.column(7).search(val).draw();
    });

    $(document).on('click', '.filter-jenis', function(e) {
        e.preventDefault();
        var val = $(this).attr('data-value');
        $('#filterJenisLabel').text($(this).text().trim());
        if(table) table.column(4).search(val).draw();
    });

    $(document).on('keyup', '#searchInput', function() {
        if(table) table.search(this.value).draw();
    });

    // ==========================================
    // 3. FUNGSI KLIK MODAL DETAIL BATCH (DIPERBAIKI)
    // ==========================================
    // Menggunakan event delegation supaya tetap jalan di halaman 2 datatable
$(document).on('click', '.btn-view-batch', function(e) {
    e.preventDefault(); 
    
    const idBahan = $(this).data('id');
    console.log("Tombol mata berhasil diklik! ID Bahan:", idBahan);
        
    $('#modalDetailBatch').modal('show');
    $('#mb-nama-bahan').text('Memuat...');
    $('#mb-rumus, #mb-merk, #mb-satuan').text('-');
    $('#mb-total-stok').html('<span class="badge bg-secondary rounded-pill px-3">...</span>');
    $('#mb-foto-bahan').attr('src', 'https://via.placeholder.com/300x300?text=Loading...');
    $('#modalBatchBody').html('<tr><td colspan="4" class="text-center py-4"><div class="spinner-border text-secondary spinner-border-sm"></div> Memuat stok...</td></tr>');

    $.ajax({
        url: '?action=detailBatchModal&id_bahan=' + idBahan,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.status === 'success') {
                
                let info = response.info;
                let batch = response.batch;

                // ISI DATA MASTER
                $('#mb-nama-bahan').text(info.nama_bahan || '-');
                $('#mb-rumus').text(info.rumus || '-');
                $('#mb-merk').text(info.merk || '-');
                $('#mb-satuan').text(info.satuan || '-');
                
                $('#mb-edit-btn').attr('href', '?action=editBahan&id=' + info.id);

                if (info.foto_bahan) {
                    $('#mb-foto-bahan').attr('src', './images/uploads/' + info.foto_bahan); 
                } else {
                    $('#mb-foto-bahan').attr('src', 'https://via.placeholder.com/300x300?text=No+Image');
                }

                // 👇 HITUNG TOTAL STOK KESELURUHAN 👇
                let totalVolume = 0;
                batch.forEach(function(b) {
                    totalVolume += parseFloat(b.volume) || 0;
                });

                if(totalVolume > 0) {
                    // Pakai badge hijau kalau ada stok
                    $('#mb-total-stok').html(`<span class="badge bg-success rounded-pill px-3">${totalVolume} ${info.satuan}</span>`);
                } else {
                    // Pakai badge merah kalau kosong
                    $('#mb-total-stok').html(`<span class="badge bg-danger rounded-pill px-3">0 ${info.satuan}</span>`);
                }

                // 👇 RENDER TABEL STOK 👇
                let batchHtml = '';
                if(batch.length === 0) {
                    batchHtml = '<tr><td colspan="4" class="text-center py-4 fw-bold text-danger">Stok Kosong</td></tr>';
                } else {
                    let today = new Date();
                    today.setHours(0,0,0,0);

                    batch.forEach(function(b) {
                        let edDate = new Date(b.tgl_kadaluarsa);
                        let isExpired = (edDate < today);
                        let edClass = isExpired ? 'text-danger fw-medium' : '';
                        
                        // Menampilkan nama rak (kalau kosong tampilkan strip)
                        let namaRak = b.rak ? b.rak : '-';

                        batchHtml += `
                            <tr>
                                <td class="py-2 fw-bold text-uppercase" style="color: #02343F;">${namaRak}</td>
                                <td class="py-2">${formatDate(b.tgl_penerimaan)}</td>
                                <td class="py-2 ${edClass}">${formatDate(b.tgl_kadaluarsa)}</td>
                                <td class="py-2 text-end fw-bold">${b.volume} <span class="fw-normal" style="font-size:0.85em">${info.satuan}</span></td>
                            </tr>
                        `;
                    });
                }
                $('#modalBatchBody').html(batchHtml);

            } else {
                $('#modalBatchBody').html(`<tr><td colspan="4" class="text-center text-danger py-4">${response.message}</td></tr>`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            $('#modalBatchBody').html('<tr><td colspan="4" class="text-center text-danger py-4">Gagal memuat data dari server.</td></tr>');
        }
    });
});


// FUNGSI HAPUS BAHAN
$(document).on('click', '.btn-hapus', function(e) {
    e.preventDefault();
    
    const idBahan = $(this).data('id');
    
    // Tampilkan peringatan konfirmasi bawaan browser
    if (confirm('⚠️ PERINGATAN!\n\nApakah Anda yakin ingin menghapus bahan ini?\nSemua data stok, riwayat request, dan foto yang terkait dengan bahan ini akan dihapus permanen!')) {
        
        // Jika user klik "OK", jalankan AJAX
        $.ajax({
            url: '?action=deleteBahan',
            type: 'POST', // Gunakan POST untuk aksi menghapus/mengubah data
            data: { id_bahan: idBahan },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Berhasil! Data bahan dan stoknya telah dihapus.');
                    location.reload(); // Refresh halaman untuk memperbarui tabel
                } else {
                    alert('Gagal menghapus: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alert('Terjadi kesalahan pada server saat mencoba menghapus data.');
            }
        });
    }
});

}); // <-- Penutup document.ready