<?php
require "functions.php";
if (isset($_POST["submit"])) {

 if (createMapel() > 0) {
    header("Location: mapel.php");
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
  <h1>Tambah Data Mapel</h1>
    <form action="" method="post" autocomplete="off">
      <ul>
        <li>
          <label for="kode">Kode: </label>
          <input type="text" id="kode" name="kode" required>
        </li>
        <li>
          <label for="nama">Nama: </label>
          <input type="nama" name="nama" id="nama"required>
        </li>
        <button type="submit" name="submit">submit</button>
      </ul>
    </form>
       
    </div>
</body>
</html>