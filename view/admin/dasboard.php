<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Parkiran</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #ecf0f1;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            width: 220px;
            height: 100vh;
            background: linear-gradient(180deg, #2c3e50, #1a252f);
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            padding-left: 30px;
        }

        /* ===== HEADER ===== */
        .header {
            margin-left: 220px;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header h1 {
            margin: 0;
            color: #2c3e50;
        }

        /* ===== CONTENT ===== */
        .container {
            margin-left: 220px;
            padding: 20px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* ===== LINK CARD (HILANGKAN GARIS BAWAH) ===== */
        .card-link {
            text-decoration: none;
            color: inherit;
            display: inline-block;
        }

        .card {
            width: 230px;
            padding: 25px;
            border-radius: 15px;
            color: white;
            transition: 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .card span {
            font-size: 35px;
        }

        .card h3 {
            margin: 15px 0 5px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
        }

        /* ===== WARNA CARD ===== */
        .card.blue { background: linear-gradient(135deg, #3498db, #2980b9); }
        .card.green { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .card.orange { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .card.purple { background: linear-gradient(135deg, #9b59b6, #8e44ad); }

        .footer {
            margin-left: 220px;
            text-align: center;
            padding: 15px;
            color: #888;
        }
    </style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <h2>🅿 Parkiran</h2>
    <a> Dashboard</a>
    <a href="aktivitas.php"> Data aktivitas</a>
    <a href="transaksi.php">⬅ Transaksi</a>
    <a href="rekapan.php">📄 Rekapan</a>
</div>

<!-- ===== HEADER ===== -->
<div class="header">
    <h1>Dashboard Parkiran</h1>
    <p>Selamat datang di sistem parkir</p>
</div>

<!-- ===== CONTENT ===== -->
<div class="container">
    <div class="cards">

        <a href="user.php" class="card-link">
            <div class="card blue">
                <span class="w-4 h-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/></svg></span>
                <h3>User</h3>
                <p>-</p>
            </div>
        </a>

        <a href="tarif.php" class="card-link">
            <div class="card green">
                <span>💰</span>
                <h3>Tarif Parkir</h3>
                <p>-</p>
            </div>
        </a>

        <a href="area.php" class="card-link">
            <div class="card orange">
                <span>⭕</span>
                <h3>Area Parkir</h3>
                <p>-</p>
            </div>
        </a>

        <a href="kendaraan.php" class="card-link">
            <div class="card purple">
                <span>🚗</span>
                <h3>Kendaraan</h3>
                <p>-</p>
            </div>
        </a>

    </div>
</div>

<!-- ===== FOOTER ===== -->
<div class="footer">
    © 2026 Sistem Parkiran
</div>

</body>
</html>
