<?php
include_once __DIR__ . '/../../controllers/c_kendaraan.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kendaraan</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
        }

        .back-btn {
            display: inline-block;
            margin: 20px;
            background: #2563eb;
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .container {
            padding: 30px;
        }

        .form-box {
            background: #111827;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .form-box input {
            padding: 8px;
            margin: 5px;
            border-radius: 6px;
            border: none;
        }

        .form-box button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-tambah { background: #22c55e; color: white; }
        .btn-update { background: #f59e0b; color: white; }

        .table-box {
            background: #111827;
            padding: 20px;
            border-radius: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #334155;
            text-align: center;
        }

        table th {
            background: #1e293b;
            color: #60a5fa;
        }

        .action {
            text-decoration: none;
            margin: 0 5px;
            font-size: 16px;
        }

        .edit { color: #facc15; }
        .hapus { color: #ef4444; }

        .footer-note {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

<a href="dasboard.php" class="back-btn">⬅ Kembali</a>

<div class="header">
    <h1>🚗 Data Kendaraan</h1>
    <p>Kelola data kendaraan</p>
</div>

<div class="container">

    <!-- ================= TAMBAH ================= -->
    <div class="form-box">
        <form method="POST">
            <input type="text" name="plat_nomor" placeholder="Plat Nomor" required>
            <input type="text" name="jenis_kendaraan" placeholder="Jenis" required>
            <input type="text" name="warna" placeholder="Warna" required>
            <input type="text" name="pemilik" placeholder="Pemilik" required>

            <button type="submit" name="tambah" class="btn-tambah">+ Tambah</button>
        </form>
    </div>

    <!-- ================= EDIT ================= -->
    <?php if(isset($_GET['edit'])): ?>
    <div class="form-box">
        <form method="POST">
            <input type="hidden" name="id_kendaraan" value="<?= $_GET['edit']; ?>">

            <input type="text" name="plat_nomor" placeholder="Edit Plat" required>
            <input type="text" name="jenis_kendaraan" placeholder="Edit Jenis" required>
            <input type="text" name="warna" placeholder="Edit Warna" required>
            <input type="text" name="pemilik" placeholder="Edit Pemilik" required>

            <button type="submit" name="update" class="btn-update">Update</button>
        </form>
    </div>
    <?php endif; ?>

    <!-- ================= TABLE ================= -->
    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Jenis</th>
                <th>Warna</th>
                <th>Pemilik</th>
                <th>Aksi</th>
            </tr>

            <?php if (!empty($data_kendaraan)): ?>
                <?php $no = 1; ?>
                <?php foreach($data_kendaraan as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->plat_nomor ?></td>
                        <td><?= $row->jenis_kendaraan ?></td>
                        <td><?= $row->warna ?></td>
                        <td><?= $row->pemilik ?></td>
                        <td>
                            <a href="?edit=<?= $row->id_kendaraan ?>" class="action edit">✏️</a>
                            <a href="?hapus=<?= $row->id_kendaraan ?>" class="action hapus" onclick="return confirm('Yakin hapus?')">🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Data kendaraan kosong</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="footer-note">Sistem Monitoring Kendaraan Parkir</div>
</div>

</body>
</html>