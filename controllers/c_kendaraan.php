<?php
include_once __DIR__ . '/../models/kendaraan.php';

$kendaraan = new kendaraan();

/* ===============================
   TAMPIL DATA KENDARAAN DARI TRANSAKSI
   =============================== */
$data_kendaraan = $kendaraan->tampil_data_kendaraan();
?>