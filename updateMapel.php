<?php 
require "functions.php";
$id = $_GET["id"];
$mapel = query("SELECT * FROM mapel WHERE id = $id");

if ( isset($_POST["edit"]) ) {
  if ( editMapelGuru() > 0 ) {
    echo "<script>
    alert('Data Berhasil Diubah');
    </script>";

    header("Location: mapel.php");
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
    <?php foreach ( $mapel as $s ) : ?>
    <form action="" method="post" autocomplete="off">
      <ul>
        <input type="hidden" name="id" value="<?= $s["id"]; ?>">
        <li>
          <label for="kode">Kode: </label>
          <input type="text" id="kode" name="kode" value="<?= $s["kode"];?>">
        </li>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" name="nama" id="nama" value="<?= $s["nama"]; ?>">
        </li>
        <button type="submit" name="edit">Edit</button>
      </ul>
    </form>
    <?php endforeach; ?>
  </div>
</body>

</html>