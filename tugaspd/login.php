<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "input_data";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    // Siapkan dan bind
    $stmt = $conn->prepare("INSERT INTO data (nama, email, telepon, alamat) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $nama, $email, $telepon, $alamat);

        if ($stmt->execute()) {
            // Redirect setelah berhasil menyimpan data
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM data");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Input Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Input Data</h1>

<form method="post" action="">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telepon">Telepon:</label><br>
    <input type="text" id="telepon" name="telepon" required><br><br>

    <label for="alamat">Alamat:</label><br>
    <textarea id="alamat" name="alamat" required></textarea><br><br>

    <input type="submit" value="Simpan">
</form>

<h2>Data yang Tersimpan:</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Alamat</th>
    </tr>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telepon']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>
