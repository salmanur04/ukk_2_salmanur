 <?php
// memanggil model user
include_once __DIR__ . '/../models/user.php';

// membuat objek dari kelas user
$user = new user();

/*
|--------------------------------------------------------------------------
| PROSES AJAX (TAMBAH / EDIT / HAPUS)
|--------------------------------------------------------------------------
*/
if (isset($_POST['aksi'])) {

    if ($_POST['aksi'] == 'tambah') {
        $user->tambah_user(
            $_POST['id_user'],
            $_POST['nama_lengkap'],
            $_POST['username'],
            $_POST['role']
        );

        echo json_encode([
            'status' => 'success',
            'pesan'  => 'Data berhasil ditambahkan'
        ]);
        exit;
    }

    if ($_POST['aksi'] == 'edit') {
        $user->edit_user(
            $_POST['id_user'],
            $_POST['nama_lengkap'],
            $_POST['username'],
            $_POST['role']
        );

        echo json_encode([
            'status' => 'success',
            'pesan'  => 'Data berhasil diupdate'
        ]);
        exit;
    }

    if ($_POST['aksi'] == 'hapus') {
        $user->hapus_user($_POST['id_user']);

        echo json_encode([
            'status' => 'success',
            'pesan'  => 'Data berhasil dihapus'
        ]);
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| TAMPIL DATA (UNTUK VIEW)
|--------------------------------------------------------------------------
*/
$users = $user->tampil_data_user();
