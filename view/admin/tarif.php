 <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Tarif Parkir</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    background: #eef2f7;
}

/* HEADER */
.header {
    background: #1f2937;
    color: white;
    padding: 20px 30px;
}

.header h1 {
    margin: 0;
}

/* GRID */
.container {
    padding: 25px;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 25px;
}

/* CARD */
.card {
    background: white;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

/* SUMMARY */
.summary {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.summary .box {
    background: linear-gradient(135deg,#3b82f6,#1e40af);
    color: white;
    padding: 20px;
    border-radius: 12px;
}

.summary .box h2 {
    margin: 0;
    font-size: 26px;
}

.summary .box p {
    margin: 5px 0 0;
    font-size: 14px;
}

/* FORM */
label {
    font-weight: 600;
    font-size: 14px;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 6px 0 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 12px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background: #f1f5f9;
    padding: 12px;
    text-align: center;
    font-size: 14px;
}

td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
}

tr:hover {
    background: #f9fafb;
}

/* AKSI */
.aksi span {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    color: white;
}

.edit { background: #22c55e; }
.hapus { background: #ef4444; }

</style>
</head>

<body>

<div class="header">
    <h1>🅿️ Tarif Parkir</h1>
    <p>Dashboard Manajemen Tarif</p>
</div>

<div class="container">

    <!-- KIRI -->
    <div>
        <div class="summary">
            <div class="box">
                <h2>Motor</h2>
                <p>Tarif mulai Rp 2.000</p>
            </div>
            <div class="box">
                <h2>Mobil</h2>
                <p>Tarif mulai Rp 5.000</p>
            </div>
        </div>

        <div class="card">
            <h3>Tambah / Edit Tarif</h3>
            <label>Jenis Kendaraan</label>
            <select>
                <option>Motor</option>
                <option>Mobil</option>
            </select>

            <label>Tarif Jam Pertama</label>
            <input type="number">

            <label>Tarif Jam Berikutnya</label>
            <input type="number">

            <button>Simpan Tarif</button>
        </div>
    </div>

    <!-- KANAN -->
    <div class="card">
        <h3>Daftar Tarif Parkir</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Kendaraan</th>
                <th>Jam Pertama</th>
                <th>Jam Berikutnya</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td> </td>
                <td></td>
                <td> </td>
                <td> </td>
                <td class="aksi">
                    <span class="edit">Edit</span>
                    <span class="hapus">Hapus</span>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>