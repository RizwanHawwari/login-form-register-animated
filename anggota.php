<?php 
session_start();
require "functions.php";

if ( !isset( $_SESSION["session_username"] ) ) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css-file/main.css">
  <title>Rookies School Management</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Rookies School Management</h2>
    </div>
    <div class="kategori">
      <div class="siswa">
        <figure>
          <img src="img/siswa.png" alt="siswa" width="250">
          <!-- <figcaption>Siswa</figcaption> -->
        </figure>
        <button><a href="siswa.php">Data Siswa</a></button>
      </div>
      <div class="guru">
        <figure>
          <img src="img/guru.png" alt="guru" width="250">
          <!-- <figcaption>Guru</figcaption> -->
        </figure>
        <button><a href="guru.php">Data Guru</a></button>
      </div>
      <div class="mapel">
        <figure>
          <img src="img/mapel.png" alt="mapel" width="250">
          <!-- <figcaption>Mapel</figcaption> -->
        </figure>
        <button><a href="mapel.php">Data Mapel</a></button>
      </div>
    </div>
  </div>
</body>

</html>