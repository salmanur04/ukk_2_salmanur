<?php
session_start();

// data login statis
$username_benar = "admin";
$password_benar = "12345";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $username_benar && $password == $password_benar) {

        // SIMPAN SESSION DALAM BENTUK ARRAY
        $_SESSION['user'] = [
            'id' => 1,
            'username' => $username,
            'role' => 'user' // ganti admin/user sesuai kebutuhan
        ];

        header("Location: /ukk_2_salmanur/view/admin/dasboard.php");
        exit;

    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Parkiran</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        body {
            height: 100vh;
            background: linear-gradient(135deg, #1abc9c, #2c3e50);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 350px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background: #1abc9c;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-login:hover {
            background: #16a085;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2 align="center">Login Parkiran</h2>
    <p align="center">Sistem Informasi Parkir Kendaraan</p>

    <?php if ($error != ""): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="input-group">
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" name="login" class="btn-login">Login</button>
    </form>

    <div style="text-align:center;font-size:12px;color:#999;margin-top:15px;">
        © 2026 Sistem Parkiran
    </div>
</div>

</body>
</html>
