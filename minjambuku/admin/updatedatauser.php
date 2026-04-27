<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../connection.php";

/*
====================================
AMBIL DATA FORM
====================================
*/

$id_user = $_POST['id_user'];
$username = mysqli_real_escape_string($link, $_POST['username']);
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
    UPDATE DATA USER
    ====================================
    */

    $query = mysqli_query($link, "
        UPDATE user SET
            username = '$username',
            `level` = '$level',
            nama_lengkap = '$nama_lengkap'
        WHERE id_user = '$id_user'
    ");

    /*
    ====================================
    HASIL
    ====================================
    */

    if($query){
        echo "
        <script>
            alert('Data user berhasil diupdate!');
            window.location='halamanadmin.php?page=datauser';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data user gagal diupdate!');
            window.location='halamanadmin.php?page=datauser';
        </script>
        ";
    }
}
?>