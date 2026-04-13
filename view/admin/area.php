<?php
session_start();
include_once __DIR__ . '/../../controllers/c_area.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Area Parkir</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 550px;
            background: #111827;
            padding: 35px 30px;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.45);
            border-top: 5px solid #3b82f6;
        }

        h2 {
            text-align: center;
            color: #60a5fa;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 26px;
        }

        p {
            text-align: center;
            color: #cbd5e1;
            margin-bottom: 20px;
            font-size: 14px;
        }

        form input {
            padding:8px;
            border-radius:8px;
            border:none;
            margin-right:5px;
        }

        form button {
            padding:8px 12px;
            border:none;
            border-radius:8px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn-tambah { background:#22c55e; color:white; }
        .btn-update { background:#f59e0b; color:white; }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            background: #1e293b;
            margin-bottom: 15px;
            padding: 18px;
            border-radius: 12px;
            font-weight: bold;
            color: #f8fafc;
            display: flex;
            align-items: center;
            border: 1px solid #334155;
        }

        .info-slot {
            font-size: 13px;
            color: #94a3b8;
            margin-left: 10px;
            font-weight: normal;
        }

        .badge {
            margin-left: auto;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .tersedia { background: #16a34a; color: white; }
        .penuh { background: #dc2626; color: white; }

        .action {
            margin-left: 10px;
            text-decoration: none;
            font-size: 16px;
        }

        .edit { color: #facc15; }
        .hapus { color: #ef4444; }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            color: white;
            background: #2563eb;
            padding: 13px;
            border-radius: 10px;
            font-weight: bold;
        }

        .footer-note {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Area Parkir</h2>
    <p>Status area parkir saat ini</p>

    <!-- ================= TAMBAH ================= -->
    <form method="POST">
        <input type="text" name="nama_area" placeholder="Nama Area" required>
        <input type="number" name="kapasitas" placeholder="Kapasitas" required>
        <button type="submit" name="tambah" class="btn-tambah">+ Tambah</button>
    </form>

    <!-- ================= EDIT ================= -->
    <?php if(isset($_GET['edit'])): ?>
    <form method="POST">
        <input type="hidden" name="id_area" value="<?= $_GET['edit']; ?>">
        <input type="text" name="nama_area" placeholder="Edit Nama Area" required>
        <input type="number" name="kapasitas" placeholder="Edit Kapasitas" required>
        <button type="submit" name="update" class="btn-update">Update</button>
    </form>
    <?php endif; ?>

    <ul>
        <?php foreach($data_area as $row): 
            $sisa = $row->kapasitas - $row->terisi;
            $status_class = ($sisa <= 0) ? 'penuh' : 'tersedia';
            $status_text = ($sisa <= 0) ? 'Penuh' : 'Tersedia';
        ?>
        <li>
            <?= $row->nama_area; ?>
            <span class="info-slot">(<?= $row->terisi; ?>/<?= $row->kapasitas; ?>)</span>
            <span class="badge <?= $status_class; ?>"><?= $status_text; ?></span>

            <a href="?edit=<?= $row->id_area; ?>" class="action edit">✏️</a>
            <a href="?hapus=<?= $row->id_area; ?>" class="action hapus" onclick="return confirm('Yakin hapus?')">🗑️</a>
        </li>
        <?php endforeach; ?>
    </ul>

    <a href="dasboard.php" class="btn-back">← Kembali ke Dashboard</a>
    <div class="footer-note">Sistem Monitoring Area Parkir</div>
</div>

</body>
</html>