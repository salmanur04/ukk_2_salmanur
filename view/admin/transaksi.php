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
}

.container{ padding:25px; }

form{
    background: rgba(255,255,255,0.05);
    padding:25px;
    border-radius:15px;
    margin-bottom:25px;
}

form input, form select{
    padding:10px;
    margin:8px 0;
    width:100%;
    border-radius:8px;
    border:1px solid #555;
    background:#1c1c1c;
    color:white;
}

.btn-simpan{ background:#3498db; color:white; }
.btn-batal{ background:#555; color:white; }

table{
    width:100%;
    border-collapse:collapse;
    background: rgba(255,255,255,0.05);
}

th, td{ padding:12px; text-align:center; }
th{ background:#203a43; }

.btn-edit{ background:#3498db; color:white; padding:6px 10px; border-radius:6px; }
.btn-hapus{ background:#e74c3c; color:white; padding:6px 10px; border-radius:6px; }

.btn-cetak{
    background:#27ae60;
    color:white;
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
}

.aksi-wrapper{
    display:flex;
    flex-direction:column;
    gap:5px;
}

/* 🔥 NOTIF STYLE */
.notif {
    position:fixed;
    top:20px;
    right:20px;
    padding:12px 20px;
    border-radius:8px;
    color:white;
    z-index:9999;
    font-size:14px;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<div class="header">
    <h1>💳 Transaksi Parkir</h1>
    <a href="dasboard.php" style="color:white;">⬅ Kembali</a>
</div>

<div class="container">

<form id="formTransaksi">
    <h3 id="formTitle">Tambah Transaksi</h3>

    <input type="hidden" name="id_parkir" id="id_parkir">

    <label>Kendaraan</label>
    <select id="id_kendaraan">
        <option value="">-- Pilih Kendaraan --</option>
        <?php foreach($data_kendaraan as $k): ?>
            <option value="<?= $k->id_kendaraan ?>">
                <?= htmlspecialchars($k->plat_nomor) ?> - <?= htmlspecialchars($k->jenis_kendaraan) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Waktu Masuk</label>
    <input type="datetime-local" id="waktu_masuk">

    <label>Waktu Keluar</label>
    <input type="datetime-local" id="waktu_keluar">

    <label>Status</label>
    <select id="status">
        <option value="masuk">Masuk</option>
        <option value="keluar">Keluar</option>
    </select>

    <button type="submit" class="btn-simpan">Simpan</button>
    <button type="button" class="btn-batal" id="btnBatal" style="display:none;">Batal</button>
</form>

<div id="tableContainer">
<table>
<tr>
    <th>ID</th>
    <th>Plat</th>
    <th>Jenis</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Durasi</th>
    <th>Biaya</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php foreach($data_transaksi as $row): ?>
<tr>
    <td><?= $row->id_parkir ?></td>
    <td><?= htmlspecialchars($row->plat_nomor) ?></td>
    <td><?= htmlspecialchars($row->jenis_kendaraan) ?></td>
    <td><?= $row->waktu_masuk ?></td>
    <td><?= $row->waktu_keluar ?: '-' ?></td>
    <td><?= $row->durasi_jam ?> Jam</td>
    <td>Rp <?= number_format($row->biaya_total) ?></td>
    <td><?= ucfirst($row->status) ?></td>
    <td>

        <button class="btn-edit"
        onclick="editTransaksi(
            '<?= $row->id_parkir ?>',
            '<?= $row->id_kendaraan ?>',
            '<?= $row->waktu_masuk ?>',
            '<?= $row->waktu_keluar ?>',
            '<?= $row->status ?>'
        )">Edit</button>

        <button class="btn-hapus"
        onclick="hapusTransaksi('<?= $row->id_parkir ?>')">Hapus</button>

        <a href="cetak_struk.php?id=<?= $row->id_parkir ?>" target="_blank" class="btn-cetak">
            📄 Cetak
        </a>

    </td>
</tr>
<?php endforeach; ?>

</table>
</div>

</div>

<!-- 🔥 AJAX + NOTIF -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

let mode = "tambah";

// ================= NOTIF =================
function notif(msg, type){
    let bg = type === "success" ? "#2ecc71" : "#e74c3c";

    let n = $("<div class='notif'></div>").text(msg).css("background", bg);

    $("body").append(n);

    setTimeout(() => {
        n.fadeOut(300, function(){
            $(this).remove();
        });
    }, 2000);
}

// ================= RESET =================
function reset(){
    mode = "tambah";
    $("#formTransaksi")[0].reset();
    $("#formTitle").text("Tambah Transaksi");
    $("#btnBatal").hide();
    $("#id_parkir").val("");
}

// ================= SUBMIT =================
$("#formTransaksi").on("submit", function(e){
    e.preventDefault();

    $.ajax({
        url: "../../controllers/c_transaksi.php",
        type: "POST",
        dataType: "json",
        data: {
            aksi: mode,
            id_parkir: $("#id_parkir").val(),
            id_kendaraan: $("#id_kendaraan").val(),
            waktu_masuk: $("#waktu_masuk").val(),
            waktu_keluar: $("#waktu_keluar").val(),
            status: $("#status").val()
        },
        success: function(res){
            notif(res.pesan, res.status);

            if(res.status === "success"){
                reset();
                location.reload(); // kalau mau full tanpa reload nanti bisa upgrade lagi
            }
        }
    });
});

// ================= EDIT =================
function editTransaksi(id, kendaraan, masuk, keluar, status){
    $("#id_parkir").val(id);
    $("#id_kendaraan").val(kendaraan);
    $("#waktu_masuk").val(masuk);
    $("#waktu_keluar").val(keluar);
    $("#status").val(status);

    mode = "edit";
    $("#formTitle").text("Edit Transaksi");
    $("#btnBatal").show();
}

// ================= HAPUS =================
function hapusTransaksi(id){
    if(confirm("Yakin hapus?")){
        $.ajax({
            url: "../../controllers/c_transaksi.php",
            type: "POST",
            dataType: "json",
            data: {
                aksi: "hapus",
                id_parkir: id
            },
            success: function(res){
                notif(res.pesan, res.status);

                if(res.status === "success"){
                    location.reload();
                }
            }
        });
    }
}

// ================= BATAL =================
$("#btnBatal").on("click", function(){
    reset();
});

</script>

</body>
</html>