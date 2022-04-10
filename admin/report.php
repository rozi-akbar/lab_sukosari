<?php
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
      <form autocomplete="off" action="./cetak_report.php" role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Pilih Data :</label>
            <select id="parameter" class="form-control col-sm-4" name="tipe_laporan">
              <option value="register">Laporan Register Laboratorium</option>
              <option value="spesimen">Laporan Spesimen Laboratorium</option>
              <option value="rekapan_diagnosa">Laporan Rekapan Diagnosa Laboratorium</option>
            </select>
          </div>
          <div class="form-group">
            <label>From - To :</label>
            <table>
              <tr>
                <td><input type="date" class="form-control" required name="dari" id="dari"></td>
                <td> - </td>
                <td><input type="date" class="form-control" required name="sampai" id="sampai"></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
        </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>