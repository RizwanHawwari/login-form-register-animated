<?php 
session_start(); // Mulai sesi

// Kosongkan data sesi
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";

// Hancurkan sesi pengguna
session_destroy();

// Atur nama dan nilai cookie untuk username
$cookie_name = "cookie_username";
$cookie_value = "";
$time = time() - (60 * 60); // Set cookie untuk kadaluarsa satu jam yang lalu
setcookie($cookie_name, $cookie_value, $time, "/");

// Atur nama dan nilai cookie untuk password
$cookie_name = "cookie_password";
$cookie_value = "";
$time = time() - (60 * 60); // Set cookie untuk kadaluarsa satu jam yang lalu
setcookie($cookie_name, $cookie_value, $time, "/");

// Arahkan pengguna ke halaman login setelah logout
header("location:login.php");
exit(); // Pastikan script berhenti setelah redirect
?>