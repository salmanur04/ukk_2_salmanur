 <?php
include_once __DIR__ . '/../models/aktivitas.php';

$aktivitas = new aktivitas();

/* ===============================
   AJAX CRUD LOG AKTIVITAS
   =============================== */
if (isset($_POST['aksi'])) {

    header('Content-Type: application/json');

    $aksi            = $_POST['aksi'];
    $id_log          = isset($_POST['id_log']) ? trim($_POST['id_log']) : '';
    $user            = isset($_POST['user']) ? trim($_POST['user']) : '';
    $role            = isset($_POST['role']) ? trim($_POST['role']) : '';
    $aktivitas_desc  = isset($_POST['aktivitas']) ? trim($_POST['aktivitas']) : '';
    $waktu_aktivitas = isset($_POST['waktu_aktivitas']) ? trim($_POST['waktu_aktivitas']) : date("Y-m-d H:i:s");

    // Validasi dasar: ID, user, dan aktivitas wajib diisi untuk tambah/edit
    if (($aksi == 'tambah' || $aksi == 'edit') && ($id_log == '' || $user == '' || $aktivitas_desc == '')) {
        echo json_encode([
            "status" => "error",
            "pesan"  => "ID Log, User, dan Aktivitas wajib diisi"
        ]);
        exit;
    }

    switch ($aksi) {
        case 'tambah':
            // Tambah data aktivitas
            $aktivitas->tambah_aktivitas($id_log, $user, $role, $aktivitas_desc, $waktu_aktivitas);

            // Tambah log otomatis: user menambah aktivitas
            $log_id = uniqid('log_');
            $aktivitas->tambah_aktivitas(
                $log_id,
                $user,
                $role,
                "Tambah Data Aktivitas (ID: $id_log)",
                date("Y-m-d H:i:s")
            );

            echo json_encode([
                "status" => "success",
                "pesan"  => "Data aktivitas berhasil ditambahkan"
            ]);
            break;

        case 'edit':
            // Edit data aktivitas
            $aktivitas->edit_aktivitas($id_log, $user, $role, $aktivitas_desc, $waktu_aktivitas);

            // Tambah log otomatis: user mengedit aktivitas
            $log_id = uniqid('log_');
            $aktivitas->tambah_aktivitas(
                $log_id,
                $user,
                $role,
                "Edit Data Aktivitas (ID: $id_log)",
                date("Y-m-d H:i:s")
            );

            echo json_encode([
                "status" => "success",
                "pesan"  => "Data aktivitas berhasil diupdate"
            ]);
            break;

        case 'hapus':
            if ($id_log == '') {
                echo json_encode([
                    "status" => "error",
                    "pesan"  => "ID Log tidak ditemukan"
                ]);
                exit;
            }

            // Hapus data aktivitas
            $aktivitas->hapus_aktivitas($id_log);

            // Tambah log otomatis: user menghapus aktivitas
            $log_id = uniqid('log_');
            $aktivitas->tambah_aktivitas(
                $log_id,
                $user,
                $role,
                "Hapus Data Aktivitas (ID: $id_log)",
                date("Y-m-d H:i:s")
            );

            echo json_encode([
                "status" => "success",
                "pesan"  => "Data aktivitas berhasil dihapus"
            ]);
            break;

        default:
            echo json_encode([
                "status" => "error",
                "pesan"  => "Aksi tidak dikenali"
            ]);
            break;
    }
    exit;
}

/* ===============================
   TAMPIL DATA (UNTUK VIEW)
   =============================== */
$data_aktivitas = $aktivitas->tampil_data_aktivitas();
?>
