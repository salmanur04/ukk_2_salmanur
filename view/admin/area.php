 <?php
include_once __DIR__ . '/../../controllers/c_area.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Area Parkir</title>

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

form input {
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
    <h1>🅿️ Area Parkir</h1>
    <p>Manajemen Data Area Parkir</p>
</div>

<div class="container">

<!-- ===== FORM TAMBAH / EDIT ===== -->
<form id="formArea">
    <input type="text" name="id_area" placeholder="ID Area" required>
    <input type="text" name="nama_area" placeholder="Nama Area" required>
    <input type="number" name="kapasitas" placeholder="Kapasitas" required>
    <input type="number" name="terisi" placeholder="Terisi" required>
    <button type="submit">Simpan</button>
</form>

<!-- ===== TABEL DATA ===== -->
<table>
<tr>
    <th>ID Area</th>
    <th>Nama Area</th>
    <th>Kapasitas</th>
    <th>Terisi</th>
    <th>Aksi</th>
</tr>

<?php if(!empty($data_area)): ?>
<?php foreach($data_area as $row): ?>
<tr>
    <td><?= htmlspecialchars($row->id_area) ?></td>
    <td><?= htmlspecialchars($row->nama_area) ?></td>
    <td><?= $row->kapasitas ?></td>
    <td><?= $row->terisi ?></td>
    <td>
        <button class="btn-edit"
            onclick="editArea(
                '<?= $row->id_area ?>',
                '<?= $row->nama_area ?>',
                '<?= $row->kapasitas ?>',
                '<?= $row->terisi ?>'
            )">Edit</button>

        <button class="btn-hapus"
            onclick="hapusArea('<?= $row->id_area ?>')">Hapus</button>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5">Data area belum tersedia</td>
</tr>
<?php endif; ?>
</table>

</div>

<script>
const form = document.getElementById('formArea');

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
function hapusArea(id){
    if(!confirm('Yakin hapus area ini?')) return;

    let data = new FormData();
    data.append('aksi','hapus');
    data.append('id_area',id);

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
function editArea(id,nama,kapasitas,terisi){
    form.id_area.value = id;
    form.nama_area.value = nama;
    form.kapasitas.value = kapasitas;
    form.terisi.value = terisi;

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
