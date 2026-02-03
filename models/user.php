 <?php
// memanggil koneksi ke database
include_once __DIR__ . "/koneksi.php";

// membuat kelas user
class user
{
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
    }

    // ================= TAMPIL DATA =================
    public function tampil_data_user()
    {
        $sql = "SELECT * FROM tb_user";
        $post = mysqli_query($this->koneksi, $sql);

        $result = [];
        if ($post && mysqli_num_rows($post) > 0) {
            while ($data = mysqli_fetch_object($post)) {
                $result[] = $data;
            }
        }
        return $result;
    }

    // ================= TAMBAH DATA =================
    public function tambah_user($id, $nama, $username, $role)
    {
        $sql = "INSERT INTO tb_user (id_user, nama_lengkap, username, role)
                VALUES ('$id', '$nama', '$username', '$role')";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================= EDIT DATA =================
    public function edit_user($id, $nama, $username, $role)
    {
        $sql = "UPDATE tb_user SET
                nama_lengkap = '$nama',
                username = '$username',
                role = '$role'
                WHERE id_user = '$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================= HAPUS DATA =================
    public function hapus_user($id)
    {
        $sql = "DELETE FROM tb_user WHERE id_user = '$id'";
        return mysqli_query($this->koneksi, $sql);
    }
}
