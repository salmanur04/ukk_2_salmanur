<?php
include_once __DIR__ . '/../models/kendaraan.php';

$kendaraan = new Kendaraan();

/* ===============================
   CREATE (TAMBAH DATA)
   =============================== */
if(isset($_POST['tambah'])){
    $plat = $_POST['plat_nomor'];
    $jenis = $_POST['jenis_kendaraan'];
    $warna = $_POST['warna'];
    $pemilik = $_POST['pemilik'];

    $kendaraan->tambahKendaraan($plat, $jenis, $warna, $pemilik);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   UPDATE (EDIT DATA)
   =============================== */
if(isset($_POST['update'])){
    $id = $_POST['id_kendaraan'];
    $plat = $_POST['plat_nomor'];
    $jenis = $_POST['jenis_kendaraan'];
    $warna = $_POST['warna'];
    $pemilik = $_POST['pemilik'];

    $kendaraan->updateKendaraan($id, $plat, $jenis, $warna, $pemilik);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   DELETE (HAPUS DATA)
   =============================== */
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    $kendaraan->hapusKendaraan($id);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   READ (TAMPIL DATA)
   =============================== */
$data_kendaraan = $kendaraan->tampil_data_kendaraan();
?>