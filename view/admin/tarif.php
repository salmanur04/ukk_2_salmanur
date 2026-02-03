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
    background: #f4f6f9;
}

/* HEADER */
.header {
    background: linear-gradient(135deg,#3498db,#2c3e50);
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

input, select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    padding: 10px 20px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #3498db;
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
</style>
</head>

<body>

<div class="header">
    <h1>🚗 Dashboard Tarif Parkir</h1>
    <p>Manajemen Tarif & Kendaraan Parkir</p>
</div>

<div class="container">

    <!-- FORM TARIF PARKIR -->
    <div class="card">
        <h3>Form Tarif Parkir</h3>

        <form>
            <label>Jenis Kendaraan</label>
            <select>
                <option>-- Pilih Kendaraan --</option>
                <option>Motor</option>
                <option>Mobil</option>
            </select>

            <label>Lama Parkir (Jam)</label>
            <input type="number" placeholder="Masukkan lama parkir">

            <button type="button">Hitung Tarif</button>
        </form>
    </div>

    <!-- TABEL TARIF PARKIR -->
    <div class="card">
        <h3>Data Parkir</h3>

        <table>
            <tr>
                <th>No</th>
                <th>Jenis Kendaraan</th>
                <th>Lama Parkir</th>
                <th>Tarif / Jam</th>
                <th>Total Bayar</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Motor</td>
                <td>2 Jam</td>
                <td>Rp 2.000</td>
                <td>Rp 4.000</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Mobil</td>
                <td>3 Jam</td>
                <td>Rp 5.000</td>
                <td>Rp 15.000</td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>
