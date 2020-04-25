<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "INSERT INTO tbl_penyakit(id_penyakit, nama_penyakit) VALUES('" . $_POST["id_penyakit"] . "','" . $_POST["nama_penyakit"] . "')";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Adding to database. Please Retry.";
  } else {
    header("Location:daftar_penyakit.php");
  }
}
require('header.php');
$uniqueID=uniqid();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Penyakit</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Penyakit</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Nama Penyakit</label>
            <input type="hidden" class="form-control" name="id_penyakit" value="<?php echo $uniqueID;?>">
            <input type="text" class="form-control" name="nama_penyakit">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          <a class="btn btn-warning" href="daftar_penyakit.php">Cancel</a>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>