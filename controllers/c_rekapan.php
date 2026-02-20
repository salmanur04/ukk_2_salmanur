 <?php
include_once __DIR__ . '/../models/rekapan.php';

// buat object model
$rekapModel = new rekapan();

// ambil data hari ini
$data = $rekapModel->rekap_hari_ini();

// kalau data kosong, set default array
if (!$data) {
    $data = [
        'total_kendaraan' => 0,
        'total_motor' => 0,
        'total_mobil' => 0,
        'total_pendapatan' => 0
    ];
}

// kirim ke view
$total_kendaraan = $data['total_kendaraan'];
$total_motor     = $data['total_motor'];
$total_mobil     = $data['total_mobil'];
$total_uang      = $data['total_pendapatan'];