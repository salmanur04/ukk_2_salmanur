 <?php
include_once __DIR__ . '/../../controllers/c_tarif.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Tarif Parkir</title>

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

/* Tombol kembali */
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
    padding:20px 25px;
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

input,select{
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
.edit{background:#3498db;}
.hapus{background:#e74c3c;}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#2c5364;
    color:#fff;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
</style>
</head>

<body>

<a href="dasboard.php" class="btn-kembali">
    ⬅ Kembali  
</a>

<div class="header">
    <h1>🚗 Dashboard Tarif Parkir</h1>
    <p>Manajemen Tarif Parkir</p>
</div>

<div class="container">

<!-- ================= FORM ================= -->
<div class="card">
<h3>Form Tarif Parkir</h3>

<form id="formTarif">
    <input type="hidden" name="id_tarif" id="id_tarif">

    <label>Jenis Kendaraan</label>
    <select name="jenis_kendaraan" id="jenis_kendaraan" required>
        <option value="">-- Pilih --</option>
        <option value="motor">Motor</option>
        <option value="mobil">Mobil</option>
    </select>

    <label>Tarif per Jam</label>
    <input type="number" name="tarif_per_jam" id="tarif_per_jam" required>

    <label>Ketentuan Waktu (Jam)</label>
    <input type="number" name="ketentuan_waktu" id="ketentuan_waktu" required>

    <button type="submit" id="btnSimpan" class="submit">💾 Simpan</button>
</form>
</div>

<!-- ================= TABEL ================= -->
<div class="card">
<h3>📋 Data Tarif Parkir</h3>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Jenis Kendaraan</th>
    <th>Tarif / Jam</th>
    <th>Ketentuan</th>
    <th>Total Bayar</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php if(!empty($data_tarif)): ?>
<?php $no=1; foreach($data_tarif as $row): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row->jenis_kendaraan) ?></td>
    <td>Rp <?= number_format($row->tarif_per_jam) ?></td>
    <td><?= $row->ketentuan_waktu ?> Jam</td>
    <td>Rp <?= number_format($row->tarif_per_jam * $row->ketentuan_waktu) ?></td>
    <td>
        <button class="edit" onclick='edit(<?= json_encode($row) ?>)'>Edit</button>
        <button class="hapus" onclick="hapus(<?= $row->id_tarif ?>)">Hapus</button>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="6">Data masih kosong</td>
</tr>
<?php endif; ?>

</tbody>
</table>
</div>

</div>

<script>
document.getElementById("formTarif").addEventListener("submit",function(e){
    e.preventDefault();

    let fd = new FormData(this);
    let aksi = document.getElementById("id_tarif").value ? "edit" : "tambah";
    fd.append("aksi", aksi);

    fetch("../../controllers/c_tarif.php",{
        method:"POST",
        body:fd
    })
    .then(res=>res.json())
    .then(data=>{
        alert(data.pesan);
        location.reload();
    });
});

function edit(data){
    document.getElementById("id_tarif").value = data.id_tarif;
    document.getElementById("jenis_kendaraan").value = data.jenis_kendaraan;
    document.getElementById("tarif_per_jam").value = data.tarif_per_jam;
    document.getElementById("ketentuan_waktu").value = data.ketentuan_waktu;
    document.getElementById("btnSimpan").innerText = "Update";

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function hapus(id){
    if(!confirm("Hapus tarif ini?")) return;

    let fd = new FormData();
    fd.append("aksi","hapus");
    fd.append("id_tarif",id);

    fetch("../../controllers/c_tarif.php",{
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
