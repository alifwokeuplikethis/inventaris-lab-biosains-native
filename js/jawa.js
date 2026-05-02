$(document).ready(function(){

  // =======================
  // DATATABLE (DASHBOARD)
  // =======================
  if ($('#table-dashboard').length) {
    const table = $('#table-dashboard').DataTable({
      pageLength: 8,
      lengthChange: false,
      info: true,
      language: {
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ bahan",
        "infoEmpty": "Tidak ada data bahan",
        "infoFiltered": "(disaring dari total _MAX_ bahan)",
        "zeroRecords": "Bahan tidak ditemukan",
        "paginate": {
          "next": "›",
          "previous": "‹"
        }
      }
    });

    // Search
    $('#searchInput').on('keyup', function(){
      table.search(this.value).draw();
    });

    // Filter Jenis
    $('.filter-item').on('click', function(e){
      e.preventDefault();
      let value = $(this).data('value');
      let text = $(this).text();

      $('#filterText').text(text);
      table.column(3).search(value).draw();
    });
  }

  // =======================
  // TAMBAH BAHAN (UPLOAD)
  // =======================
  // if ($('#fileInput').length) {

  //   $('#fileInput').on('change', function(event){
  //     const file = event.target.files[0];

  //     if (!file) return;

  //     // 🔒 Validasi size (2MB)
  //     if (file.size > 2 * 1024 * 1024) {
  //       alert("Ukuran maksimal 2MB!");
  //       $(this).val('');
  //       return;
  //     }

  //     // 🔒 Validasi type
  //     const allowed = ['image/jpeg', 'image/png', 'image/webp'];
  //     if (!allowed.includes(file.type)) {
  //       alert("Format harus JPG, PNG, WEBP!");
  //       $(this).val('');
  //       return;
  //     }

  //     const reader = new FileReader();

  //     reader.onload = function(e){
  //       $('#previewImage')
  //         .attr('src', e.target.result)
  //         .show();

  //       $('#uploadIcon, #uploadText, #uploadSubText').hide();
  //     };

  //     reader.readAsDataURL(file);
  //   });

  // }

});


// =======================
// GLOBAL FUNCTION (WAJIB GLOBAL)
// =======================
window.resetForm = function() {
  $('#previewImage').attr('src', '').hide();
  $('#uploadIcon, #uploadText, #uploadSubText').show();
};