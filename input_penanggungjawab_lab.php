<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_penanggungjawab_lab SET nip='" . $_POST["nip"] . "', nama='" . $_POST["nama"] . "' WHERE nip='" . $_POST["nip"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
  } else {
    echo '<script>alert("Berhasil Dirubah")</script>'; 
    header("Location:input_penanggungjawab_lab.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data PenanggungJawab Lab</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Petugas</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form autocomplete="off" role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" value="<?php echo $result[0]["nip"]; ?>">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $result[0]["nama"]; ?>">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" onclick="return confirm('Apakah anda yakin data yang anda masukkan sudah benar?')" class="btn btn-primary" value="Add" name="submit">Submit</button>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>