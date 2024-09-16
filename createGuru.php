<?php 
require "functions.php";

if (isset($_POST["submit"])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $email = htmlspecialchars($_POST["email"]);
  $no_telp = htmlspecialchars($_POST["no_telp"]);
  $guru_mapel = htmlspecialchars($_POST["guru_mapel"]);
  $jenis_kelamin = isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"] : '';

  if ($jenis_kelamin === '') {
    echo "<script>
      alert('Silakan pilih jenis kelamin.');
      </script>";
    return false;
  }

  if ($_FILES["file"]["error"] === 0) {
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_destination = "image/" . $file_name;

    // memindahkan foto ke folder image
    if (move_uploaded_file($file_tmp, $file_destination)) {

      if (createGuru() > 0) {
        header("Location: guru.php");
      } else {
        echo "<script>
          alert('Data Gagal Ditambahkan');
          </script>";
      }
    } else {
      echo "<script>
        alert('Gagal mengunggah file.');
        </script>";
    }
  } else {
    echo "<script>
      alert('File tidak valid.');
      </script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-file/create.css">
    <title>Admin Page</title>
</head>
<body>
  <h1>Tambah Data Guru</h1>
  <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <ul>
      <li>
        <label for="nama">Nama: </label>
        <input type="text" id="nama" name="nama" required>
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
        <label for="guru_mapel">Guru Mapel: </label>
        <input type="text" name="guru_mapel" id="guru_mapel" required>
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
      <li>
        <button type="submit" name="submit">Submit</button>
      </li>
    </ul>
  </form>
</body>
</html>
