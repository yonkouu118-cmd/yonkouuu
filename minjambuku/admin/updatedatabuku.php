<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../connection.php";

/*
====================================
CEK SUBMIT
====================================
*/

if (isset($_POST['submit'])) {

    $id_buku      = $_POST['id_buku'];
    $judul_buku   = mysqli_real_escape_string($link, $_POST['judul_buku']);
    $pengarang    = mysqli_real_escape_string($link, $_POST['pengarang']);
    $penerbit     = mysqli_real_escape_string($link, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($link, $_POST['tahun_terbit']);
    $stok         = mysqli_real_escape_string($link, $_POST['stok']);

    /*
    ====================================
    UPDATE DATA
    ====================================
    */

    $query = mysqli_query($link, "
        UPDATE tb_buku SET
            judul_buku = '$judul_buku',
            pengarang = '$pengarang',
            penerbit = '$penerbit',
            tahun_terbit = '$tahun_terbit',
            stok = '$stok'
        WHERE id_buku = '$id_buku'
    ");

    /*
    ====================================
    HASIL
    ====================================
    */

    if ($query) {
        echo "
        <script>
            alert('Data buku berhasil diupdate!');
            window.location='halamanadmin.php?page=databuku';
        </script>
        ";
    } else {
        echo mysqli_error($link);
    }

} else {
    echo "Submit tidak terdeteksi!";
}
?>