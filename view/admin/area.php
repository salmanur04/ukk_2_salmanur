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
        * {
            box-sizing: border-box;
        }

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
            margin-bottom: 30px;
            font-size: 14px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .area-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        ul li {
            background: #1e293b;
            margin-bottom: 15px;
            padding: 18px 18px;
            border-radius: 12px;
            font-weight: bold;
            color: #f8fafc;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid #334155;
        }

        ul li:hover {
            background: #3b82f6;
            color: white;
            transform: translateX(8px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.25);
        }

        ul li::before {
            content: "📍";
            margin-right: 15px;
            font-size: 18px;
        }

        .info-slot {
            font-size: 13px;
            color: #94a3b8;
            margin-left: 10px;
            font-weight: normal;
        }

        ul li:hover .info-slot {
            color: #e0f2fe;
        }

        .badge {
            margin-left: auto;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .tersedia {
            background: #16a34a;
            color: white;
        }

        .penuh {
            background: #dc2626;
            color: white;
        }

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
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #1d4ed8;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
            transform: translateY(-2px);
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

        <ul>
            <?php foreach($data_area as $row): 
                $sisa = $row->kapasitas - $row->terisi;
                $status_class = ($sisa <= 0) ? 'penuh' : 'tersedia';
                $status_text = ($sisa <= 0) ? 'Penuh' : 'Tersedia';
            ?>
                <a href="#" class="area-link">
                    <li>
                        <?= $row->nama_area; ?>
                        <span class="info-slot">(<?= $row->terisi; ?>/<?= $row->kapasitas; ?>)</span>
                        <span class="badge <?= $status_class; ?>"><?= $status_text; ?></span>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>

        <a href="dasboard.php" class="btn-back">← Kembali ke Dashboard</a>
        <div class="footer-note">Sistem Monitoring Area Parkir</div>
    </div>

</body>
</html>