<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
    $id_paket = $_POST['id_paket'];
    $id_param = $_POST['id_param'];
    $hasil = $_POST['hasil'];
    $jumlah_data = count($id_paket);
    for ($x = 0; $x < $jumlah_data; $x++) {
        $query = "INSERT INTO tbl_hasil(id_pendaftaran, waktu_input, id_paket, id_param, hasil) 
        VALUES('" . $_POST["id_pendaftaran"] . "','" . $_POST["tgl_hasil"] . "','$id_paket[$x]','$id_param[$x]','$hasil[$x]');";
        $result3 = $db_handle->executeQuery($query);
    }
    $query2 = "UPDATE tbl_pendaftaran SET status=1 WHERE id_pendaftaran='" . $_POST["id_pendaftaran"] . "'";
    $result2 = $db_handle->executeQuery($query2);
    if (!$result3) {
        $message = "Problem in Adding to database. Please Retry.";
        echo $message;
    } else {
        header("Location:history_pendaftaran.php");
    }
}
require('header.php');
$uniqueID = uniqid();
$query = "SELECT * FROM tbl_pendaftaran t1 
JOIN tbl_rm t2 ON t2.no_rm=t1.no_rm 
JOIN tbl_paket_param t3 ON t3.id_paket=t1.id_paket 
JOIN tbl_param t4 ON t4.id_param=t3.id_param 
WHERE t1.id_pendaftaran='" . $_GET["id"] . "'
ORDER BY t1.id_paket, t4.id_param";
$result = $db_handle->runQuery($query);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Input Hasil Lab</h1>
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
            <form autocomplete="off" role="form" method="post" autocomplete="off">
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
                            <td><input type="text" id="datepicker" name="tgl_hasil" value=""></td>
                        </tr>
                    </table>
                    <br />
                    <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $result[0]["id_pendaftaran"]; ?>">
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
                                for ($i = 0; $i < count($result); $i++) {
                                    if ($id_paket != $result[$i]["nama_paket"]) {
                                        $id_paket = $result[$i]["nama_paket"]; ?>
                                        <tr>
                                            <td colspan="4"><b><?php echo $id_paket; ?></b></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tr>
                                        <input type="checkbox" name="id_param[]" value="<?php echo $result[$i]["id_param"]; ?>" checked hidden>
                                        <input type="checkbox" name="id_paket[]" value="<?php echo $result[$i]["id_paket"]; ?>" checked hidden>
                                        <td><?php echo $result[$i]["nama_param"]; ?></td>
                                        <td align="center"><input type="text" name="hasil[]"></td>
                                        <td align="center"><?php echo $result[$i]["nilai_rujukan"]; ?></td>
                                        <td align="center"><?php echo $result[$i]["satuan"]; ?></td>
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