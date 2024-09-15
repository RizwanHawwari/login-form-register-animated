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
  $id = $_POST["id"];

  $q2 = "SELECT email FROM siswa WHERE email = '$email' AND id != '$id'";
  $r2 = mysqli_query($conn, $q2);
  if (mysqli_fetch_assoc($r2)) {
    echo "<script>alert('Email Sudah Terdaftar');</script>";
    return false;
  }

  if (!validatePhoneNumber($no_telp)) {
    echo "<script>alert('Nomor Telepon Tidak Valid');</script>";
    return false;
}

  $q3 = "SELECT no_telp FROM siswa WHERE no_telp = '$no_telp' AND id != '$id'";
  $r3 = mysqli_query($conn, $q3);
  if (mysqli_fetch_assoc($r3)) {
    echo "<script>alert('Nomor Telepon Sudah Terdaftar');</script>";
    return false;
  }

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
  $id = $_POST["id"];

  $q2 = "SELECT email FROM guru WHERE email = '$email' AND id != '$id'";
  $r2 = mysqli_query($conn, $q2);
  if (mysqli_fetch_assoc($r2)) {
    echo "<script>alert('Email Sudah Terdaftar');</script>";
    return false;
  }

  if (!validatePhoneNumber($no_telp)) {
    echo "<script>alert('Nomor Telepon Tidak Valid');</script>";
    return false;
}

  $q3 = "SELECT no_telp FROM guru WHERE no_telp = '$no_telp' AND id != '$id'";
  $r3 = mysqli_query($conn, $q3);
  if (mysqli_fetch_assoc($r3)) {
    echo "<script>alert('Nomor Telepon Sudah Terdaftar');</script>";
    return false;
  }

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

function delete($tabel, $id) {
  global $conn;

  $tabelValid = ["siswa", "guru"];
  if (!in_array($tabel, $tabelValid)) {
      return false;
  }

  $query = "DELETE FROM $tabel WHERE id = '$id'";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


function deleteMapel() {
  global $conn;
  $id = $_GET["id"];
  $q2 = "DELETE FROM mapel WHERE id = '$id'";
  mysqli_query($conn, $q2);
  return mysqli_affected_rows($conn);

}

function create($table, $fields) {
  global $conn;

  $fieldData = [];
  foreach ($fields as $field => $value) {
      $fieldData[$field] = htmlspecialchars($value);
  }

  $email = $fieldData['email'];
  $q2 = "SELECT email FROM $table WHERE email = '$email'";
  $r2 = mysqli_query($conn, $q2);
  if (mysqli_fetch_assoc($r2)) {
      echo "<script>alert('Email Sudah Terdaftar');</script>";
      return false;
  }

  $no_telp = $fieldData['no_telp'];
  if (!validatePhoneNumber($no_telp)) {
      echo "<script>alert('Nomor Telepon Tidak Valid');</script>";
      return false;
  }

  $q3 = "SELECT no_telp FROM $table WHERE no_telp = '$no_telp'";
  $r3 = mysqli_query($conn, $q3);
  if (mysqli_fetch_assoc($r3)) {
      echo "<script>alert('Nomor Telepon Sudah Terdaftar');</script>";
      return false;
  }

  $columns = implode(", ", array_keys($fieldData));
  $values = implode("', '", array_values($fieldData));

  $q4 = "INSERT INTO $table ($columns) VALUES ('$values')";
  $r4 = mysqli_query($conn, $q4);

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
      '852', '853', '811', '812', '813', '821', '822', '851',    // Telkomsel
      '856', '857',   // Indosat
      '817', '818', '819', '859', '877', '878',   // XL
      '896', '895', '897', '898', '899',    // Tri
      '881', '882', '883', '884', '885', '886', '887', '888', '889',    // Smartfren
      '813', '832', '833', '838',   // Axis
      // source: https://kumparan.com/how-to-tekno/daftar-kode-nomor-operator-seluler-di-indonesia-1xTI8XnRtVj/full
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