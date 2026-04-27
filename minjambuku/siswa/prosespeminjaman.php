<?php
session_start();
include "../connection.php";

/*
====================================
CEK LOGIN
====================================
*/

if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit;
}

/*
====================================
AMBIL DATA
====================================
*/

$nama_user = $_SESSION['nama_lengkap'];
$id_buku = isset($_GET['id']) ? $_GET['id'] : '';

$tanggal_pinjam   = date("Y-m-d");
$tanggal_kembali  = date("Y-m-d", strtotime("+7 days"));
$status           = "dipinjam";

/*
====================================
CEK ID BUKU
====================================
*/

if (empty($id_buku)) {
    echo "<script>
        alert('ID buku tidak ditemukan!');
        window.location='halamansiswa.php?page=peminjaman';
    </script>";
    exit;
}

/*
====================================
AMBIL DATA BUKU
====================================
*/

$cek_buku = mysqli_query($link, "
    SELECT * FROM tb_buku
    WHERE id_buku = '$id_buku'
");

$data_buku = mysqli_fetch_array($cek_buku);

/*
====================================
JIKA DATA BUKU TIDAK ADA
====================================
*/

if (!$data_buku) {
    echo "<script>
        alert('Data buku tidak ditemukan!');
        window.location='halamansiswa.php?page=peminjaman';
    </script>";
    exit;
}

/*
====================================
CEK STOK BUKU
====================================
*/

if ((int)$data_buku['stok'] <= 0) {
    echo "<script>
        alert('Stok buku habis!');
        window.location='halamansiswa.php?page=peminjaman';
    </script>";
    exit;
}

/*
====================================
SIMPAN KE TRANSAKSI
====================================
*/

$query = mysqli_query($link, "
    INSERT INTO tb_transaksi
    (
        nama_user,
        id_buku,
        judul_buku,
        tanggal_pinjam,
        tanggal_kembali,
        status
    )
    VALUES
    (
        '$nama_user',
        '$id_buku',
        '".$data_buku['judul_buku']."',
        '$tanggal_pinjam',
        '$tanggal_kembali',
        '$status'
    )
");

/*
====================================
KURANGI STOK BUKU
====================================
*/

mysqli_query($link, "
    UPDATE tb_buku
    SET stok = stok - 1
    WHERE id_buku = '$id_buku'
");


/*
====================================
HASIL
====================================
*/

if ($query) {
    echo "<script>
        alert('Peminjaman berhasil!');
        window.location='halamansiswa.php?page=peminjaman';
    </script>";
} else {
    echo "<script>
        alert('Peminjaman gagal!');
        window.location='halamansiswa.php?page=peminjaman';
    </script>";
}
?>