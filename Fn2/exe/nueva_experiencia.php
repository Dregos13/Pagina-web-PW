<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

if (isset($_POST['Subir'])){
    $usuario = $_SESSION['user_id'];
$lugar = $_POST['centro'];
$titulacion = $_POST['formacion'];
$fechaini = $_POST['dateini0'];
$fechafin = $_POST['datefin0'];

$db = new Database();
$db = $db->connect();

$sql = "SELECT * FROM empresa WHERE Nombre = '$lugar'";
$resul = $db->query($sql);
if($resul->num_rows == 0) {
    $sql = "INSERT INTO empresa (`Nombre`) VALUES ('$lugar')";
    $db->query($sql);
    $sql = "SELECT * FROM empresa WHERE Nombre = '$lugar'";
    $resul = $db->query($sql);
    $row = $resul->fetch_assoc();
    $lugar = $row['idEmpresa'];
}else{
    $row = $resul->fetch_assoc();
    $lugar = $row['idEmpresa'];
}


$sql = "SELECT * FROM puesto WHERE Nombre = '$titulacion'";
$resul = $db->query($sql);
if($resul->num_rows == 0) {
    $sql = "INSERT INTO puesto (`Nombre`) VALUES ('$titulacion')";
    $db->query($sql);
    $sql = "SELECT * FROM puesto WHERE Nombre = '$titulacion'";
    $resul = $db->query($sql);
    $row = $resul->fetch_assoc();
    $titulacion = $row['idPuesto'];
}else{
    $row = $resul->fetch_assoc();
    $titulacion = $row['idPuesto'];
}

$sql = "INSERT INTO `experiencia` (`usuario`, `puesto`, `empresa`, `fecha_ini`, `fecha_fin`)  VALUES ('$usuario', '$titulacion', '$lugar', '$fechaini','$fechafin')";
if($db->query($sql)){
    header("LOCATION: modificar_formacion.php");
}
}


?>

<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Gestión de la experiencia.</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script type="text/javascript" src="../js/functions.js"></script>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" action="" class="box">
                    <h1>Nombre de la empresa y puesto</h1>
                    <input type="text" name="centro" placeholder="Empresa" required>
                    <input type="text" name="formacion" placeholder="Puesto" required>
                    <span style="color:#33ccff;text-align:center;">Fecha inicio
                    <input type="date" name="dateini0"><br/>

                    <span style="color:#33ccff;text-align:center;">Fecha fin
                    <input type="date" name="datefin0">
                    <br/>
                        <input type="submit" value="Subir" name="Subir">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

