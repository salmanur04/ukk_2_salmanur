 <?php
include_once __DIR__ . '/../../controllers/c_user.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard User</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    margin:0;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    min-height:100vh;
}

.btn-kembali{
    display:inline-block;
    margin:20px;
    background:linear-gradient(135deg,#2c5364,#203a43);
    color:#fff;
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}

.header{
    color:#fff;
    padding:20px;
}

.container{
    padding:25px;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,0.2);
    margin-bottom:25px;
}

label{
    font-weight:600;
    color:#203a43;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0 15px;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    padding:8px 14px;
    border:none;
    border-radius:8px;
    color:#fff;
    cursor:pointer;
    font-weight:bold;
}

.submit{background:#2c5364;}
.reset{background:#95a5a6;}
.edit{background:#3498db;}
.hapus{background:#e74c3c;}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
}

th, td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

th{
    background:#2c5364;
    color:#fff;
}

tr:hover{
    background:#f2f2f2;
}
</style>
</head>

<body>

<a href="dasboard.php" class="btn-kembali">
    ⬅ Kembali 
</a>

<div class="header">
    <h1 id="judulForm">➕ Tambah User</h1>
    <p>Manajemen Data User</p>
</div>

<div class="container">

<!-- ===== FORM ===== -->
<div class="card">

<input type="text" style="display:none">
<input type="password" style="display:none">

<form id="formUser" autocomplete="off">
    <input type="hidden" name="aksi" id="aksi" value="tambah">
    <input type="hidden" name="id_user" id="id_user">

    <label>Nama Lengkap</label>
    <input type="text" name="nama_lengkap" id="nama_lengkap" required>

    <label>Username</label>
    <input type="text" name="username" id="username" required autocomplete="off">

    <label>Password</label>
    <input type="password" name="password" id="password" required autocomplete="new-password">

    <button type="submit" class="submit">💾 Simpan Data</button>
</form>
</div>

<!-- ===== TABEL ===== -->
<h3 style="color:white;">📋 Data User</h3>

<table>
<thead>
<tr>
    <th>No</th>
    <th>ID</th>
    <th>Nama Lengkap</th>
    <th>Password</th>
    <th>Username</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($users as $u){ ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $u->id_user ?></td>
    <td><?= $u->nama_lengkap ?></td>
    <td><?= $u->password ?></td>
    <td><?= $u->username ?></td>
    <td>
        <button class="edit" onclick='editUser(<?= json_encode($u) ?>)'>Edit</button>
        <button class="hapus" onclick="hapusUser('<?= $u->id_user ?>')">Hapus</button>
    </td>
</tr>
<?php } ?>
</tbody>
</table>

</div>

<script>
document.getElementById("formUser").addEventListener("submit",function(e){
    e.preventDefault();
    let formData=new FormData(this);

    fetch("../../controllers/c_user.php",{
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(data=>{
        alert(data.pesan);
        location.reload();
    });
});

function editUser(data){
    aksi.value = "edit";
    document.getElementById("judulForm").innerHTML = "✏ Edit User";

    id_user.value = data.id_user;
    nama_lengkap.value = data.nama_lengkap;
    username.value = data.username;
    password.value = data.password;

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function hapusUser(id){
    if(!confirm("Yakin hapus data?")) return;

    let fd=new FormData();
    fd.append("aksi","hapus");
    fd.append("id_user",id);

    fetch("../../controllers/c_user.php",{
        method:"POST",
        body:fd
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