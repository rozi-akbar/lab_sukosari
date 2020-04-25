<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "INSERT INTO tbl_param(nama_param, satuan, nilai_rujukan, metoda, harga) VALUES('" . $_POST["nama_param"] . "',
  '" . $_POST["satuan"] . "','" . $_POST["nilai_rujukan"] . "','" . $_POST["metoda"] . "','" . $_POST["harga"] . "')";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Adding to database. Please Retry.";
  } else {
    header("Location:daftar_param.php");
  }
}
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
            <label>Nama Parameter</label>
            <input type="text" class="form-control" name="nama_param">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" class="form-control" name="satuan">
          </div>
          <div class="form-group">
            <label>Nilai Rujukan</label>
            <input type="text" class="form-control" name="nilai_rujukan">
          </div>
          <div class="form-group">
            <label>Metoda</label>
            <input type="text" class="form-control" name="metoda">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" name="harga">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          <a class="btn btn-warning" href="daftar_param.php">Cancel</a>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>