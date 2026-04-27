<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "minjambuku";

$link = mysqli_connect($host, $user, $pass, $db);

if (!$link) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>