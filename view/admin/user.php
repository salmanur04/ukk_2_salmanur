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
.header {
    background: linear-gradient(135deg,#1abc9c,#16a085);
    color: white;
    padding: 20px;
}
.container {
    padding: 25px;
}
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    margin-bottom: 25px;
}
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
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
}
button.submit {
    background: #1abc9c;
}
button.edit {
    background: #3498db;
}
button.hapus {
    background: #e74c3c;
}
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
</style>
</head>

<body>
    <a href="dasboard.php"
   style="display:inline-block;margin-bottom:15px;
          background:#1abc9c;color:#fff;
          padding:8px 14px;border-radius:6px;
          text-decoration:none;">
    ⬅ Kembali ke Dashboard
</a>


<div class="header">
    <h1>📊 Dashboard User</h1>
    <p>Manajemen Data User</p>
</div>

<div class="container">

<!-- ================= FORM ================= -->
<div class="card">
    <h3>Form User</h3>

    <form id="formUser">
        <input type="hidden" name="aksi" id="aksi" value="tambah">

        <label>ID User</label>
        <input type="text" name="id_user" id="id_user" required>

        <label>Nama lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" required>

        <label>Username</label>
        <input type="text" name="username" id="username" required>

        <label>Role</label>
        <input type="text" name="role" id="role" required>

        <button type="submit" class="submit">💾 Simpan Data</button>
    </form>
</div>

<!-- ================= TABLE ================= -->
<div class="card">
    <h3>Data User</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID User</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($users as $data) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data->id_user ?></td>
                <td><?= $data->nama_lengkap ?></td>
                <td><?= $data->username ?></td>
                <td><?= $data->role ?></td>
                <td>
                    <button class="edit" onclick='editUser(<?= json_encode($data) ?>)'>Edit</button>
                    <button class="hapus" onclick="hapusUser('<?= $data->id_user ?>')">Hapus</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
document.getElementById("formUser").addEventListener("submit", function(e){
    e.preventDefault();
    const formData = new FormData(this);

    fetch("../../controllers/c_user.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.pesan);
        location.reload();
    });
});

function editUser(data){
    document.getElementById("aksi").value = "edit";
    document.getElementById("id_user").value = data.id_user;
    document.getElementById("id_user").readOnly = true;
    document.getElementById("nama_lengkap").value = data.nama_lengkap;
    document.getElementById("username").value = data.username;
    document.getElementById("role").value = data.role;
}

function hapusUser(id){
    if(!confirm("Yakin hapus data?")) return;

    const formData = new FormData();
    formData.append("aksi","hapus");
    formData.append("id_user",id);

    fetch("../../controllers/c_user.php",{
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(data=>{
        alert(data.pesan);
        location.reload();
    });
}
</script>

</body>
</html>
