 <?php
include_once __DIR__ . "/koneksi.php";

class rekapan {

    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;

        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // ================= REKAP HARI INI =================
    public function rekap_hari_ini()
    {
        $today = date('Y-m-d');

        $sql = "
            SELECT 
                COUNT(*) as total_kendaraan,
                SUM(CASE WHEN jenis_kendaraan='motor' THEN 1 ELSE 0 END) as total_motor,
                SUM(CASE WHEN jenis_kendaraan='mobil' THEN 1 ELSE 0 END) as total_mobil,
                COALESCE(SUM(biaya_total),0) as total_pendapatan
            FROM tb_transaksi
            WHERE DATE(waktu_masuk)=?
            AND status='keluar'
        ";

        $stmt = mysqli_prepare($this->koneksi, $sql);

        if (!$stmt) {
            die("Query error: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $today);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        return $data;
    }
}