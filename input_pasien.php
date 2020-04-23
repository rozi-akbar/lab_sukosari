<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "INSERT INTO tbl_rm(no_rm, no_ktp, nama, tgl_lahir, alamat, id_desa) VALUES('" . $_POST["no_rm"] . "','" . $_POST["no_ktp"] . "','" . $_POST["nama"] . "','" . $_POST["tgl_lahir"] . "','" . $_POST["alamat"] . "','" . $_POST["id_desa"] . "')";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Adding to database. Please Retry.";
  } else {
    header("Location:daftar_pendaftaran.php");
  }
}
require('header.php');
$result = $db_handle->runQuery("SELECT * FROM tbl_desa");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pasien</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Pasien</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>No Rekam Medis</label>
            <input type="text" class="form-control" name="no_rm">
          </div>
          <div class="form-group">
            <label>No KTP</label>
            <input type="text" class="form-control" name="no_ktp">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>Tgl Lahir</label>
            <input type="date" class="form-control col-sm-2" name="tgl_lahir">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea type="text" class="form-control" name="alamat"></textarea>
          </div>
          <div class="form-group">
            <label>Desa</label>
            <select class="form-control select2bs4 col-sm-2" name="id_desa">
              <?php
              if (!empty($result)) {
                foreach ($result as $a => $v) {
                  if (is_numeric($a)) {
              ?>
                    <option value="<?php echo $result[$a]["id_desa"] ?>"><?php echo $result[$a]["nama_desa"]; ?></option>
              <?php
                  }
                }
              }
              ?>
            </select>
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