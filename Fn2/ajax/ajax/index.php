<html>
<head>
<script>
function muestra(str) {
    if (str.length == 0) { 
        document.getElementById("txt").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txt").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "getNombres.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<p><b>Escribe el principio de un nombre:</b></p>
<form> 
Nombre: <input type="text" onkeyup="muestra(this.value)">
</form>
<p>Sugerencia: <span id="txt"></span></p>
</body>
</html>