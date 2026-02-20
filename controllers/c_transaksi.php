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
            isset($_POST['jenis_kendaraan']) &&
            isset($_POST['waktu_masuk']) &&
            isset($_POST['waktu_keluar']) &&
            isset($_POST['status'])
        ) {

            $simpan = $model->tambah(
                $_POST['jenis_kendaraan'],
                $_POST['waktu_masuk'],
                $_POST['waktu_keluar'],
                $_POST['status']
            );

            echo json_encode([
                'status' => $simpan ? 'success' : 'error',
                'pesan'  => $simpan ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data'
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
            isset($_POST['id_parkir']) &&
            isset($_POST['jenis_kendaraan']) &&
            isset($_POST['waktu_masuk']) &&
            isset($_POST['waktu_keluar']) &&
            isset($_POST['status'])
        ) {

            $update = $model->edit(
                $_POST['id_parkir'],
                $_POST['jenis_kendaraan'],
                $_POST['waktu_masuk'],
                $_POST['waktu_keluar'],
                $_POST['status']
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