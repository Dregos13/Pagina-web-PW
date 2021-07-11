<?php
if (isset($_POST['pais'])) {
   
    $id = trim($_POST['pais']);

    //Cambia por los detalles de tu base datos
    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "fn";
    $conexion = new mysqli($dbserver, $dbuser, $password, $dbname);
    if($conexion->connect_errno) {
                die("No se pudo conectar a la base de datos");
    }

    $sql = "SELECT * FROM provincia WHERE idPais = $id";
    $municipiosStmt = $conexion->query($sql);
     
    $municipios = array(); 
    while($row = mysqli_fetch_assoc($municipiosStmt)) {
        $municipio = array('id'=> utf8_encode($row['idProvincia']), 'nombre'=> $row['Nombre']);
        $municipios[] = $municipio;
    } 

    $conexion->close();

    $json_string = json_encode($municipios);
    echo $json_string;
}
?>