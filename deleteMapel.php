<?php

require "functions.php";

if (deleteMapel() > 0) {
    echo "<script>
    alert('Data Sudah Dihapus');
    document.location.href = 'mapel.php';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    document.location.href = 'mapel.php';
    </script>";
}


?>