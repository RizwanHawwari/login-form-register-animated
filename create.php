<?php
require "functions.php";

$siswa = query("SELECT * FROM siswa");
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

            <?php foreach ($siswa as $row) : ?>
            <tr>
                <td><?= $row["nama"];?></td>
                <td><?= $row["nis"];?></td>
                <td><?= $row["email"];?></td>
                <td><?= $row["no_telp"];?> </td>
                <td><a href="update.php">Edit</a> | 
                    <a href="#">Delete</a></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>