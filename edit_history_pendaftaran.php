<?php
require_once("./database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
    $query = "UPDATE tbl_pendaftaran SET tipebayar='" . $_POST["tipebayar"] . "', 
    tgl_daftar='" . $_POST["tgl_daftar"] . "', permintaan='" . $_POST["permintaan"] . "' 
    WHERE id_pendaftaran='" . $_POST["id_pendaftaran"] . "' ";
    $result = $db_handle->executeQuery($query);
    if (!$result) {
        $message = "Problem in Update to database. Please Retry.";
    } else {
        header("Location:history_pendaftaran.php");
    }
}
$ID = $_GET["id"];
$result = $db_handle->runQuery("SELECT t1.id_pendaftaran ,t1.no_rm, t1.tgl_daftar, t1.permintaan, t1.tipebayar, t2.nama, t2.no_ktp, t2.alamat, t3.nama_paket
FROM tbl_pendaftaran t1
JOIN tbl_rm t2 ON t1.no_rm = t2.no_rm
JOIN tbl_paket_param t3 ON t1.id_paket=t3.id_paket
WHERE t1.id_pendaftaran='" . $ID . "'
GROUP BY t3.id_paket;");
$result3 = $db_handle->runQuery("SELECT * FROM tbl_paket_param GROUP BY id_paket;");
$result6 = $db_handle->runQuery("SELECT * FROM tbl_permintaan;");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pendaftaran Pasien</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Pendaftaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form autocomplete="off" role="form" method="post">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><label>ID Pendaftaran</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $ID; ?></label></td>
                        </tr>
                        <tr>
                            <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $ID; ?>">
                            <td><label>Nama</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["nama"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>No RM</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["no_rm"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>No.KTP</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["no_ktp"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>Alamat</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["alamat"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>Tanggal</label></td>
                            <td><label> : </label></td>
                            <td><input type="text" id="datepicker" name="tgl_daftar" class="" value="<?php echo $result[0]["tgl_daftar"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label>Tipe Penjamin</label></td>
                            <td><label> : </label></td>
                            <td>
                                <select class="select2bs4" name="tipebayar">
                                    <?php
                                    if ($result[0]["tipebayar"]==null){
                                        ?><option value="">==PILIH==</option><?php
                                    } else{
                                        ?><option value="<?php echo $result[0]["tipebayar"] ?>"><?php echo $result[0]["tipebayar"] ?></option><?php
                                    }
                                    ?>
                                    <option value="Umum">Umum</option>
                                    <option value="BPJS">BPJS</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Atas Permintaan</label></td>
                            <td><label> : </label></td>
                            <td>
                                <select class="select2bs4" name="permintaan">
                                    <option value="<?php echo $result[0]["permintaan"] ?>"><?php echo $result[0]["permintaan"]; ?></option>
                                    <?php
                                    if (!empty($result6)) {
                                        foreach ($result6 as $a => $v) {
                                            if (is_numeric($a)) {
                                    ?>
                                                <option value="<?php echo $result6[$a]["nama_peminta"] ?>"><?php echo $result6[$a]["nama_peminta"]; ?></option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" onclick="return confirm('Apakah anda yakin data yang anda masukkan sudah benar?')" class="btn btn-primary" value="Add" name="submit">Submit</button>
                    <a class="btn btn-warning" href="history_pendaftaran.php">Cancel</a>
                </div>
            </form>
        </div>
        <!-- End Right col -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>