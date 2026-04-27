<?php
error_reporting(E_ALL);

include "../connection.php";

/*
====================================
AMBIL DATA FORM
====================================
*/

$username = mysqli_real_escape_string($link, $_POST['username']);
$password = md5($_POST['password']);
$level = mysqli_real_escape_string($link, $_POST['level']);
$nama_lengkap = mysqli_real_escape_string($link, $_POST['nama_lengkap']);

/*
====================================
CEK SUBMIT
====================================
*/

if (isset($_POST['submit'])) {

    /*
    ====================================
    INSERT DATA USER
    ====================================
    */

    $query = mysqli_query($link, "
        INSERT INTO user
        (
            username,
            password,
            `level`,
            nama_lengkap
        )
        VALUES
        (
            '$username',
            '$password',
            '$level',
            '$nama_lengkap'
        )
    ");

    /*
    ====================================
    HASIL
    ====================================
    */

    if($query){
        echo "
        <script>
            alert('Data user berhasil ditambahkan!');
            window.location='halamanadmin.php?page=datauser';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data user gagal ditambahkan!');
            window.location='halamanadmin.php?page=datauser';
        </script>
        ";
    }
}
?>