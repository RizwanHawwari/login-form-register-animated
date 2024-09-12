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
  no_telp = '$no_telp'
  WHERE id = $id";
$result = mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
} 

function editGuru() {
    global $conn;
  
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $no_telp = htmlspecialchars($_POST["no_telp"]);
    $guru_mapel = htmlspecialchars($_POST["guru_mapel"]);
  
    $q1 = "SELECT nama FROM guru WHERE nama = '$nama'";
    $r1 = mysqli_query($conn, $q1);
    if ( mysqli_fetch_assoc($r1) ) {
      echo "<script>
      alert('Nama Sudah Terdaftar');
      </script>";
      return false;
    }

  $id = $_POST["id"];
  
  $query = "UPDATE guru SET
  nama = '$nama',
  email = '$email',
  no_telp = '$no_telp',
  guru_mapel = '$guru_mapel'
  WHERE id = $id";
$result = mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
} 

function editMapelGuru() {
  global $conn;

  $kode = htmlspecialchars($_POST["kode"]);
  $nama = htmlspecialchars($_POST["nama"]);

  $q1 = "SELECT nama FROM mapel WHERE nama = '$nama'";
  $r1 = mysqli_query($conn, $q1);
  if ( mysqli_fetch_assoc($r1) ) {
    echo "<script>
    alert('Nama Sudah Terdaftar');
    </script>";
    return false;
  }

$id = $_POST["id"];

$query = "UPDATE mapel SET
kode = '$kode',
nama = '$nama'
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

function deleteGuru() {
  global $conn;
  $id = $_GET["id"];
  $q2 = "DELETE FROM guru WHERE id = '$id'";
  mysqli_query($conn, $q2);
  return mysqli_affected_rows($conn);

}

function deleteMapel() {
  global $conn;
  $id = $_GET["id"];
  $q2 = "DELETE FROM mapel WHERE id = '$id'";
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
    '', '$nama', $nis, '$email', '$no_telp')";

    $r2 = mysqli_query($conn, $q2);
    return mysqli_affected_rows($conn);
}

function createGuru() {
  global $conn;
  $nama = htmlspecialchars($_POST["nama"]);
  $email = htmlspecialchars($_POST["email"]);
  $no_telp = htmlspecialchars($_POST["no_telp"]);
  $guru_mapel = htmlspecialchars($_POST["guru_mapel"]);
   $q1 = "SELECT nama FROM guru WHERE nama = '$nama'";
  $r1 = mysqli_query($conn, $q1);
  if ( mysqli_fetch_assoc($r1) ) {
    echo "<script>
    alert('Nama Sudah Terdaftar');
    </script>";
      return false;
    }  
    $q2 = "INSERT INTO guru VALUES (
    '', '$nama', '$email', '$no_telp', '$guru_mapel')";

    $r2 = mysqli_query($conn, $q2);
    return mysqli_affected_rows($conn);
}

function createMapel() {
  global $conn;
  $kode = htmlspecialchars($_POST["kode"]);
  $nama = htmlspecialchars($_POST["nama"]);
   $q1 = "SELECT nama FROM mapel WHERE nama = '$nama'";
  $r1 = mysqli_query($conn, $q1);
  if ( mysqli_fetch_assoc($r1) ) {
    echo "<script>
    alert('Nama Sudah Terdaftar');
    </script>";
      return false;
    }  
    $q2 = "INSERT INTO mapel VALUES (
    '', '$kode', '$nama')";

    $r2 = mysqli_query($conn, $q2);
    return mysqli_affected_rows($conn);
}


function validatePhoneNumber($no_telp) {

  $kode_operator = [
      '812', '813', '814', '815', '816', '817', '818', '819',  // Telkomsel
      '822', '823', '852', '853', '851',                        // Indosat
      '838', '831', '832', '833', '859',                        // XL
      '877', '878', '896', '897', '898', '899',                 // Tri
      '881', '882', '883', '884',                               // Smartfren
  ];

  $no_telp = preg_replace('/[^\d]/', '', $no_telp);

  if (preg_match('/^62|^08/', $no_telp)) {
      if (substr($no_telp, 0, 2) == '08') {
          $no_telp = '62' . substr($no_telp, 1);
      }

      $kode = substr($no_telp, 2, 3);

      if (in_array($kode, $kode_operator)) {
          return true;
      } else {
          return false;
      }
  } else {
      return false; 
  }
}
?>