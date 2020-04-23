<?php
require_once("database.php");
$db_handle = new Koneksi();
if(!empty($_GET["id"])) {
    $query = "DELETE FROM tbl_pendaftaran WHERE id_pendaftaran ='" . $_GET["id"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
        echo $message;
	} else {
		header("Location:history_pendaftaran.php");
	}
}
?>