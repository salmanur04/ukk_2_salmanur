<?php
include_once __DIR__ . '/tarif.php';
include_once __DIR__ . '/koneksi.php';

class Transaksi {
    private $koneksi;
    private $tarifModel;

    public function __construct(){
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
        $this->tarifModel = new TarifParkir();
    }

    // ================= TAMPIL DATA =================
    public function tampil_data(){
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan 
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                ORDER BY t.id_parkir DESC";

        $query = mysqli_query($this->koneksi, $sql);

        $data = [];
        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }
        return $data;
    }

    // ================= GET BY ID =================
    public function get_by_id($id){
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan 
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                WHERE t.id_parkir='$id'";

        $query = mysqli_query($this->koneksi, $sql);

        return mysqli_fetch_object($query);
    }

    // ================= HITUNG DURASI =================
    private function hitungDurasi($masuk, $keluar){
        $m = new DateTime($masuk);
        $k = new DateTime($keluar);
        $diff = $m->diff($k);

        $jam = ($diff->days * 24) + $diff->h;
        if($diff->i > 0) $jam += 1;

        return ($jam > 0) ? $jam : 1;
    }

    // ================= TAMBAH =================
    public function tambah($id_kendaraan, $waktu_masuk, $waktu_keluar, $status){

        $k = mysqli_fetch_assoc(mysqli_query($this->koneksi,
            "SELECT * FROM tb_kendaraan WHERE id_kendaraan='$id_kendaraan'"
        ));

        if(!$k){
            return false;
        }

        $jenis = $k['jenis_kendaraan'];

        $tarif = $this->tarifModel->getByJenis($jenis);
        if(!$tarif){
            return false;
        }

        $id_tarif = $tarif['id_tarif'];
        $tarif_per_jam = $tarif['tarif_per_jam'];

        $durasi = $this->hitungDurasi($waktu_masuk, $waktu_keluar);
        $biaya = $durasi * $tarif_per_jam;

        $id_user = $_SESSION['id_user'] ?? 1;
        $id_area = 1;

        $sql = "INSERT INTO tb_transaksi 
                (id_kendaraan, id_tarif, id_user, id_area, waktu_masuk, waktu_keluar, durasi_jam, biaya_total, status)
                VALUES 
                ('$id_kendaraan','$id_tarif','$id_user','$id_area','$waktu_masuk','$waktu_keluar','$durasi','$biaya','$status')";

        return mysqli_query($this->koneksi, $sql);
    }

    // ================= EDIT =================
    public function edit($id, $id_kendaraan, $waktu_masuk, $waktu_keluar, $status){

        $k = mysqli_fetch_assoc(mysqli_query($this->koneksi,
            "SELECT * FROM tb_kendaraan WHERE id_kendaraan='$id_kendaraan'"
        ));

        if(!$k){
            return false;
        }

        $jenis = $k['jenis_kendaraan'];

        $tarif = $this->tarifModel->getByJenis($jenis);
        if(!$tarif){
            return false;
        }

        $id_tarif = $tarif['id_tarif'];
        $tarif_per_jam = $tarif['tarif_per_jam'];

        $durasi = $this->hitungDurasi($waktu_masuk, $waktu_keluar);
        $biaya = $durasi * $tarif_per_jam;

        $sql = "UPDATE tb_transaksi SET
                id_kendaraan='$id_kendaraan',
                id_tarif='$id_tarif',
                waktu_masuk='$waktu_masuk',
                waktu_keluar='$waktu_keluar',
                durasi_jam='$durasi',
                biaya_total='$biaya',
                status='$status'
                WHERE id_parkir='$id'";

        return mysqli_query($this->koneksi, $sql);
    }

    // ================= HAPUS =================
    public function hapus($id){
        $sql = "DELETE FROM tb_transaksi WHERE id_parkir='$id'";
        return mysqli_query($this->koneksi, $sql);
    }
}
?>