<?php
require_once("database.php");
$db_handle = new Koneksi();
$query = "SELECT p.id_pendaftaran, p.id_penyakit
FROM tbl_pendaftaran as p 
JOIN tbl_rm as rm ON p.no_rm = rm.no_rm 
GROUP BY p.id_pendaftaran 
ORDER BY p.id_pendaftaran desc";

$result = $db_handle->runQuery($query); 
if (!empty($result)) {
    foreach ($result as $k => $v) {
        if (is_numeric($k)) {

            $no++;
            $id_pendaftaran = $result[$k]["id_pendaftaran"];
            $id_penyakit = $result[$k]["id_penyakit"];

            $qedit = "UPDATE tbl_hasil set id_penyakit='$id_penyakit' where id_pendaftaran='$id_pendaftaran'";
            $eresult2 = $db_handle->runQuery($qedit);
        }
    }
}
?>