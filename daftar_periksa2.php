<?php
require('header.php');
require_once("perpage.php");
require_once("koneksi.php");
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
$orderby = " ORDER BY tbl1.id_pendaftaran desc";
$sql = "SELECT * FROM tbl_hasil tbl1
JOIN tbl_pendaftaran tbl2 ON tbl2.id_pendaftaran=tbl1.id_pendaftaran
JOIN tbl_rm tbl3 ON tbl3.no_rm=tbl2.no_rm" . $queryCondition." GROUP BY tbl1.id_pendaftaran";
$href = 'daftar_periksa2.php';

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
          <h1>Data Hasil Lab</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h5>Hasil Lab</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form name="frmSearch" method="post" action="daftar_periksa2.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="No rekam medis" name="search[no_rm]" class="demoInputBox" value="<?php echo $no_rm; ?>" />
              <input type="text" placeholder="No KTP" name="search[diagnosa]" class="demoInputBox" value="<?php echo $diagnosa; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_periksa2.php'">
            </p>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No REG</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Tanggal Input Data</th>
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
                      <td><?php echo $result[$k]["id_pendaftaran"]; ?></td>
                      <td><?php echo $result[$k]["no_rm"]; ?></td>
                      <td><?php echo $result[$k]["nama"]; ?></td>
                      <td><?php echo $result[$k]["waktu_input"]; ?></td>
                      <td>
                        <a type="button" class="btn btn-outline-primary btn-xs far fa-file-pdf" href="cetak_hasil_lab3.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Cetak</a>
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