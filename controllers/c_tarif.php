 <?php
include_once __DIR__ . '/../models/tarif.php';

$tarif = new TarifParkir();

/* ================= PROSES AJAX ================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi'])) {

    header('Content-Type: application/json');

    $aksi = $_POST['aksi'];

    // ================= TAMBAH =================
    if ($aksi == 'tambah') {

        $jenis = strtolower(trim($_POST['jenis_kendaraan']));
        $tarif_per_jam = $_POST['tarif_per_jam'];

        $simpan = $tarif->create($jenis, $tarif_per_jam);

        echo json_encode([
            'status' => $simpan ? 'success' : 'error',
            'pesan'  => $simpan ? 'Tarif berhasil ditambahkan' : 'Gagal tambah tarif'
        ]);
        exit;
    }

    // ================= EDIT =================
    if ($aksi == 'edit') {

        $id = $_POST['id_tarif'];
        $jenis = strtolower(trim($_POST['jenis_kendaraan']));
        $tarif_per_jam = $_POST['tarif_per_jam'];

        $update = $tarif->update($id, $jenis, $tarif_per_jam);

        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'pesan'  => $update ? 'Tarif berhasil diupdate' : 'Gagal update tarif'
        ]);
        exit;
    }

    // ================= HAPUS =================
    if ($aksi == 'hapus') {

        $id = $_POST['id_tarif'];

        $hapus = $tarif->delete($id);

        echo json_encode([
            'status' => $hapus ? 'success' : 'error',
            'pesan'  => $hapus ? 'Tarif berhasil dihapus' : 'Gagal hapus tarif'
        ]);
        exit;
    }
}

/* ================= AMBIL DATA ================= */
$data_tarif = $tarif->getAll();
?>