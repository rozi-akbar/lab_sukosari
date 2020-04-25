<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_rm SET no_ktp='" . $_POST["no_ktp"] . "', nama='" . $_POST["nama"] . "', tgl_lahir='" . $_POST["tgl_lahir"] . "', alamat='" . $_POST["alamat"] . "', id_desa='" . $_POST["id_desa"] . "' WHERE no_rm='" . $_POST["no_rm"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
  } else {
    header("Location:daftar_pendaftaran.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_rm rm JOIN tbl_desa ds ON rm.id_desa=ds.id_desa WHERE rm.no_rm='" . $_GET["id"] . "'");
$result2= $db_handle->runQuery("SELECT * FROM tbl_desa");
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
      <form autocomplete="off" role="form" method="post">
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
            <label>Alamat</label>
            <textarea type="text" class="form-control" name="alamat"><?php echo $result[0]["alamat"]; ?></textarea>
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
              if (!empty($result2)) {
                foreach ($result2 as $b => $u) {
                  if (is_numeric($b)) {
              ?>
                    <option value="<?php echo $result2[$b]["id_desa"] ?>"><?php echo $result2[$b]["nama_desa"]; ?></option>
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