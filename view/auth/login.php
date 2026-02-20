 <?php
session_start();

// Kalau sudah login, langsung ke dashboard
if (isset($_SESSION['user'])) {
    header("Location: /ukk_2_salmanur/view/admin/dasboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = $_POST['role'];

    if ($username != "" && $password == "12345" && in_array($role, ['admin','petugas','owner'])) {

        // Simpan session
        $_SESSION['user'] = $username; // string, bukan array
        $_SESSION['role'] = $role;

        // Simpan log aktivitas login
        $modelPath = __DIR__ . '/../../models/aktivitas.php';
        if(file_exists($modelPath)){
            include_once $modelPath;
            $aktivitas = new aktivitas();

            $id_log = uniqid('log_');
            $desc   = "Login ke Sistem";
            $waktu  = date("Y-m-d H:i:s");

            $aktivitas->tambah_aktivitas($id_log, $username, $role, $desc, $waktu);
        }

        header("Location: /ukk_2_salmanur/view/admin/dasboard.php");
        exit;

    } else {
        $error = "Username, password, atau role salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | Sistem Parkiran</title>
<style>
*{box-sizing:border-box;font-family:'Segoe UI',sans-serif;}
body{
    height:100vh;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    display:flex;
    align-items:center;
    justify-content:center;
}
.login-box{
    width:360px;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,0.3);
}
.input-group{margin-bottom:15px;}
.input-group input, .input-group select{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
}
.btn-login{
    width:100%;
    padding:10px;
    background:#2c5364;
    border:none;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}
.btn-login:hover{background:#203a43;}
.error{
    color:red;
    text-align:center;
    margin-bottom:10px;
}
.footer{
    text-align:center;
    font-size:12px;
    color:#999;
    margin-top:15px;
}
</style>
</head>
<body>

<div class="login-box">
    <h2 align="center">Login Parkiran</h2>
    <p align="center">Sistem Informasi Parkir Kendaraan</p>

    <?php if ($error != ""): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Dummy anti autofill -->
    <input type="text" style="display:none">
    <input type="password" style="display:none">

    <form method="post" autocomplete="off">
        <div class="input-group">
            <input type="text" name="username" placeholder="Masukkan username" autocomplete="off" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Masukkan password" autocomplete="new-password" required>
        </div>
        <div class="input-group">
            <select name="role" required autocomplete="off">
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="owner">Owner</option>
            </select>
        </div>
        <button type="submit" name="login" class="btn-login">Login</button>
    </form>

    <div class="footer">
        © 2026 Sistem Parkiran
    </div>
</div>

</body>
</html>
