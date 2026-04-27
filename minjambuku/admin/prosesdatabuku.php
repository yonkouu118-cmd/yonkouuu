<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../connection.php";

/*
====================================
AMBIL DATA DARI FORM
====================================
*/

$judul_buku   = mysqli_real_escape_string($link, $_POST['judul_buku']);
$pengarang    = mysqli_real_escape_string($link, $_POST['pengarang']);
$penerbit     = mysqli_real_escape_string($link, $_POST['penerbit']);
$tahun_terbit = mysqli_real_escape_string($link, $_POST['tahun_terbit']);
$stok         = mysqli_real_escape_string($link, $_POST['stok']);

/*
====================================
CEK SUBMIT
====================================
*/

if (isset($_POST['submit'])) {

    /*
    ====================================
    INSERT DATA KE DATABASE
    ====================================
    */

    $query = mysqli_query($link, "
        INSERT INTO tb_buku
        (
            judul_buku,
            pengarang,
            penerbit,
            tahun_terbit,
            stok
        )
        VALUES
        (
            '$judul_buku',
            '$pengarang',
            '$penerbit',
            '$tahun_terbit',
            '$stok'
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
            alert('Data buku berhasil ditambahkan!');
            window.location='halamanadmin.php?page=databuku';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data buku gagal ditambahkan!');
            window.location='halamanadmin.php?page=databuku';
        </script>
        ";
    }
}
?>