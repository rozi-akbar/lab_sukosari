<?php
require_once("../database.php");
$db_handle = new Koneksi();
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Cetak Laporan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form autocomplete="off" role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Pilih Data :</label>
            <select id="parameter" class="form-control col-sm-2">
              <option value="parameter">Per Parameter</option>
              <option value="paket">Per Paket</option>
              <option value="penyakit">Per Penyakit</option>
            </select>
          </div>
          <div class="form-group">
            <label>From - To :</label>
            <table>
              <tr align="Right">
                <td><input type="date" class="form-control" name="dari" id="dari"></td>
                <td> - </td>
                <td><input type="date" class="form-control" name="sampai" id="sampai"></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="button" onclick="rubah()" class="btn btn-primary fas fa-check-square"> Cetak</button>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  function rubah() {
    var docpilih = document.getElementById("parameter");

    var pilih = docpilih.options[docpilih.selectedIndex].value;
    var dari = document.getElementById("dari").value;
    var sampai = document.getElementById("sampai").value;

    document.getElementById("coba").value=dari;
  }
</script>
<?php include('footer.php'); ?>