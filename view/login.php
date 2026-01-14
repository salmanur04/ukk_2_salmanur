<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }
        .login-box {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 8px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form>
        <input type="text" placeholder="Username" required>
        <input type="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>