<?php
session_start();
require_once __DIR__ . "/../../models/koneksi.php";

$db = new koneksi();
$conn = $db->koneksi;

// Kalau sudah login
if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
    header("Location: /ukk_2_salmanur/view/admin/dasboard.php");
    exit;
}


$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username_baru']);
    $password = trim($_POST['password_baru']);
    $role     = trim($_POST['role']);

    if ($username && $password && $role) {

        // PREPARE STATEMENT (AMAN)
        $stmt = mysqli_prepare($conn, 
            "SELECT * FROM tb_user WHERE username=? AND role=?"
        );
        mysqli_stmt_bind_param($stmt, "ss", $username, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {

            $data = mysqli_fetch_assoc($result);

            // cek password hash
            if (password_verify($password, $data['password'])) {

                $_SESSION['user'] = $data['username'];
                $_SESSION['role'] = $data['role'];

                // Redirect sesuai role
                 header("Location: /ukk_2_salmanur/view/admin/dasboard.php");
exit;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "Username atau role salah!";
        }

    } else {
        $error = "Semua field wajib diisi!";
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
.input-group input,
.input-group select{
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
.help{
    text-align:center;
    font-size:12px;
    margin-top:10px;
}
.help a{
    color:#2c5364;
    text-decoration:none;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="login-box">
    <h2 align="center">Login Parkiran</h2>
    <p align="center">Sistem Informasi Parkir Kendaraan</p>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <!-- jebakan autofill -->
        <input type="text" name="fakeuser" style="display:none">
        <input type="password" name="fakepass" style="display:none">

        <div class="input-group">
            <input type="text" name="username_baru" placeholder="Masukkan username" autocomplete="off" value="">
        </div>

        <div class="input-group">
            <input type="password" name="password_baru" placeholder="Masukkan password" autocomplete="new-password" value="">
        </div>

        <div class="input-group">
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <button type="submit" name="login" class="btn-login">Login</button>
    </form>

    <div class="help">
        Lupa password? 
        <a href="https://wa.me/083840294606" target="_blank">
            Hubungi Admin
        </a>
    </div>

    <div class="footer">
        © 2026 Sistem Parkiran
    </div>
</div>

</body>
</html>