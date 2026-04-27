<?php
/* =========================================
FILE : siswa/pengembalian.php
PROSES PENGEMBALIAN BUKU
========================================= */

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

$nama_user = $_SESSION['nama_lengkap'];

/*
====================================
PROSES KEMBALIKAN BUKU
====================================
*/

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Ambil data transaksi dulu
    $ambil = mysqli_query($link, "
        SELECT * FROM tb_transaksi
        WHERE id_transaksi = '$id'
    ");

    $data_transaksi = mysqli_fetch_array($ambil);

    if ($data_transaksi) {

        // Tambahkan kembali stok buku
        mysqli_query($link, "
            UPDATE tb_buku
            SET stok = stok + 1
            WHERE id_buku = '".$data_transaksi['id_buku']."'
        ");

        // Hapus transaksi
        mysqli_query($link, "
            DELETE FROM tb_transaksi
            WHERE id_transaksi = '$id'
        ");

        echo "
        <script>
            alert('Buku berhasil dikembalikan');
            window.location='halamansiswa.php?page=pengembalian';
        </script>
        ";
        exit;
    }
}
?>

<style>
h1{
    font-size: 28px;
    margin-bottom: 20px;
    color: #222;
}

h3{
    margin-bottom: 15px;
    color: #333;
}

.table-box{
    width: 75%;
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    margin: 0 auto;
    overflow-x: auto;
}

table{
    width: 100%;
    border-collapse: collapse;
}

table th{
    background: #43a047;
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

.btn-kembali{
    background: #e53935;
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    display: inline-block;
    transition: 0.3s;
}

.btn-kembali:hover{
    background: #c62828;
}
</style>

<h1>Pengembalian Buku</h1>

<div class="table-box">

    <h3>Daftar Buku Yang Dipinjam</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        $data = mysqli_query($link, "
            SELECT * FROM tb_transaksi
            WHERE nama_user = '$nama_user'
            ORDER BY id_transaksi DESC
        ");

        while($d = mysqli_fetch_array($data)){
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama_user']; ?></td>
            <td><?php echo $d['judul_buku']; ?></td>
            <td><?php echo $d['tanggal_pinjam']; ?></td>
            <td><?php echo $d['tanggal_kembali']; ?></td>
            <td><?php echo $d['status']; ?></td>
            <td>
                <a 
                href="halamansiswa.php?page=pengembalian&id=<?php echo $d['id_transaksi']; ?>"
                class="btn-kembali"
                onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                    Kembalikan
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>