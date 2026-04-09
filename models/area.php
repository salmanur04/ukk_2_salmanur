 <?php
include_once __DIR__ . "/koneksi.php";

class area {

    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;

        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // ================= DATA AREA PARKIR OTOMATIS =================
    public function tampil_data_area()
    {
        $data = [];

        // Hitung jumlah motor yang masih parkir
        $sql_motor = "SELECT COUNT(*) as total FROM tb_transaksi WHERE jenis_kendaraan='motor' AND status='masuk'";
        $q_motor = mysqli_query($this->koneksi, $sql_motor);

        if (!$q_motor) {
            die("Query motor error: " . mysqli_error($this->koneksi));
        }

        $motor = mysqli_fetch_assoc($q_motor);
        $terisi_motor = $motor['total'] ?? 0;

        // Hitung jumlah mobil yang masih parkir
        $sql_mobil = "SELECT COUNT(*) as total FROM tb_transaksi WHERE jenis_kendaraan='mobil' AND status='masuk'";
        $q_mobil = mysqli_query($this->koneksi, $sql_mobil);

        if (!$q_mobil) {
            die("Query mobil error: " . mysqli_error($this->koneksi));
        }

        $mobil = mysqli_fetch_assoc($q_mobil);
        $terisi_mobil = $mobil['total'] ?? 0;

        // Area Mobil
        $area1 = new stdClass();
        $area1->id_area = "A01";
        $area1->nama_area = "Area Mobil";
        $area1->kapasitas = 30;
        $area1->terisi = $terisi_mobil;

        // Area Motor
        $area2 = new stdClass();
        $area2->id_area = "A02";
        $area2->nama_area = "Area Motor";
        $area2->kapasitas = 50;
        $area2->terisi = $terisi_motor;

        $data[] = $area1;
        $data[] = $area2;

        return $data;
    }
}
?>