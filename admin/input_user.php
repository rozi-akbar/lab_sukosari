<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "INSERT INTO tbl_user(ID, username, nama, NIP, level, password) VALUES('" . $_POST["ID"] . "','" . $_POST["username"] . "',
  '" . $_POST["nama"] . "','" . $_POST["NIP"] . "','" . $_POST["level"] . "','" . $_POST["password"] . "')";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Adding to database. Please Retry.";
  } else {
    header("Location:daftar_user.php");
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
            <label>Username</label>
            <input type="hidden" class="form-control" name="ID" value="<?php echo $uniqueID;?>">
            <input type="text" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label>Level</label>
            <select class="form-control select2bs4" name="level">
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          <a class="btn btn-warning" href="daftar_user.php">Cancel</a>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>