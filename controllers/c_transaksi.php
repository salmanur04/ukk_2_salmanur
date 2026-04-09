 <?php
include_once __DIR__ . '/../models/transaksi.php';
include_once __DIR__ . '/../models/tarif.php';

$transaksi = new Transaksi();
$tarif = new TarifParkir();

// ================= PROSES AJAX =================
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi'])) {
    header('Content-Type: application/json');
    $aksi = $_POST['aksi'];

    // ================= TAMBAH =================
    if($aksi == 'tambah'){
        $plat_nomor = $_POST['plat_nomor'];
        $jenis = $_POST['jenis_kendaraan'];
        $waktu_masuk = $_POST['waktu_masuk'];
        $waktu_keluar = $_POST['waktu_keluar'];
        $status = $_POST['status'];

        $simpan = $transaksi->tambah($plat_nomor, $jenis, $waktu_masuk, $waktu_keluar, $status);

        echo json_encode([
            'status' => $simpan ? 'success' : 'error',
            'pesan' => $simpan ? 'Transaksi berhasil disimpan' : 'Gagal menyimpan transaksi'
        ]);
        exit;
    }

    // ================= EDIT =================
    if($aksi == 'edit'){
        $id_parkir = $_POST['id_parkir'];
        $plat_nomor = $_POST['plat_nomor'];
        $jenis = $_POST['jenis_kendaraan'];
        $waktu_masuk = $_POST['waktu_masuk'];
        $waktu_keluar = $_POST['waktu_keluar'];
        $status = $_POST['status'];

        $update = $transaksi->edit($id_parkir, $plat_nomor, $jenis, $waktu_masuk, $waktu_keluar, $status);

        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'pesan' => $update ? 'Transaksi berhasil diupdate' : 'Gagal update transaksi'
        ]);
        exit;
    }

    // ================= HAPUS =================
    if($aksi == 'hapus'){
        $id_parkir = $_POST['id_parkir'];
        $hapus = $transaksi->hapus($id_parkir);

        echo json_encode([
            'status' => $hapus ? 'success' : 'error',
            'pesan' => $hapus ? 'Transaksi berhasil dihapus' : 'Gagal hapus transaksi'
        ]);
        exit;
    }
}

// ================= AMBIL DATA =================
$data_tarif = $tarif->getAll();
$data_transaksi = $transaksi->tampil_data();
?>