<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Bahan</title>
    <style>
        body { font-family: sans-serif; }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background: teal;
            color: white;
        }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">
    <div class="card">
        <h2>Pengajuan Pemakaian Bahan</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Jumlah Ambil</th>
                <th>Aksi</th>
            </tr>

            <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <form action="proses_pengajuan.php" method="POST">
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['satuan'] ?></td>
                    <td><?= $row['stok'] ?></td>

                    <td>
                        <input type="number" name="jumlah" required min="1">
                        <input type="hidden" name="barang_id" value="<?= $row['id'] ?>">
                    </td>

                    <td>
                        <button type="submit">Ajukan</button>
                    </td>
                </form>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>