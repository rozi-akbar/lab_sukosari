<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$no_rm = "";
$nama_pendaftar = "";
$tanggal = "";

$queryCondition = "";
$groupby = "";
if (!empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (!empty($v)) {

            $queryCases = array("no_rm", "nama_pendaftar", "tanggal");
            if (in_array($k, $queryCases)) {
                if (!empty($queryCondition)) {
                    $queryCondition .= " AND ";
                } else {
                    $queryCondition .= " AND ";
                    $groupby .= " GROUP BY p.id_pendaftaran ";
                }
            }
            switch ($k) {
                case "no_rm":
                    $nama_pendaftar = $v;
                    $queryCondition .= "rm.no_rm LIKE '" . $v . "%'";
                    break;
                case "nama_pendaftar":
                    $nama_pendaftar = $v;
                    $queryCondition .= "rm.nama LIKE '" . $v . "%'";
                    break;
                case "tanggal":
                    $tanggal = $v;
                    $queryCondition .= "p.tgl_daftar LIKE '" . $v . "%'";
                    break;
            }
        }
    }
}
$orderby = " ORDER BY p.id_pendaftaran desc";
$sql = "SELECT p.id_pendaftaran, rm.no_rm, rm.nama, p.tgl_daftar FROM tbl_pendaftaran as p JOIN tbl_rm as rm ON p.no_rm = rm.no_rm" . $queryCondition . " GROUP BY p.id_pendaftaran";
$href = 'history_pendaftaran.php';

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
                    <h1>Input Hasil LAB</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="daftar_pendaftaran.php">+ Tambah Pendaftaran</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form autocomplete="off" name="frmSearch" method="post" action="history_pendaftaran.php">
                    <div class="search-box">
                        <p>
                            <input type="text" placeholder="No RM" name="search[no_rm]" class="" value="<?php echo $no_rm; ?>" />
                            <input type="text" placeholder="Nama Pendaftar" name="search[nama_pendaftar]" class="" value="<?php echo $nama_pendaftar; ?>" />
                            <input type="date" name="search[tanggal]" class="" value="<?php echo $tanggal; ?>" />
                            <input type="submit" name="go" class="btnSearch" value="Search">
                            <input type="reset" class="btnSearch" value="Reset" onclick="window.location='history_pendaftaran.php'">
                        </p>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No REG</th>
                                <th>No RM Pendaftar</th>
                                <th>Nama Pendaftar</th>
                                <th>Tanggal Mendaftar</th>
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
                                            <td><?php echo $result[$k]["tgl_daftar"]; ?></td>
                                            <td align="center">
                                                <a type="button" class="btn btn-outline-success btn-xs fas fa-check-square" href="input_hasil_lab.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Pilih</a>
                                            </td>
                                            <td align="center">
                                                <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_history_pendaftaran.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Edit</a>
                                                <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" onclick="return confirm('Yakin Hapus?')" href="delete_history_pendaftaran.php?id=<?php echo $result[$k]["id_pendaftaran"]; ?>"> Hapus</a>
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