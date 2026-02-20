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

    // Menampilkan semua data kendaraan
    public function tampil_data_kendaraan()
    {
        $sql = "SELECT * FROM tb_kendaraan";
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

    // Mengambil data kendaraan berdasarkan ID
    public function get_kendaraan($id_kendaraan)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM tb_kendaraan WHERE id_kendaraan=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_kendaraan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_object($result);
        mysqli_stmt_close($stmt);

        return $data;
    }

    // Menambah data kendaraan
    public function tambah_kendaraan($id_kendaraan, $plat_nomor, $jenis_kendaraan, $warna)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO tb_kendaraan (id_kendaraan, plat_nomor, jenis_kendaraan, warna)
             VALUES (?, ?, ?, ?)"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $id_kendaraan,
            $plat_nomor,
            $jenis_kendaraan,
            $warna
        );

        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Mengedit data kendaraan
    public function edit_kendaraan($id_kendaraan, $plat_nomor, $jenis_kendaraan, $warna)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE tb_kendaraan
             SET plat_nomor=?, jenis_kendaraan=?, warna=?
             WHERE id_kendaraan=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $plat_nomor,
            $jenis_kendaraan,
            $warna,
            $id_kendaraan
        );

        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Menghapus data kendaraan
    public function hapus_kendaraan($id_kendaraan)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM tb_kendaraan WHERE id_kendaraan=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_kendaraan);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }
}
