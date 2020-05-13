<?php
require('header.php');
require_once("perpage.php");
require_once("../database.php");
$db_handle = new Koneksi();

$nama_desa = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("nama_desa");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "nama_desa":
          $nama_desa = $v;
          $queryCondition .= "nama_desa LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY nama_desa desc";
$sql = "SELECT * FROM tbl_desa " . $queryCondition;
$href = 'daftar_desa.php';

$perPage = 7;
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
          <h1>Data Desa</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="input_desa.php">+ Tambah Data</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form autocomplete="off" name="frmSearch" method="post" action="daftar_desa.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="Nama Desa" name="search[nama_desa]" class="demoInputBox" value="<?php echo $nama_desa; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_desa.php'">
            </p>
          </div>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID Desa</th>
                <th>Nama Desa</th>
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
                      <td><?php echo $result[$k]["id_desa"]; ?></td>
                      <td><?php echo $result[$k]["nama_desa"]; ?></td>
                      <td>
                        <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_desa.php?id_desa=<?php echo $result[$k]["id_desa"]; ?>"> Edit</a>
                        <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" onclick="return confirm('Yakin Hapus?')" href="delete_desa.php?id_desa=<?php echo $result[$k]["id_desa"]; ?>"> Hapus</a>
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