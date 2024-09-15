<?php
session_start();
require "functions.php";
$guru = query("SELECT * FROM guru");

// Check if the user is logged in
if (!isset($_SESSION['session_username'])) {
    // Logika di sini tetap kosong tanpa redirect atau exit
    $username = "Guest"; // Menampilkan pesan default jika tidak ada username di sesi
} else {
    // Fetch user details from session
    $username = htmlspecialchars($_SESSION['session_username']);
}

// Handle logout logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie("cookie_username", "", time() - 3600, "/");
    setcookie("cookie_password", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member's Page</title>
  <link rel="stylesheet" href="css-file/anggota.css">
</head>

<body>
  <header>
    <div class="brand">Rookies School Management</div>
    <nav>
      <ul>
        <li><a href="siswa.php">Siswa</a></li>
        <li><a href="guru.php">Guru</a></li>
        <li><a href="mapel.php">Mapel</a></li>
      </ul>
    </nav>
  </header>
  <!-- <div class="user-info">
    <p><strong>Username:</strong></p>
  </div> -->

  <div class="container">
    <h1 class="welcome">Welcome, <?php echo $username; ?>!</h1>
    <p>Kamu telah berhasil login dan ini adalah data Guru</p>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No Telp</th>
        <th>Guru Mapel</th>
        <th>Aksi</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach( $guru as $s ) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td><?= $s["nama"]; ?></td>
        <td><?= $s["email"]; ?></td>
        <td><?= $s["no_telp"]; ?></td>
        <td><?= $s["guru_mapel"]; ?></td>
        <td><a class="edit-btn" href="updateGuru.php?id=<?= $s['id']; ?>">Edit</a><a class="delete-btn"
            href="delete.php?tabel=guru&id=<?= $s['id']; ?>">Delete</a></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>

    </table>
    <a class="add-user" href="create.php?tabel=guru">Tambah Data Guru</a>

    <div class="logout-link">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="logout" class="btn" value="Logout">
      </form>
    </div>
  </div>
</body>

</html>