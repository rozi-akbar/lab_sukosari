<?php
require_once("../database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "UPDATE tbl_user SET username='" . $_POST["username"] . "', nama='" . $_POST["nama"] . "', NIP='" . $_POST["NIP"] . "',
   password='" . md5($_POST['password']) . "', level='" . $_POST["level"] . "' WHERE ID='" . $_POST["ID"] . "' ";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    $message = "Problem in Update to database. Please Retry.";
  } else {
    header("Location:daftar_user.php");
  }
}
$result = $db_handle->runQuery("SELECT * FROM tbl_user WHERE ID='" . $_GET["ID"] . "'");
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
            <label>Username</label>
            <input type="hidden" class="form-control" name="ID" value="<?php echo $result[0]["ID"]; ?>">
            <input type="text" class="form-control" name="username" value="<?php echo $result[0]["username"]; ?>" required>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $result[0]["nama"]; ?>" required>
          </div>
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="NIP" value="<?php echo $result[0]["NIP"]; ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" required>
          </div>
          <div class="form-group">
            <label>Level</label>
            <select class="form-control select2bs4" name="level">
              <option value="Admin" <?php if($result[0]["level"] == "Admin"){echo 'selected';}?>>Admin</option>
              <option value="User" <?php if($result[0]["level"] == "User"){echo 'selected';}?>>User</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" onclick="return confirm('Apakah anda yakin data yang anda masukkan sudah benar?')" class="btn btn-primary" value="Add" name="submit">Submit</button>
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