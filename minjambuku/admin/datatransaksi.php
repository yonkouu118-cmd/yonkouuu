<?php
include "../connection.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Transaksi</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background: #f1f5f9;
}

main{
    width: 95%;
    margin: 30px auto;
}

h1{
    font-size: 28px;
    margin-bottom: 20px;
    color: #222;
}

.table-box{
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    overflow-x: auto;
}

table{
    width: 100%;
    border-collapse: collapse;
}

table th{
    background: #1e88e5;
    color: white;
    padding: 14px;
    text-align: center;
    font-size: 14px;
}

table td{
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #e5e5e5;
    font-size: 14px;
}

.status-pinjam{
    background: orange;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
}

.status-kembali{
    background: green;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
}
</style>
</head>
<body>

<main>

    <h1>Data Transaksi</h1>

    <div class="table-box">

        <table>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>

            <?php
            $no = 1;

            $query = mysqli_query($link, "
                SELECT * FROM tb_transaksi
                ORDER BY id_transaksi DESC
            ");

            while($data = mysqli_fetch_array($query)){
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_user']; ?></td>
                <td><?php echo $data['judul_buku']; ?></td>
                <td><?php echo $data['tanggal_pinjam']; ?></td>
                <td><?php echo $data['tanggal_kembali']; ?></td>
                <td>
                    <?php if($data['status'] == "dipinjam"){ ?>
                        <span class="status-pinjam">
                            Dipinjam
                        </span>
                    <?php } else { ?>
                        <span class="status-kembali">
                            Dikembalikan
                        </span>
                    <?php } ?>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</main>

</body>
</html>