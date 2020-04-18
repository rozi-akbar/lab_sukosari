<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
if(!empty($_GET["ID"])) {
    $query = "DELETE FROM tbl_paket_param WHERE id_paket =".$_GET["ID"].";";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
        echo $message;
	} else {
		header("Location:daftar_paket_param.php");
	}
}
?>