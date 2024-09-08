<?php
require "functions.php";
if (isset($_POST["submit"])) {

 if (createGuru() > 0) {
    header("Location: guru.php");
 } else { 
    echo "<script>
    alert('Data Gagal Ditambahkan');
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
    <form action="" method="post" autocomplete="off">
      <ul>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama" required>
        </li>
        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email"required>
        </li>
        <li>
          <label for="no_telp">no_telp: </label>
          <input type="tel" name="no_telp" id="no_telp"required >
        </li>
        <li>
          <label for="guru_mapel">Guru Mapel: </label>
          <input type="tel" name="guru_mapel" id="guru_mapel"required>
        </li>
        <button type="submit" name="submit">submit</button>
      </ul>
    </form>
       
    </div>
</body>
</html>