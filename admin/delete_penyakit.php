<?php
require_once("../database.php");
$db_handle = new Koneksi();
if(!empty($_GET["id_penyakit"])) {
    $query = "DELETE FROM tbl_penyakit WHERE id_penyakit='" . $_GET["id_penyakit"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
	} else {
		header("Location:daftar_penyakit.php");
	}
}
?>