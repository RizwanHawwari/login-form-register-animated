<?php
session_start();
require "functions.php";

if ( !isset($_SESSION["session_username"]) ) {
    header("Location: login.php");
    exit;
}

if ( !isset($_GET["tabel"]) ) {
    header("Location: anggota.php");
    exit;
}

$tabel = $_GET["tabel"];
$tabelValid = ["siswa", "guru", "mapel"];
if ( !in_array($tabel, $tabelValid) ) {
    header("Location: anggota.php");
    exit;
}

if (isset($_POST["submit"])) {
    $fields = [
        "nama" => $_POST["nama"],
        "email" => $_POST["email"],
        "no_telp" => $_POST["no_telp"]
    ];

    if ($tabel == "siswa") {
        $fields["nis"] = $_POST["nis"];
    } elseif ($tabel == "guru") {
        $fields["guru_mapel"] = $_POST["guru_mapel"];
    }

    if (create($tabel, $fields) > 0) {
        header("Location: $tabel.php");
    } else {
        echo "<script>alert('Data Gagal Ditambahkan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css-file/create.css">
  <title>Tambah Data <?= ucfirst($tabel); ?></title>
</head>

<body>
  <div class="container">
    <h1>Tambah Data <?= ucfirst($tabel); ?></h1>

    <form action="" method="post" autocomplete="off">
      <ul>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama" required>
        </li>

        <?php if ($tabel == "siswa"): ?>
        <li>
          <label for="nis">NIS: </label>
          <input type="text" name="nis" id="nis" required>
        </li>
        <?php endif; ?>

        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" required>
        </li>

        <li>
          <label for="no_telp">No Telp: </label>
          <input type="tel" name="no_telp" id="no_telp" required>
        </li>

        <?php if ($tabel == "guru"): ?>
        <li>
          <label for="guru_mapel">Guru Mapel: </label>
          <input type="text" name="guru_mapel" id="guru_mapel" required>
        </li>
        <?php endif; ?>

        <button type="submit" name="submit">Tambah</button>
      </ul>
    </form>
  </div>
</body>

</html>