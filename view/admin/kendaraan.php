 <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kendaraan Parkir</title>

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

/* GRID */
.kendaraan-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* CARD */
.kendaraan-card {
    background: white;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
}

/* PLAT */
.plat {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* STATUS */
.status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    color: white;
    display: inline-block;
    margin-bottom: 10px;
}

.masuk {
    background: #27ae60;
}

.keluar {
    background: #e74c3c;
}

/* INFO */
.info {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

</style>
</head>

<body>

<div class="header">
    <h1>🚘 Data Kendaraan</h1>
    <p>Kendaraan Masuk & Keluar Area Parkir</p>
</div>

<div class="container">

    <div class="kendaraan-grid">

        <!-- KENDARAAN 1 -->
        <div class="kendaraan-card">
            <span class="status masuk">Masuk</span>
            <div class="plat">B 1234 ABC</div>
            <div class="info">
                Jenis : Motor <br>
                Area  : A <br>
                Jam Masuk : 08:15
            </div>
        </div>

        <!-- KENDARAAN 2 -->
        <div class="kendaraan-card">
            <span class="status masuk">Masuk</span>
            <div class="plat">D 9876 ZYX</div>
            <div class="info">
                Jenis : Mobil <br>
                Area  : B <br>
                Jam Masuk : 09:05
            </div>
        </div>

        <!-- KENDARAAN 3 -->
        <div class="kendaraan-card">
            <span class="status keluar">Keluar</span>
            <div class="plat">H 5555 QQ</div>
            <div class="info">
                Jenis : Mobil <br>
                Area  : C <br>
                Jam Keluar : 10:30
            </div>
        </div>

    </div>

</div>

</body>
</html>
