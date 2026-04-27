	<?php
/* ================================= */
/* FILE : admin/logout.php */
/* ================================= */

session_start();

/*
====================================
HAPUS SEMUA SESSION LOGIN
====================================
*/

session_unset();
session_destroy();

/*
====================================
KEMBALI KE HALAMAN LOGIN
====================================
*/

header("Location: ../index.php");
exit;

?>