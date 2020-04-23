<?php
require('header.php');
require_once("perpage.php");
require_once("database.php");
$db_handle = new Koneksi();

$id_param = "";
$nama_param = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (!empty($v)) {

            $queryCases = array("id_paket", "nama_paket");
            if (in_array($k, $queryCases)) {
                if (!empty($queryCondition)) {
                    $queryCondition .= " AND ";
                } else {
                    $queryCondition .= " WHERE ";
                }
            }
            switch ($k) {
                case "username":
                    $id_param = $v;
                    $queryCondition .= "id_paket LIKE '" . $v . "%'";
                    break;
                case "nama":
                    $nama_param = $v;
                    $queryCondition .= "nama_paket LIKE '" . $v . "%'";
                    break;
            }
        }
    }
}
$orderby = " ORDER BY id_paket asc";
$sql = "SELECT id_paket, nama_paket, harga, lab_terkait, COUNT(id_param) FROM tbl_paket_param GROUP BY id_paket" . $queryCondition;
$href = 'daftar_paket_param.php';

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
                    <h1>Data Paket Parameter</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="input_paket_param.php">+ Tambah Data Paket</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form name="frmSearch" method="post" action="daftar_paket_param.php">
                    <div class="search-box">
                        <p>
                            <input type="text" placeholder="ID Parameter" name="search[id_param]" class="demoInputBox" value="<?php echo $id_param; ?>" />
                            <input type="text" placeholder="Nama Parameter" name="search[nama_param]" class="demoInputBox" value="<?php echo $nama_param; ?>" /><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_user.php'">
                        </p>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Item</th>
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
                                            <td><?php echo $result[$k]["nama_paket"]; ?></td>
                                            <td><?php echo $result[$k]["harga"]; ?></td>
                                            <td><?php echo $result[$k]["COUNT(id_param)"]; ?> Item</td>
                                            <td>
                                                <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" href="delete_paket_param.php?ID=<?php echo $result[$k]["id_paket"]; ?>"></a>
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