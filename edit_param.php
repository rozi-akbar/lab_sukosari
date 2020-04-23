<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_param SET nama_param='".$_POST["nama_param"]."',satuan='".$_POST["satuan"]."',
  nilai_rujukan='".$_POST["nilai_rujukan"]."',metoda='".$_POST["metoda"]."',harga='".$_POST["harga"]."' 
  WHERE id_param='" . $_POST["id_param"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
    echo'error';
  } else {
    header("Location:daftar_param.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_param WHERE id_param='" . $_GET["ID"] . "'");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Parameter</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Parameter</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Nama Parameter</label>
            <input type="hidden" class="form-control" name="id_param" value="<?php echo $result[0]["id_param"]; ?>">
            <input type="text" class="form-control" name="nama_param" value="<?php echo $result[0]["nama_param"]; ?>">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" class="form-control" name="satuan" value="<?php echo $result[0]["satuan"]; ?>">
          </div>
          <div class="form-group">
            <label>Nilai Rujukan</label>
            <input type="text" class="form-control" name="nilai_rujukan" value="<?php echo $result[0]["nilai_rujukan"]; ?>">
          </div>
          <div class="form-group">
            <label>Metoda</label>
            <input type="text" class="form-control" name="metoda" value="<?php echo $result[0]["metoda"]; ?>">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" name="harga" value="<?php echo $result[0]["harga"]; ?>">
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