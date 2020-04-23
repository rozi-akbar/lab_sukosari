<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$no_rm = "";
$diagnosa = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("hl.no_rm", "rm.no_ktp");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "hl.no_rm":
          $no_rm = $v;
          $queryCondition .= "hl.no_rm LIKE '" . $v . "%'";
          break;
        case "rm.no_ktp":
          $diagnosa = $v;
          $queryCondition .= "rm.no_ktp LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY hl.no_rm desc";
$sql = "SELECT hl.id_hasil_lab, hl.no_rm, rm.no_ktp, rm.nama, hl.diagnosa, hl.tanggal FROM tbl_hasil_lab hl JOIN tbl_rm rm WHERE rm.no_rm=hl.no_rm" . $queryCondition;
$href = 'daftar_periksa.php';

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
          <h3>Data Rekam Medis</h3>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h1>Hasil Lab</h1>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form name="frmSearch" method="post" action="daftar_periksa.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="No rekam medis" name="search[no_rm]" class="demoInputBox" value="<?php echo $no_rm; ?>" />
              <input type="text" placeholder="No KTP" name="search[diagnosa]" class="demoInputBox" value="<?php echo $diagnosa; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_periksa.php'">
            </p>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No Rekam Medis</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Diagnosa</th>
                <th>Tanggal</th>
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
                      <td><?php echo $result[$k]["diagnosa"]; ?></td>
                      <td><?php echo $result[$k]["tanggal"]; ?></td>
                      <td>
                        <a href="cetak_hasil_lab.php?id=<?php echo $result[$k]["id_hasil_lab"]; ?>">Cetak</a>
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