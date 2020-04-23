<?php
require_once("database.php");
$db_handle = new Koneksi();
if(!empty($_GET["id"])) {
    $query = "DELETE FROM tbl_rm WHERE no_rm='" . $_GET["id"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
        echo"";
	} else {
		header("Location:daftar_pendaftaran.php");
	}
}
?>