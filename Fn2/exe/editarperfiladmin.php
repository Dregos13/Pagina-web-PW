<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$nombre = $_SESSION['usuario'];
$sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre'";
$db = new Database();
$db = $db->connect();
$resul = $db->query($sql);
$row = $resul->fetch_assoc();
$img = $row['imagenperfil'];
$name = $row['Nombre'];
$correo = $row['Correo'];
$surname = $row['Apellidos'];
$bday = $row['FechaNacimiento'];
$sql = "SELECT * FROM imagenes WHERE idImagenes = '$img'";
$resul = $db->query($sql);
$row = $resul->fetch_assoc();
$img = $row['image'];


if (isset($_POST['modificar'])){

    $name = $_POST['nombre'];
    $surname = $_POST['surname'];
    $bday = $_POST['bday'];

    $sql = "UPDATE `usuario` SET `Correo` = '$correo',`Nombre`='$name',`Apellidos`='$surname',FechaNacimiento = '$bday' WHERE `usuario`.`NombreUsuario` = '$nombre'";
    $db->query($sql);
}

if (isset($_POST['imgp'])){

    header("Location: admin_cambiar_subir_foto.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Gestión del perfil.</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body>
<div style="position: absolute;right: 0px;">
    <div style="background: #c0c0c0">
        <p><?php
            echo "admin";
            ?></p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
    <form class="box" method="post">
        <a href="./adminbuscador.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
        <h1>Select the item you want to modify.</h1>

        <input type="text" name="surname" class="btn btn-primary btn-block btn-large" value="<?php echo $surname ?>">

        <input type="text" name="nombre" class="btn btn-primary btn-block btn-large" value="<?php echo $name ?>">

        <input type="date" name="bday" value="<?php echo $bday ?>">

        <input type="submit" name="modificar" class="btn btn-primary btn-block btn-large"value="Modificar">

        <input type="submit" name="imgp" class="btn btn-primary btn-block btn-large" value="Imagen de perfil">

    </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

