 <?php
include_once __DIR__ . '/koneksi.php';

class TarifParkir {

    private $conn;

    public function __construct(){
        $db = new koneksi();
        $this->conn = $db->koneksi;

        if (!$this->conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    /* ================= TAMPIL DATA ================= */
    public function getAll(){
        $sql = "SELECT * FROM tarif_parkir ORDER BY id_tarif DESC";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Query error: " . mysqli_error($this->conn));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /* ================= AMBIL TARIF ================= */
    public function getByJenis($jenis){

        $jenis = strtolower(trim($jenis));

        $sql = "SELECT * FROM tarif_parkir WHERE jenis_kendaraan = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if(!$stmt){
            die("Prepare error: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $jenis);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        // 🔥 fallback kalau data tidak ada
        if(!$data){
            return [
                'jenis_kendaraan' => $jenis,
                'tarif_per_jam' => ($jenis == 'motor') ? 3000 : 6000
            ];
        }

        return $data;
    }

    /* ================= TAMBAH ================= */
    public function create($jenis, $tarif){

        $jenis = strtolower(trim($jenis));

        $sql = "INSERT INTO tarif_parkir 
                (jenis_kendaraan, tarif_per_jam)
                VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);

        if(!$stmt){
            die("Prepare error: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "si", $jenis, $tarif);

        return mysqli_stmt_execute($stmt);
    }

    /* ================= EDIT ================= */
    public function update($id, $jenis, $tarif){

        $jenis = strtolower(trim($jenis));

        $sql = "UPDATE tarif_parkir 
                SET jenis_kendaraan=?, tarif_per_jam=?
                WHERE id_tarif=?";

        $stmt = mysqli_prepare($this->conn, $sql);

        if(!$stmt){
            die("Prepare error: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "sii", $jenis, $tarif, $id);

        return mysqli_stmt_execute($stmt);
    }

    /* ================= HAPUS ================= */
    public function delete($id){

        $sql = "DELETE FROM tarif_parkir WHERE id_tarif=?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if(!$stmt){
            die("Prepare error: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }
}
?>