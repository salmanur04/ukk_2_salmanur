 <?php
include_once __DIR__ . '/../models/area.php';

$area = new area();

/* ===============================
   AJAX CRUD AREA PARKIR
   =============================== */
if (isset($_POST['aksi'])) {

    header('Content-Type: application/json');

    $aksi      = $_POST['aksi'];
    $id_area   = isset($_POST['id_area']) ? trim($_POST['id_area']) : '';
    $nama_area = isset($_POST['nama_area']) ? trim($_POST['nama_area']) : '';
    $kapasitas = isset($_POST['kapasitas']) ? (int)$_POST['kapasitas'] : 0;
    $terisi    = isset($_POST['terisi']) ? (int)$_POST['terisi'] : 0;

    // validasi dasar
    if (($aksi == 'tambah' || $aksi == 'edit') && ($id_area == '' || $nama_area == '')) {
        echo json_encode([
            "status" => "error",
            "pesan"  => "ID Area dan Nama Area wajib diisi"
        ]);
        exit;
    }

    // TAMBAH
    if ($aksi == "tambah") {
        $area->tambah_area($id_area, $nama_area, $kapasitas, $terisi);
        echo json_encode([
            "status" => "success",
            "pesan"  => "Data area parkir berhasil ditambahkan"
        ]);
        exit;
    }

    // EDIT
    if ($aksi == "edit") {
        $area->edit_area($id_area, $nama_area, $kapasitas, $terisi);
        echo json_encode([
            "status" => "success",
            "pesan"  => "Data area parkir berhasil diupdate"
        ]);
        exit;
    }

    // HAPUS
    if ($aksi == "hapus") {
        if ($id_area == '') {
            echo json_encode([
                "status" => "error",
                "pesan"  => "ID Area tidak ditemukan"
            ]);
            exit;
        }

        $area->hapus_area($id_area);
        echo json_encode([
            "status" => "success",
            "pesan"  => "Data area parkir berhasil dihapus"
        ]);
        exit;
    }
}

/* ===============================
   TAMPIL DATA (UNTUK VIEW)
   =============================== */
$data_area = $area->tampil_data_area();
