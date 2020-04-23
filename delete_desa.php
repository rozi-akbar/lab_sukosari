<?php
require_once("database.php");
$db_handle = new Koneksi();
if(!empty($_GET["id_desa"])) {
    $query = "DELETE FROM tbl_desa WHERE id_desa='" . $_GET["id_desa"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
	} else {
		header("Location:daftar_desa.php");
	}
}
?>