<?php
include "../connection.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Buku</title>

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

h3{
    margin-bottom: 15px;
    color: #333;
}

/* FORM BOX */

.form-box{
    width: 75%;
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    margin: 0 auto 30px auto;
}

/* FORM */

form{
    display: flex;
    flex-direction: column;
    gap: 12px;
}

label{
    font-weight: bold;
    color: #333;
}

input,
select{
    width: 100%;
    padding: 12px;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
}

input:focus,
select:focus{
    border-color: #1e88e5;
}

button{
    background: #1e88e5;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
}

button:hover{
    background: #1565c0;
}

/* TABLE */

.table-box{
    background: white;
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

.btn-edit{
    background: orange;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-hapus{
    background: red;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}
</style>
</head>
<body>

<main>

    <h1>Data Buku</h1>

    <!-- FORM TAMBAH BUKU -->
    <div class="form-box">
        <h3>Tambah / Edit Buku</h3>

        <form action="prosesdatabuku.php" method="POST">

            <label>Judul Buku</label>
            <input type="text" name="judul_buku" required>

            <label>Pengarang</label>
            <input type="text" name="pengarang" required>

            <label>Penerbit</label>
            <input type="text" name="penerbit" required>

            <label>Tahun Terbit</label>
            <input type="date" name="tahun_terbit" required>

            <label>Stok</label>
            <input type="number" name="stok" required>

            <button type="submit" name="submit">
                Simpan
            </button>

        </form>
    </div>

    <!-- TABLE DATA BUKU -->
    <div class="table-box">

        <table>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $query = mysqli_query($link, "
                SELECT * FROM tb_buku
                ORDER BY id_buku DESC
            ");

            while($data = mysqli_fetch_array($query)){
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['judul_buku']; ?></td>
                <td><?php echo $data['pengarang']; ?></td>
                <td><?php echo $data['penerbit']; ?></td>
                <td><?php echo $data['tahun_terbit']; ?></td>
                <td><?php echo $data['stok']; ?></td>
                <td>
                    <a href="edit_buku.php?id=<?php echo $data['id_buku']; ?>" class="btn-edit">
                        Edit
                    </a>

                    <a href="hapusdatabuku.php?id=<?php echo $data['id_buku']; ?>"
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin hapus buku ini?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</main>

</body>
</html>