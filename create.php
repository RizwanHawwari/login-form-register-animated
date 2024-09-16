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

if ( !isset($_GET["tabel"]) ) {
    header("Location: anggota.php");
    exit;
}

$tabelValid = ["siswa", "guru", "mapel"];
if ( !in_array($tabel, $tabelValid) ) {
    header("Location: anggota.php");
    exit;
}

if (isset($_POST["submit"])) {
    $fields = [];
    
    if ($tabel == "siswa") {
        $fields = [
            "nama" => $_POST["nama"],
            "email" => $_POST["email"],
            "no_telp" => $_POST["no_telp"],
            "nis" => $_POST["nis"]
        ];
    } elseif ($tabel == "guru") {
        $fields = [
            "nama" => $_POST["nama"],
            "email" => $_POST["email"],
            "no_telp" => $_POST["no_telp"],
            "guru_mapel" => $_POST["guru_mapel"]
        ];
    } elseif ($tabel == "mapel") {
        $fields = [
            "kode" => $_POST["kode"],
            "nama" => $_POST["nama"]
        ];
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

    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <>
        <?php if ($tabel == "siswa"): ?>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama" required>
        </li>
        <li>
          <label for="nis">NIS: </label>
          <input type="text" name="nis" id="nis" required>
        </li>
        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" required>
        </li>
        <li>
          <label for="no_telp">No Telp: </label>
          <input type="tel" name="no_telp" id="no_telp" required>
        </li>
        <?php elseif ($tabel == "guru"): ?>
        <li>
            <label for="nama">Nama: </label>
            <input type="text" id="nama" name="nama" required>
        </li>
        <li>
            <label for="guru_mapel">Mapel: </label>
            <select name="guru_mapel" id="guru_mapel" required>
                <?php
                $mapelQuery = "SELECT * FROM mapel";
                $mapelResult = mysqli_query($conn, $mapelQuery);
                while ($mapel = mysqli_fetch_assoc($mapelResult)) {
                    echo "<option value='{$mapel['id']}'>{$mapel['nama']}</option>";
                }
                ?>
            </select>
        </li>
        <li>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required>
        </li>
        <li>
            <label for="no_telp">No Telp: </label>
            <input type="tel" name="no_telp" id="no_telp" required>
        </li>
        <li>
            <label for="jenis_kelamin">Perempuan</label>
            <input type="radio" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin_perempuan" required>
        </li>
        <li>
            <label for="jenis_kelamin">Laki-laki</label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin_laki" required>
        </li>
        <li>
            <label for="file">Foto Diri:</label>
            <input type="file" name="file" id="foto" required>
        </li>
        <?php elseif ($tabel == "mapel"): ?>
        <li>
          <label for="kode">Kode: </label>
          <input type="text" id="kode" name="kode" required>
        </li>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" name="nama" id="nama" required>
        </li>
        <?php endif; ?>

        <button type="submit" name="submit">Tambah</button>
      </ul>
    </form>
  </div>
</body>

</html>