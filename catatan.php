Array (
[0] => Array ( [0] => Paul [1] => paul1 )
[1] => Array ( [0] => Paul [1] => paul2 )
[2] => Array ( [0] => Mark [1] => mark1 )
[3] => Array ( [0] => Mark [1] => mark2 )
[4] => Array ( [0] => Ojan [1] => Ojan1 )
[5] => Array ( [0] => Ojan [1] => Ojan2 )
[6] => Array ( [0] => Ojan [1] => Ojan3 )
)
Array (
[0] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b03296f9 [id_param] => 6dh1U7Ds9Ag13 [hasil] => 1 [nama_param] => Hemoglobin [satuan] => g/dl [nilai_rujukan] => P : 13,5-17,5 W : 12-16 [metoda] => [harga] => )
[1] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b03296f9 [id_param] => hd82GY7sAAA9i [hasil] => 2 [nama_param] => LED [satuan] => mm/jam [nilai_rujukan] => P : 0-15 W : 0-20 [metoda] => [harga] => )
[2] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b0c22188 [id_param] => 7hjJDL8A4Bbd9 [hasil] => 3 [nama_param] => Protein [satuan] => [nilai_rujukan] => Negatif [metoda] => [harga] => )
[3] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b0c22188 [id_param] => 7hjDWL8A4Bbd9 [hasil] => 4 [nama_param] => Glukosa [satuan] => [nilai_rujukan] => Negatif [metoda] => [harga] => )
[4] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b03296f9 [id_param] => 5e7cbaf8f32fd [hasil] => 5 [nama_param] => Hitung Eritrosit [satuan] => /ul [nilai_rujukan] => P : 4,5-5,9 W : 4,0-5,2 [metoda] => [harga] => )
[5] => Array ( [id_pendaftaran] => 5e8e8e9f1f6d5 [waktu_input] => 2020-04-09 10:30:00 [id_paket] => 5e858b03296f9 [id_param] => 5e7cbc52bc7c4 [hasil] => 6 [nama_param] => Hitung Leukosit [satuan] => /ul [nilai_rujukan] => 4.000-10.000 [metoda] => [harga] => )
)
Array (
[0] => Array ( [0] => Paul [1] => 5 [2] => Jember )
[1] => Array ( [0] => Paul [1] => 3 [2] => Bondowoso )
[2] => Array ( [0] => Mark [1] => 6 [2] => Surabaya )
[3] => Array ( [0] => Mark [1] => 4 [2] => Malang )
[4] => Array ( [0] => Ojan [1] => 5 [2] => Situbondo )
[5] => Array ( [0] => Ojan [1] => 5 [2] => Mojokerto )
[6] => Array ( [0] => Ojan [1] => 3 [2] => Jombang )
)
Array (
[Paul] => Array ( [0] => 5 [1] => 3 )
[Mark] => Array ( [0] => 6 [1] => 4 )
[Ojan] => Array ( [0] => 5 [1] => 5 [2] => 3 )
)

$name_holder = null;
for($i=0;$i<count($data);$i++) {
    if($name_holder != $data[$i]->name){
        $name_holder = $data[$i]->name;
        echo "<tr><td colspan='2'>Name: " . $name_holder . "</td></tr>"
    }

    echo "<tr>";
    echo "<td align='left'>".$data[$i]->hour."</td>";
    echo "<td align='left'>edit</td>";
    echo "</tr>";
}


$name_holder = null;
for($i=0;$i<count($data);$i++) {
    if($name_holder != $data[$i]->name){
        $name_holder = $data[$i]->name;
        //not sure what to do here??
    }

    echo "<tr>";
    echo "<td align='left'>".$data[$i]->name."</td>";
    echo "<td align='left'>".$data[$i]->hour."</td>";
    echo "</tr>";
}

