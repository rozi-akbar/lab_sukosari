<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$nama_penyakit = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("nama_penyakit");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "nama_penyakit":
          $nama_penyakit = $v;
          $queryCondition .= "nama_penyakit LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY id_penyakit desc";
$sql = "SELECT * FROM tbl_penyakit " . $queryCondition;
$href = 'daftar_penyakit.php';

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
          <h1>Data Penyakit</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="input_penyakit.php">+ Tambah Data</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form name="frmSearch" method="post" action="daftar_penyakit.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="Nama Penyakit" name="search[nama_penyakit]" class="demoInputBox" value="<?php echo $nama_penyakit; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_penyakit.php'">
            </p>
          </div>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID Penyakit</th>
                <th>Nama Penyakit</th>
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
                      <td><?php echo $result[$k]["id_penyakit"]; ?></td>
                      <td><?php echo $result[$k]["nama_penyakit"]; ?></td>
                      <td>
                        <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_penyakit.php?id_penyakit=<?php echo $result[$k]["id_penyakit"]; ?>"></a>
                        <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" href="delete_penyakit.php?id_penyakit=<?php echo $result[$k]["id_penyakit"]; ?>"></a>
                      </td>
                    </tr>
                <?php
                  }
                }
              }
              if (isset($result["perpage"])) {
                ?>
                <tr>
                  <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
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