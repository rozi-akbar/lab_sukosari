<?php
require_once("database.php");
$db_handle = new Koneksi();
if (!empty($_POST["submit"])) {
  $query = "INSERT INTO tbl_hasil_lab(id_hasil_lab, no_rm, umur, diagnosa, tanggal, permintaan, sampel_diterima, selesai_dikerjakan, 
  hemoglobin, LED, hitung_eritrosit, hitung_leukosit, hitung_trombosit, hematocrit, hitung_jenis_leukosit, MCV, MCH, MCHC, 
  masa_pendarahan, masa_pembekuan, protein, glukosa, urobilinogen, billirubin, nitrit, keton, berat_jenis, PH, eritrosit, 
  leukosit, epithel, silinder, kristal, lain_lain, billirubin_direct, billirubin_total, SGOT, SGPT, alkali_phospatase, 
  total_protein, albumin, globulin, gula_darah_puasa, gula_darah_2_jam_pp, gula_darah_sewaktu, kreatinin, ureum, uric_acid, 
  cholesterol_total, trigliserida, HDL, LDL, golongan_darah, golongan_darah_rhesus, widal_o, widal_h, widal_bo, widal_ao, 
  AD_IgG, AD_IgM, VDRL, anti_HIV, HBs_Ag, anti_HBs, mycobacterium_tuberculosis, mycobacterium_leprae, neisseria_gonnorrhoae, 
  trichomonas_vaginalis, candida_albicans, bacterial_vaginosis, jamur_permukaan, natrium, kalium, chlorida) 
  VALUES ('" . $_POST["id_hasil_lab"] . "','" . $_POST["no_rm"] . "','" . $_POST["umur"] . "','" . $_POST["diagnosa"] . "','" . $_POST["tanggal"] . "','" . $_POST["permintaan"] . "','" . $_POST["sampel_diterima"] . "','" . $_POST["selesai_dikerjakan"] . "',
  '" . $_POST["hemoglobin"] . "','" . $_POST["LED"] . "','" . $_POST["hitung_eritrosit"] . "','" . $_POST["hitung_leukosit"] . "','" . $_POST["hitung_trombosit"] . "','" . $_POST["hematocrit"] . "','" . $_POST["hitung_jenis_leukosit"] . "','" . $_POST["MCV"] . "','" . $_POST["MCH"] . "','" . $_POST["MCHC"] . "',
  '" . $_POST["masa_pendarahan"] . "','" . $_POST["masa_pembekuan"] . "','" . $_POST["protein"] . "','" . $_POST["glukosa"] . "','" . $_POST["urobilinogen"] . "','" . $_POST["billirubin"] . "','" . $_POST["nitrit"] . "','" . $_POST["keton"] . "','" . $_POST["berat_jenis"] . "','" . $_POST["PH"] . "','" . $_POST["eritrosit"] . "',
  '" . $_POST["leukosit"] . "','" . $_POST["epithel"] . "','" . $_POST["silinder"] . "','" . $_POST["kristal"] . "','" . $_POST["lain_lain"] . "','" . $_POST["billirubin_direct"] . "','" . $_POST["billirubin_total"] . "','" . $_POST["SGOT"] . "','" . $_POST["SGPT"] . "','" . $_POST["alkali_phospatase"] . "',
  '" . $_POST["total_protein"] . "','" . $_POST["albumin"] . "','" . $_POST["globulin"] . "','" . $_POST["gula_darah_puasa"] . "','" . $_POST["gula_darah_2_jam_pp"] . "','" . $_POST["gula_darah_sewaktu"] . "','" . $_POST["kreatinin"] . "','" . $_POST["ureum"] . "','" . $_POST["uric_acid"] . "',
  '" . $_POST["cholesterol_total"] . "','" . $_POST["trigliserida"] . "','" . $_POST["HDL"] . "','" . $_POST["LDL"] . "','" . $_POST["golongan_darah"] . "','" . $_POST["golongan_darah_rhesus"] . "','" . $_POST["widal_o"] . "','" . $_POST["widal_h"] . "','" . $_POST["widal_bo"] . "','" . $_POST["widal_ao"] . "',
  '" . $_POST["AD_IgG"] . "','" . $_POST["AD_IgM"] . "','" . $_POST["VDRL"] . "','" . $_POST["anti_HIV"] . "','" . $_POST["HBs_Ag"] . "','" . $_POST["anti_HBs"] . "','" . $_POST["mycobacterium_tuberculosis"] . "','" . $_POST["mycobacterium_leprae"] . "','" . $_POST["neisseria_gonnorrhoae"] . "',
  '" . $_POST["trichomonas_vaginalis"] . "','" . $_POST["candida_albicans"] . "','" . $_POST["bacterial_vaginosis"] . "','" . $_POST["jamur_permukaan"] . "','" . $_POST["natrium"] . "','" . $_POST["kalium"] . "','" . $_POST["chlorida"] . "')";
  $result = $db_handle->executeQuery($query);
  if (!$result) {
    echo "Query yang dijalankan: $query";
    $message = "Problem in Adding data to database. Please Retry.";
  } else {
    header("Location:daftar_periksa.php");
  }
}
$id_random = uniqid();
$result = $db_handle->runQuery("SELECT * FROM tbl_rm WHERE no_rm='" . $_GET["id"] . "'");
require('header.php');
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
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Input Data</h3>
      </div>
      <!-- /.card-header -->
      <form autocomplete="off" role="form" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="hidden" class="form-control" name="id_hasil_lab" value="<?php echo $id_random; ?>">
            <input type="hidden" class="form-control" name="no_rm" value="<?php echo $result[0]["no_rm"]; ?>">
            <input type="text" class="form-control" name="nama" value="<?php echo $result[0]["nama"]; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $result[0]["alamat"]; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">No.KTP/REG</label>
            <input type="text" class="form-control" name="no_ktp" value="<?php echo $result[0]["no_ktp"]; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Umur</label>
            <input type="text" class="form-control" name="umur">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Diagnosa</label>
            <input type="text" class="form-control" name="diagnosa">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal</label>
            <input type="date" class="form-control" name='tanggal'>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Atas Permintaan</label>
            <input type="text" class="form-control" id="permintaan" name="permintaan">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jam Sampel Diterima/Selesai Dikerjakan</label>
            <input type="text" class="form-control" id="diterima" name="sampel_diterima">/
            <input type="text" class="form-control" id="selesai" name="selesai_dikerjakan">
          </div>
        </div>
        <!-- /.card-body -->

        <!-- form start -->
        <div class="card-body">
          <div class="container-fluid">
            <div class="row">
              <!-- Left col -->
              <div class="col-md-6">
                <!-- Default box -->
                <!-- Hematologi -->
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Form Input Hematologi</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">Pemeriksaan</th>
                          <th>Hasil</th>
                          <th>Satuan</th>
                          <th>Normal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Hemoglobin</td>
                          <td><input type="text" class="form-control" id="Hemoglobin" placeholder="Hemoglobin" name="hemoglobin">
                          </td>
                          <td>g/dl</td>
                          <td>P : 13,5-17,5 W : 12-16</td>
                        </tr>
                        <tr>
                          <td>LED</td>
                          <td><input type="text" class="form-control" id="LED" placeholder="LED" name="LED"></td>
                          <td>mm/jam</td>
                          <td>P : 0-15 W : 0-20</td>
                        </tr>
                        <tr>
                          <td>Eritrosit</td>
                          <td><input type="text" class="form-control" id="Eritrosit" placeholder="Eritrosit" name="hitung_eritrosit">
                          </td>
                          <td>10/ul</td>
                          <td>P : 4,5-5,9 W : 4,0-5,2</td>
                        </tr>
                        <tr>
                          <td>Leukosit</td>
                          <td><input type="text" class="form-control" id="Leukosit" placeholder="Leukosit" name="hitung_leukosit">
                          </td>
                          <td>/ul</td>
                          <td>4.000-10.000</td>
                        </tr>
                        <tr>
                          <td>Trombosit</td>
                          <td><input type="text" class="form-control" id="Trombosit" placeholder="Trombosit" name="hitung_trombosit">
                          </td>
                          <td>/ul</td>
                          <td>150.000-400.000</td>
                        </tr>
                        <tr>
                          <td>Hematocrit</td>
                          <td><input type="text" class="form-control" id="Hematocrit" placeholder="Hematocrit" name="hematocrit">
                          </td>
                          <td>%</td>
                          <td>P : 40-48 W : 37-43</td>
                        </tr>
                        <tr>
                          <td>Hitung Jenis Leukosit</td>
                          <td><input type="text" class="form-control" id="hitung_jenis_leukosit" placeholder="Hitung Jenis Leukosit" name="hitung_jenis_leukosit">
                          </td>
                          <td>Eos/Baso/Stab/Seg/Lympo/Mono</td>
                          <td>1-3/0-1/2-6/50-70/20-40/2-8</td>
                        </tr>
                        <tr>
                          <td>MCV</td>
                          <td><input type="text" class="form-control" id="MCV" placeholder="MCV" name="MCV">
                          </td>
                          <td>fL</td>
                          <td>78-102</td>
                        </tr>
                        <tr>
                          <td>MCH</td>
                          <td><input type="text" class="form-control" id="MCH" placeholder="MCH" name="MCH">
                          </td>
                          <td>pg/cell</td>
                          <td>26-34</td>
                        </tr>
                        <tr>
                          <td>MCHC</td>
                          <td><input type="text" class="form-control" id="MCHC" placeholder="MCHC" name="MCHC">
                          </td>
                          <td>g/dl</td>
                          <td>31-37</td>
                        </tr>
                        <tr>
                          <td>Masa Pendarahan</td>
                          <td><input type="text" class="form-control" id="masa_pendarahan" placeholder="Masa Pendarahan" name="masa_pendarahan">
                          </td>
                          <td>Menit</td>
                          <td>1,0-3,0</td>
                        </tr>
                        <tr>
                          <td>Masa Pembekuan</td>
                          <td><input type="text" class="form-control" id="masa_pembekuan" placeholder="Masa Pembekuan" name="masa_pembekuan">
                          </td>
                          <td>Menit</td>
                          <td>5,0-15</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-body -->
                  <div class="card-footer">
                  </div>
                  <!-- /.card-footer-->

                </div>
                <!-- Hematologi End-->

                <!-- Urinalisa -->
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Form Input Urinalisa</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">Pemeriksaan</th>
                          <th>Hasil</th>
                          <th>Satuan</th>
                          <th>Normal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Protein</td>
                          <td><select class="form-control" name="protein">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Glukosa</td>
                          <td><select class="form-control" name="glukosa">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Urobilinogen</td>
                          <td><select class="form-control" name="urobilinogen">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Billirubin</td>
                          <td><select class="form-control" name="billirubin">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Nitrit</td>
                          <td><select class="form-control" name="nitrit">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Keton</td>
                          <td><select class="form-control" name="keton">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Berat Jenis</td>
                          <td><input type="text" class="form-control" id="masa_pembekuan" name="berat_jenis">
                          </td>
                          <td></td>
                          <td>1.005-1.030</td>
                        </tr>
                        <tr>
                          <td>PH</td>
                          <td><input type="text" class="form-control" id="masa_pembekuan" name="PH">
                          </td>
                          <td></td>
                          <td>5.0-8.0</td>
                        </tr>
                        <tr>
                          <td>*Eritrosit</td>
                          <td><input type="text" class="form-control" name="eritrosit" placeholder="Eritrosit">
                          </td>
                          <td>/LPB</td>
                          <td>
                            < 3</td> </tr> <tr>
                          <td>*Leukosit</td>
                          <td><input type="text" class="form-control" name="leukosit" placeholder="Leukosit">
                          </td>
                          <td>/LPB</td>
                          <td>
                            < 5</td> </tr> <tr>
                          <td>*Epithel</td>
                          <td><input type="text" class="form-control" name="epithel" placeholder="Epithel">
                          </td>
                          <td>/LPB</td>
                          <td>
                            < 5</td> </tr> <tr>
                          <td>*Silinder</td>
                          <td><select class="form-control" name="silinder">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>*Kristal</td>
                          <td><select class="form-control" name="kristal">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>*Lain-lain</td>
                          <td><select class="form-control" name="lain_lain">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-body -->
                  <div class="card-footer">
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- Urinalisa End-->

                <!-- Parasitologi-->
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Form Input Parasitologi</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">Pemeriksaan</th>
                          <th>Hasil</th>
                          <th>Satuan</th>
                          <th>Normal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>*Eritrosit</td>
                          <td><select class="form-control" id="Eritrosit2">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>*Leukosit</td>
                          <td><select class="form-control" id="Leukosit2">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>*T. Cacing</td>
                          <td><select class="form-control" id="Cacing">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Lain-Lain</td>
                          <td><select class="form-control" id="lain2">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Darah Samar</td>
                          <td><select class="form-control" id="darahsamar">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Malaria</td>
                          <td><select class="form-control" id="Malaria">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                        <tr>
                          <td>Mikrofilaria</td>
                          <td><select class="form-control" id="Mikrofilaria">
                              <option value="0">Pilih</option>
                              <option value="1">Negative</option>
                              <option value="2">Positive</option>
                            </select>
                          </td>
                          <td></td>
                          <td>Negative</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-body -->
                  <div class="card-footer">
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- Parasitologi End-->

                <!-- Kimia Klinik-->
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Form Input Kimia Klinik</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">Pemeriksaan</th>
                          <th>Hasil</th>
                          <th>Satuan</th>
                          <th>Normal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Bilirubin Direct</td>
                          <td><input type="text" class="form-control" id=">bilirubin_direct" name="billirubin_direct">
                          </td>
                          <td>mg/dl</td>
                          <td>0.1-0.3</td>
                        </tr>
                        <tr>
                          <td>Bilirubin Total</td>
                          <td><input type="text" class="form-control" id="bilirubin_total" name="billirubin_total">
                          </td>
                          <td>mg/dl</td>
                          <td>0.3-1.1</td>
                        </tr>
                        <tr>
                          <td>SGOT (Opt. 37 C)</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="SGOT">
                          </td>
                          <td>IU/I</td>
                          <td>P : < 35 W : < 31</td> </tr> <tr>
                          <td>SGPT (Opt. 37 C)</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="SGPT">
                          </td>
                          <td>IU/I</td>
                          <td>P : < 40 W : < 31</td> </tr> <tr>
                          <td>Alkali Phospatase (Opt. 37 C)</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="alkali_phospatase">
                          </td>
                          <td>IU/I</td>
                          <td>P : 53-128 W : 42-141</td>
                        </tr>
                        <tr>
                          <td>Total Protein</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="total_protein">
                          </td>
                          <td>mg/dl</td>
                          <td>6.0-8.0</td>
                        </tr>
                        <tr>
                          <td>Albumin</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="albumin">
                          </td>
                          <td>mg/dl</td>
                          <td>3.5-5.5</td>
                        </tr>
                        <tr>
                          <td>Globulin</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="globulin">
                          </td>
                          <td>mg/dl</td>
                          <td>2.0-3.6</td>
                        </tr>
                        <tr>
                          <td>Gula Darah Puasa</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="gula_darah_puasa">
                          </td>
                          <td>mg/dl</td>
                          <td>70-110</td>
                        </tr>
                        <tr>
                          <td>Gula Darah 2 Jam PP</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="gula_darah_2_jam_pp">
                          </td>
                          <td>mg/dl</td>
                          <td>70-125</td>
                        </tr>
                        <tr>
                          <td>Gula Darah Sewaktu</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="gula_darah_sewaktu">
                          </td>
                          <td>mg/dl</td>
                          <td>70-140</td>
                        </tr>
                        <tr>
                          <td>Kreatinin</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="kreatinin">
                          </td>
                          <td>mg/dl</td>
                          <td>P : 0.6-1.3 W : 0.5-1.1</td>
                        </tr>
                        <tr>
                          <td>Ureum</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="ureum">
                          </td>
                          <td>mg/dl</td>
                          <td>15-38</td>
                        </tr>
                        <tr>
                          <td>Uric Acid</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="uric_acid">
                          </td>
                          <td>mg/dl</td>
                          <td>P : 3.4-7.0 W : 2.4-5.7</td>
                        </tr>
                        <tr>
                          <td>Cholesterol Total</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="cholesterol_total">
                          </td>
                          <td>mg/dl</td>
                          <td>
                            < 200</td> </tr> <tr>
                          <td>Trigliserida</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="trigliserida">
                          </td>
                          <td>mg/dl</td>
                          <td>
                            < 150</td> </tr> <tr>
                          <td>HDL-Cholesterol</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="HDL">
                          </td>
                          <td>mg/dl</td>
                          <td>35-55</td>
                        </tr>
                        <tr>
                          <td>LDL-Cholesterol</td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" name="LDL">
                          </td>
                          <td>mg/dl</td>
                          <td>
                            <150</td> </tr> </tbody> </table> </div> <!-- /.card-body -->
                              <!-- /.card-body -->
                              <div class="card-footer">
                              </div>
                              <!-- /.card-footer-->
                  </div>
                  <!-- Kimia Klinik End-->
                </div>
                <!-- End Left col -->

                <!-- Right col -->
                <div class="col-md-6">
                  <!-- Imunologi -->
                  <div class="card card-success collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">Form Input Imunologi</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Satuan</th>
                            <th>Normal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Golongan Darah</td>
                            <td><input type="text" class="form-control" name="golongan_darah">
                            </td>
                            <td></td>
                            <td>A - B - O</td>
                          </tr>
                          <tr>
                            <td>Golongan Darah Rhesus</td>
                            <td><input type="text" class="form-control" name="golongan_darah_rhesus">
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>*Sal. Thypi O</td>
                            <td><select class="form-control" id="widal_o" name="widal_o">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>*Sal. Thypi H</td>
                            <td><select class="form-control" name="widal_h">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>*Sal. Thypi B (O)</td>
                            <td><select class="form-control" name="widal_bo">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>*Sal. Thypi A (O)</td>
                            <td><select class="form-control" name="widal_ao">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Anti Dengue - IgG (Rapid Test)</td>
                            <td><select class="form-control" name="AD_IgG">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Anti Dengue - IgM (Rapid Test)</td>
                            <td><select class="form-control" name="AD_IgM">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                  </div>
                  <!-- Imunologi End-->

                  <!-- Tes Kehamilan -->
                  <div class="card card-success collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">Form Input Tes Kehamilan</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Satuan</th>
                            <th>Normal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>VDRL</td>
                            <td><select class="form-control" name="VDRL">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Anti - HIV</td>
                            <td><select class="form-control" name="anti_HIV">
                                <option value="0">Pilih</option>
                                <option value="1">Reaktif</option>
                                <option value="2">Non-Reaktif</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>HBs Ag</td>
                            <td><select class="form-control" name="HBs_Ag">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Anti HBs</td>
                            <td><input type="text" class="form-control" name="anti_HBs">
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                  </div>
                  <!-- Tes Kehamilan End -->

                  <!-- Mikrobiologi -->
                  <div class="card card-success collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">Form Input Mikrobiologi</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>

                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Satuan</th>
                            <th>Normal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Mycobacterium Tuberculosis</td>
                            <td><select class="form-control" name="mycobacterium_tuberculosis">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Mycobacterium Leprae</td>
                            <td><select class="form-control" name="mycobacterium_leprae">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Neisseria Gonnorrhoae</td>
                            <td><select class="form-control" name="neisseria_gonnorrhoae">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Trichomonas Vaginalis</td>
                            <td><select class="form-control" name="trichomonas_vaginalis">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Candida Albicans</td>
                            <td><select class="form-control" name="candida_albicans">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Bacterial Vaginosis</td>
                            <td><select class="form-control" name="bacterial_vaginosis">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                          <tr>
                            <td>Jamur Permukaan</td>
                            <td><select class="form-control" name="jamur_permukaan">
                                <option value="0">Pilih</option>
                                <option value="1">Negative</option>
                                <option value="2">Positive</option>
                              </select>
                            </td>
                            <td></td>
                            <td>Negative</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                  </div>
                  <!-- Mikrobiologi End -->

                  <!-- Elektrolit -->
                  <div class="card card-success collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">Form Input Elektrolit</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Satuan</th>
                            <th>Normal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Natrium</td>
                            <td><input type="text" class="form-control" name="natrium">
                            </td>
                            <td>mmol/L</td>
                            <td>135-155</td>
                          </tr>
                          <tr>
                            <td>Kalium</td>
                            <td><input type="text" class="form-control" name="kalium">
                            </td>
                            <td>mmol/L</td>
                            <td>3.6-5.5</td>
                          </tr>
                          <tr>
                            <td>Chlorida</td>
                            <td><input type="text" class="form-control" name="chlorida">
                            </td>
                            <td>mmol/L</td>
                            <td>96-106</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                  </div>
                  <!-- Elektrolit End-->
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" value="Add" name="submit">Submit</button>
          </div>
      </form>
    </div>
    <!-- End Right col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>