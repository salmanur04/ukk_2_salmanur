<?php
include_once __DIR__ . "/koneksi.php";

class Kendaraan {
    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;

        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // ================= READ =================
    public function tampil_data_kendaraan()
    {
        $data = [];

        $query = mysqli_query($this->koneksi, "SELECT * FROM tb_kendaraan");

        if(!$query){
            die("Query SELECT error: " . mysqli_error($this->koneksi));
        }

        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }

        return $data;
    }

    // ================= CREATE =================
    public function tambahKendaraan($plat, $jenis, $warna, $pemilik){
        $query = mysqli_query($this->koneksi,
            "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, warna, pemilik)
             VALUES ('$plat','$jenis','$warna','$pemilik')"
        );

        if(!$query){
            die("Query INSERT error: " . mysqli_error($this->koneksi));
        }
    }

    // ================= DELETE =================
    public function hapusKendaraan($id){
        $query = mysqli_query($this->koneksi,
            "DELETE FROM tb_kendaraan WHERE id_kendaraan='$id'"
        );

        if(!$query){
            die("Query DELETE error: " . mysqli_error($this->koneksi));
        }
    }

    // ================= UPDATE =================
    public function updateKendaraan($id, $plat, $jenis, $warna, $pemilik){
        $query = mysqli_query($this->koneksi,
            "UPDATE tb_kendaraan SET 
            plat_nomor='$plat',
            jenis_kendaraan='$jenis',
            warna='$warna',
            pemilik='$pemilik'
            WHERE id_kendaraan='$id'"
        );

        if(!$query){
            die("Query UPDATE error: " . mysqli_error($this->koneksi));
        }
    }
}
?>