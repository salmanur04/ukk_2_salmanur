 <?php
include_once __DIR__ . '/tarif.php'; // ambil model tarif
include_once __DIR__ . '/koneksi.php';

class Transaksi {
    private $koneksi;
    private $tarifModel;

    public function __construct(){
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
        $this->tarifModel = new TarifParkir();

        if(!$this->koneksi){
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // ================= TAMPIL DATA =================
    public function tampil_data(){
        $sql = "SELECT * FROM tb_transaksi ORDER BY id_parkir DESC";
        $query = mysqli_query($this->koneksi, $sql);

        if(!$query){
            die("Query tampil_data error: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }
        return $data;
    }

    // ================= HITUNG DURASI =================
    private function hitungDurasi($waktu_masuk, $waktu_keluar){
        try {
            $masuk  = new DateTime($waktu_masuk);
            $keluar = new DateTime($waktu_keluar);

            if($keluar < $masuk) return 1;

            $selisih = $masuk->diff($keluar);
            $durasi_jam = ($selisih->days * 24) + $selisih->h;
            if($selisih->i > 0) $durasi_jam += 1;

            return ($durasi_jam > 0) ? $durasi_jam : 1;
        } catch (Exception $e) {
            return 1;
        }
    }

    // ================= TAMBAH =================
    public function tambah($plat_nomor, $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){
        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);

        // ambil tarif dari tabel tarif_parkir
        $tarifData = $this->tarifModel->getByJenis($jenis_kendaraan);
        $tarif_per_jam = $tarifData['tarif_per_jam'];

        $biaya_total = $durasi_jam * $tarif_per_jam;

        $sql = "INSERT INTO tb_transaksi 
                (plat_nomor, jenis_kendaraan, waktu_masuk, waktu_keluar, durasi_jam, biaya_total, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $sql);
        if(!$stmt) die("Prepare gagal: " . mysqli_error($this->koneksi));

        mysqli_stmt_bind_param(
            $stmt,
            "ssssiis",
            $plat_nomor,
            $jenis_kendaraan,
            $waktu_masuk,
            $waktu_keluar,
            $durasi_jam,
            $biaya_total,
            $status
        );

        return mysqli_stmt_execute($stmt);
    }

    // ================= GET BY ID =================
    public function get_by_id($id){
        $sql = "SELECT * FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result);
    }

    // ================= EDIT =================
    public function edit($id_parkir, $plat_nomor, $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){
        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);

        // ambil tarif terbaru dari tarif_parkir
        $tarifData = $this->tarifModel->getByJenis($jenis_kendaraan);
        $tarif_per_jam = $tarifData['tarif_per_jam'];
        $biaya_total = $durasi_jam * $tarif_per_jam;

        $sql = "UPDATE tb_transaksi 
                SET plat_nomor=?, jenis_kendaraan=?, waktu_masuk=?, waktu_keluar=?, durasi_jam=?, biaya_total=?, status=?
                WHERE id_parkir=?";

        $stmt = mysqli_prepare($this->koneksi, $sql);
        if(!$stmt) die("Prepare gagal: " . mysqli_error($this->koneksi));

        mysqli_stmt_bind_param(
            $stmt,
            "ssssiisi",
            $plat_nomor,
            $jenis_kendaraan,
            $waktu_masuk,
            $waktu_keluar,
            $durasi_jam,
            $biaya_total,
            $status,
            $id_parkir
        );

        return mysqli_stmt_execute($stmt);
    }

    // ================= HAPUS =================
    public function hapus($id){
        $sql = "DELETE FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
?>