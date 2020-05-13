<?php
require('header.php');
require_once("perpage.php");
require_once("../database.php");
$db_handle = new Koneksi();

$no_rm = "";
$nama = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("tbl2.no_rm", "tbl3.nama");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " AND ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "tbl2.no_rm":
          $no_rm = $v;
          $queryCondition .= "tbl2.no_rm LIKE '" . $v . "%'";
          break;
        case "tbl3.nama":
          $nama = $v;
          $queryCondition .= "tbl3.nama LIKE '" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY tbl1.id_pendaftaran desc";
$sql = "SELECT * FROM tbl_hasil tbl1
JOIN tbl_pendaftaran tbl2 ON tbl2.id_pendaftaran=tbl1.id_pendaftaran
JOIN tbl_rm tbl3 ON tbl3.no_rm=tbl2.no_rm" . $queryCondition . " GROUP BY tbl1.id_pendaftaran";
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
          <h1>Cetak Hasil LAB</h1>
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
        <form autocomplete="off" name="frmSearch" method="post" action="daftar_periksa.php">
          <div class="search-box">
            <p>
              <input type="text" placeholder="No rekam medis" name="search[tbl2.no_rm]" class="demoInputBox" value="<?php echo $no_rm; ?>" />
              <input type="text" placeholder="Nama" name="search[tbl3.nama]" class="demoInputBox" value="<?php echo $nama; ?>" />
              <input type="submit" name="go" class="btnSearch" value="Search">
              <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_periksa.php'">
            </p>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr align="center">
                <th>No REG</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Tanggal Input Data</th>
                <th colspan="2">Action</th>
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
                      <td align="center"><?php echo $result[$k]["waktu_input"]; ?></td>
                      <td align="center">
                        <a type="button" class="btn btn-outline-success btn-xs far fa-file-pdf" href="cetak_hasil_lab.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Cetak</a>
                      </td>
                      <td align="center">
                        <a type="button" class="btn btn-outline-primary btn-xs far fa-edit" href="edit_hasil_lab.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Edit</a>
                        <a type="button" class="btn btn-outline-danger btn-xs far fa-trash-alt" onclick="return confirm('Yakin Hapus?')" href="delete_hasil_lab.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Hapus</a>
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