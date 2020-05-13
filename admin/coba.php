<html>

<head>

</head>

<body>
    <select id="parameter" onchange="rubah()">
        <option value="">==Pilih==</option>
        <option value="parameter">Parameter</option>
        <option value="paket">Paket</option>
        <option value="penyakit">Penyakit</option>
    </select>
    <input type="text" id="keren">
</body>
<script>
    function rubah() {
        var angka = document.getElementById("parameter");
        var output = angka.options[angka.selectedIndex].value;
        document.getElementById("keren").value = output;
    }
</script>

</html>