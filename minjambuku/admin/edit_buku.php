<?php
include "../connection.php";

/*
====================================
AMBIL ID BUKU
====================================
*/

$id = $_GET['id'];

/*
====================================
AMBIL DATA BUKU BERDASARKAN ID
====================================
*/

$query = mysqli_query($link, "
    SELECT * FROM tb_buku
    WHERE id_buku = '$id'
");

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Buku</title>

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
    width: 75%;
    margin: 40px auto;
}

h1{
    margin-bottom: 20px;
    color: #222;
}

.form-box{
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

form{
    display: flex;
    flex-direction: column;
    gap: 12px;
}

label{
    font-weight: bold;
}

input{
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
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
</style>
</head>
<body>

<main>

    <h1>Edit Data Buku</h1>

    <div class="form-box">

        <form action="updatedatabuku.php" method="POST">

            <input 
                type="hidden" 
                name="id_buku"
                value="<?php echo $data['id_buku']; ?>"
            >

            <label>Judul Buku</label>
            <input 
                type="text" 
                name="judul_buku"
                value="<?php echo $data['judul_buku']; ?>"
                required
            >

            <label>Pengarang</label>
            <input 
                type="text" 
                name="pengarang"
                value="<?php echo $data['pengarang']; ?>"
                required
            >

            <label>Penerbit</label>
            <input 
                type="text" 
                name="penerbit"
                value="<?php echo $data['penerbit']; ?>"
                required
            >

            <label>Tahun Terbit</label>
            <input 
                type="date" 
                name="tahun_terbit"
                value="<?php echo $data['tahun_terbit']; ?>"
                required
            >

            <label>Stok</label>
            <input 
                type="number" 
                name="stok"
                value="<?php echo $data['stok']; ?>"
                required
            >

            <button type="submit" name="submit">
                Update Data
            </button>

        </form>

    </div>

</main>

</body>
</html>