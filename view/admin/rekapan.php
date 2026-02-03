 <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekapan Parkir</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

.header{
    background:linear-gradient(135deg,#1abc9c,#16a085);
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

/* ===== REKAPAN ===== */
.rekap{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
}

.rekap-box{
    background:linear-gradient(135deg,#3498db,#2c3e50);
    color:white;
    padding:22px;
    border-radius:18px;
    text-align:center;
    position:relative;
    overflow:hidden;
}

.rekap-box::after{
    content:"";
    position:absolute;
    top:-30px;
    right:-30px;
    width:80px;
    height:80px;
    background:rgba(255,255,255,.15);
    border-radius:50%;
}

.rekap-box p{
    margin:0;
    font-size:14px;
    opacity:.9;
}

.rekap-box h2{
    margin:10px 0 0;
    font-size:30px;
}

.rekap-motor{ background:linear-gradient(135deg,#1abc9c,#16a085); }
.rekap-mobil{ background:linear-gradient(135deg,#9b59b6,#8e44ad); }
.rekap-uang{ background:linear-gradient(135deg,#f39c12,#d35400); }
</style>
</head>

<body>

<div class="header">
    <h1>📊 Rekapan Parkir</h1>
    <p>Ringkasan data kendaraan & pendapatan</p>
</div>

<div class="container">

<div class="card">
    <h3>📌 Rekap Hari Ini</h3>

    <div class="rekap">
        <div class="rekap-box">
            <p>Total Kendaraan</p>
            <h2>45</h2>
        </div>

        <div class="rekap-box rekap-motor">
            <p>Total Motor</p>
            <h2>30</h2>
        </div>

        <div class="rekap-box rekap-mobil">
            <p>Total Mobil</p>
            <h2>15</h2>
        </div>

        <div class="rekap-box rekap-uang">
            <p>Total Pendapatan</p>
            <h2>Rp 185.000</h2>
        </div>
    </div>
</div>

</div>
</body>
</html>
