<?php
session_start();
require "functions.php";
$id = $_GET["id"];

$gurus = query("SELECT guru.id, guru.nama, guru.email, guru.no_telp, guru.jenis_kelamin, mapel.nama AS nama_mapel
                FROM guru
                JOIN mapel ON guru.guru_mapel = mapel.id
                WHERE guru.id = $id");
// $guru = query("SELECT * FROM guru WHERE id = $id")[0];

if (!isset($_SESSION['session_username'])) {
    $username = "Guest"; // Menampilkan pesan default jika tidak ada username di sesi
} else {
    $username = htmlspecialchars($_SESSION['session_username']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie("cookie_username", "", time() - 3600, "/");
    setcookie("cookie_password", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Guru</title>
  <link rel="stylesheet" href="css-file/anggota.css">
</head>

<body>
  <div class="user-info">
    <p><strong>Username:</strong> <?php echo $username; ?></p>
  </div>

  <div class="container">
    <h1>Detail Data Guru</h1>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>No Telp</th>
        <th>Guru Mapel</th>
        <th>Jenis Kelamin</th>
      </tr>
      <?php foreach( $gurus as $guru ) : ?>
      <tr>
        <td><?= $guru["nama"]; ?></td>
        <td><?= $guru["email"]; ?></td>
        <td><?= $guru["no_telp"]; ?></td>
        <td><?= $guru["nama_mapel"]; ?></td>
        <td><?= $guru["jenis_kelamin"]; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>

    <a href="guru.php">Kembali ke daftar guru</a>

    <div class="logout-link">
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="submit" name="logout" class="btn" value="Logout">
      </form>
    </div>
  </div>
</body>

</html>