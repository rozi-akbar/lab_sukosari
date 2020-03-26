<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
    $id_param = $_POST['id_param'];
    $jumlah_dipilih = count($id_param);
    for ($x = 0; $x < $jumlah_dipilih; $x++) {
        $query = "INSERT INTO tbl_paket_param(id_paket, nama_paket, harga, lab_terkait, id_param) VALUES('" . $_POST["id_paket"] . "',
  '" . $_POST["nama_paket"] . "','" . $_POST["harga"] . "','" . $_POST["lab_terkait"] . "',' $id_param[$x] ')";
        $result = $db_handle->executeQuery($query);
    }
    if (!$result) {
        $message = "Problem in Adding to database. Please Retry.";
    } else {
        header("Location:daftar_paket_param.php");
    }
}
require('header.php');
$uniqueID = uniqid();
$query = "SELECT * FROM tbl_param;";
$result = $db_handle->runQuery($query);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Paket</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Input Paket</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="hidden" class="form-control" name="id_paket" value="<?php echo $uniqueID; ?>">
                        <input type="text" class="form-control" name="nama_paket">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="harga">
                    </div>
                    <div class="form-group">
                        <label>Lab Terkait</label>
                        <input type="text" class="form-control" name="lab_terkait">
                    </div>
                    <div class="form-group">
                        <label>Pilih Parameter</label>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Parameter</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed">
                                            <thead>
                                                <tr>
                                                    <th>Pilih</th>
                                                    <th>Nama Parameter</th>
                                                    <th>Satuan</th>
                                                    <th>Nilai Rujukan</th>
                                                    <th>Metoda</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($result)) {
                                                    foreach ($result as $k => $v) {
                                                        if (is_numeric($k)) {
                                                ?>
                                                            <tr>
                                                                <td><input type="checkbox" name="id_param[]" value="<?php echo $result[$k]["id_param"]; ?>"></td>
                                                                <td><?php echo $result[$k]["nama_param"]; ?></td>
                                                                <td><?php echo $result[$k]["satuan"]; ?></td>
                                                                <td><?php echo $result[$k]["nilai_rujukan"]; ?></td>
                                                                <td><?php echo $result[$k]["metoda"]; ?></td>
                                                                <td><?php echo $result[$k]["harga"]; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                }
                                                if (isset($result["perpage"])) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
                                                    </tr>
                                                <?php } ?>
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
                    <a class="btn btn-warning" href="daftar_paket_param.php">Cancel</a>
                </div>
            </form>
        </div>
        <!-- End Right col -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>