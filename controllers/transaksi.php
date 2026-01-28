<?php
class Transaksi {
    private $db;
    public function __construct($koneksi){
        $this->db = $koneksi;
    }

    public function masuk($id_kendaraan){
        mysqli_query($this->db,
        "INSERT INTO tb_transaksi 
        VALUES(null,'$id_kendaraan',NOW(),NULL,0,0,'masuk')");
    }

    public function keluar($id){
        $data = mysqli_fetch_assoc(mysqli_query($this->db,
        "SELECT * FROM tb_transaksi WHERE id_parkir='$id'"));

        $masuk  = strtotime($data['waktu_masuk']);
        $keluar = time();
        $jam    = ceil(($keluar-$masuk)/3600);
        $biaya  = $jam * 2000;

        mysqli_query($this->db,
        "UPDATE tb_transaksi SET
        waktu_keluar=NOW(),
        durasi_jam='$jam',
        biaya_total='$biaya',
        status='keluar'
        WHERE id_parkir='$id'");
    }

    public function laporan($awal,$akhir){
        return mysqli_query($this->db,
        "SELECT * FROM tb_transaksi 
         WHERE waktu_masuk BETWEEN '$awal' AND '$akhir'");
    }
}
