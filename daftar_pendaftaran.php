<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$no_rm = "";
$nama = "";
$no_ktp = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (!empty($v)) {

            $queryCases = array("no_rm", "nama", "no_ktp");
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
                case "nama":
                    $nama = $v;
                    $queryCondition .= "nama LIKE '" . $v . "%'";
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
$href = 'daftar_pendaftaran.php';

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

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Proses</a></li>
                        <li class="breadcrumb-item active">Input Pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input Pendaftaran</h3>
                <div class="card-tools">
                    <a class="btn btn-success btn-sm" href="input_pasien.php">+ Tambah Data Pasien</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form autocomplete="off" name="frmSearch" method="post" action="daftar_pendaftaran.php">
                    <div class="search-box">
                        <p>
                            <input type="text" placeholder="No RM" name="search[no_rm]" class="demoInputBox" value="<?php echo $no_rm; ?>" />
                            <input type="text" placeholder="No KTP" name="search[no_ktp]" class="demoInputBox" value="<?php echo $no_ktp; ?>" />
                            <input type="text" placeholder="Nama" name="search[nama]" class="demoInputBox" value="<?php echo $nama; ?>" />
                            <input type="submit" name="go" class="btnSearch" value="Search">
                            <input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_pendaftaran.php'">
                        </p>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No Rekam Medis</th>
                                <th>No KTP</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Alamat</th>
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
                                            <td><?php echo $result[$k]["no_rm"]; ?></td>
                                            <td><?php echo $result[$k]["no_ktp"]; ?></td>
                                            <td><?php echo $result[$k]["nama"]; ?></td>
                                            <td><?php echo $result[$k]["tgl_lahir"]; ?></td>
                                            <td><?php echo $result[$k]["alamat"]; ?></td>
                                            <td align="center">
                                                <a type="button" class="btn btn-outline-success btn-xs fas fa-check-square" href="input_pendaftaran.php?id=<?php echo $result[$k]["no_rm"]; ?>"> Pilih</a>
                                            </td>
                                            <td align="center">
                                                <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_pasien.php?id=<?php echo $result[$k]["no_rm"]; ?>"> Edit</a>
                                                <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" href="delete_pasien.php?id=<?php echo $result[$k]["no_rm"]; ?>"> Hapus</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" align="center"><?php echo "Hasil pencarian tidak ada, pilih tambah data pasien terlebih dahulu"; ?></td>
                                </tr>
                            <?php
                            }
                            if (isset($result["perpage"])) {
                            ?>
                                <tr>
                                    <td colspan="7" align=right>
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