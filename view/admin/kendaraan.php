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
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            color: white;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,.25);
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header p {
            margin-top: 8px;
            color: #dbeafe;
            font-size: 15px;
        }

        .container {
            padding: 30px;
        }

        .table-box {
            background: #111827;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,.3);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        table th, table td {
            padding: 14px 12px;
            border-bottom: 1px solid #334155;
            text-align: center;
        }

        table th {
            background: #1e293b;
            color: #60a5fa;
            font-size: 14px;
            text-transform: uppercase;
        }

        table tr:hover {
            background: rgba(59, 130, 246, 0.08);
        }

        .status-masuk {
            background: #16a34a;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-keluar {
            background: #dc2626;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #cbd5e1;
            padding: 20px;
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

    <a href="dasboard.php" class="back-btn">⬅ Kembali</a>

    <div class="header">
        <h1>🚗 Data Kendaraan</h1>
        <p>Daftar kendaraan berdasarkan transaksi parkir</p>
    </div>

    <div class="container">
        <div class="table-box">
            <table>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                </tr>

                <?php if (!empty($data_kendaraan)): ?>
                    <?php $no = 1; ?>
                    <?php foreach($data_kendaraan as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row->plat_nomor) ?></td>
                            <td><?= htmlspecialchars($row->jenis_kendaraan) ?></td>
                            <td><?= htmlspecialchars($row->waktu_masuk) ?></td>
                            <td>
                                <?= !empty($row->waktu_keluar) ? htmlspecialchars($row->waktu_keluar) : '-' ?>
                            </td>
                            <td>
                                <?php if(strtolower($row->status) == 'masuk'): ?>
                                    <span class="status-masuk">Masuk</span>
                                <?php else: ?>
                                    <span class="status-keluar">Keluar</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty">Data kendaraan belum tersedia</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <div class="footer-note">Sistem Monitoring Kendaraan Parkir</div>
    </div>

</body>
</html>