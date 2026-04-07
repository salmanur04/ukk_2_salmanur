 <?php
include_once __DIR__ . '/koneksi.php';

class transaksi {
    private $koneksi;

    public function __construct(){
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
        if(!$this->koneksi){
            die(json_encode(["status" => "error", "pesan" => "Koneksi database gagal"]));
        }
    }

    public function tampil_data(){
        $sql = "SELECT * FROM tb_transaksi ORDER BY id_parkir DESC";
        $query = mysqli_query($this->koneksi, $sql);
        $data = [];
        if($query){
            while($row = mysqli_fetch_object($query)){
                $data[] = $row;
            }
        }
        return $data;
    }

    private function hitungDurasi($waktu_masuk, $waktu_keluar){
        try {
            $masuk  = new DateTime($waktu_masuk);
            $keluar = new DateTime($waktu_keluar);
            if($keluar < $masuk) return 1;
            $selisih = $masuk->diff($keluar);
            $durasi_jam = ($selisih->days * 24) + $selisih->h;
            if($selisih->i > 0) $durasi_jam += 1;
            return $durasi_jam > 0 ? $durasi_jam : 1;
        } catch (Exception $e) {
            return 1;
        }
    }

    public function tambah($jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){
        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);
        $tarif_per_jam = ($jenis_kendaraan == "Motor") ? 3000 : 5000;
        $biaya_total = $durasi_jam * $tarif_per_jam;

        $sql = "INSERT INTO tb_transaksi 
                (jenis_kendaraan, waktu_masuk, waktu_keluar, durasi_jam, biaya_total, status)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $sql);
        if(!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "sssiis", $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $durasi_jam, $biaya_total, $status);
        $execute = mysqli_stmt_execute($stmt);

        if($execute){
            return mysqli_insert_id($this->koneksi); // Mengembalikan ID untuk cetak struk
        }
        return false;
    }

    public function get_by_id($id){
        $sql = "SELECT * FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result);
    }

    // Fungsi edit & hapus tetap seperti sebelumnya...
    public function edit($id_parkir, $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){
        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);
        $tarif_per_jam = ($jenis_kendaraan == "Motor") ? 3000 : 5000;
        $biaya_total = $durasi_jam * $tarif_per_jam;
        $sql = "UPDATE tb_transaksi SET jenis_kendaraan=?, waktu_masuk=?, waktu_keluar=?, durasi_jam=?, biaya_total=?, status=? WHERE id_parkir=?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssiisi", $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $durasi_jam, $biaya_total, $status, $id_parkir);
        return mysqli_stmt_execute($stmt);
    }

    public function hapus($id){
        $sql = "DELETE FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}