<?php
session_start();
require "functions.php";
$siswa = query("SELECT * FROM siswa");

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
  <div class="user-info">
    <p><strong>Username:</strong> <?php echo $username; ?></p>
  </div>

  <div class="container">
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>Kamu telah berhasil login dan ini adalah data siswa</p>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Email</th>
        <th>No Telp</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach( $siswa as $s ) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td><a href="update.php?id=<?= $s["id"]; ?>">Edit </a>|<a href="#">Delete</a></td>
        <td><?= $s["nama"]; ?></td>
        <td><?= $s["nis"]; ?></td>
        <td><?= $s["email"]; ?></td>
        <td><?= $s["no_telp"]; ?></td>
      </tr>
      <?php endforeach; ?>
      <?php $i++; ?>
    </table>

    <div class="logout-link">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="logout" class="btn" value="Logout">
      </form>
    </div>
  </div>
</body>

</html>