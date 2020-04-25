<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
    $id_paket = $_POST['id_paket'];
    $jumlah_dipilih = count($id_paket);
    for ($x = 0; $x < $jumlah_dipilih; $x++) {
        $query = "INSERT INTO tbl_pendaftaran(id_pendaftaran, no_rm, id_penyakit, id_paket, tgl_daftar, permintaan, status) 
        VALUES('" . $_POST["id_pendaftaran"] . "','" . $_POST["no_rm"] . "','" . $_POST["id_penyakit"] . "','$id_paket[$x]',
        '" . $_POST["tgl_daftar"] . "','" . $_POST["permintaan"] . "','0');";
        $result3 = $db_handle->executeQuery($query);
    }
    if (!$result3) {
        $message = "Problem in Adding to database. Please Retry.";
        echo $message;
    } else {
        header("Location:daftar_pendaftaran.php");
    }
}
require('header.php');
$uniqueID = uniqid();
$result = $db_handle->runQuery("SELECT * FROM tbl_rm WHERE no_rm='" . $_GET["id"] . "'");
$result2 = $db_handle->runQuery("SELECT * FROM tbl_penyakit;");
$result3 = $db_handle->runQuery("SELECT * FROM tbl_paket_param GROUP BY id_paket;");
$result6 = $db_handle->runQuery("SELECT * FROM tbl_permintaan;");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pendaftaran Pasien</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Input Pendaftaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form autocomplete="off" role="form" method="post">
                <div class="card-body">
                    <table>
                        <tr>
                            <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $uniqueID; ?>">
                            <input type="hidden" class="form-control" name="no_rm" value="<?php echo $result[0]["no_rm"]; ?>">
                            <td><label>Nama</label></td>
                            <td><label> : </label></td>
                            <td><label><?php echo $result[0]["nama"]; ?></label></td>
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
                            <td><input type="text" id="datepicker" name="tgl_daftar" class="" value=""></td>
                        </tr>
                        <tr>
                            <td><label>Diagnosa</label></td>
                            <td><label> : </label></td>
                            <td>
                                <select class="select2bs4" name="id_penyakit">
                                    <?php
                                    if (!empty($result2)) {
                                        foreach ($result2 as $a => $v) {
                                            if (is_numeric($a)) {
                                    ?>
                                                <option value="<?php echo $result2[$a]["id_penyakit"] ?>"><?php echo $result2[$a]["nama_penyakit"]; ?></option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Atas Permintaan</label></td>
                            <td><label> : </label></td>
                            <td>
                                <select class="select2bs4" name="permintaan">
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Pilih Paket</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Pilih</th>
                                                    <th>Nama Paket</th>
                                                    <th>Harga</th>
                                                    <th>Lab Terkait</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($result3)) {
                                                    foreach ($result3 as $k => $v2) {
                                                        if (is_numeric($k)) {
                                                ?>
                                                            <tr>
                                                                <td><input type="checkbox" name="id_paket[]" value="<?php echo $result3[$k]["id_paket"]; ?>"></td>
                                                                <td><?php echo $result3[$k]["nama_paket"]; ?></td>
                                                                <td><?php echo $result3[$k]["harga"]; ?></td>
                                                                <td><?php echo $result3[$k]["lab_terkait"]; ?></td>
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