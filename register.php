<?php
session_start();
require "functions.php";

// mengatur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "login";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

// mengatur variable
$err = "";
$username = "";
$password = "";
$konfirmasi_password = "";
$email = "";
$no_telp = "";

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $konfirmasi_password = $_POST['konfirmasi_password'];
  $email = $_POST['email'];
  $no_telp = $_POST['no_telp'];
  $err = '';

  // Memvalidasi input dari user
  if ($username == '' || $password == '' || $konfirmasi_password == '' || $email == '' || $no_telp == '') {
      $err .= "<li>Silakan isi semua kolom.</li>";
  } elseif ($password != $konfirmasi_password) {
      $err .= "<li>Konfirmasi password tidak sesuai.</li>";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err .= "<li>Email tidak valid.</li>";
  } elseif (!validatePhoneNumber($no_telp)) {
      $err .= "<li>Nomor Telepon tidak valid atau kode operator tidak terdaftar.</li>";
  } else {
      // Ngecek apakah username sudah ada
      $sql1 = "SELECT * FROM login WHERE username = '$username'";
      $q1 = mysqli_query($koneksi, $sql1);
      $r1 = mysqli_fetch_array($q1);

      if ($r1) {
          $err .= "<li>Username <b>$username</b> sudah terdaftar.</li>";
      } else {
          // Ngecek email apakah sudah terdaftar
          $sql2 = "SELECT * FROM login WHERE email = '$email'";
          $q2 = mysqli_query($koneksi, $sql2);
          $r2 = mysqli_fetch_array($q2);

          if ($r2) {
              $err .= "<li>Email <b>$email</b> sudah terdaftar.</li>";
          } else {
              // Ngecek nomor telp apakah sudah terdaftar
              $sql3 = "SELECT * FROM login WHERE no_telp = '$no_telp'";
              $q3 = mysqli_query($koneksi, $sql3);
              $r3 = mysqli_fetch_array($q3);

              if ($r3) {
                  $err .= "<li>Nomor Telepon <b>$no_telp</b> sudah terdaftar.</li>";
              } else {
                  // Kalo valid, maka akan dimasukan ke database
                  $password_hashed = md5($password);
                  $sql4 = "INSERT INTO login (username, password, email, no_telp) VALUES ('$username', '$password_hashed', '$email', '$no_telp')";
                  $q4 = mysqli_query($koneksi, $sql4);

                  if ($q4) {
                      header("location:login.php");
                      exit();
                  } else {
                      $err .= "<li>Terjadi kesalahan saat menyimpan data.</li>";
                  }
              }
          }
      }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css-file/register.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="logo-cn">
        <div class="logo-bg">
          <img src="img/logo-cn.png" alt="logo-cn" width="100px">
        </div>
      </div>
      <h2>Create An Account</h2>
      <?php if ($err) { ?>
      <div id="register-alert" class="alert">
        <ul><?php echo $err ?></ul>
      </div>
      <?php } ?>
      <form id="registerform" action="" method="post" role="form" autocomplete="off">
  <div class="form-row">
    <div class="input-box">
      <input id="register-username" type="text" name="username" placeholder=" "
        value="<?php echo htmlspecialchars($username) ?>" required>
      <label>Username</label>
    </div>
    <div class="input-box">
      <input id="register-email" type="text" name="email" placeholder=" "
        value="<?php echo htmlspecialchars($email) ?>" required>
      <label>Email</label>
    </div>
  </div>
  <div class="form-row">
    <div class="input-box">
      <input id="register-password" type="password" name="password" placeholder=" " required>
      <label>Password</label>
    </div>
    <div class="input-box">
      <input id="register-konfirmasi-password" type="password" name="konfirmasi_password" placeholder=" " required>
      <label>Confirm Password</label>
    </div>
  </div>
  <div class="input-box full-width">
    <input id="register-no-telp" type="text" name="no_telp" value="<?php echo htmlspecialchars($no_telp) ?>"
      placeholder=" " required>
    <label>Phone Number</label>
  </div>
  <input type="submit" name="register" class="btn" value="Register">
</form>
      <div class="login">
        <a href="login.php">Log In</a>
      </div>
    </div>
    
    <!-- <span style="--i:0;"></span>
    <span style="--i:2;"></span>
    <span style="--i:4;"></span>
    <span style="--i:6;"></span>
    <span style="--i:8;"></span>
    <span style="--i:10;"></span>
    <span style="--i:12;"></span>
    <span style="--i:14;"></span>
    <span style="--i:16;"></span>
    <span style="--i:18;"></span>
    <span style="--i:20;"></span>
    <span style="--i:22;"></span>
    <span style="--i:24;"></span>
    <span style="--i:26;"></span>
    <span style="--i:28;"></span>
    <span style="--i:30;"></span>
    <span style="--i:32;"></span>
    <span style="--i:34;"></span>
    <span style="--i:36;"></span>
    <span style="--i:38;"></span>
    <span style="--i:40;"></span>
    <span style="--i:42;"></span>
    <span style="--i:44;"></span>
    <span style="--i:46;"></span>
    <span style="--i:48;"></span> -->
  </div>
</body>
</html>