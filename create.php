<?php
require "functions.php";

$id = $_GET["id"];
$siswa = query("SELECT * FROM siswa WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <div class="container">
        <table border="1" cellpadding="10" cellspacing="0" >
            <tr>
                <th>Nama</th>
                <th>Nis</th>
                <th>Email</th>
                <th>No Telphone</th>
                <th>Action</th>
            </tr>

            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
        </table>
    </div>
</body>
</html>