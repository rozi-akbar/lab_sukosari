<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_desa SET nama_desa='" . $_POST["nama_desa"] . "' WHERE id_desa='" . $_POST["id_desa"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
    echo'error';
  } else {
    header("Location:daftar_desa.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_desa WHERE id_desa='" . $_GET["id_desa"] . "'");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Desa</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Desa</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form autocomplete="off" role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Nama Desa</label>
            <input type="hidden" class="form-control" name="id_desa" value="<?php echo $result[0]["id_desa"]; ?>">
            <input type="text" class="form-control" name="nama_desa" value="<?php echo $result[0]["nama_desa"]; ?>">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          <a class="btn btn-warning" href="daftar_desa.php">Cancel</a>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>