 <?php
include_once __DIR__ . '/../../controllers/c_rekapan.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekapan Parkir</title>

<style>
body{
    margin:0;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family:'Segoe UI',sans-serif;
}

.header{
    background: linear-gradient(135deg,#2c5364,#203a43);
    color:white;
    padding:25px;
}

.container{
    padding:25px;
}

/* tombol kembali */
.btn-kembali{
    display:inline-block;
    background: linear-gradient(135deg,#2c5364,#203a43);
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
    transition:.3s;
    box-shadow:0 5px 15px rgba(0,0,0,.2);
    margin-bottom:20px;
}

.btn-kembali:hover{
    background: linear-gradient(135deg,#3498db,#2c5364);
    transform:translateY(-2px);
}

.card{
    background:white;
    border-radius:10px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
}

.card h3{
    margin:0 0 20px;
    color:#2c5364;
}

.rekap{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.rekap-box{
    background: linear-gradient(135deg,#2c5364,#203a43);
    color:white;
    padding:25px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
    transition:.3s;
}

.rekap-box:hover{
    transform:translateY(-5px);
}

.rekap-box p{
    margin:0;
    font-size:14px;
    opacity:.8;
}

.rekap-box h2{
    margin:10px 0 0;
    font-size:32px;
}

.rekap-motor{
    background: linear-gradient(135deg,#3498db,#2c5364);
}

.rekap-mobil{
    background: linear-gradient(135deg,#8e44ad,#2c5364);
}

.rekap-uang{
    background: linear-gradient(135deg,#16a085,#2c5364);
}
</style>
</head>

<body>

<div class="header">
    <!-- Tombol Kembali -->
    <a href="dasboard.php" class="btn-kembali">⬅ Kembali </a>

    <h1>📊 Rekapan Parkir</h1>
    <p>Ringkasan data kendaraan & pendapatan hari ini</p>
</div>

<div class="container">


    <div class="card">
        <h3>📌 Rekap Hari Ini (<?= date('d-m-Y') ?>)</h3>

        <div class="rekap">
            <div class="rekap-box">
                <p>Total Kendaraan</p>
                <h2><?= $total_kendaraan ?></h2>
            </div>

            <div class="rekap-box rekap-motor">
                <p>Total Motor</p>
                <h2><?= $total_motor ?></h2>
            </div>

            <div class="rekap-box rekap-mobil">
                <p>Total Mobil</p>
                <h2><?= $total_mobil ?></h2>
            </div>

            <div class="rekap-box rekap-uang">
                <p>Total Pendapatan</p>
                <h2>Rp <?= number_format($total_uang,0,',','.') ?></h2>
            </div>
        </div>
    </div>
</div>

</body>
</html>