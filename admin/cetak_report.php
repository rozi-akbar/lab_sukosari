<?php
$tipe_laporan   =   $_POST['tipe_laporan'];
$dari           =   $_POST['dari'];
$sampai         =   $_POST['sampai'];

require_once("../database.php");

if ($tipe_laporan == "register") {
    session_start();
    $db_handle = new Koneksi();
    $id_pendaftaran = $_GET["id"];
    $result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
    $result2 = $db_handle->runQuery("SELECT
                                    tbl1.id_pendaftaran as 'id_pendaftaran',
                                    tbl1.waktu_input as 'waktu_input',
                                    tbl2.no_rm as 'no_rm',
                                    tbl3.nama as 'nama',
                                    tbl3.jenis_kelamin as 'jenis_kelamin',
                                    tbl3.alamat as 'alamat',
                                    tbl2.tipebayar as 'tipebayar'
                                    FROM tbl_hasil tbl1
                                    JOIN tbl_pendaftaran tbl2 ON tbl2.id_pendaftaran=tbl1.id_pendaftaran
                                    JOIN tbl_rm tbl3 ON tbl3.no_rm=tbl2.no_rm
                                    WHERE tbl1.waktu_input >= '" . date('Y-m-d', strtotime($dari)) . "' AND tbl1.waktu_input <= '" . date('Y-m-d', strtotime($sampai)) . "'
                                    GROUP BY tbl1.id_pendaftaran
                                    ORDER BY tbl1.id_pendaftaran ASC");
    date_default_timezone_set('Asia/Jakarta');
    $birthDt =  $result3[0]["tgl_lahir"];
    $interval = date_diff(date_create(), date_create($birthDt));
    $umur = $interval->format("%YThn %MBln %dHr");
    ob_start();
?>
    <html>

    <head>
    </head>

    <body>
        <table width="100%" border="0" class="tablenoborder">
            <tr>
                <th>
                    <h4>LAPORAN PEMERIKSAAN LABORATORIUM</h4>
                </th>
            </tr>
            <tr>
                <th>
                    <h4>PUSKESMAS SUKOSARI</h4>
                </th>
            </tr>
        </table>
        <br />
        <table width="100%" style="font-size: 12px;" border="0" class="tablenoborder">
            <tr>
                <td>
                    Laporan Register Laboratorium bulan <?= date('F', strtotime($dari)); ?> - <?= date('F', strtotime($sampai)); ?>
                </td>
            </tr>
        </table>
        <table width="100%" border="1" class="tablewithborder">
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NAMA PASIEN</th>
                <th>JK</th>
                <th>ALAMAT</th>
                <th>PARAMETER PEMERIKSAAN</th>
                <th>PENJAMIN</th>
            </tr>
            <?php
            $no = 1;
            for ($i = 0; $i < count($result2); $i++) {
                $list_pemeriksaan = $db_handle->runQuery("
                            SELECT t1.id_pendaftaran, 
                            t1.id_paket, 
                            t2.nama_paket
                            FROM tbl_hasil t1 
                            JOIN tbl_paket_param t2 
                            ON t1.id_paket = t2.id_paket 
                            WHERE t1.id_pendaftaran = '" . $result2[$i]['id_pendaftaran'] . "'
                            GROUP BY t1.id_paket;");
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-F-Y', strtotime($result2[$i]["waktu_input"])); ?></td>
                    <td><?= $result2[$i]["nama"]; ?></td>
                    <td><?= $result2[$i]["jenis_kelamin"]; ?></td>
                    <td><?= $result2[$i]["alamat"]; ?></td>
                    <td>
                        <?php
                        for ($x = 0; $x < count($list_pemeriksaan); $x++) {
                            echo $list_pemeriksaan[$x]['nama_paket'] . ',';
                        }
                        ?>
                    </td>
                    <td><?= $result2[$i]["tipebayar"]; ?></td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <table width="100%" class="tablenoborder">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                    Pemeriksa Hasil
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <u><?= $_SESSION['nama']; ?></u>
                    <br />
                    <?= $_SESSION['NIP']; ?>
                    <br />
                </td>
            </tr>
        </table>
    </body>

    </html>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    require_once "../mpdf/vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
    // $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
    $stylesheet = file_get_contents('cetak_hasil_lab.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($content);
    $mpdf->Output();
} elseif ($tipe_laporan == "spesimen") {
    session_start();
    $db_handle = new Koneksi();
    $id_pendaftaran = $_GET["id"];
    $result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
    $result2 = $db_handle->runQuery("SELECT
                                    tbl1.id_pendaftaran as 'id_pendaftaran',
                                    tbl1.waktu_input as 'waktu_input',
                                    tbl2.no_rm as 'no_rm',
                                    tbl3.nama as 'nama',
                                    tbl3.jenis_kelamin as 'jenis_kelamin',
                                    tbl3.alamat as 'alamat',
                                    tbl2.tipebayar as 'tipebayar'
                                    FROM tbl_hasil tbl1
                                    JOIN tbl_pendaftaran tbl2 ON tbl2.id_pendaftaran=tbl1.id_pendaftaran
                                    JOIN tbl_rm tbl3 ON tbl3.no_rm=tbl2.no_rm
                                    WHERE tbl1.waktu_input >= '" . date('Y-m-d', strtotime($dari)) . "' AND tbl1.waktu_input <= '" . date('Y-m-d', strtotime($sampai)) . "'
                                    GROUP BY tbl1.id_pendaftaran
                                    ORDER BY tbl1.id_pendaftaran ASC");
    date_default_timezone_set('Asia/Jakarta');
    $birthDt =  $result3[0]["tgl_lahir"];
    $interval = date_diff(date_create(), date_create($birthDt));
    $umur = $interval->format("%YThn %MBln %dHr");
    ob_start();
?>
    <html>

    <head>
    </head>

    <body>
        <table width="100%" border="0" class="tablenoborder">
            <tr>
                <th>
                    <h4>LAPORAN PEMERIKSAAN LABORATORIUM</h4>
                </th>
            </tr>
            <tr>
                <th>
                    <h4>PUSKESMAS SUKOSARI</h4>
                </th>
            </tr>
        </table>
        <br />
        <table width="100%" style="font-size: 12px;" border="0" class="tablenoborder">
            <tr>
                <td>
                    Laporan Register Laboratorium bulan <?= date('F', strtotime($dari)); ?> - <?= date('F', strtotime($sampai)); ?>
                </td>
            </tr>
        </table>
        <table width="100%" border="1" class="tablewithborder">
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NAMA PASIEN</th>
                <th>JK</th>
                <th>ALAMAT</th>
                <th>PARAMETER PEMERIKSAAN</th>
                <th>PENJAMIN</th>
            </tr>
            <?php
            $no = 1;
            for ($i = 0; $i < count($result2); $i++) {
                $list_pemeriksaan = $db_handle->runQuery("
                            SELECT t1.id_pendaftaran, 
                            t1.id_paket, 
                            t2.nama_paket
                            FROM tbl_hasil t1 
                            JOIN tbl_paket_param t2 
                            ON t1.id_paket = t2.id_paket 
                            WHERE t1.id_pendaftaran = '" . $result2[$i]['id_pendaftaran'] . "'
                            GROUP BY t1.id_paket;");
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-F-Y', strtotime($result2[$i]["waktu_input"])); ?></td>
                    <td><?= $result2[$i]["nama"]; ?></td>
                    <td><?= $result2[$i]["jenis_kelamin"]; ?></td>
                    <td><?= $result2[$i]["alamat"]; ?></td>
                    <td>
                        <?php
                        for ($x = 0; $x < count($list_pemeriksaan); $x++) {
                            echo $list_pemeriksaan[$x]['nama_paket'] . ',';
                        }
                        ?>
                    </td>
                    <td><?= $result2[$i]["tipebayar"]; ?></td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <table width="100%" class="tablenoborder">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                    Pemeriksa Hasil
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <u><?= $_SESSION['nama']; ?></u>
                    <br />
                    <?= $_SESSION['NIP']; ?>
                    <br />
                </td>
            </tr>
        </table>
    </body>

    </html>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    require_once "../mpdf/vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
    // $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
    $stylesheet = file_get_contents('cetak_hasil_lab.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($content);
    $mpdf->Output();
} elseif ($tipe_laporan == "rekapan_diagnosa") {
    session_start();
    $db_handle = new Koneksi();
    $id_pendaftaran = $_GET["id"];
    $result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
    $result2 = $db_handle->runQuery("SELECT
                                    tbl1.id_pendaftaran as 'id_pendaftaran',
                                    tbl1.waktu_input as 'waktu_input',
                                    tbl2.no_rm as 'no_rm',
                                    tbl3.nama as 'nama',
                                    tbl3.jenis_kelamin as 'jenis_kelamin',
                                    tbl3.alamat as 'alamat',
                                    tbl2.tipebayar as 'tipebayar'
                                    FROM tbl_hasil tbl1
                                    JOIN tbl_pendaftaran tbl2 ON tbl2.id_pendaftaran=tbl1.id_pendaftaran
                                    JOIN tbl_rm tbl3 ON tbl3.no_rm=tbl2.no_rm
                                    WHERE tbl1.waktu_input >= '" . date('Y-m-d', strtotime($dari)) . "' AND tbl1.waktu_input <= '" . date('Y-m-d', strtotime($sampai)) . "'
                                    GROUP BY tbl1.id_pendaftaran
                                    ORDER BY tbl1.id_pendaftaran ASC");
    date_default_timezone_set('Asia/Jakarta');
    $birthDt =  $result3[0]["tgl_lahir"];
    $interval = date_diff(date_create(), date_create($birthDt));
    $umur = $interval->format("%YThn %MBln %dHr");
    ob_start();
?>
    <html>

    <head>
    </head>

    <body>
        <table width="100%" border="0" class="tablenoborder">
            <tr>
                <th>
                    <h4>LAPORAN PEMERIKSAAN LABORATORIUM</h4>
                </th>
            </tr>
            <tr>
                <th>
                    <h4>PUSKESMAS SUKOSARI</h4>
                </th>
            </tr>
        </table>
        <br />
        <table width="100%" style="font-size: 12px;" border="0" class="tablenoborder">
            <tr>
                <td>
                    Laporan Register Laboratorium bulan <?= date('F', strtotime($dari)); ?> - <?= date('F', strtotime($sampai)); ?>
                </td>
            </tr>
        </table>
        <table width="100%" border="1" class="tablewithborder">
            <tr>
                <th>NO</th>
                <th>DIAGNOSA</th>
                <th>TOTAL</th>
            </tr>
            <?php
            $no = 1;
            for ($i = 0; $i < count($result2); $i++) {
                $list_pemeriksaan = $db_handle->runQuery("
                            SELECT t1.id_pendaftaran, 
                            t1.id_paket, 
                            t2.nama_paket
                            FROM tbl_hasil t1 
                            JOIN tbl_paket_param t2 
                            ON t1.id_paket = t2.id_paket 
                            WHERE t1.id_pendaftaran = '" . $result2[$i]['id_pendaftaran'] . "'
                            GROUP BY t1.id_paket;");    
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-F-Y', strtotime($result2[$i]["waktu_input"])); ?></td>
                    <td><?= $result2[$i]["nama"]; ?></td>
                    <td><?= $result2[$i]["jenis_kelamin"]; ?></td>
                    <td><?= $result2[$i]["alamat"]; ?></td>
                    <td>
                        <?php
                        for ($x = 0; $x < count($list_pemeriksaan); $x++) {
                            echo $list_pemeriksaan[$x]['nama_paket'] . ',';
                        }
                        ?>
                    </td>
                    <td><?= $result2[$i]["tipebayar"]; ?></td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <table width="100%" class="tablenoborder">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                    Pemeriksa Hasil
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <u><?= $_SESSION['nama']; ?></u>
                    <br />
                    <?= $_SESSION['NIP']; ?>
                    <br />
                </td>
            </tr>
        </table>
    </body>

    </html>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    require_once "../mpdf/vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
    // $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
    $stylesheet = file_get_contents('cetak_hasil_lab.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($content);
    $mpdf->Output();
}
?>