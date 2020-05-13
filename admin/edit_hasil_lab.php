<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
    $id_paket = $_POST['id_paket'];
    $id_param = $_POST['id_param'];
    $hasil = $_POST['hasil'];
    $jumlah_data = count($id_paket);
    for ($x = 0; $x < $jumlah_data; $x++) {
        $query = "UPDATE tbl_hasil SET waktu_input='" . $_POST["tgl_hasil"] . "', hasil='" . $hasil[$x] . "'
        WHERE id_pendaftaran = '" . $_POST["id_pendaftaran"] . "'
        AND id_paket='" . $id_paket[$x] . "'
        AND id_param='" . $id_param[$x] . "';";
        $result3 = $db_handle->executeQuery($query);
    }
    $query2 = "UPDATE tbl_pendaftaran SET status=1 WHERE id_pendaftaran='" . $_POST["id_pendaftaran"] . "'";
    $result2 = $db_handle->executeQuery($query2);
    if (!$result3) {
        $message = "Problem in Updating to database. Please Retry.";
        echo $message;
    } else {
        header("Location:daftar_periksa.php");
    }
}
require('header.php');
$result = $db_handle->runQuery("SELECT t1.id_pendaftaran, t1.no_rm, t2.nama 
FROM tbl_pendaftaran t1
JOIN tbl_rm t2 ON t2.no_rm=t1.no_rm
WHERE t1.id_pendaftaran='" . $_GET["id"] . "'");

$result2 = $db_handle->runQuery("SELECT * FROM tbl_hasil t1
JOIN tbl_param t2 ON t1.id_param = t2.id_param
JOIN tbl_paket_param t3 ON t2.id_param = t3.id_param AND t1.id_paket=t3.id_paket
WHERE t1.id_pendaftaran='" . $_GET["id"] . "'
ORDER BY t3.id_paket;");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Hasil Lab</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Input</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form autocomplete="off" role="form" method="post">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><label>No Registrasi</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["id_pendaftaran"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>No RM</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["no_rm"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>Nama</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["nama"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>Tanggal</label></td>
                            <td><label> : </label></td>
                            <td>
                                <input type="text" id="datepicker" name="tgl_hasil" value="<?php echo $result2[0]["waktu_input"]; ?>">
                            </td>
                        </tr>
                    </table>
                    <br />
                    <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $result2[0]["id_pendaftaran"]; ?>">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Isi Hasil</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr align="center">
                                    <th>Pemeriksaan</th>
                                    <th>Hasil</th>
                                    <th>Nilai Rujukan</th>
                                    <th>Satuan</th>
                                </tr>
                                <?php
                                $id_paket = null;
                                for ($i = 0; $i < count($result2); $i++) {
                                    if ($id_paket != $result2[$i]["nama_paket"]) {
                                        $id_paket = $result2[$i]["nama_paket"]; ?>
                                        <tr>
                                            <td colspan="4"><b><?php echo $id_paket; ?></b></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tr>
                                        <input type="checkbox" name="id_param[]" value="<?php echo $result2[$i]["id_param"]; ?>" checked hidden>
                                        <input type="checkbox" name="id_paket[]" value="<?php echo $result2[$i]["id_paket"]; ?>" checked hidden>
                                        <td><?php echo $result2[$i]["nama_param"]; ?></td>
                                        <td align="center"><input type="text" name="hasil[]" value="<?php echo $result2[$i]["hasil"]; ?>"></td>
                                        <td align="center"><?php echo $result2[$i]["nilai_rujukan"]; ?></td>
                                        <td align="center"><?php echo $result2[$i]["satuan"]; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" onclick="return confirm('Apakah anda yakin data yang anda masukkan sudah benar?')" class="btn btn-primary" value="Add" name="submit">Submit</button>
                    <a class="btn btn-warning" href="daftar_periksa.php">Cancel</a>
                </div>
            </form>
        </div>
        <!-- End Right col -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>