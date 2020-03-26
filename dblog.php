<?php
//variabel koneksi mysql server
$hostname = "localhost";//sesuaikan dengan host anda
$username = "root";	//sesuaikan dengan username database anda
$password = "";		//sesuaikan dengan password database anda
$database = "hasil_lab"; 	//sesuaikan dengan nama database anda

$mysqli = new mysqli($hostname, $username, $password, $database);

//mengecek jika terjadi gagal koneksi
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database. ";
    exit;
}
?>