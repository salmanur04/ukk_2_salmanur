 <?php
include_once __DIR__ . '/../models/user.php';

$user = new user();

// ambil data berdasarkan id
$id = $_GET['id'];
$data = $user->get_user_by_id($id);

// proses update
if (isset($_POST['update'])) {
    $user->update_user(
        $_POST['id_user'],
        $_POST['nama_lengkap'],
        $_POST['username'],
        $_POST['role']
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Form Edit User</h2>

<form method="post">
    <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

    <label>Nama Lengkap</label><br>
    <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" required><br><br>

    <label>Username</label><br>
    <input type="text" name="username" value="<?= $data['username']; ?>" required><br><br>

    <label>Role</label><br>
    <select name="role">
        <option value="admin" <?= $data['role']=='admin'?'selected':''; ?>>Admin</option>
        <option value="user" <?= $data['role']=='user'?'selected':''; ?>>User</option>
    </select><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
