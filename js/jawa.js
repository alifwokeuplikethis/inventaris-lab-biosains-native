// Gunakan var agar tidak ada error redeclare
var table; 

// Pastikan semua library (jQuery, Bootstrap, DT) sudah siap
$(document).ready(function() {
    
    // 1. Inisialisasi DataTable dengan proteksi
    if ($('#table-dashboard').length) {
        // Hancurkan jika sudah ada inisialisasi sebelumnya (mencegah error double init)
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

    // 2. Gunakan Delegasi Event (Sangat Penting!)
    // Ini supaya event 'click' tetap nempel walau elemen belum muncul sempurna
    $(document).on('click', '.filter-status', function(e) {
        e.preventDefault();
        var val = $(this).attr('data-value'); 
        var text = $(this).text().trim();
        
        $('#filterStatusLabel').text(text);
        if(table) table.column(7).search(val).draw();
    });

    $(document).on('click', '.filter-jenis', function(e) {
        e.preventDefault();
        var val = $(this).attr('data-value');
        var text = $(this).text().trim();

        $('#filterJenisLabel').text(text);
        if(table) table.column(4).search(val).draw();
    });

    // 3. Search Global
    $(document).on('keyup', '#searchInput', function() {
        if(table) table.search(this.value).draw();
    });
});

// Fungsi Global untuk reset upload (taruh di luar ready agar bisa dipanggil HTML)
window.resetForm = function() {
  $('#previewImage').attr('src', '').hide();
  $('#uploadIcon, #uploadText, #uploadSubText').show();
};