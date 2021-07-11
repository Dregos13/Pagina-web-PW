<html>
<head>
<meta charset="utf-8">
<title>Ejemplo AJAX Jquery Mysql</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script>
function cargaMunicipios(){
    $.ajax({
            type: "POST",
            url: 'cargaMunicipios.php',
            data: { 'provincia': $("#provincia").val() },
            dataType:'json',
            beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
            success: function(data) {
               $("#resultado").html("Listo!!");

               var select = $("#municipio"), options = '';
               select.empty();      

               for(var i=0;i<data.length; i++)
               {
                    options += "<option value='"+data[i].id+"'>"+ data[i].nombre +"</option>";              
               }

               select.append(options);
            }
        });
}
</script>

</head>
<body>
<br/>
Provincia:
<select id="provincia" onChange="javascript:cargaMunicipios()">
<?php 
    //Cambia por los detalles de tu base datos
  $dbserver = "localhost";
  $dbuser = "pw";
  $password = "pw";
  $dbname = "pw";
  $conexion = new mysqli($dbserver, $dbuser, $password, $dbname);
  $conexion->query("SET NAMES 'utf8'");
  if($database->connect_errno) {
                die("No se pudo conectar a la base de datos");
  }
  
  $sql = "SELECT * FROM provincias ORDER BY provincia ASC";
  $provincias = $conexion->query($sql);
     
  while ($row = $provincias->fetch_assoc()) {
      echo '<option value="' . $row['id_provincia'] . '" >' . $row['provincia'] . '</option>';
  }
  $conexion->close();
?>
</select>
<br/>
Municipio:
<select id="municipio">
    <option>Vacio</option>
</select>
<span id="resultado"></span>
</body>
</html>