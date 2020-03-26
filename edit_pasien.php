<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_rm SET no_ktp='" . $_POST["no_ktp"] . "', nama='" . $_POST["nama"] . "', tgl_lahir='" . $_POST["tgl_lahir"] . "', alamat='" . $_POST["alamat"] . "' WHERE no_rm='" . $_POST["no_rm"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
    echo'error';
  } else {
    header("Location:daftar_pasien.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_rm WHERE no_rm='" . $_GET["id"] . "'");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data User</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>ID</label>
            <input type="text" class="form-control" name="no_rm" value="<?php echo $result[0]["no_rm"]; ?>">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="no_ktp" value="<?php echo $result[0]["no_ktp"]; ?>">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $result[0]["nama"]; ?>">
          </div>
          <div class="form-group">
            <label>Tgl Lahir</label>
            <input type="date" class="form-control col-sm-2" name="tgl_lahir" value="<?php echo $result[0]["tgl_lahir"]; ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $result[0]["alamat"]; ?>">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          <a class="btn btn-warning" href="daftar_pasien.php">Cancel</a>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>