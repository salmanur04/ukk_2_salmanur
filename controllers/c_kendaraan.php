<?php
include_once __DIR__ . '/../models/kendaraan.php';

$kendaraan = new kendaraan();

/* ===============================
   AJAX CRUD KENDARAAN
   =============================== */
if (isset($_POST['aksi'])) {

    header('Content-Type: application/json');

    $aksi            = $_POST['aksi'];
    $id_kendaraan    = isset($_POST['id_kendaraan']) ? trim($_POST['id_kendaraan']) : '';
    $plat_nomor      = isset($_POST['plat_nomor']) ? trim($_POST['plat_nomor']) : '';
    $jenis_kendaraan = isset($_POST['jenis_kendaraan']) ? trim($_POST['jenis_kendaraan']) : '';
    $warna           = isset($_POST['warna']) ? trim($_POST['warna']) : '';

    // validasi dasar
    if (($aksi == 'tambah' || $aksi == 'edit') && ($id_kendaraan == '' || $plat_nomor == '')) {
        echo json_encode([
            "status" => "error",
            "pesan"  => "ID Kendaraan dan Plat Nomor wajib diisi"
        ]);
        exit;
    }

    // TAMBAH
    if ($aksi == "tambah") {
        $kendaraan->tambah_kendaraan(
            $id_kendaraan,
            $plat_nomor,
            $jenis_kendaraan,
            $warna
        );

        echo json_encode([
            "status" => "success",
            "pesan"  => "Data kendaraan berhasil ditambahkan"
        ]);
        exit;
    }

    // EDIT
    if ($aksi == "edit") {
        $kendaraan->edit_kendaraan(
            $id_kendaraan,
            $plat_nomor,
            $jenis_kendaraan,
            $warna
        );

        echo json_encode([
            "status" => "success",
            "pesan"  => "Data kendaraan berhasil diupdate"
        ]);
        exit;
    }

    // HAPUS
    if ($aksi == "hapus") {
        if ($id_kendaraan == '') {
            echo json_encode([
                "status" => "error",
                "pesan"  => "ID Kendaraan tidak ditemukan"
            ]);
            exit;
        }

        $kendaraan->hapus_kendaraan($id_kendaraan);
        echo json_encode([
            "status" => "success",
            "pesan"  => "Data kendaraan berhasil dihapus"
        ]);
        exit;
    }
}

/* ===============================
   TAMPIL DATA (UNTUK VIEW)
   =============================== */
$data_kendaraan = $kendaraan->tampil_data_kendaraan();
