<?php
include_once __DIR__ . "/koneksi.php";

class Area {

    private $koneksi;

    public function __construct()
    {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;

        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // ================= TAMPIL DATA =================
    public function tampil_data_area()
    {
        $data = [];

        $query = mysqli_query($this->koneksi, "SELECT * FROM area_parkir");

        if(!$query){
            die("Query SELECT error: " . mysqli_error($this->koneksi));
        }

        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }

        return $data;
    }

    // ================= CREATE =================
    public function tambahArea($nama, $kapasitas){
        $query = mysqli_query($this->koneksi,
            "INSERT INTO area_parkir (nama_area, kapasitas, terisi)
             VALUES ('$nama','$kapasitas',0)"
        );

        if(!$query){
            die("Query INSERT error: " . mysqli_error($this->koneksi));
        }
    }

    // ================= DELETE =================
    public function hapusArea($id){
        $query = mysqli_query($this->koneksi,
            "DELETE FROM area_parkir WHERE id_area='$id'"
        );

        if(!$query){
            die("Query DELETE error: " . mysqli_error($this->koneksi));
        }
    }

    // ================= UPDATE =================
    public function updateArea($id, $nama, $kapasitas){
        $query = mysqli_query($this->koneksi,
            "UPDATE area_parkir SET 
            nama_area='$nama',
            kapasitas='$kapasitas'
            WHERE id_area='$id'"
        );

        if(!$query){
            die("Query UPDATE error: " . mysqli_error($this->koneksi));
        }
    }
}
?>