<?php

require "functions.php";


$nis = $_GET["nis"];

if (delete($nis) > 0) {
    echo "<script>
    alert('Nis Sudah dihapus');
    document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert('Nis gagal dihapus');
    document.location.href = 'index.php';
    </script>";
}


?>
