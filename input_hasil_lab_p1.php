<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$no_rm = "";
$no_ktp = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("no_rm", "no_ktp");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "no_rm":
          $no_rm = $v;
          $queryCondition .= "no_rm LIKE '" . $v . "%'";
          break;
        case "no_ktp":
          $no_ktp = $v;
          $queryCondition .= "no_ktp LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY no_rm desc";
$sql = "SELECT * FROM tbl_rm " . $queryCondition;
$href = 'input_hasil_lab_p1.php';

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
          <h1>Pilih Data Pasien</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="input_pasien.php">+ Tambah Data Pasien</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form name="frmSearch" method="post" action="input_hasil_lab_p1.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="No rekam medis" name="search[no_rm]" class="demoInputBox" value="<?php echo $no_rm; ?>" />
              <input type="text" placeholder="No KTP" name="search[no_ktp]" class="demoInputBox" value="<?php echo $no_ktp; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='input_hasil_lab_p1.php'">
            </p>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No Rekam Medis</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Alamat</th>
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
                      <td><?php echo $result[$k]["no_rm"]; ?></td>
                      <td><?php echo $result[$k]["no_ktp"]; ?></td>
                      <td><?php echo $result[$k]["nama"]; ?></td>
                      <td><?php echo $result[$k]["alamat"]; ?></td>
                      <td>
                        <a href="input_hasil_lab_p2.php?id=<?php echo $result[$k]["no_rm"]; ?>">Pilih</a>
                      </td>
                    </tr>
                <?php
                  }
                }
              } else {
                ?>
                <tr>
                  <td colspan="5" align="center"><?php echo "Hasil pencarian tidak ada, pilih tambah data pasien terlebih dahulu"; ?></td>
                </tr>
              <?php

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