<?php

require "functions.php";


if (delete() > 0) {
    echo "<script>
    alert('Nis Sudah dihapus');
    document.location.href = 'anggota.php';
    </script>";
} else {
    echo "<script>
    alert('Nis gagal dihapus');
    document.location.href = 'anggota.php';
    </script>";
}


?>
