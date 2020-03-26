<?php
require_once("koneksi.php");
$db_handle = new Koneksi();
$result = $db_handle->runQuery("SELECT * FROM tbl_penanggungjawab_lab");
$result2 = $db_handle->runQuery("SELECT * FROM tbl_petugas");
ob_start();
?>
<html>
<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
<table border="0" width="100%">
  <tr>
    <th>
      <h4>Pemerintah Kabupaten Bondowoso</h4>
    </th>
  </tr>
  <tr>
    <th>
      <h4>DINAS KESEHATAN</h4>
    </th>
  </tr>
  <tr>
    <th>
      <h2>PUSKESMAS SUKOSARI</h2>
    </th>
  </tr>
  <tr>
    <th>
      <h4>Jl. Raya Kawah Ijen No. 53 Sukosari - Bondowoso</h4>
    </th>
  </tr>
</table>
<hr />
<br />
<table border="1" width="100%" style="margin-top:-12; text-align:left">
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td></td>
    <td>No.KTP/REG</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>Umur</td>
    <td>:</td>
    <td></td>
    <td>Tanggal</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td></td>
    <td>Atas Permintaan</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>Diagnosa</td>
    <td>:</td>
    <td></td>
    <td style=>JAM SAMPEL DITERIMA / SELESAI DIKERJAKAN</td>
    <td>:</td>
    <td></td>
  </tr>
