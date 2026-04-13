<?php
include_once __DIR__ . '/../models/transaksi.php';
include_once __DIR__ . '/../models/tarif.php';
include_once __DIR__ . '/../models/kendaraan.php';

$transaksi = new Transaksi();
$tarif = new TarifParkir();
$kendaraan = new Kendaraan();

// ================= PROSES AJAX =================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-Type: application/json');

    // 🔥 FIX UTAMA: aman ambil aksi
    $aksi = isset($_POST['aksi']) ? trim($_POST['aksi']) : '';

    if ($aksi == '') {
        echo json_encode([
            'status' => 'error',
            'pesan' => 'Aksi tidak dikirim dari form / ajax'
        ]);
        exit;
    }

    // ================= TAMBAH =================
    if ($aksi == 'tambah') {

        $id_kendaraan = $_POST['id_kendaraan'] ?? '';
        $waktu_masuk  = $_POST['waktu_masuk'] ?? '';
        $waktu_keluar = $_POST['waktu_keluar'] ?? '';
        $status       = $_POST['status'] ?? 'masuk';

        if ($id_kendaraan == '' || $waktu_masuk == '') {
            echo json_encode([
                'status' => 'error',
                'pesan' => 'Data tidak lengkap'
            ]);
            exit;
        }

        $simpan = $transaksi->tambah($id_kendaraan, $waktu_masuk, $waktu_keluar, $status);

        echo json_encode([
            'status' => $simpan ? 'success' : 'error',
            'pesan' => $simpan ? 'Transaksi berhasil disimpan' : 'Gagal menyimpan transaksi'
        ]);
        exit;
    }

    // ================= EDIT =================
    if ($aksi == 'edit') {

        $id_parkir    = $_POST['id_parkir'] ?? '';
        $id_kendaraan = $_POST['id_kendaraan'] ?? '';
        $waktu_masuk  = $_POST['waktu_masuk'] ?? '';
        $waktu_keluar = $_POST['waktu_keluar'] ?? '';
        $status       = $_POST['status'] ?? '';

        if ($id_parkir == '' || $id_kendaraan == '') {
            echo json_encode([
                'status' => 'error',
                'pesan' => 'Data edit tidak lengkap'
            ]);
            exit;
        }

        $update = $transaksi->edit($id_parkir, $id_kendaraan, $waktu_masuk, $waktu_keluar, $status);

        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'pesan' => $update ? 'Transaksi berhasil diupdate' : 'Gagal update transaksi'
        ]);
        exit;
    }

    // ================= HAPUS =================
    if ($aksi == 'hapus') {

        $id_parkir = $_POST['id_parkir'] ?? '';

        if ($id_parkir == '') {
            echo json_encode([
                'status' => 'error',
                'pesan' => 'ID parkir tidak ditemukan'
            ]);
            exit;
        }

        $hapus = $transaksi->hapus($id_parkir);

        echo json_encode([
            'status' => $hapus ? 'success' : 'error',
            'pesan' => $hapus ? 'Transaksi berhasil dihapus' : 'Gagal hapus transaksi'
        ]);
        exit;
    }

    // kalau aksi tidak dikenal
    echo json_encode([
        'status' => 'error',
        'pesan' => 'Aksi tidak valid'
    ]);
    exit;
}

// ================= AMBIL DATA =================
$data_tarif = $tarif->getAll();
$data_transaksi = $transaksi->tampil_data();
$data_kendaraan = $kendaraan->tampil_data_kendaraan();
?>