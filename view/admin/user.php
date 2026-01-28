 <?php
include_once __DIR__ . '/../../controllers/c_user.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard User</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    background: #f4f6f9;
}

/* HEADER */
.header {
    background: linear-gradient(135deg,#1abc9c,#16a085);
    color: white;
    padding: 20px;
}

.header h1 {
    margin: 0;
}

/* CONTAINER */
.container {
    padding: 25px;
}

/* CARD */
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    margin-bottom: 25px;
}

/* FORM */
label {
    font-weight: 600;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    padding: 10px 20px;
    background: #1abc9c;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #1abc9c;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f1f1f1;
}

/* AKSI */
.aksi span {
    padding: 6px 12px;
    border-radius: 6px;
    color: white;
    font-size: 14px;
}

.edit {
    background: #3498db;
}

.hapus {
    background: #e74c3c;
}
</style>
</head>

<body>

<div class="header">
    <h1>📊 Dashboard User</h1>
    <p>Manajemen Data User</p>
</div>

<div class="container">

    <div class="card">
        <h3>Form User</h3>
        <form>
            <label>ID User</label>
            <input type="text" placeholder="Masukkan ID User">

            <label>Nama lengkap</label>
            <input type="text" placeholder="Masukkan Nama lengkap">

            <label>Username</label>
            <input type="text" placeholder="Masukkan Username">

            <label>Role</label>
            <input type="text" placeholder="Masukkan Role">


            <button type="button">💾 Simpan Data</button>
        </form>
    </div>

    <!-- TABLE (TAMPILAN SAJA) -->
    <div class="card">
        <h3>Data User</h3>
        <table>
            <tr>
                <th>No</th>
                <th>iD User</th>
                <th>Nama lengkap</th>
                <th>username</th>
                <th>role</th>
                <th>Aksi</th>
            </tr>

</thead>

 <tbody>
<?php
$no = 1;
foreach ($users as $data) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $data->id_user ?></td>
    <td><?= $data->nama_lengkap ?></td>
    <td><?= $data->username ?></td>
    <td><?= $data->role ?></td>
    <td>
        <!-- AKSI -->
        <a href="edit_user.php?id=<?= $data->id_user ?>" 
           style="padding:6px 10px; background:#3498db; color:#fff; text-decoration:none; border-radius:5px;">
           Edit
        </a>

        <a href="hapus_user.php?id=<?= $data->id_user ?>" 
           onclick="return confirm('Yakin mau hapus data ini?')"
           style="padding:6px 10px; background:#e74c3c; color:#fff; text-decoration:none; border-radius:5px;">
           Hapus
        </a>
    </td>
</tr>
<?php } ?>
</tbody>

     
        
    