<?php 
require "functions.php";
$id = $_GET["id"];
$guru = query("SELECT * FROM guru WHERE id = $id");

if ( isset($_POST["edit"]) ) {
  if ( editGuru() > 0 ) {
    echo "<script>
    alert('Data Berhasil Diubah');
    </script>";

    header("Location: guru.php");
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
    <?php foreach ( $guru as $s ) : ?>
    <form action="" method="post">
      <ul>
        <input type="hidden" name="id" value="<?= $s["id"]; ?>">
        <li>
          <label for="nama">Nama Guru: </label>
          <input type="text" id="nama" name="nama" value="<?= $s["nama"];?>">
        </li>
        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" value="<?= $s["email"]; ?>">
        </li>
        <li>
          <label for="no_telp">No Telp: </label>
          <input type="tel" name="no_telp" id="no_telp" value="<?= $s["no_telp"]; ?>"
            pattern="^\0(895|896|897|898|899|856|857|858|859)[0-9]{6,10}$">
        </li>
        <li>
          <label for="guru_mapel">Mapel: </label>
          <input type="text" name="guru_mapel" id="guru_mapel" value="<?= $s["guru_mapel"];?>">
        </li>
        <button type="submit" name="edit">Edit</button>
      </ul>
    </form>
    <?php endforeach; ?>
  </div>
</body>

</html>