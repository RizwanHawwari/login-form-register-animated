<?php 

$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "sekolah";
$conn    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}

function edit() {
  global $conn;

  $nama = htmlspecialchars($_POST["nama"]);
  $nis = htmlspecialchars($_POST["nis"]);
  $email = htmlspecialchars($_POST["email"]);
  $no_telp = htmlspecialchars($_POST["no_telp"]);

  $q1 = "SELECT nama FROM siswa WHERE nama = '$nama'";
  $r1 = mysqli_query($conn, $q1);
  if ( mysqli_fetch_assoc($r1) ) {
    echo "<script>
    alert('Nama Sudah Terdaftar');
    </script>";
    return false;
  }

  $id = $_POST["id"];
  
  $query = "UPDATE siswa SET
  nama = '$nama',
  nis = $nis,
  email = '$email',
  no_telp = $no_telp
  WHERE id = $id";
$result = mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
} 
function delete() {
  global $conn;
  $id = $_GET["id"];
  $q2 = "DELETE FROM siswa WHERE id = '$id'";
  mysqli_query($conn, $q2);
  return mysqli_affected_rows($conn);

}

function create() {
  global $conn;
  $nama = htmlspecialchars($_POST["nama"]);
  $nis = htmlspecialchars($_POST["nis"]);
  $email = htmlspecialchars($_POST["email"]);
  $no_telp = htmlspecialchars($_POST["no_telp"]);
   $q1 = "SELECT nama FROM siswa WHERE nama = '$nama'";
  $r1 = mysqli_query($conn, $q1);
  if ( mysqli_fetch_assoc($r1) ) {
    echo "<script>
    alert('Nama Sudah Terdaftar');
    </script>";
      return false;
    }  
    $q2 = "INSERT INTO siswa VALUES (
    '', '$nama', $nis, '$email', $no_telp)";

    $r2 = mysqli_query($conn, $q2);
    return mysqli_affected_rows($conn);
}
?>