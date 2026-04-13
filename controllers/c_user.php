<?php
include_once __DIR__ . '/../models/user.php';

$user = new User();

/* ================= AJAX CRUD ================= */
if(isset($_POST['aksi'])){

    // ================= TAMBAH =================
    if($_POST['aksi'] == "tambah"){

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user->tambah_user(
            $_POST['username'],
            $password,
            $_POST['role']
        );

        echo json_encode([
            "status" => "success",
            "pesan" => "User berhasil ditambahkan"
        ]);
        exit;
    }

    // ================= EDIT =================
    if($_POST['aksi'] == "edit"){

        // kalau password kosong → jangan diubah
        if(!empty($_POST['password'])){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            // ambil password lama dari DB
            $dataLama = $user->getById($_POST['id_user']);
            $password = $dataLama->password;
        }

        $user->edit_user(
            $_POST['id_user'],
            $_POST['username'],
            $password,
            $_POST['role']
        );

        echo json_encode([
            "status" => "success",
            "pesan" => "User berhasil diupdate"
        ]);
        exit;
    }

    // ================= HAPUS =================
    if($_POST['aksi'] == "hapus"){

        $user->hapus_user($_POST['id_user']);

        echo json_encode([
            "status" => "success",
            "pesan" => "User berhasil dihapus"
        ]);
        exit;
    }
}

/* ================= TAMPIL DATA ================= */
$users = $user->tampil_data_user();
?>