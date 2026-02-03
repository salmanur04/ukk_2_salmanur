<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Area Parkir</title>

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
    background: linear-gradient(135deg,#9b59b6,#8e44ad);
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

/* GRID AREA */
.area-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

/* CARD AREA */
.area-card {
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    text-align: center;
}

/* STATUS */
.status {
    padding: 6px 12px;
    border-radius: 20px;
    color: white;
    font-size: 14px;
    display: inline-block;
    margin-bottom: 10px;
}

.kosong {
    background: #2ecc71;
}

.terisi {
    background: #e74c3c;
}

.area-card h3 {
    margin: 10px 0;
}

/* INFO */
.info {
    font-size: 14px;
    color: #555;
}

</style>
</head>

<body>

<div class="header">
    <h1>🅿️ Area Parkir</h1>
    <p>Status Area Parkir Kendaraan</p>
</div>

<div class="container">

    <div class="area-grid">

        <!-- AREA 1 -->
        <div class="area-card">
            <span class="status kosong">Kosong</span>
            <h3>Area A</h3>
            <div class="info">
                Kapasitas: 20<br>
                Terisi: 12
            </div>
        </div>

        <!-- AREA 2 -->
        <div class="area-card">
            <span class="status terisi">Terisi</span>
            <h3>Area B</h3>
            <div class="info">
                Kapasitas: 15<br>
                Terisi: 15
            </div>
        </div>

        <!-- AREA 3 -->
        <div class="area-card">
            <span class="status kosong">Kosong</span>
            <h3>Area C</h3>
            <div class="info">
                Kapasitas: 30<br>
                Terisi: 8
            </div>
        </div>

    </div>

</div>

</body>
</html>
