<?php
/* ================================= */
/* FILE : siswa/halamansiswa.php */
/* ================================= */

session_start();

/*
====================================
CEK SESSION LOGIN SISWA
====================================
*/

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

/*
====================================
MENENTUKAN HALAMAN YANG DIBUKA
====================================
*/

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Siswa</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background: #f1f1f1;
    display: flex;
}

/* SIDEBAR */

.sidebar{
    width: 230px;
    height: 100vh;
    background: #43a047;
    padding: 20px 10px;
    color: white;
    position: fixed;
}

.sidebar h2{
    text-align: center;
    margin-bottom: 30px;
}

.sidebar a{
    display: block;
    color: white;
    text-decoration: none;
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 5px;
    transition: 0.3s;
}

.sidebar a:hover{
    background: #2e7d32;
}

/* MAIN */

.main{
    margin-left: 230px;
    width: calc(100% - 230px);
    min-height: 100vh;
    padding: 30px;
}

/* CARD */

.card-container{
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.card{
    flex: 1;
    min-width: 250px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    text-align: center;
}

.card h3{
    margin-bottom: 10px;
    color: #333;
}

.card p{
    font-size: 24px;
    font-weight: bold;
    color: #43a047;
}
</style>
</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">
    <h2>SISWA</h2>

    <a href="halamansiswa.php?page=dashboard">Dashboard</a>
    <a href="halamansiswa.php?page=peminjaman">Peminjaman</a>
    <a href="halamansiswa.php?page=pengembalian">Pengembalian</a>
    <a href="logout.php">Logout</a>
</div>

<!-- MAIN -->

<div class="main">

<?php

/*
====================================
ROUTING HALAMAN SISWA
====================================
*/

if ($page == "dashboard") {
?>

    <h1>Dashboard Siswa</h1>
    <p>Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?></p>

    <div class="card-container">

        <div class="card">
            <h3>Buku Dipinjam</h3>
            <p>2 Buku</p>
        </div>

        <div class="card">
            <h3>Belum Dikembalikan</h3>
            <p>1 Buku</p>
        </div>

        <div class="card">
            <h3>Total Transaksi</h3>
            <p>5 Kali</p>
        </div>

    </div>

<?php
}

elseif ($page == "peminjaman") {
    include "peminjaman.php";
}

elseif ($page == "pengembalian") {
    include "pengembalian.php";
}

else {
    echo "<h1>Halaman tidak ditemukan</h1>";
}

?>

</div>

</body>
</html>