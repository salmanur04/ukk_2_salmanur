 <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Transaksi Parkir</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

.header{
    background:linear-gradient(135deg,#3498db,#2c3e50);
    color:white;
    padding:25px;
    border-radius:0 0 20px 20px;
}

.container{
    padding:25px;
}

.card{
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.card h3{
    margin:0 0 15px;
    color:#2c3e50;
}

/* ===== TRANSAKSI ===== */
.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#3498db;
    color:white;
    padding:14px;
    text-align:center;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

tr:hover{
    background:#f1f7ff;
}

.badge{
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    color:white;
    display:inline-block;
}

.motor{ background:#1abc9c; }
.mobil{ background:#9b59b6; }

.tarif{
    font-weight:bold;
    color:#27ae60;
}
</style>
</head>

<body>

<div class="header">
    <h1>💳 Transaksi Parkir</h1>
    <p>Data pembayaran kendaraan parkir</p>
</div>

<div class="container">

<div class="card">
    <h3>📋 Daftar Transaksi</h3>

    <div class="table-wrap">
    <table>
        <tr>
            <th>No</th>
            <th>Plat Kendaraan</th>
            <th>Jenis</th>
            <th>Durasi</th>
            <th>Tarif</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>

        <tr>
            <td>1</td>
            <td>B 1234 ABC</td>
            <td><span class="badge motor">Motor</span></td>
            <td>2 Jam</td>
            <td class="tarif">Rp 4.000</td>
            <td>02-02-2026</td>
            <td><span class="badge motor">Selesai</span></td>
        </tr>

        <tr>
            <td>2</td>
            <td>B 5678 XYZ</td>
            <td><span class="badge mobil">Mobil</span></td>
            <td>3 Jam</td>
            <td class="tarif">Rp 15.000</td>
            <td>02-02-2026</td>
            <td><span class="badge mobil">Selesai</span></td>
        </tr>

    </table>
    </div>
</div>

</div>
</body>
</html>
