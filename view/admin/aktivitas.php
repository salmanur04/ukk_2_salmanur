 <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Aktivitas Parkir</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

.header{
    background:linear-gradient(135deg,#f39c12,#d35400);
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

/* ===== AKTIVITAS ===== */
.activity{
    display:flex;
    flex-direction:column;
    gap:15px;
}

.activity-item{
    display:flex;
    align-items:center;
    gap:15px;
    background:#fdf6ec;
    padding:15px 20px;
    border-radius:14px;
    box-shadow:0 4px 10px rgba(0,0,0,.06);
    transition:.2s;
}

.activity-item:hover{
    transform:translateX(6px);
    background:#fff1dc;
}

.activity-icon{
    width:46px;
    height:46px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    color:white;
}

.icon-masuk{ background:#2ecc71; }
.icon-keluar{ background:#e74c3c; }

.activity-info{
    flex:1;
}

.activity-info h4{
    margin:0;
    font-size:15px;
    color:#2c3e50;
}

.activity-info p{
    margin:4px 0 0;
    font-size:13px;
    color:#777;
}

.activity-time{
    font-size:12px;
    color:#999;
    white-space:nowrap;
}
</style>
</head>

<body>

<div class="header">
    <h1>🕒 Aktivitas Parkir</h1>
    <p>Log masuk & keluar kendaraan</p>
</div>

<div class="container">

<div class="card">
    <h3>📌 Aktivitas Terbaru</h3>

    <div class="activity">

        <div class="activity-item">
            <div class="activity-icon icon-masuk">⬅</div>
            <div class="activity-info">
                <h4>B 1234 ABC (Motor)</h4>
                <p>Kendaraan masuk area parkir</p>
            </div>
            <div class="activity-time">08:15</div>
        </div>

        <div class="activity-item">
            <div class="activity-icon icon-masuk">⬅</div>
            <div class="activity-info">
                <h4>B 5678 XYZ (Mobil)</h4>
                <p>Kendaraan masuk area parkir</p>
            </div>
            <div class="activity-time">09:02</div>
        </div>

        <div class="activity-item">
            <div class="activity-icon icon-keluar">➡</div>
            <div class="activity-info">
                <h4>B 1234 ABC (Motor)</h4>
                <p>Kendaraan keluar • Durasi 2 Jam</p>
            </div>
            <div class="activity-time">10:20</div>
        </div>

        <div class="activity-item">
            <div class="activity-icon icon-keluar">➡</div>
            <div class="activity-info">
                <h4>B 9999 KLM (Mobil)</h4>
                <p>Kendaraan keluar • Durasi 3 Jam</p>
            </div>
            <div class="activity-time">11:05</div>
        </div>

    </div>
</div>

</div>
</body>
</html>
