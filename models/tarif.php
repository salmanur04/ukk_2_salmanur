 <?php
include_once __DIR__ . '/koneksi.php';

class tarif_parkir {

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
        $sql = "SELECT * FROM tarif_parkir ORDER BY id_tarif DESC";
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

    /* ================= TAMBAH ================= */
    public function tambah($jenis, $tarif, $waktu){
        $sql = "INSERT INTO tarif_parkir 
                (jenis_kendaraan, tarif_per_jam, ketentuan_waktu)
                VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sii", $jenis, $tarif, $waktu);
        return mysqli_stmt_execute($stmt);
    }

    /* ================= EDIT ================= */
    public function edit($id, $jenis, $tarif, $waktu){
        $sql = "UPDATE tarif_parkir 
                SET jenis_kendaraan=?, tarif_per_jam=?, ketentuan_waktu=?
                WHERE id_tarif=?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "siii", $jenis, $tarif, $waktu, $id);
        return mysqli_stmt_execute($stmt);
    }

    /* ================= HAPUS ================= */
    public function hapus($id){
        $sql = "DELETE FROM tarif_parkir WHERE id_tarif=?";
        $stmt = mysqli_prepare($this->koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
