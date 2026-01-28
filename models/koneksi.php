<?php

//membuat sebuah kelas pada konsep oop
class koneksi{

//membuat variabel atau poperti
//jenis jenis modifier / konsep enkapsulassi pada oop
//private
//public
//protected

   private  $host = "localhost",
   $username = "root",
   $pass = "",
   $db = "db_parkiran";

   public $koneksi;
    
   //membuat konstrak yang dimana fungsi ini akan dijalankan otomatis ketika kita membuat objek dari kelas koneksi
   function __construct()
   {
       //variabel $this adalah sebuah variabel khusus dalam oop php yang digunakan sebagai penunjuk kepada objek,ketika kita mengaksesnya dari dalam class.
       $this->koneksi = mysqli_connect($this->host,
       $this->username, $this->pass, $this->db);

       if ($this->koneksi){
         //  echo "koneksi kedatabase ".$this->db. " berhasil";

          return $this->koneksi;
       }else{
         die("koneksi kedatabase gagal".mysqli_connect_error()); 
       }
   }
}

//cara membuat variabel objek
$con = new koneksi();
