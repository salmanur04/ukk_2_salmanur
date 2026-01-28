 <?php
//memanggil koneksi ke database
 include_once __DIR__ . "/koneksi.php";

//membuat kelas user
class user
{

//membuat fungsi untuk menampilkan semua data dari tabel user
public function tampil_data_user(){

//membuat objek dari kelas koneksi
$koneksi = new koneksi();

//membuat query untuk menampilkan data dari tabel user
$sql = "SELECT * FROM tb_user";

//perintah untuk menjalankan query diatas 
$post = mysqli_query($koneksi->koneksi, $sql);

//mengecek apakah variabel $post ada data nya atau tida
$result = [];

if($post && $post->num_rows > 0){
    //merubah data dari variabel $post menjadi data berbentuk objek 
    while ($data = mysqli_fetch_object($post)) {
        //menyimpan data objek kedalam variabel $result yang berbentuk array
        $result[] = $data;
    }
}

//kembali nilai nya (kosong atau berisi)
return $result;

}

}