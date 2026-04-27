<?php
include "../connection.php";

$id_user = $_GET['id'];

$query = mysqli_query($link, "SELECT * FROM user WHERE id_user='$id_user'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data User</title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body{
    background: #f1f5f9;
}

/* MAIN */

main{
    width: 95%;
    margin: 30px auto;
}

/* TITLE */

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
    margin-top: 10px;
}

button:hover{
    background: #1565c0;
}

/* TABLE BOX */

.table-box{
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    overflow-x: auto;
}

/* TABLE */

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

table tr:hover{
    background: #f9fafb;
}

/* BUTTON AKSI */

.btn-edit{
    background: orange;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    margin-right: 5px;
}

.btn-edit:hover{
    background: #d97706;
}

.btn-hapus{
    background: red;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-hapus:hover{
    background: #dc2626;
}
</style>
</head>

<body>

<main>

    <h1>Edit Data User</h1>

    <!-- FORM EDIT -->
    <div class="form-box">
        <h3>Edit User</h3>

        <form action="updatedatauser.php" method="POST">

            <input 
            type="hidden" 
            name="id_user" 
            value="<?php echo $data['id_user']; ?>">

            <label>Username</label>
            <input 
            type="text" 
            name="username"
            value="<?php echo $data['username']; ?>"
            required>

            <label>Password</label>
            <input 
            type="text"
            value="<?php echo $data['password']; ?>"
            readonly>

            <label>Level</label>
            <select name="level" required>

                <option value="administrator"
                <?php if($data['level']=="administrator"){ echo "selected"; } ?>>
                    Administrator
                </option>

                <option value="siswa"
                <?php if($data['level']=="siswa"){ echo "selected"; } ?>>
                    Siswa
                </option>

            </select>

            <label>Nama Lengkap</label>
            <input 
            type="text" 
            name="nama_lengkap"
            value="<?php echo $data['nama_lengkap']; ?>"
            required>

            <button type="submit" name="submit">
                Update
            </button>

        </form>
    </div>

    <!-- TABLE USER -->
    <div class="table-box">
        <h3>Daftar Data User</h3>

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
            $tampil = mysqli_query($link, "SELECT * FROM user ORDER BY id_user DESC");

            while($d = mysqli_fetch_array($tampil)){
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['username']; ?></td>
                <td><?php echo $d['password']; ?></td>
                <td><?php echo $d['level']; ?></td>
                <td><?php echo $d['nama_lengkap']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $d['id_user']; ?>" class="btn-edit">
                        Edit
                    </a>

                    <a href="hapusdatauser.php?id=<?php echo $d['id_user']; ?>"
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