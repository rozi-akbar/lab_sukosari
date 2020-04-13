<?php
require_once("koneksi.php");
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
    $query2="UPDATE tbl_pendaftaran SET status=1 WHERE id_pendaftaran='".$_POST["id_pendaftaran"]."'";
    $result2= $db_handle->executeQuery($query2);
    if (!$result3) {
        $message = "Problem in Adding to database. Please Retry.";
        echo $message;
    } else {
        header("Location:history_pendaftaran.php");
    }
}
require('header.php');
$uniqueID = uniqid();
$query = "SELECT * 
FROM tbl_pendaftaran t1 
JOIN tbl_rm t2 ON t2.no_rm=t1.no_rm 
JOIN tbl_paket_param t3 ON t3.id_paket=t1.id_paket 
JOIN tbl_param t4 ON t4.id_param=t3.id_param 
WHERE t1.id_pendaftaran='" . $_GET["id"] . "'";
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
            <form role="form" method="post">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><label>No REG</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["id_pendaftaran"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>No RM</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["no_rm"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>No RM</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["nama"]; ?></label></td>
                        </tr>
                        <tr>
                            <td><label>Tanggal</label></td>
                            <td><label> : </label></td>
                            <td><input type="datetime-local" class="form-control" name="tgl_hasil"></td>
                        </tr>
                    </table>
                    <br/>
                    <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $result[0]["id_pendaftaran"]; ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Isi Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed">
                                            <thead>
                                                <tr>
                                                    <th>Pemeriksaan</th>
                                                    <th>Hasil</th>
                                                    <th>Satuan</th>
                                                    <th>Normal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($result)) {
                                                    foreach ($result as $k => $v2) {
                                                        if (is_numeric($k)) {
                                                ?>
                                                            <tr>
                                                                <input type="checkbox" name="id_param[]" value="<?php echo $result[$k]["id_param"]; ?>" checked hidden>
                                                                <input type="checkbox" name="id_paket[]" value="<?php echo $result[$k]["id_paket"]; ?>" checked hidden>
                                                                <td><?php echo $result[$k]["nama_param"]; ?></td>
                                                                <td><input type="text" name="hasil[]"></td>
                                                                <td><?php echo $result[$k]["satuan"]; ?></td>
                                                                <td><?php echo $result[$k]["nilai_rujukan"]; ?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
                    <a class="btn btn-warning" href="daftar_pendaftaran.php">Cancel</a>
                </div>
            </form>
        </div>
        <!-- End Right col -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>