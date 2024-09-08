<?php 
require "functions.php";
$id = $_GET["id"];
$siswa = query("SELECT * FROM siswa WHERE id = $id");

if ( isset($_POST["edit"]) ) {
  if ( edit() > 0 ) {
    echo "<script>
    alert('Data Berhasil Diubah');
    </script>";

    header("Location: anggota.php");
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
  <h1>Edit User Data</h1>
  <div class="container">
    <?php foreach ( $siswa as $s ) : ?>
    <form action="" method="post">
      <ul>
        <input type="hidden" name="id" value="<?= $s["id"]; ?>">
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
          <label for="no_telp">No Telp: </label>
          <input type="tel" name="no_telp" id="no_telp" value="<?= $s["no_telp"]; ?>">
        </li>
        <button type="submit" name="edit">Edit</button>
      </ul>
    </form>
    <?php endforeach; ?>
  </div>
</body>

</html>