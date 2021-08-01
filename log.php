<?php

session_start();
require_once("database.php");
$db_handle = new Koneksi();

$userid = $_POST['username'];
$psw = hash('sha256', md5($_POST['password']));
$op = $_GET['op'];

if ($op == "in") {
    $query="SELECT ID, nama, level FROM tbl_user WHERE username = '$userid' AND password = '$psw'";
    $result= $db_handle->runQuery($query);

    if ($db_handle->numRows($query) == 1) {//jika berhasil akan bernilai 1

        $_SESSION['ID'] = $result[0]['ID'];
        $_SESSION['nama'] = $result[0]['nama'];
        $_SESSION['level'] = $result[0]['level'];
        
        if ($result[0]['level']=='Admin'){
            header("location:admin/dashboard.php");
        } else if ($result[0]['level']=='User'){
            header("location:dashboard.php");
        }
    } 
    else {
        echo '<script> alert("Username atau Password salah");'
        . 'window.location = "index.php";</script>';
    }
} else if ($op == "out") {
    unset($_SESSION['ID']);
    unset($_SESSION['nama']);
    unset($_SESSION['level']);
    header("location:index.php");
}
?>