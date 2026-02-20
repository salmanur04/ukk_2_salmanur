<?php
include_once __DIR__ . "/koneksi.php";

class aktivitas {
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Menampilkan semua log aktivitas
    public function tampil_data_aktivitas()
    {
        $sql = "SELECT * FROM tb_log_aktivitas ORDER BY waktu_aktivitas DESC";
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

    // Mengambil log berdasarkan ID
    public function get_aktivitas($id_log)
    {
        $stmt = mysqli_prepare($this->koneksi, "SELECT * FROM tb_log_aktivitas WHERE id_log=?");
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_log);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_object($result);
        mysqli_stmt_close($stmt);

        return $data;
    }

    // Menambah log aktivitas (dengan validasi)
    public function tambah_aktivitas($id_log, $user, $role, $aktivitas, $waktu_aktivitas)
    {
        // Pastikan aktivitas bukan array dan tidak kosong
        if (empty($aktivitas) || is_array($aktivitas)) {
            $aktivitas = "Aktivitas tidak terdefinisi";
        }

        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO tb_log_aktivitas (id_log, user, role, aktivitas, waktu_aktivitas)
             VALUES (?, ?, ?, ?, ?)"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "sssss", $id_log, $user, $role, $aktivitas, $waktu_aktivitas);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Mengedit log aktivitas
    public function edit_aktivitas($id_log, $user, $role, $aktivitas, $waktu_aktivitas)
    {
        if (empty($aktivitas) || is_array($aktivitas)) {
            $aktivitas = "Aktivitas tidak terdefinisi";
        }

        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE tb_log_aktivitas
             SET user=?, role=?, aktivitas=?, waktu_aktivitas=?
             WHERE id_log=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "sssss", $user, $role, $aktivitas, $waktu_aktivitas, $id_log);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }

    // Menghapus log aktivitas
    public function hapus_aktivitas($id_log)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM tb_log_aktivitas WHERE id_log=?"
        );
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->koneksi));
        }

        mysqli_stmt_bind_param($stmt, "s", $id_log);
        if (!mysqli_stmt_execute($stmt)) {
            die("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return true;
    }
}
?>
