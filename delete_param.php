<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
if(!empty($_GET["ID"])) {
    $query = "DELETE FROM tbl_param WHERE id_param='" . $_GET["ID"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
	} else {
		header("Location:daftar_param.php");
	}
}
?>