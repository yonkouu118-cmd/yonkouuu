<?php 
$con = mysqli_connect("localhost","root","","minjambuku");



$username = $_POST['username'];
$password = md5($_POST['password']);
$nama_lengkap = $_POST['nama_lengkap'];
$level = $_POST['level'];
$submit = $_POST['submit'];



if (isset($submit)){
    if (empty($password)){
        echo"<script>window.alert('Maaf,Form Tidak Boleh Kosong...!!!');window.location=('register.php');</script>";
    }else{

        $query="INSERT into user (id_user,username,password,level,nama_lengkap) values ('','$username','$password','$level','$nama_lengkap')";

        $result=mysqli_query($con,$query);

    echo"<script>window.alert('register berhasil');window.location=('index.php')</script>";
    }
}
?>