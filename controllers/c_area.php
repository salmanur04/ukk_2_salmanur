<?php
include_once __DIR__ . '/../models/area.php';

$area = new Area();

/* ===============================
   CREATE (TAMBAH AREA)
   =============================== */
if(isset($_POST['tambah'])){
    $nama = $_POST['nama_area'];
    $kapasitas = $_POST['kapasitas'];

    $area->tambahArea($nama, $kapasitas);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   UPDATE (EDIT AREA)
   =============================== */
if(isset($_POST['update'])){
    $id = $_POST['id_area'];
    $nama = $_POST['nama_area'];
    $kapasitas = $_POST['kapasitas'];

    $area->updateArea($id, $nama, $kapasitas);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   DELETE (HAPUS AREA)
   =============================== */
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    $area->hapusArea($id);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===============================
   READ (TAMPIL DATA)
   =============================== */
$data_area = $area->tampil_data_area();
?>