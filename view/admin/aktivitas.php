 <?php
include_once __DIR__ . '/../../controllers/c_aktivitas.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Log Aktivitas | Smart Parking</title>

<style>
* { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

body { 
    margin: 0; 
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
}

.header {
    background: linear-gradient(135deg,#2c5364,#203a43);
    color:white;
    padding:20px;
}

.container { padding:25px; }

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,.2);
}

table th, table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

table th {
    background: #2c5364;
    color: white;
}

.badge {
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    color: white;
}

.login { background: #1cc88a; }
.logout { background: #e74a3b; }
.edit { background: #f6c23e; color:black; }
.other { background: #858796; }

.role-admin { background: #4e73df; }
.role-petugas { background: #36b9cc; }
.role-owner { background: #858796; }

.user-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: bold;
    color: white;
    margin-right: 10px;
    background: linear-gradient(90deg,#4e73df,#6f42c1);
}

.user-info {
    display: flex;
    align-items: center;
}

button {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-edit { background:#3498db; color:white; }
.btn-hapus { background:#e74c3c; color:white; }

</style>
</head>

<body>

<a href="dasboard.php"
style="display:inline-block;margin:15px;
background:linear-gradient(135deg,#2c5364,#203a43);
color:#fff;
padding:8px 14px;border-radius:6px;
text-decoration:none">
⬅ Kembali  
</a>

<div class="header">
    <h1>🅿️ Log Aktivitas</h1>
    <p>Audit Log Aktivitas Sistem</p>
</div>

<div class="container">

<table>
<tr>
    <th>ID Log</th>
    <th>User</th>
    <th>Role</th>
    <th>Aktivitas</th>
    <th>Waktu Aktivitas</th>
</tr>

<?php if(!empty($data_aktivitas)): ?>
<?php foreach($data_aktivitas as $row): ?>
<tr>
    <td><?= htmlspecialchars($row->id_log) ?></td>
    <td>
        <div class="user-info">
            <div class="user-circle"><?= strtoupper(substr($row->user,0,2)) ?></div>
            <?= htmlspecialchars($row->user) ?>
        </div>
    </td>
    <td>
        <?php
        $role_class = 'other';
        $role_text = htmlspecialchars($row->role);
        if(strtolower($row->role)=='admin') $role_class='role-admin';
        elseif(strtolower($row->role)=='petugas') $role_class='role-petugas';
        elseif(strtolower($row->role)=='owner') $role_class='role-owner';
        ?>
        <span class="badge <?= $role_class ?>"><?= $role_text ?></span>
    </td>
    <td>
        <?php
        $act_class = 'other';
        $aktivitas_text = htmlspecialchars($row->aktivitas);
        $lower = strtolower($row->aktivitas);
        if(strpos($lower,'login')!==false) $act_class='login';
        elseif(strpos($lower,'logout')!==false) $act_class='logout';
        elseif(strpos($lower,'edit')!==false) $act_class='edit';
        ?>
        <span class="badge <?= $act_class ?>"><?= $aktivitas_text ?></span>
    </td>
    <td><?= date("d M Y, H:i", strtotime($row->waktu_aktivitas)) ?> WIB</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5">Data aktivitas kosong</td>
</tr>
<?php endif; ?>
</table>

<p style="color:white;margin-top:10px;">
Total Data: <?= count($data_aktivitas) ?> aktivitas
</p>

</div>

</body>
</html>
