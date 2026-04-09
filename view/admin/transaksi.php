 <?php
include_once __DIR__ . '/../../controllers/c_transaksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Transaksi Parkir</title>

<style>
* { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

body {
    margin:0;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
}

.header{
    background: linear-gradient(135deg,#2c5364,#203a43);
    padding:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 5px 20px rgba(0,0,0,.6);
}

.header h1{ margin:0; }

.btn-dashboard{
    background: linear-gradient(135deg,#3498db,#2c5364);
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    transition:.3s;
}

.btn-dashboard:hover{ transform:translateY(-3px); }

.container{ padding:25px; }

form{
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(8px);
    padding:25px;
    border-radius:15px;
    margin-bottom:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.6);
}

form h3{ margin-top:0; color:#3498db; }

form input, form select{
    padding:10px;
    margin:8px 0;
    width:100%;
    border-radius:8px;
    border:1px solid #555;
    background:#1c1c1c;
    color:white;
}

form input:focus, form select:focus{
    border-color:#3498db;
    outline:none;
    box-shadow:0 0 10px rgba(52,152,219,.6);
}

form button{
    padding:10px 15px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    margin-top:10px;
    font-weight:bold;
    transition:.3s;
}

.btn-simpan{
    background:linear-gradient(135deg,#3498db,#2c5364);
    color:white;
}

.btn-simpan:hover{ transform:scale(1.05); }

.btn-batal{ background:#555; color:white; }

table{
    width:100%;
    border-collapse:collapse;
    background: rgba(255,255,255,0.05);
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.6);
}

th, td{ padding:14px; text-align:center; }

th{
    background:linear-gradient(135deg,#2c5364,#203a43);
    color:white;
}

tr:nth-child(even){ background:rgba(255,255,255,0.03); }
tr:hover{ background:rgba(52,152,219,0.1); }

.btn-edit{
    background:#3498db;
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:6px;
    cursor:pointer;
    margin-bottom:5px;
}

.btn-hapus{
    background:#e74c3c;
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:6px;
    cursor:pointer;
    margin-bottom:5px;
}

.btn-cetak{
    background:#27ae60;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    display:inline-block;
    font-size:12px;
}

.aksi-wrapper{
    display:flex;
    flex-direction:column;
    gap:6px;
    align-items:center;
}
</style>
</head>

<body>

<div class="header">
    <h1>💳 Transaksi Parkir</h1>
    <a href="dasboard.php" class="btn-dashboard">⬅ Kembali</a>
</div>

<div class="container">

<form id="formTransaksi">
    <h3 id="formTitle">Tambah Transaksi</h3>

    <input type="hidden" name="id_parkir" id="id_parkir">

    <label>Plat Nomor</label>
    <input type="text" name="plat_nomor" id="plat_nomor" required>

    <label>Jenis Kendaraan</label>
    <select name="jenis_kendaraan" id="jenis_kendaraan" required>
        <option value="">-- Pilih --</option>
        <option value="Motor">Motor</option>
        <option value="Mobil">Mobil</option>
    </select>

    <label>Waktu Masuk</label>
    <input type="datetime-local" name="waktu_masuk" id="waktu_masuk" required>

    <label>Waktu Keluar</label>
    <input type="datetime-local" name="waktu_keluar" id="waktu_keluar" required>

    <label>Status</label>
    <select name="status" id="status">
        <option value="masuk">masuk</option>
        <option value="keluar">keluar</option>
    </select>

    <button type="submit" class="btn-simpan" id="btnSubmit">Simpan</button>
    <button type="button" class="btn-batal" id="btnBatal" style="display:none;">Batal Edit</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Plat Nomor</th>
    <th>Jenis</th>
    <th>Waktu Masuk</th>
    <th>Waktu Keluar</th>
    <th>Durasi</th>
    <th>Biaya</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php if(!empty($data_transaksi)): ?>
<?php foreach($data_transaksi as $row): ?>
<tr>
    <td><?= $row->id_parkir ?></td>
    <td><?= htmlspecialchars($row->plat_nomor) ?></td>
    <td><?= htmlspecialchars($row->jenis_kendaraan) ?></td>
    <td><?= $row->waktu_masuk ?></td>
    <td><?= $row->waktu_keluar ?></td>
    <td><?= $row->durasi_jam ?> Jam</td>
    <td>Rp <?= number_format($row->biaya_total) ?></td>
    <td><?= htmlspecialchars($row->status) ?></td>
    <td>
        <div class="aksi-wrapper">
            <button type="button" class="btn-edit"
                onclick="editTransaksi(
                    '<?= $row->id_parkir ?>',
                    '<?= htmlspecialchars($row->plat_nomor, ENT_QUOTES) ?>',
                    '<?= $row->jenis_kendaraan ?>',
                    '<?= $row->waktu_masuk ?>',
                    '<?= $row->waktu_keluar ?>',
                    '<?= $row->status ?>'
                )">Edit</button>

            <button type="button" class="btn-hapus"
                onclick="hapusTransaksi('<?= $row->id_parkir ?>')">Hapus</button>

            <a href="cetak_struk.php?id=<?= $row->id_parkir ?>" target="_blank" class="btn-cetak">
                📄 Cetak
            </a>
        </div>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="9">Belum ada data transaksi</td>
</tr>
<?php endif; ?>
</table>

</div>

<script>
const form = document.getElementById('formTransaksi');
let mode = "tambah";

function editTransaksi(id, plat, jenis, masuk, keluar, status){
    document.getElementById("id_parkir").value = id;
    document.getElementById("plat_nomor").value = plat;
    form.jenis_kendaraan.value = jenis;
    form.waktu_masuk.value = masuk.replace(" ", "T").substring(0,16);
    form.waktu_keluar.value = keluar.replace(" ", "T").substring(0,16);
    form.status.value = status;

    document.getElementById("formTitle").innerText = "Edit Transaksi";
    document.getElementById("btnSubmit").innerText = "Update";
    document.getElementById("btnBatal").style.display = "inline-block";

    mode = "edit";
}

document.getElementById("btnBatal").addEventListener("click", function(){
    form.reset();
    document.getElementById("id_parkir").value = "";
    document.getElementById("formTitle").innerText = "Tambah Transaksi";
    document.getElementById("btnSubmit").innerText = "Simpan";
    this.style.display = "none";
    mode = "tambah";
});

form.addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(form);

    // Konversi datetime-local ke format MySQL
    let masuk = form.waktu_masuk.value.replace("T", " ") + ":00";
    let keluar = form.waktu_keluar.value.replace("T", " ") + ":00";
    formData.set("waktu_masuk", masuk);
    formData.set("waktu_keluar", keluar);

    formData.append("aksi", mode);

    fetch("../../controllers/c_transaksi.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.pesan);
        if(data.status === "success"){
            location.reload();
        }
    });
});

function hapusTransaksi(id){
    if(confirm("Yakin ingin menghapus data ini?")){
        let formData = new FormData();
        formData.append("aksi", "hapus");
        formData.append("id_parkir", id);

        fetch("../../controllers/c_transaksi.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            alert(data.pesan);
            if(data.status === "success"){
                location.reload();
            }
        });
    }
}
</script>

</body>
</html>