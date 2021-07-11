<?php
if (isset($_POST['provincia'])) {
   
    $id = trim($_POST['provincia']);

    //Cambia por los detalles de tu base datos
    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "fn";
    $conexion = new mysqli($dbserver, $dbuser, $password, $dbname);
    if($conexion->connect_errno) {
                die("No se pudo conectar a la base de datos");
    }

    $sql = "SELECT * FROM localidad WHERE idProvincia = $id";
    $municipiosStmt = $conexion->query($sql);
     
    $municipios = array(); 
    while($row = mysqli_fetch_assoc($municipiosStmt)) {
        $municipio = array('id'=> utf8_encode($row['idLocalidad']), 'nombre'=> $row['Nombre']);
        $municipios[] = $municipio;
    } 

    $conexion->close();

    $json_string = json_encode($municipios);
    echo $json_string;
}
?>