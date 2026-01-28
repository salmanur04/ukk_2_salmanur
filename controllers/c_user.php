 <?php
//memanggil model user
include_once __DIR__ . '/../models/user.php';

//membuat objek dari kelas user
$user = new user();

//memanggil fungsi tampil data yang ada di kelas user
$users = $user->tampil_data_user();