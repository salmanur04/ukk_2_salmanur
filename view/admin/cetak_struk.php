 <?php
// ambil model langsung (bukan controller lagi)
include_once __DIR__ . '/../../models/transaksi.php';

// cek id
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

// buat objek
$model = new Transaksi();

// ambil data
$data = $model->get_by_id($id);

// cek data
if (!$data) {
    die("Data tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir #<?= $data->id_parkir ?></title>
    <style>
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 300px; 
            margin: auto; 
            border: 1px solid #eee; 
            padding: 20px; 
        }
        .header { 
            text-align: center; 
            border-bottom: 1px dashed #000; 
            padding-bottom: 10px; 
        }
        .content { 
            margin: 20px 0; 
            line-height: 1.6; 
        }
        .footer { 
            text-align: center; 
            border-top: 1px dashed #000; 
            padding-top: 10px; 
            margin-top: 20px; 
        }
        .row { 
            display: flex; 
            justify-content: space-between; 
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h2>E-PARKING</h2>
        <p>Jl. Raya Parkir No. 123<br>Struk Pembayaran</p>
    </div>

    <div class="content">
        <div class="row">
            <span>No Transaksi:</span> 
            <span>#<?= $data->id_parkir ?></span>
        </div>

        <div class="row">
            <span>Plat:</span> 
            <span><?= $data->plat_nomor ?></span>
        </div>

        <div class="row">
            <span>Jenis:</span> 
            <span><?= $data->jenis_kendaraan ?></span>
        </div>

        <hr>

        <div class="row">
            <span>Masuk:</span> 
            <span><?= date('d/m/Y H:i', strtotime($data->waktu_masuk)) ?></span>
        </div>

        <div class="row">
            <span>Keluar:</span> 
            <span><?= date('d/m/Y H:i', strtotime($data->waktu_keluar)) ?></span>
        </div>

        <div class="row">
            <span>Durasi:</span> 
            <span><?= $data->durasi_jam ?> Jam</span>
        </div>

        <hr>

        <div class="row" style="font-weight:bold;">
            <span>TOTAL:</span> 
            <span>Rp <?= number_format($data->biaya_total, 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="footer">
        <p>Terima Kasih<br>Semoga Selamat Sampai Tujuan</p>
    </div>

</body>
</html>