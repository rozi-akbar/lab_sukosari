<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
if(!empty($_GET["ID"])) {
    $query = "DELETE FROM tbl_user WHERE ID='" . $_GET["ID"] . "' ";
    $result = $db_handle->executeQuery($query);
	if(!$result){
        $message = "Problem in Delete! Please Retry!";
        echo"";
	} else {
		header("Location:daftar_user.php");
	}
}
?>