<?php
include "../connection.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data User Admin</title>

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
    width: 35%; /* 3/4 layar */
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    margin-bottom: 30px;
}

/* FORM */

form{
    display: 80px;
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
    margin-top: 10px;
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

    <h1>Data User</h1>

    <!-- FORM -->
    <div class="form-box">
        <h3>Tambah / Edit User</h3>

        <form action="prosesdatauser.php" method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Level</label>
            <select name="level" required>
                <option value="">-- Pilih Level --</option>
                <option value="administrator">Administrator</option>
                <option value="siswa">Siswa</option>
            </select>

            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required>

            <button type="submit" name="submit">
                Simpan
            </button>

        </form>
    </div>

    <!-- TABLE -->
    <div class="table-box">

        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Nama Lengkap</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $query = mysqli_query($link, "SELECT * FROM user ORDER BY id_user DESC");

            while($data = mysqli_fetch_array($query)){
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['level']; ?></td>
                <td><?php echo $data['nama_lengkap']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $data['id_user']; ?>" class="btn-edit">
                        Edit
                    </a>

                    <a href="hapusdatauser.php?id=<?php echo $data['id_user']; ?>" 
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin hapus data ini?')">
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