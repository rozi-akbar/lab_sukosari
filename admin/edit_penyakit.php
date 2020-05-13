<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_penyakit SET nama_penyakit='" . $_POST["nama_penyakit"] . "' WHERE id_penyakit='" . $_POST["id_penyakit"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
    echo'error';
  } else {
    header("Location:daftar_penyakit.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_penyakit WHERE id_penyakit='" . $_GET["id_penyakit"] . "'");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Penyakit</h1>
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
      <form autocomplete="off" role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Nama Penyakit</label>
            <input type="hidden" class="form-control" name="id_penyakit" value="<?php echo $result[0]["id_penyakit"]; ?>">
            <input type="text" class="form-control" name="nama_penyakit" value="<?php echo $result[0]["nama_penyakit"]; ?>">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" onclick="return confirm('Apakah anda yakin data yang anda masukkan sudah benar?')" class="btn btn-primary" value="Add" name="submit">Submit</button>
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