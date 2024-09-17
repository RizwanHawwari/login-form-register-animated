<?php 
session_start();

// Mengatur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "login";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

// Menyiapkan variabel
$err        = ""; // Menyimpan pesan kesalahan
$username   = ""; // Menyimpan username dari form login
$ingataku   = ""; // Menyimpan status checkbox "Ingat Aku"

// Mengecek jika cookie login ada dan valid
if (isset($_COOKIE['cookie_username']) && isset($_COOKIE['cookie_password'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    // Cek username di database
    $sql1 = "SELECT * FROM login WHERE username = '$cookie_username'";
    $q1   = mysqli_query($koneksi, $sql1);
    $r1   = mysqli_fetch_array($q1);

    // Verifikasi password dari cookie
    if ($r1 && $r1['password'] == $cookie_password) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

// Jika sudah login, arahkan ke halaman anggota
if (isset($_SESSION['session_username'])) {
    header("location:anggota.php");
    exit();
}

// Jika form login disubmit
if (isset($_POST['login'])) {
    $username   = isset($_POST['username']) ? $_POST['username'] : ""; // Ambil username dari form
    $password   = isset($_POST['password']) ? $_POST['password'] : ""; // Ambil password dari form

    // Pastikan checkbox 'ingataku' ada sebelum mengaksesnya
    $ingataku   = isset($_POST['ingataku']) ? $_POST['ingataku'] : ""; 

    // Validasi input
    if ($username == '' || $password == '') {
        $err .= "<li>Please input your username and password before continuing.</li>";
    } else {
        // Cek username di database
        $sql1 = "SELECT * FROM login WHERE username = '$username'";
        $q1   = mysqli_query($koneksi, $sql1);
        $r1   = mysqli_fetch_array($q1);

        // Cek apakah username ada dan password sesuai
        if (!$r1) {
            $err .= "<li>Username tidak tersedia.</li>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<li>Password tidak sesuai.</li>";
        }       
        
        // Jika tidak ada kesalahan, simpan sesi dan cookie jika perlu
        if (empty($err)) {
            $_SESSION['session_username'] = $username; // Simpan username di sesi
            $_SESSION['session_password'] = md5($password); // Simpan password hash di sesi

            // Jika checkbox "Ingat Aku" dicentang, simpan cookie
            if ($ingataku == 1) {
                setcookie("cookie_username", $username, time() + (60 * 60 * 24 * 30), "/");
                setcookie("cookie_password", md5($password), time() + (60 * 60 * 24 * 30), "/");
            }
            header("location:anggota.php"); // Arahkan ke halaman anggota setelah login berhasil
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
  <title>Login</title>
  <link rel="stylesheet" href="css-file/login.css">
</head>

<body>

  <div class="container">
    <div class="login-box">
      <div class="logo-cn">
        <img src="img/logo-cn.png" alt="logo-cn" width="100px">
      </div>
      <?php if ($err) { ?>
      <!-- Tampilkan pesan kesalahan jika ada -->
      <div id="error-message">
        <ul><?php echo $err ?></ul>
      </div>
      <?php } ?>
      <h2>Login</h2>
      <form id="loginform" action="" method="post" role="form" autocomplete="off">

        <div class="input-box">
          <input id="login-username" type="text" name="username" value="<?php echo htmlspecialchars($username) ?>"
            required>
          <label>Username</label>
        </div>

        <div class="input-box">
          <input id="login-password" type="password" name="password" required>
          <label>Password</label>
        </div>

        <div class="checkbox-container">
          <input id="login-remember" type="checkbox" name="ingataku" value="1"
            <?php if ($ingataku == '1') echo "checked" ?>>
          <label for="login-remember" class="remember">Remember me</label>
        </div>

        <!-- Tombol login -->
        <input type="submit" name="login" class="btn" value="Login" />
        
        <div class="signup-link">
          <a href="register.php">Sign Up</a>
        </div>
      </form>
    </div>

    <span style="--i:0;"></span>
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
    <span style="--i:48;"></span>
    <span style="--i:49;"></span>
  </div>
</body>

</html>