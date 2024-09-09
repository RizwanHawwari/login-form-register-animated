<?php

require "functions.php";

if (deleteGuru() > 0) {
    echo "<script>
    alert('Data Sudah Dihapus');
    document.location.href = 'guru.php';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    document.location.href = 'guru.php';
    </script>";
}


?>
