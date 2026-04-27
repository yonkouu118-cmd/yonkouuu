<?php
/* ================================= */
/* FILE : proseslogin.php */
/* ================================= */

session_start();
include "connection.php";

/*
====================================
AMBIL DATA DARI FORM LOGIN
====================================
*/

$username = $_POST['username'];
$password = md5($_POST['password']);

/*
====================================
CEK USERNAME DAN PASSWORD
====================================
*/

$query = mysqli_query($link, "SELECT * FROM user 
    WHERE username='$username' 
    AND password='$password'");

$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);

/*
====================================
JIKA LOGIN BERHASIL
====================================
*/

if ($cek > 0) {

    /*
    ============================
    LOGIN SEBAGAI ADMIN
    ============================
    */

    if ($data['level'] == "administrator") {

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['level'] = "administrator";

        echo "<script>alert('Login Admin Berhasil, Selamat Datang  $_SESSION[nama_lengkap]');window.location='admin/halamanadmin.php';</script>";
    }

    /*
    ============================
    LOGIN SEBAGAI SISWA
    ============================
    */

    elseif ($data['level'] == "siswa") {

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['level'] = "siswa";

        echo "<script>alert('Login Siswa Berhasil, Selamat Datang  $_SESSION[nama_lengkap]');window.location='siswa/halamansiswa.php';</script>";
    }

    /*
    ============================
    LEVEL TIDAK SESUAI
    ============================
    */

    else {
        echo "<script>
            alert('Level user tidak dikenali!');
            window.location='index.php';
        </script>";
    }

}

/*
====================================
JIKA LOGIN GAGAL
====================================
*/

else {
    echo "<script>
        alert('Login gagal! Username atau Password salah');
        window.location='index.php';
    </script>";
}
?>