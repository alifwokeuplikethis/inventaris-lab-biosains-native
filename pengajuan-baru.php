<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan Bahan</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6f8;
}

/* Sidebar */
.sidebar {
    width: 230px;
    height: 100vh;
    background: #3b7d7d;
    color: white;
    position: fixed;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 30px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar li {
    padding: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    border-radius: 5px;
}

.sidebar li:hover {
    background: rgba(255,255,255,0.2);
}

/* Content */
.content {
    margin-left: 250px;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card {
    margin-top: 20px;
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.table th {
    text-align: left;
    padding: 12px;
    background: #e9ecef;
}

.table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

input[type="number"] {
    width: 70px;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-ajukan {
    background: #2d9cdb;
    color: white;
}

.btn-ajukan:hover {
    background: #238ac4;
}

.status {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.tersedia {
    background: #d4edda;
    color: #155724;
}
</style>
</head>
<body>

<div class="sidebar">
    <h2>LAB-BIOSAINS</h2>
    <ul>
        <li>Dashboard</li>
        <li><b>Pengajuan</b></li>
        <li>Kadaluwarsa</li>
        <li>Laporan</li>
    </ul>
</div>

<div class="content">
    <div class="header">
        <h2>Pengajuan Pemakaian Bahan</h2>
        <input type="text" placeholder="Telusuri...">
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Jumlah Ambil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Data akan diisi JS -->
            </tbody>
        </table>
    </div>
</div>

<script>
// Dummy data (nanti ganti dari backend)
const dataBarang = [
    { id: 1, nama: 'Clorin', satuan: 'ml', jenis: 'Gas', stok: 1000 },
    { id: 2, nama: 'Alkohol', satuan: 'ml', jenis: 'Cair', stok: 500 }
];

const tableBody = document.getElementById('tableBody');

function renderTable() {
    tableBody.innerHTML = '';

    dataBarang.forEach((item, index) => {
        tableBody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.nama}</td>
                <td>${item.satuan}</td>
                <td>${item.jenis}</td>
                <td>${item.stok}</td>
                <td><span class="status tersedia">Tersedia</span></td>
                <td>
                    <input type="number" id="jumlah-${item.id}" min="1">
                </td>
                <td>
                    <button class="btn-ajukan" onclick="ajukan(${item.id})">Ajukan</button>
                </td>
            </tr>
        `;
    });
}

function ajukan(id) {
    const jumlah = document.getElementById(`jumlah-${id}`).value;

    if (!jumlah || jumlah <= 0) {
        alert('Masukkan jumlah yang valid!');
        return;
    }

    alert(`Pengajuan dikirim!\nBarang ID: ${id}\nJumlah: ${jumlah}`);

    // nanti ganti ke fetch / ajax ke backend PHP
}

renderTable();
</script>

</body>
</html>
