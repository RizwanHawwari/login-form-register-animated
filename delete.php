<?php
require "functions.php";

if (isset($_GET["tabel"]) && isset($_GET["id"])) {
    $tabel = $_GET["tabel"];
    $id = $_GET["id"];
    $tabelValid = ["siswa", "guru", "mapel"];
    
    if (in_array($tabel, $tabelValid)) {
        if (delete($tabel, $id) > 0) {
            echo "<script>alert('Data Sudah Dihapus'); document.location.href = '$tabel.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Dihapus'); document.location.href = '$tabel.php';</script>";
        }
    } else {
        header("Location: anggota.php");
    }
} else {
    header("Location: anggota.php");
}
?>