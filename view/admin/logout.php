 <?php
session_start();

// Ambil data user sebelum logout
 $user = $_SESSION['user'] ?? '';
$role = $_SESSION['role'] ?? '';


// Simpan log aktivitas logout
if(!empty($user)){
    include_once __DIR__ . '/../../models/aktivitas.php';
    $aktivitas = new aktivitas();

    $id_log = uniqid('log_');       // ID unik
    $desc   = "Logout dari Sistem";
    $waktu  = date("Y-m-d H:i:s");

    $aktivitas->tambah_aktivitas($id_log, $user, $role, $desc, $waktu);
}

// Hapus session
session_destroy();

// Redirect ke login
header("Location: ../../index.php");
exit;
?>
