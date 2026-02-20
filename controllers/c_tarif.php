 <?php
include_once __DIR__ . '/../models/tarif.php';

$tarif = new tarif_parkir();

/* ===== AJAX ===== */
if(isset($_POST['aksi'])){

    /* TAMBAH */
    if($_POST['aksi'] == 'tambah'){
        $tarif->tambah(
            $_POST['jenis_kendaraan'],
            $_POST['tarif_per_jam'],
            $_POST['ketentuan_waktu']
        );

        echo json_encode([
            "status"=>"success",
            "pesan"=>"Tarif berhasil ditambahkan"
        ]);
        exit;
    }

    /* EDIT */
    if($_POST['aksi'] == 'edit'){
        $tarif->edit(
            $_POST['id_tarif'],
            $_POST['jenis_kendaraan'],
            $_POST['tarif_per_jam'],
            $_POST['ketentuan_waktu']
        );

        echo json_encode([
            "status"=>"success",
            "pesan"=>"Tarif berhasil diupdate"
        ]);
        exit;
    }

    /* HAPUS */
    if($_POST['aksi'] == 'hapus'){
        $tarif->hapus($_POST['id_tarif']);

        echo json_encode([
            "status"=>"success",
            "pesan"=>"Tarif berhasil dihapus"
        ]);
        exit;
    }
}

/* ===== DATA UNTUK VIEW ===== */
$data_tarif = $tarif->tampil_data();
