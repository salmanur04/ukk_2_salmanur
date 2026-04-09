 <?php
include_once __DIR__ . '/../models/transaksi.php';

$model = new transaksi();

/* ================= PROSES AJAX ================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi'])) {

    header('Content-Type: application/json');

    $aksi = $_POST['aksi'];

    /* ================= TAMBAH ================= */
    if ($aksi == 'tambah') {

        if (
            !empty($_POST['plat_nomor']) &&
            !empty($_POST['jenis_kendaraan']) &&
            !empty($_POST['waktu_masuk']) &&
            !empty($_POST['waktu_keluar']) &&
            !empty($_POST['status'])
        ) {
            
            $plat_nomor = trim($_POST['plat_nomor']);
            $jenis_kendaraan = trim($_POST['jenis_kendaraan']);
            $waktu_masuk = str_replace('T', ' ', $_POST['waktu_masuk']);
            $waktu_keluar = str_replace('T', ' ', $_POST['waktu_keluar']);
            $status = trim($_POST['status']);

            $id_baru = $model->tambah(
                $plat_nomor,
                $jenis_kendaraan,
                $waktu_masuk,
                $waktu_keluar,
                $status
            );

            echo json_encode([
                'status' => $id_baru ? 'success' : 'error',
                'pesan'  => $id_baru ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data',
                'id_baru' => $id_baru
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'pesan'  => 'Data tidak lengkap'
            ]);
        }
        exit;
    }

    /* ================= EDIT ================= */
    if ($aksi == 'edit') {

        if (
            !empty($_POST['id_parkir']) &&
            !empty($_POST['plat_nomor']) &&
            !empty($_POST['jenis_kendaraan']) &&
            !empty($_POST['waktu_masuk']) &&
            !empty($_POST['waktu_keluar']) &&
            !empty($_POST['status'])
        ) {
            
            $id_parkir = $_POST['id_parkir'];
            $plat_nomor = trim($_POST['plat_nomor']);
            $jenis_kendaraan = trim($_POST['jenis_kendaraan']);
            $waktu_masuk = str_replace('T', ' ', $_POST['waktu_masuk']);
            $waktu_keluar = str_replace('T', ' ', $_POST['waktu_keluar']);
            $status = trim($_POST['status']);

            $update = $model->edit(
                $id_parkir,
                $plat_nomor,
                $jenis_kendaraan,
                $waktu_masuk,
                $waktu_keluar,
                $status
            );

            echo json_encode([
                'status' => $update ? 'success' : 'error',
                'pesan'  => $update ? 'Data berhasil diupdate' : 'Gagal update data'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'pesan'  => 'Data tidak lengkap'
            ]);
        }
        exit;
    }

    /* ================= HAPUS ================= */
    if ($aksi == 'hapus') {

        if (isset($_POST['id_parkir'])) {

            $hapus = $model->hapus($_POST['id_parkir']);

            echo json_encode([
                'status' => $hapus ? 'success' : 'error',
                'pesan'  => $hapus ? 'Data berhasil dihapus' : 'Gagal hapus data'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'pesan'  => 'ID tidak ditemukan'
            ]);
        }
        exit;
    }

    echo json_encode([
        'status' => 'error',
        'pesan'  => 'Aksi tidak valid'
    ]);
    exit;
}

/* ================= AMBIL DATA UNTUK TABEL ================= */
$data_transaksi = $model->tampil_data();
?>