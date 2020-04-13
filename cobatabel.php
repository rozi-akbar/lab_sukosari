<?php
require('header.php');
require_once("koneksi.php");
$db_handle = new Koneksi();
$data = $db_handle->runQuery("SELECT * FROM coba");
?>

<!-- Here's your rendering section -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php print_r($rawData); ?>
                    <h1>Data Hasil Lab</h1>
                    <?php print_r($out); ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h5>Hasil Lab</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h1>Cek</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No REG</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Input Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Test1</td>
                            <td>Test2</td>
                            <td>Test3</td>
                            <td>Test4</td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table table-bordered">
                    <tr>
                        <th>Hour</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $name_holder = null;
                    for ($i = 0; $i < count($data); $i++) {
                        if ($name_holder != $data[$i]["name"]) {
                            $name_holder = $data[$i]["name"]; ?>
                            <tr>
                                <td colspan="3"><b>Nama :<?php echo $name_holder; ?></b></td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td><?php echo $data[$i]["hour"]; ?></td>
                            <td><?php echo $data[$i]["city"]; ?></td>
                            <td>Edit</td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- End Right col -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>