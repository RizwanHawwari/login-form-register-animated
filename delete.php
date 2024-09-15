<?php
require "functions.php";

if (!isset($_GET["tabel"]) || !isset($_GET["id"])) {
    echo "<script>
    alert('Parameter tidak lengkap');
    document.location.href = 'anggota.php';
    </script>";
    exit;
}

$tabel = $_GET["tabel"];
$id = $_GET["id"];

if (delete($tabel, $id) > 0) {
    echo "<script>
    alert('Data Sudah Dihapus');
    document.location.href = '$tabel.php';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    document.location.href = '$tabel.php';
    </script>";
}
?>