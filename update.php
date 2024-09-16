<?php 
session_start();
require "functions.php";

$tabel = $_GET["tabel"];
if ( !isset($_SESSION["session_username"]) ) {
    echo "<script>
    alert('Anda Harus Login Untuk Menggunakan Fitur Ini');
    window.location.href='$tabel.php';
    </script>";
    exit;
}

if (!isset($_GET["tabel"]) || !isset($_GET["id"])) {
    echo "<script>
    alert('Parameter tidak lengkap');
    document.location.href = 'anggota.php';
    </script>";
    exit;
}

$tabel = $_GET["tabel"];
$id = $_GET["id"];

if ($tabel == "siswa") {
    $data = query("SELECT * FROM siswa WHERE id = $id");
    $title = "Ubah Data Siswa";
} elseif ($tabel == "guru") {
    $data = query("SELECT * FROM guru WHERE id = $id");
    $title = "Ubah Data Guru";
    //ngambil data mapel untuk dropdown
    $mapel = query("SELECT * FROM mapel");
} elseif ($tabel == "mapel") {
    $data = query("SELECT * FROM mapel WHERE id = $id");
    $title = "Ubah Data Mapel";
} else {
    echo "<script>alert('Tabel tidak valid!');</script>";
    exit;
}

if (isset($_POST["edit"])) {
    if (edit($tabel, $id) > 0) {
        echo "<script>
        alert('Data Berhasil Diubah');
        document.location.href = '$tabel.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diubah!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css-file/update.css">
  <title>Edit Data</title>
</head>

<body>
  <h1><?= $title ?></h1>
  <div class="container">
    <?php foreach ($data as $s) : ?>
    <form action="" method="post">
      <ul>
        <input type="hidden" name="id" value="<?= $s["id"]; ?>">

        <?php if ($tabel == "siswa") : ?>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama" value="<?= $s["nama"];?>">
        </li>
        <li>
          <label for="nis">NIS: </label>
          <input type="text" name="nis" id="nis" value="<?= $s["nis"]; ?>">
        </li>
        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" value="<?= $s["email"]; ?>">
        </li>
        <li>
          <label for="no_telp">Nomor Telepon: </label>
          <input type="tel" name="no_telp" id="no_telp" value="<?= $s["no_telp"]; ?>">
        </li>
        <?php elseif ($tabel == "guru") : ?>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama" value="<?= $s["nama"];?>">
        </li>
        <li>
          <label for="guru_mapel">Mapel: </label>
          <select name="guru_mapel" id="guru_mapel">
            <?php foreach ($mapel as $m) : ?>
            <option value="<?= $m['nama']; ?>" <?= ($s["guru_mapel"] == $m['nama']) ? 'selected' : ''; ?>>
              <?= $m['nama']; ?>
            </option>
            <?php endforeach; ?>
          </select>
        </li>

        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" value="<?= $s["email"]; ?>">
        </li>
        <li>
          <label for="no_telp">Nomor Telepon: </label>
          <input type="tel" name="no_telp" id="no_telp" value="<?= $s["no_telp"]; ?>">
        </li>
        <?php elseif ($tabel == "mapel") : ?>
        <li>
          <label for="kode">Kode: </label>
          <input type="text" id="kode" name="kode" value="<?= $s["kode"];?>">
        </li>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" name="nama" id="nama" value="<?= $s["nama"]; ?>">
        </li>
        <?php endif; ?>

        <button type="submit" name="edit">Ubah</button>
      </ul>
    </form>
    <?php endforeach; ?>
  </div>
</body>

</html>