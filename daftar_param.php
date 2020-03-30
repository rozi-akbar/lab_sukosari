<?php
require('header.php');
require_once("perpage.php");
require_once("koneksi.php");
$db_handle = new Koneksi();

$id_param = "";
$nama_param = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (!empty($v)) {

            $queryCases = array("id_param", "nama_param");
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
                    $queryCondition .= "id_param LIKE '" . $v . "%'";
                    break;
                case "nama":
                    $nama_param = $v;
                    $queryCondition .= "nama_param LIKE '" . $v . "%'";
                    break;
            }
        }
    }
}
$orderby = " ORDER BY nama_param desc";
$sql = "SELECT * FROM tbl_param " . $queryCondition;
$href = 'daftar_param.php';

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
                    <h1>Data Parameter</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="input_param.php">+ Tambah Data</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form name="frmSearch" method="post" action="daftar_param.php">
                    <div class="search-box">
                        <p>
                            <input type="text" placeholder="ID Parameter" name="search[id_param]" class="demoInputBox" value="<?php echo $id_param; ?>" />
                            <input type="text" placeholder="Nama Parameter" name="search[nama_param]" class="demoInputBox" value="<?php echo $nama_param; ?>" /><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='daftar_user.php'">
                        </p>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Parameter</th>
                                <th>Nama Parameter</th>
                                <th>Satuan</th>
                                <th>Nilai Rujukan</th>
                                <th>Metoda</th>
                                <th>Harga</th>
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
                                            <td><?php echo $result[$k]["id_param"]; ?></td>
                                            <td><?php echo $result[$k]["nama_param"]; ?></td>
                                            <td><?php echo $result[$k]["satuan"]; ?></td>
                                            <td><?php echo $result[$k]["nilai_rujukan"]; ?></td>
                                            <td><?php echo $result[$k]["metoda"]; ?></td>
                                            <td><?php echo $result[$k]["harga"]; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-outline-primary btn-xs fas fa-edit" href="edit_param.php?ID=<?php echo $result[$k]["id_param"]; ?>"></a>
                                                <a type="button" class="btn btn-outline-danger btn-xs fas fa-trash-alt" href="delete_param.php?ID=<?php echo $result[$k]["id+param"]; ?>"></a>
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