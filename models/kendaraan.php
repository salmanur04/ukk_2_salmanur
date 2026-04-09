 <?php
include_once __DIR__ . "/koneksi.php";

class kendaraan {
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Menampilkan data kendaraan dari transaksi
    public function tampil_data_kendaraan()
    {
        $sql = "SELECT * FROM tb_transaksi ORDER BY waktu_masuk DESC";
        $q = mysqli_query($this->koneksi, $sql);

        if (!$q) {
            die("Query Error: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while ($row = mysqli_fetch_object($q)) {
            $data[] = $row;
        }

        return $data;
    }
}
?>