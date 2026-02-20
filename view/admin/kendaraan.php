 <?php
include_once __DIR__ . '/../../controllers/c_kendaraan.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kendaraan</title>

<style>
* { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

body { 
    margin: 0; 
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
}

.header {
    background: linear-gradient(135deg,#2c5364,#203a43);
    color:white;
    padding:20px;
}

.container { padding:25px; }

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,.2);
}

table th, table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

table th {
    background: #2c5364;
    color: white;
}

form {
    margin-bottom: 20px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,.2);
}

form input, form select {
    padding: 8px;
    margin-right: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

form button {
    padding: 10px 20px;
    background: #2c5364;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

form button:hover { 
    background: #203a43; 
}

button {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-edit { 
    background:#3498db; 
    color:white; 
}

.btn-hapus { 
    background:#e74c3c; 
    color:white; 
}
</style>
</head>

<body>

<a href="dasboard.php"
style="display:inline-block;margin:15px;
background:linear-gradient(135deg,#2c5364,#203a43);
color:#fff;
padding:8px 14px;border-radius:6px;
text-decoration:none">
⬅ Kembali  
</a>

<div class="header">
    <h1>🚗 Data Kendaraan</h1>
    <p>Manajemen Data Kendaraan</p>
</div>

<div class="container">

<!-- ===== FORM TAMBAH / EDIT ===== -->
<form id="formKendaraan">
    <input type="text" name="id_kendaraan" placeholder="ID Kendaraan" required>
    <input type="text" name="plat_nomor" placeholder="Plat Nomor" required>

    <select name="jenis_kendaraan" required>
        <option value="">-- Pilih Jenis Kendaraan --</option>
        <option value="Motor">Motor</option>
        <option value="Mobil">Mobil</option>
         
    </select>

    <input type="text" name="warna" placeholder="Warna" required>

    <button type="submit">Simpan</button>
</form>

<!-- ===== TABEL DATA ===== -->
<table>
<tr>
    <th>ID Kendaraan</th>
    <th>Plat Nomor</th>
    <th>Jenis Kendaraan</th>
    <th>Warna</th>
    <th>Aksi</th>
</tr>

<?php if(!empty($data_kendaraan)): ?>
<?php foreach($data_kendaraan as $row): ?>
<tr>
    <td><?= htmlspecialchars($row->id_kendaraan) ?></td>
    <td><?= htmlspecialchars($row->plat_nomor) ?></td>
    <td><?= htmlspecialchars($row->jenis_kendaraan) ?></td>
    <td><?= htmlspecialchars($row->warna) ?></td>
    <td>
        <button class="btn-edit"
            onclick="editKendaraan(
                '<?= $row->id_kendaraan ?>',
                '<?= $row->plat_nomor ?>',
                '<?= $row->jenis_kendaraan ?>',
                '<?= $row->warna ?>'
            )">Edit</button>

        <button class="btn-hapus"
            onclick="hapusKendaraan('<?= $row->id_kendaraan ?>')">Hapus</button>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5">Data kendaraan belum tersedia</td>
</tr>
<?php endif; ?>
</table>

</div>

<script>
const form = document.getElementById('formKendaraan');

/* TAMBAH DATA */
form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData(form);
    data.append('aksi','tambah');

    fetch('', {
        method:'POST',
        body:data
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success'){
            alert(res.pesan);
            location.reload();
        } else {
            alert(res.pesan);
        }
    });
});

/* HAPUS DATA */
function hapusKendaraan(id){
    if(!confirm('Yakin hapus kendaraan ini?')) return;

    let data = new FormData();
    data.append('aksi','hapus');
    data.append('id_kendaraan',id);

    fetch('',{
        method:'POST',
        body:data
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success'){
            alert(res.pesan);
            location.reload();
        } else {
            alert(res.pesan);
        }
    });
}

/* EDIT DATA */
function editKendaraan(id,plat,jenis,warna){
    form.id_kendaraan.value = id;
    form.plat_nomor.value = plat;
    form.jenis_kendaraan.value = jenis;
    form.warna.value = warna;

    form.onsubmit = function(e){
        e.preventDefault();

        let data = new FormData(form);
        data.append('aksi','edit');

        fetch('',{
            method:'POST',
            body:data
        })
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success'){
                alert(res.pesan);
                location.reload();
            } else {
                alert(res.pesan);
            }
        });
    }
}
</script>

</body>
</html>
