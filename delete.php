<?php

require "functions.php";


$id = $_GET["id"];

if (delete($id) > 0) {
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
