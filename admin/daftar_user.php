<?php
require('header.php');
require_once("perpage.php");
require_once("../database.php");
$db_handle = new Koneksi();

$username = "";
$nama = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("username", "nama");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "username":
          $username = $v;
          $queryCondition .= "username LIKE '" . $v . "%'";
          break;
        case "nama":
          $nama = $v;
          $queryCondition .= "nama LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY ID desc";
$sql = "SELECT * FROM tbl_user " . $queryCondition;
$href = 'daftar_user.php';

$perPage = 10;
$page = 1;
if (isset($_POST['page'])) {
  $page = $_POST['page'];
}
$start = ($page - 1) * $perPage;
if ($start < 0) $start = 0;

$query =  $sql . $orderby .  " limit " . $start . "," . $perPage;
$result = $db_handle->runQuery($query);

if (!empty($result)) {
  $result["perpage"] = showperpage($sql, $perPage, $href);
}

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
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="input_user.php">+ Tambah Data</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form autocomplete="off" name="frmSearch" method="post" action="daftar_user.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="Username" name="search[username]" class="demoInputBox" value="<?php echo $username; ?>" />
              <input type="text" placeholder="Nama" name="search[nama]" class="demoInputBox" value="<?php echo $nama; ?>" /><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_user.php'">
            </p>
          </div>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($result)) {
                foreach ($result as $k => $v) {
                  if (is_numeric($k)) {
              ?>
                    <tr>
                      <td><?php echo $result[$k]["ID"]; ?></td>
                      <td><?php echo $result[$k]["username"]; ?></td>
                      <td><?php echo $result[$k]["nama"]; ?></td>
                      <td><?php echo $result[$k]["password"]; ?></td>
                      <td><?php echo $result[$k]["level"]; ?></td>
                      <td>
                        <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_user.php?ID=<?php echo $result[$k]["ID"]; ?>"> Edit</a>
                        <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" onclick="return confirm('Yakin Hapus?')" href="delete_user.php?ID=<?php echo $result[$k]["ID"]; ?>"> Hapus</a>
                      </td>
                    </tr>
                <?php
                  }
                }
              }
              if (isset($result["perpage"])) {
                ?>
                <tr>
                  <td colspan="6" align=right>
                    <ul class="pagination pagination-sm m-0 float-right">
                      <?php echo $result["perpage"]; ?>
                    </ul>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>