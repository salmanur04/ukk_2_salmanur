 <?php
include_once __DIR__ . '/../models/user.php';

$user = new user();

/* AJAX CRUD */
if(isset($_POST['aksi'])){

    if($_POST['aksi']=="tambah"){

        // HASH PASSWORD
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user->tambah_user(
            $_POST['id_user'],
            $_POST['nama_lengkap'],
            $password, // ✅ pakai password hash
            $_POST['username'],
            $_POST['role']
        );

        echo json_encode([
            "status"=>"success",
            "pesan"=>"Data berhasil ditambahkan"
        ]);
        exit;
    }

    if($_POST['aksi']=="edit"){

        // HASH PASSWORD SAAT EDIT
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user->edit_user(
            $_POST['id_user'],
            $_POST['nama_lengkap'],
            $password, // ✅ pakai password hash
            $_POST['username'],
            $_POST['role']
        );

        echo json_encode([
            "status"=>"success",
            "pesan"=>"Data berhasil diupdate"
        ]);
        exit;
    }

    if($_POST['aksi']=="hapus"){
        $user->hapus_user($_POST['id_user']);
        echo json_encode([
            "status"=>"success",
            "pesan"=>"Data berhasil dihapus"
        ]);
        exit;
    }
}

/* TAMPIL DATA */
$users = $user->tampil_data_user();
