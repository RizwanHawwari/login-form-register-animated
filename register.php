<?php
session_start();

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

    // memvalidasi input dari user
    if ($username == '' || $password == '' || $konfirmasi_password == '' || $email == '' || $no_telp == '') {
        $err .= "<li>Silakan isi semua kolom.</li>";
    } elseif ($password != $konfirmasi_password) {
        $err .= "<li>Konfirmasi password tidak sesuai.</li>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err .= "<li>Email tidak valid.</li>";
    } else {
        // ngecek apakah username sudah ada
        $sql1 = "SELECT * FROM login WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if ($r1) {
            $err .= "<li>Username <b>$username</b> sudah terdaftar.</li>";
        } else {
            // ngecek email apakah sudah terdaftar
            $sql2 = "SELECT * FROM login WHERE email = '$email'";
            $q2 = mysqli_query($koneksi, $sql2);
            $r2 = mysqli_fetch_array($q2);

            if ($r2) {
                $err .= "<li>Email <b>$email</b> sudah terdaftar.</li>";
            } else {
                // ngecek nomor telp apakah sudah terdaftar
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

  <div class="img">
    <img src="img/logo-cn.png" alt="Logo SMK Citra Negara" width="150px" height="150px">
  </div>

    <div class="container">
        <div class="login-box">
            <h2>Create An Account</h2>
            <form id="registerform" action="" method="post" role="form" autocomplete="off">
                
                <div class="row">
                    <div class="input-box">
                        <input id="register-username" type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <input id="register-email" type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
                        <label>Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-box">
                        <input id="register-password" type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="input-box">
                        <input id="register-konfirmasi-password" type="password" name="konfirmasi_password" required>
                        <label>Confirm Password</label>
                    </div>
                </div>

                <div class="input-box full-width">
                    <input id="register-no-telp" type="text" name="no_telp" value="<?php echo htmlspecialchars($no_telp) ?>" required>
                    <label>Phone Number</label>
                </div>

                <input type="submit" name="register" class="btn" value="Register">
                
                <div class="login-btn">
                    <a href="login.php">Log In</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>