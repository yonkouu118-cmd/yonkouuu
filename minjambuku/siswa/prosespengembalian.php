<?php
/* =========================================
FILE : siswa/prosespengembalian.php
PROSES PENGEMBALIAN BUKU
========================================= */

session_start();
include "../connection.php";

/*
====================================
CEK LOGIN
====================================
*/

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../index.php");
    exit;
}

/*
====================================
AMBIL ID TRANSAKSI
====================================
*/

$id_transaksi = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_transaksi)) {
    echo "<script>
        alert('ID transaksi tidak ditemukan!');
        window.location='halamansiswa.php?page=pengembalian';
    </script>";
    exit;
}

/*
====================================
AMBIL DATA TRANSAKSI
====================================
*/

$ambil = mysqli_query($link, "
    SELECT * FROM tb_transaksi
    WHERE id_transaksi = '$id_transaksi'
");

$data = mysqli_fetch_array($ambil);

if (!$data) {
    echo "<script>
        alert('Data transaksi tidak ditemukan!');
        window.location='halamansiswa.php?page=pengembalian';
    </script>";
    exit;
}

/*
====================================
KEMBALIKAN STOK BUKU
====================================
*/

mysqli_query($link, "
    UPDATE tb_buku
    SET stok = stok + 1
    WHERE id_buku = '".$data['id_buku']."'
");

/*
====================================
HAPUS DATA TRANSAKSI
====================================
*/

$hapus = mysqli_query($link, "
    DELETE FROM tb_transaksi
    WHERE id_transaksi = '$id_transaksi'
");

/*
====================================
HASIL
====================================
*/

if ($hapus) {
    echo "<script>
        alert('Buku berhasil dikembalikan!');
        window.location='halamansiswa.php?page=pengembalian';
    </script>";
} else {
    echo "<script>
        alert('Pengembalian gagal!');
        window.location='halamansiswa.php?page=pengembalian';
    </script>";
}
?>