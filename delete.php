<?php

require "functions.php";


if (delete() > 0) {
    echo "<script>
    alert('Data Sudah Dihapus');
    document.location.href = 'anggota.php';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    document.location.href = 'anggota.php';
    </script>";
}


?>