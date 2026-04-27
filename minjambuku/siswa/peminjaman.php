<?php
include "../connection.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit;
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : "";

/*
====================================
QUERY SEARCH BUKU
====================================
*/

if ($cari != "") {
    $query = mysqli_query($link, "
        SELECT * FROM tb_buku
        WHERE 
            judul_buku LIKE '%$cari%'
            OR pengarang LIKE '%$cari%'
            OR penerbit LIKE '%$cari%'
        ORDER BY id_buku DESC
    ");
} else {
    $query = mysqli_query($link, "
        SELECT * FROM tb_buku
        ORDER BY id_buku DESC
    ");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjaman Buku</title>

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

h1{
    margin-bottom: 20px;
}

.search-box{
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
}

.search-box form{
    display: flex;
    gap: 10px;
}

.search-box input{
    flex: 1;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.search-box button{
    padding: 12px 20px;
    background: #1e88e5;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.table-box{
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
}

table{
    width: 100%;
    border-collapse: collapse;
}

table th{
    background: #1e88e5;
    color: white;
    padding: 12px;
}

table td{
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.btn-pinjam{
    background: green;
    color: white;
    padding: 8px 14px;
    border-radius: 5px;
    text-decoration: none;
}
</style>
</head>
<body>

<h1>Peminjaman Buku</h1>

<div class="search-box">
    <form method="GET" action="">
        <input 
            type="text" 
            name="cari"
            placeholder="Cari judul buku / penulis / penerbit..."
            value="<?php echo $cari; ?>"
        >

        <button type="submit">
            Search
        </button>
    </form>
</div>

<div class="table-box">

<table>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;

while($data = mysqli_fetch_array($query)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['judul_buku']; ?></td>
    <td><?php echo $data['pengarang']; ?></td>
    <td><?php echo $data['penerbit']; ?></td>
    <td><?php echo $data['stok']; ?></td>
    <td>
        <?php if($data['stok'] > 0){ ?>
            <a 
            href="prosespeminjaman.php?id=<?php echo $data['id_buku']; ?>"
            class="btn-pinjam"
            onclick="return confirm('Yakin ingin meminjam buku ini?')">
            Pinjam
            </a>
        <?php } else { ?>
        <span style="color:red;">Stok Habis</span>
    <?php } ?>
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>