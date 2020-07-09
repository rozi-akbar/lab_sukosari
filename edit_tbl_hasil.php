<?php
require_once("database.php");
$db_handle = new Koneksi();
$query = "SELECT p.id_pendaftaran, rm.no_rm, rm.nama, p.tgl_daftar 
FROM tbl_pendaftaran as p 
JOIN tbl_rm as rm ON p.no_rm = rm.no_rm
WHERE p.id_pendaftaran LIKE '5%'
GROUP BY p.id_pendaftaran";

$result = $db_handle->runQuery($query); ?>
<table border="1">
    <?php
    $no = 0;
    $no_urut = "000";
    if (!empty($result)) {
        foreach ($result as $k => $v) {
            if (is_numeric($k)) {

                $no++;
                $id_pendaftaran = $result[$k]["id_pendaftaran"];
                $tgl = $result[$k]["tgl_daftar"];
                $day = date("d", strtotime($tgl));
                $month = date("m", strtotime($tgl));
                $year = date("Y", strtotime($tgl));
                $tgllengkap = $year . $month . $day;
                $no_urut = (int) substr($no_urut, 0, 3);
                $no_urut++;
                $uniqueID = $tgllengkap . sprintf("%03s", $no_urut);

                // $qedit = "UPDATE tbl_pendaftaran set id_pendaftaran='$uniqueID' where id_pendaftaran='$id_pendaftaran'";
                // $qedit2 = "UPDATE tbl_hasil set id_pendaftaran='$uniqueID' where id_pendaftaran='$id_pendaftaran'";
                // $eresult = $db_handle->runQuery($qedit);
                // $eresult2 = $db_handle->runQuery($qedit2);
    ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $result[$k]["id_pendaftaran"]; ?></td>
                    <td><?php echo $result[$k]["no_rm"]; ?></td>
                    <td><?php echo $result[$k]["tgl_daftar"]; ?></td>
                    <td><?php echo $uniqueID; ?></td>
                </tr>

    <?php      }
        }
    }
    ?>
</table>