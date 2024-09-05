<?php
require "functions.php";
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
    <form action="" method="post">
      <ul>
        <li>
          <label for="nama">Nama: </label>
          <input type="text" id="nama" name="nama">
        </li>
        <li>
          <label for="nis">NIS: </label>
          <input type="text" name="nis" id="nis" >
        </li>
        <li>
          <label for="email">Email: </label>
          <input type="email" name="email" id="email" >
        </li>
        <li>
          <label for="no_telp">No Telp: </label>
          <input type="tel" name="no_telp" id="no_telp">
        </li>
        <button type="submit" name="edit">Edit</button>
      </ul>
    </form>
       
    </div>
</body>
</html>