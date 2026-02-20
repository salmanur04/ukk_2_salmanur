<?php
include_once __DIR__ . "/koneksi.php";

class user
{
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
    }

    public function tampil_data_user()
    {
        $sql="SELECT * FROM tb_user";
        $q=mysqli_query($this->koneksi,$sql);
        $data=[];
        while($row=mysqli_fetch_object($q)){
            $data[]=$row;
        }
        return $data;
    }

    public function tambah_user($id,$nama,$password,$username,$role)
    {
        $sql="INSERT INTO tb_user VALUES(
            '$id','$nama','$password','$username','$role'
        )";
        return mysqli_query($this->koneksi,$sql);
    }

    public function edit_user($id,$nama,$password,$username,$role)
    {
        $sql="UPDATE tb_user SET
            nama_lengkap='$nama',
            username='$username',
            password='$password',
            role='$role'
            WHERE id_user='$id'";
        return mysqli_query($this->koneksi,$sql);
    }

    public function hapus_user($id)
    {
        return mysqli_query(
            $this->koneksi,
            "DELETE FROM tb_user WHERE id_user='$id'"
        );
    }
}
