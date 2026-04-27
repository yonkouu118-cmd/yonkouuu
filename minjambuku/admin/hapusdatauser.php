<?php
include "../connection.php";

$id_user = $_GET['id'];

$query = mysqli_query($link,
"DELETE FROM user WHERE id_user='$id_user'");

echo "<script>
    alert('Data user berhasil dihapus');
    window.location='halamanadmin.php?page=datauser';
</script>";
?>