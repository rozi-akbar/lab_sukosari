<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
$id_pendaftaran = $_GET["id"];
$result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
$result2 = $db_handle->runQuery("SELECT * FROM tbl_petugas");
$result3 = $db_handle->runQuery("SELECT * FROM tbl_pendaftaran tbl1
JOIN tbl_rm tbl2 ON tbl2.no_rm = tbl1.no_rm
WHERE tbl1.id_pendaftaran = '" . $id_pendaftaran . "';");
$result4 = $db_handle->runQuery("SELECT * FROM tbl_hasil tbl1
JOIN tbl_param tbl2 ON tbl2.id_param = tbl1.id_param
WHERE tbl1.id_pendaftaran = '" . $id_pendaftaran . "'
ORDER BY tbl1.id_paket;");
ob_start();
?>
<html>

<head>
</head>

<body>
    <table width="100%" border="0">
        <tr>
            <th>
                <h4>Pemerintah Kabupaten Bondowoso</h4>
            </th>
        </tr>
        <tr>
            <th>
                <h4>DINAS KESEHATAN</h4>
            </th>
        </tr>
        <tr>
            <th>
                <h2>PUSKESMAS SUKOSARI</h2>
            </th>
        </tr>
        <tr>
            <th>
                <h4>Jl. Raya Kawah Ijen No. 53 Sukosari - Bondowoso</h4>
            </th>
        </tr>
    </table>
    <hr />
    <br />
    <table width="100%" style="margin-top:-12; text-align:left" border="0">
        <tr>
            <td colspan="6" align="center">HASIL PEMERIKSAAN LABORATORIUM</td>
        </tr>
        <tr>
            <td>No.RM</td>
            <td>:</td>
            <td><?php echo $result3[0]["no_rm"]; ?></td>
            <td>No.REG</td>
            <td>:</td>
            <td><?php echo $result3[0]["id_pendaftaran"]; ?></td>
        </tr>
        <tr>
            <td>Tgl Sampling</td>
            <td>:</td>
            <td><?php echo $result3[0]["tgl_daftar"]; ?></td>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $result3[0]["nama"]; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $result3[0]["alamat"]; ?></td>
            <td>Tgl Lahir/Umur</td>
            <td>:</td>
            <td><?php echo $result3[0]["tgl_lahir"]; ?>/</td>
        </tr>
        <tr>
            <td>Dokter Penanggungjawab</td>
            <td>:</td>
            <td><?php echo $result[0]["nama"]; ?></td>
            <td>Pengirim</td>
            <td>:</td>
            <td><?php echo $result3[0]["permintaan"]; ?></td>
        </tr>
    </table>
    <br />
    <table width="100%" border="1">
        <tr>
            <th>Pemeriksaan</th>
            <th>Hasil</th>
            <th>Nilai Rujukan</th>
            <th>Satuan</th>
        </tr>
        <?php
        $id_paket = null;
        for ($i = 0; $i < count($result4); $i++) {
            if ($id_paket != $result4[$i]["id_paket"]) {
                $id_paket = $result4[$i]["id_paket"]; ?>
                <tr>
                    <td colspan="4"><b><?php echo $id_paket; ?></b></td>
                </tr>
            <?php }
            ?>
            <tr>
                <td><?php echo $result4[$i]["nama_param"]; ?></td>
                <td align="center"><?php echo $result4[$i]["hasil"]; ?></td>
                <td align="center"><?php echo $result4[$i]["nilai_rujukan"]; ?></td>
                <td align="center"><?php echo $result4[$i]["satuan"]; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br />
    <table width="100%">
        <tr>
            <td>Waktu Pengambilan Spesimen : <?php echo $result3[0]["tgl_daftar"]; ?>
                <br />
                Waktu Selesai Hasil : <?php echo $result4[0]["waktu_input"]; ?>
                <br />
                <?php date_default_timezone_set('Asia/Bangkok') ?>
                Dokumen ini dicetak pada : <?php echo date("Y-m-d H:i:s"); ?>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center"><u><?php echo $result2[0]["nama"]; ?></u><br />
                Pemeriksa Hasil
            </td>
        </tr>
    </table>
</body>

</html>
<?php
$content = ob_get_contents();
ob_end_clean();
require_once "./mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
$mpdf->WriteHTML($content);
$mpdf->Output();
