<?php
// Simulasi data, nanti ini bisa diganti dengan query database berdasarkan $_GET['id']
$namaBarang = "MacBook Pro M3 - 14 Inch";
$stok = 12;
?>

<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg flex flex-col overflow-hidden max-h-[90vh]">
    
    <div class="p-4 border-b bg-gray-50 shrink-0">
      <div class="flex items-center gap-4">
        <img src="https://via.placeholder.com/60" alt="Produk" class="w-16 h-16 rounded-lg object-cover">
        <div class="flex-1">
          <h2 class="text-xl font-bold text-gray-800"><?php echo $namaBarang; ?></h2>
          <p class="text-sm text-blue-600 font-semibold">Stok: <?php echo $stok; ?> Unit</p>
        </div>
        <a href="index.php" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</a>
      </div>
    </div>

    <div class="p-6 overflow-y-auto bg-white">
      <h3 class="font-semibold text-gray-700 mb-3">Spesifikasi Lengkap</h3>
      <ul class="space-y-4 text-sm text-gray-600">
        <li>
          <span class="block font-medium text-gray-900">Chipset</span>
          Apple M3 Pro chip dengan 11‑core CPU dan 14‑core GPU.
        </li>
        <li>
          <span class="block font-medium text-gray-900">Memori</span>
          18GB Unified Memory.
        </li>
        <li>
          <span class="block font-medium text-gray-900">Deskripsi Panjang</span>
          Konten ini bisa sangat panjang untuk mengetes scroll area yang sudah Anda buat...
          (Ulangi teks ini jika perlu testing)
        </li>
      </ul>
    </div>

    <div class="p-4 border-t bg-gray-50 flex justify-end gap-3 shrink-0">
      <a href="index.php" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
        Tutup
      </a>
      <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
        Edit Barang
      </button>
    </div>
  </div>
</div>