 <?php
include_once __DIR__ . "/koneksi.php";

class User
{
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
    }

    // ================= TAMPIL USER =================
    public function tampil_data_user()
    {
        $sql = "SELECT * FROM tb_user";
        $q = mysqli_query($this->koneksi, $sql);

        $data = [];
        while($row = mysqli_fetch_object($q)){
            $data[] = $row;
        }
        return $data;
    }

    // ================= TAMBAH USER =================
    public function tambah_user($username, $password, $role)
    {
        $sql = "INSERT INTO tb_user (username, password, role)
                VALUES ('$username', '$password', '$role')";

        return mysqli_query($this->koneksi, $sql);
    }

    // ================= EDIT USER =================
    public function edit_user($id, $username, $password, $role)
    {
        $sql = "UPDATE tb_user SET
                username='$username',
                password='$password',
                role='$role'
                WHERE id_user='$id'";

        return mysqli_query($this->koneksi, $sql);
    }

    // ================= HAPUS USER =================
    public function hapus_user($id)
    {
        $sql = "DELETE FROM tb_user WHERE id_user='$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================= LOGIN =================
    public function login($username, $password)
    {
        $sql = "SELECT * FROM tb_user 
                WHERE username='$username' 
                AND password='$password'";

        $q = mysqli_query($this->koneksi, $sql);

        return mysqli_fetch_object($q);
    }
}
?>