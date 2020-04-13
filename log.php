<?php

session_start();
include './dblog.php';

$userid = $_POST['username'];
$psw = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    $result = $mysqli->query("SELECT ID, nama FROM tbl_user WHERE username = '$userid' AND password = '$psw'");
    
    if ($result->num_rows == 1) {//jika berhasil akan bernilai 1
        $c = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['ID'] = $c['ID'];
        $_SESSION['nama'] = $c['nama'];
        header("location:dashboard.php");
    } else {
        echo '<script> alert("Username atau Password salah");'
        . 'window.location = "index.php";</script>';
    }
} else if ($op == "out") {
    unset($_SESSION['ID']);
    unset($_SESSION['nama']);
    header("location:index.php");
}
?>