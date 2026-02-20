 <?php
session_start();

// Cegah kalau belum login
if (!isset($_SESSION['user'])) {
    header("Location: /ukk_2_salmanur/auth/login.php");
    exit;
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$role     = isset($_SESSION['role']) ? strtolower(trim($_SESSION['role'])) : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Parkiran</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f9;
}

.sidebar{
    position:fixed;
    width:230px;
    height:100vh;
    background:#1e293b;
    color:white;
    padding-top:25px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    padding:14px 20px;
    color:#cbd5e1;
    text-decoration:none;
}

.sidebar a:hover{
    background:#334155;
    color:white;
}

.header{
    margin-left:230px;
    padding:20px;
    background:white;
    box-shadow:0 2px 5px rgba(0,0,0,0.05);
}

.container{
    margin-left:230px;
    padding:30px;
}

.hero{
    background:#1e293b;
    color:white;
    padding:40px;
    border-radius:12px;
    margin-bottom:30px;
}

.cards{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    width:240px;
    padding:25px;
    border-radius:12px;
    background:#1e293b;
    color:white;
}
.footer{
    margin-left:230px;
    text-align:center;
    padding:20px;
    color:#888;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>🅿 ParkirApp</h2>

    <a href="dasboard.php">🏠 Dashboard</a>

    <?php if($role == 'admin'): ?>
        <a href="user.php">👤 Kelola User</a>
        <a href="tarif.php">💰 Kelola Tarif</a>
        <a href="area.php">⭕ Kelola Area</a>
        <a href="kendaraan.php">🚗 Data Kendaraan</a>
        <a href="aktivitas.php">📋 Aktivitas</a>

    <?php endif; ?>

    <?php if($role == 'petugas'): ?>
        <a href="transaksi.php">📝 Input Transaksi</a>
    <?php endif; ?>

    <?php if($role == 'owner'): ?>
        <a href="rekapan.php">📊 Rekapan Laporan</a>
        
    <?php endif; ?>

 <a href="logout.php">🚪 Logout</a>

    

</div>

<div class="header">
    <h3>Dashboard <?php echo ucfirst($role); ?></h3>
    <p>Login sebagai: <b><?php echo $username; ?></b></p>
</div>

<div class="container">

<div class="hero">
    <h1>Selamat Datang di Sistem Parkiran</h1>
    <p>
        Sistem ini membantu pengelolaan kendaraan, transaksi parkir,
        area parkir, dan laporan secara efisien.
    </p>
</div>

</div>

<div class="footer">
    © 2026 Sistem Parkiran
</div>

</body>
</html>
