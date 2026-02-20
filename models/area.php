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

    // Menampilkan semua data area
    public function tampil_data_area()
    {
        $sql = "SELECT * FROM area_parkir";
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

    // Mengambil data area berdasarkan ID
    public function get_area($id_area)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM area_parkir WHERE id_area=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_area);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_object($result);
        mysqli_stmt_close($stmt);

        return $data;
    }

    // Menambah data area
    public function tambah_area($id_area, $nama_area, $kapasitas, $terisi)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO area_parkir (id_area, nama_area, kapasitas, terisi)
             VALUES (?, ?, ?, ?)"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "ssii", $id_area, $nama_area, $kapasitas, $terisi);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Mengedit data area
    public function edit_area($id_area, $nama_area, $kapasitas, $terisi)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE area_parkir
             SET nama_area=?, kapasitas=?, terisi=?
             WHERE id_area=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "siis", $nama_area, $kapasitas, $terisi, $id_area);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Menghapus data area
    public function hapus_area($id_area)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM area_parkir WHERE id_area=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_area);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }
}