</table>
<br />
<table border=1 style="width:100%">
  <tr>
    <th>PEMERIKSAAN</th>
    <th>HASIL</th>
    <th>NORMAL</th>
    <th>PEMERIKSAAN</th>
    <th>HASIL</th>
    <th>NORMAL</th>
  </tr>
  <tr>
    <td><b>Hematologi</td>
    <td></td>
    <td></td>
    <td><b>Kimia Klink</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Hemoglobin</td>
    <td>g/dl</td>
    <td>P : 13,5-17,5 W : 12-16</td>
    <td>Bilirubin Direct</td>
    <td>mg/dl</td>
    <td>0.1-0.3</td>
  </tr>
  <tr>
    <td>LED</td>
    <td>mm/jam</td>
    <td>P : 0-15 W : 0-20</td>
    <td>Bilirubin Total</td>
    <td>mg/dl</td>
    <td>0.1-0.3</td>
  </tr>
  <tr>
    <td>Hitung Eritrosit</td>
    <td>10/ul</td>
    <td>P : 4,5-5,9 W : 4,0-5,2</td>
    <td>SGOT (Opt. 37 C)</td>
    <td>IU/I</td>
    <td>P : < 35 W : < 31</td> </tr> <tr>
    <td>Hitung Leukosit</td>
    <td>/ul</td>
    <td>4.000-10.000</td>
    <td>SGPT (Opt. 37 C)</td>
    <td>IU/I</td>
    <td>P : < 40 W : < 31</td> </tr> <tr>
    <td>Hitung Trombosit</td>
    <td>/ul</td>
    <td>150.000-400.000</td>
    <td>Alkali Phospatase (Opt. 37 C)</td>
    <td>IU/I</td>
    <td>P : 53-128 W : 42-141</td>
  </tr>
  <tr>
    <td>Hematocrit</td>
    <td>%</td>
    <td>P : 40-48 W : 37-43</td>
    <td>Total Protein</td>
    <td>mg/dl</td>
    <td>6.0-8.0</td>
  </tr>
  <tr>
    <td rowspan=2>Hitung Jenis Leukosit</td>
    <td>Eos/Baso/Stab/Seg/Lympo/Mono</td>
    <td rowspan=2>1-3/0-1/2-6/50-70/20-40/2-8</td>
    <td>Albumin</td>
    <td>mg/dl</td>
    <td>3.5-5.5</td>
  </tr>
  <tr>
    <td>/ / / / /</td>
    <td>Globulin</td>
    <td>mg/dl</td>
    <td>2.0-3.6</td>
  </tr>
  <tr>
    <td>MCV</td>
    <td>fL</td>
    <td>78-102</td>
    <td>Gula Darah Puasa</td>
    <td>mg/dl</td>
    <td>70-110</td>
  </tr>
  <tr>
    <td>MCH</td>
    <td>pg/cell</td>
    <td>26-34</td>
    <td>Gula Darah 2 Jam PP</td>
    <td>mg/dl</td>
    <td>70-125</td>
  </tr>
  <tr>
    <td>MCHC</td>
    <td>g/dl</td>
    <td>31-37</td>
    <td>Gula Darah Sewaktu</td>
    <td>mg/dl</td>
    <td>70-140</td>
  </tr>
  <tr>
    <td>Masa Pendarahan</td>
    <td>Menit</td>
    <td>1,0-3,0</td>
    <td>Kreatinin</td>
    <td>mg/dl</td>
    <td>P : 0.6-1.3 W : 0.5-1.1</td>
  </tr>
  <tr>
    <td>Masa Pembekuan</td>
    <td>Menit</td>
    <td>5,0-15</td>
    <td>Ureum</td>
    <td>mg/dl</td>
    <td>15-38</td>
  </tr>
  <tr>
    <td><b>URINALISA</td>
    <td></td>
    <td></td>
    <td>Uric Acid</td>
    <td>mg/dl</td>
    <td>P : 3.4-7.0 W : 2.4-5.7</td>
  </tr>
  <tr>
    <td>Makroskopis</td>
    <td></td>
    <td></td>
    <td>Cholesterol Total</td>
    <td>mg/dl</td>
    <td>
      < 200</td> </tr> <tr>
    <td>Protein</td>
    <td></td>
    <td>Negatif</td>
    <td>Trigliserida</td>
    <td>mg/dl</td>
    <td>
      < 150</td> </tr> <tr>
    <td>Glukosa</td>
    <td></td>
    <td>Negatif</td>
    <td>HDL-Cholesterol</td>
    <td>mg/dl</td>
    <td>35-55</td>
  </tr>
  <tr>
    <td>Urobilinogen</td>
    <td></td>
    <td>Negatif</td>
    <td>LDL-Cholesterol</td>
    <td></td>
    <td>
      <150</td> </tr> <tr>
    <td>Billirubin</td>
    <td></td>
    <td>Negatif</td>
    <td><b>IMUNOLOGI</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Nitrit</td>
    <td></td>
    <td>Negatif</td>
    <td>Golongan Darah</td>
    <td></td>
    <td>A - B - O</td>
  </tr>
  <tr>
    <td>Keton</td>
    <td></td>
    <td>Negatif</td>
    <td>Gol. Darah Rhesus</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Berat Jenis</td>
    <td></td>
    <td>1.005-1.030</td>
    <td>Widal Slide :</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>PH</td>
    <td></td>
    <td>5.0-8.0</td>
    <td>*Sal. Thypi O</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>Sediment : </td>
    <td></td>
    <td></td>
    <td>*Sal. Thypi H</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Eritrosit</td>
    <td>/LPB</td>
    <td>
      < 3</td> <td>*Sal. Thypi B (O)
    </td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Leukosit</td>
    <td>/LPB</td>
    <td>
      < 5</td> <td>*Sal. Thypi A (O)
    </td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Epithel</td>
    <td>/LPB</td>
    <td>
      < 5</td> <td>Anti Dengue - IgG (Rapid Test)
    </td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Kristal</td>
    <td></td>
    <td>Negatif</td>
    <td>TES KEHAMILAN</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>VDRL</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Lain-Lain</td>
    <td></td>
    <td>Negatif</td>
    <td>Anti - HIV</td>
    <td></td>
    <td>Non Reaktif</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>HBs Ag</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td><b>PARASITOLOGI</td>
    <td></td>
    <td></td>
    <td>Anti HBs</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Faeces : -Makroskopis</td>
    <td></td>
    <td></td>
    <td><b>MIKROBIOLOGI</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Mikroskopis :</td>
    <td></td>
    <td></td>
    <td>Mycobacterium Tuberculosis</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Eritrosit</td>
    <td></td>
    <td>Negatif</td>
    <td>Mycobacterium Leprae</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*Leukosit</td>
    <td></td>
    <td>Negatif</td>
    <td>Neisseria Gonnorrhoae</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>*T. Cacing</td>
    <td></td>
    <td>Negatif</td>
    <td>Trichomonas Vaginalis</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Candida Albicans</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>Lain-Lain</td>
    <td></td>
    <td>Negatif</td>
    <td>Bacterial Vaginosis</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Jamur Permukaan</td>
    <td></td>
    <td>Negatif</td>
  </tr>
  <tr>
    <td>Darah Samar</td>
    <td></td>
    <td>Negatif</td>
    <td><b>ELEKTROLIT</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Malaria</td>
    <td></td>
    <td>Negatif</td>
    <td>Natrium</td>
    <td>mmol/L</td>
    <td>135-155</td>
  </tr>
  <tr>
    <td>Mikrofilaria</td>
    <td></td>
    <td>Negatif</td>
    <td>Kalium</td>
    <td>mmol/L</td>
    <td>3.6-5.5</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Chlorida</td>
    <td>mmol/L</td>
    <td>96-106</td>
  </tr>
</table>
<br />
<table style=width:100%>
  <tr>
    <td>Catatan:</td>
    <td style="text-align:center">Penanggungjawab Laboratorium</td>
    <td style="text-align:center;">Pemeriksa</td>
  </tr>
  <tr>
    <td></td>
    <td style="text-align:center"><?php echo $result[0]["nama"]; ?></td>
    <td style="text-align:center"><?php echo $result2[0]["nama"]; ?></td>
  </tr>
  <tr>
    <td></td>
    <td style="text-align:center"><?php echo $result[0]["nip"]; ?></td>
    <td style="text-align:center"><?php echo $result2[0]["nip"]; ?></td>
  </tr>
</table>

</html>
<?php
$content = ob_get_contents();
ob_end_clean();
require_once "./mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
$mpdf->WriteHTML($content);
$mpdf->Output();
