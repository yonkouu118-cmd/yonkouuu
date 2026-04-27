<?php
session_start();
include "../connection.php";

/*
====================================
CEK SESSION LOGIN ADMIN
====================================
*/

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}


/*
====================================
AMBIL TOTAL DATA DARI DATABASE
====================================
*/

/* total buku */
$q_buku = mysqli_query($link, "SELECT COUNT(*) as total_buku FROM tb_buku");
$d_buku = mysqli_fetch_array($q_buku);
$total_buku = $d_buku['total_buku'];

/* total transaksi */
$q_transaksi = mysqli_query($link, "SELECT COUNT(*) as total_transaksi FROM tb_transaksi");
$d_transaksi = mysqli_fetch_array($q_transaksi);
$total_transaksi = $d_transaksi['total_transaksi'];

/* total user */
$q_user = mysqli_query($link, "SELECT COUNT(*) as total_user FROM user");
$d_user = mysqli_fetch_array($q_user);
$total_user = $d_user['total_user'];

/*
====================================
MENENTUKAN HALAMAN
====================================
*/

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background: #f1f5f9;
    display: flex;
}

/* SIDEBAR */

.sidebar{
    width: 230px;
    height: 100vh;
    background: #1e88e5;
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
    background: #1565c0;
}

/* MAIN */

.main{
    margin-left: 230px;
    width: calc(100% - 230px);
    min-height: 100vh;
    padding: 30px;
}

.main h1{
    margin-bottom: 10px;
}

.main p{
    margin-bottom: 20px;
    color: #555;
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
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    text-align: center;
}

.card h3{
    margin-bottom: 10px;
    color: #333;
}

.card p{
    font-size: 30px;
    font-weight: bold;
    color: #1e88e5;
}
</style>
</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">
    <h2>ADMIN</h2>

    <a href="halamanadmin.php?page=dashboard">Dashboard</a>
    <a href="halamanadmin.php?page=databuku">Data Buku</a>
    <a href="halamanadmin.php?page=datatransaksi">Data Transaksi</a>
    <a href="halamanadmin.php?page=datauser">Data User</a>
    <a href="logout.php">Logout</a>
</div>

<!-- MAIN -->

<div class="main">

<?php if($page == "dashboard"){ ?>

    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?></p>

    <div class="card-container">

        <div class="card">
            <h3>Total Buku</h3>
            <p><?php echo $total_buku; ?></p>
        </div>

        <div class="card">
            <h3>Total Transaksi</h3>
            <p><?php echo $total_transaksi; ?></p>
        </div>

        <div class="card">
            <h3>Total User</h3>
            <p><?php echo $total_user; ?></p>
        </div>

    </div>

<?php
}

elseif($page == "databuku"){
    include "databuku.php";
}

elseif($page == "datatransaksi"){
    include "datatransaksi.php";
}

elseif($page == "datauser"){
    include "datauser.php";
}

else{
    echo "<h2>Halaman tidak ditemukan</h2>";
}
?>

</div>

</body>
</html>