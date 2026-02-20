 <?php
include_once __DIR__ . '/koneksi.php';

class transaksi {

    private $koneksi;

    public function __construct(){
        $db = new koneksi();
        $this->koneksi = $db->koneksi;

        if(!$this->koneksi){
            die("Koneksi database gagal");
        }
    }

    /* ================= TAMPIL DATA ================= */
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

    /* ================= HITUNG DURASI ================= */
    private function hitungDurasi($waktu_masuk, $waktu_keluar){
        $masuk  = new DateTime($waktu_masuk);
        $keluar = new DateTime($waktu_keluar);

        if($keluar < $masuk){
            return 1;
        }

        $selisih = $masuk->diff($keluar);
        $durasi_jam = ($selisih->days * 24) + $selisih->h;

        if($selisih->i > 0){
            $durasi_jam += 1;
        }

        return $durasi_jam > 0 ? $durasi_jam : 1;
    }

    /* ================= TAMBAH ================= */
    public function tambah($jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){

        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);

        $tarif_per_jam = ($jenis_kendaraan == "Motor") ? 3000 : 5000;
        $biaya_total = $durasi_jam * $tarif_per_jam;

        $sql = "INSERT INTO tb_transaksi 
                (jenis_kendaraan, waktu_masuk, waktu_keluar, durasi_jam, biaya_total, status)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $sql);
        if(!$stmt){
            die("Prepare gagal (tambah): " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "sssiis",
            $jenis_kendaraan,
            $waktu_masuk,
            $waktu_keluar,
            $durasi_jam,
            $biaya_total,
            $status
        );

        $execute = mysqli_stmt_execute($stmt);

        if(!$execute){
            die("Execute gagal (tambah): " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return $execute;
    }

    /* ================= EDIT ================= */
    public function edit($id_parkir, $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $status){

        $durasi_jam = $this->hitungDurasi($waktu_masuk, $waktu_keluar);

        $tarif_per_jam = ($jenis_kendaraan == "Motor") ? 3000 : 5000;
        $biaya_total = $durasi_jam * $tarif_per_jam;

        $sql = "UPDATE tb_transaksi SET
                jenis_kendaraan = ?,
                waktu_masuk = ?,
                waktu_keluar = ?,
                durasi_jam = ?,
                biaya_total = ?,
                status = ?
                WHERE id_parkir = ?";

        $stmt = mysqli_prepare($this->koneksi, $sql);
        if(!$stmt){
            die("Prepare gagal (edit): " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "sssiisi",
            $jenis_kendaraan,
            $waktu_masuk,
            $waktu_keluar,
            $durasi_jam,
            $biaya_total,
            $status,
            $id_parkir
        );

        $execute = mysqli_stmt_execute($stmt);

        if(!$execute){
            die("Execute gagal (edit): " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return $execute;
    }

    /* ================= HAPUS ================= */
    public function hapus($id){
        $sql = "DELETE FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        if(!$stmt){
            die("Prepare gagal (hapus): " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "i", $id);

        $execute = mysqli_stmt_execute($stmt);

        if(!$execute){
            die("Execute gagal (hapus): " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return $execute;
    }

    /* ================= GET BY ID ================= */
    public function get_by_id($id){
        $sql = "SELECT * FROM tb_transaksi WHERE id_parkir = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        if(!$stmt){
            die("Prepare gagal (get_by_id): " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_object($result);

        mysqli_stmt_close($stmt);
        return $data;
    }
}