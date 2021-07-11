<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$nombre = $_SESSION['user_id'];
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
$local = $row['localidad'];
$sql = "SELECT * FROM imagenes WHERE idImagenes = '$img'";
$resul = $db->query($sql);
$row = $resul->fetch_assoc();
$img = $row['image'];
$sql = "SELECT * FROM localidad WHERE idLocalidad = '$local'";
$localidad = $db->query($sql);
$loc = $localidad->fetch_assoc();
$prov = $loc['idProvincia'];
$sql = "SELECT * FROM provincia WHERE idProvincia = '$prov'";
$provin = $db->query($sql);
$country = $provin->fetch_assoc();
$pais = $country['idPais'];


if (isset($_POST['modificar'])){

    $name = $_POST['nombre'];
    $surname = $_POST['surname'];
    $bday = $_POST['bday'];
    $localidad = $_POST['local'];

    $sql = "UPDATE `usuario` SET `Correo` = '$correo',`Nombre`='$name',`Apellidos`='$surname',FechaNacimiento = '$bday', localidad = '$localidad' WHERE `usuario`.`NombreUsuario` = '$nombre'";
    $db->query($sql);
    header("Location: gestionPerfil.php");
}

if (isset($_POST['exp'])){

    header("Location: modificar_formacion.php");

}

if (isset($_POST['contrasenia'])){

    header("LOCATION: cambiar_pass.php");
}

if (isset($_POST['imgp'])){

    header("Location: cambiar_subir_foto.php");

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
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
</head>
<body>
<div style="position: absolute;right: 0px;">
    <div style="background: #c0c0c0">
        <p><?php

            echo $nombre;
            ?></p>
        <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
    <form class="box" method="post">
        <a href="./Perfil.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
        <h1>Select the item you want to modify.</h1>

        <input type="text" name="surname" class="btn btn-primary btn-block btn-large" value="<?php echo $surname ?>">

        <input type="text" name="nombre" class="btn btn-primary btn-block btn-large" value="<?php echo $name ?>">

        <input type="date" name="bday" value="<?php echo $bday ?>">

        <select id="pais" class="select" onChange="javascript:cargaProvincia()">
            <?php
            //Cambia por los detalles de tu base datos
            $db = new Database();
            $db = $db->connect();

            $sql = "SELECT * FROM pais ORDER BY Nombre ASC";
            $pp = $db->query($sql);

            while ($row = $pp->fetch_assoc()) {
                echo '<option value="' . $row['IdPais'] . '" '.($row['IdPais']==$pais?"selected":"").'>' . $row['Nombre'] . '</option>';

            }
            $db->close();
            ?>
        </select>

        <select id="provincia" class="select" onChange="javascript:cargaMunicipios()">
            <?php
            //Cambia por los detalles de tu base datos
            $db = new Database();
            $db = $db->connect();

            $sql = "SELECT * FROM provincia ORDER BY Nombre ASC";
            $pr = $db->query($sql);

            while ($row = $pr->fetch_assoc()) {
                echo '<option value=' . $row['idProvincia'] . ' '.($row['idProvincia']==$prov?"selected":"").'>' . $row['Nombre'] . '</option>';

            }
            $db->close();
            ?>
        </select>

        <select name="local" id="municipio" class="select" >
            <?php
            //Cambia por los detalles de tu base datos
            $db = new Database();
            $db = $db->connect();

            $sql = "SELECT * FROM localidad ORDER BY Nombre ASC";
            $pr = $db->query($sql);

            while ($row = $pr->fetch_assoc()) {
                echo '<option value=' . $row['idLocalidad'] . ' '.($row['idLocalidad']==$local?"selected":"").'>' . $row['Nombre'] . '</option>';

            }
            $db->close();
            ?>
        </select>

        <input type="submit" name="modificar" class="btn btn-primary btn-block btn-large"value="Modificar">

        <input type="submit" name="exp" class="btn btn-primary btn-block btn-large" value="Formacion/Experiencia laboral">

        <input type="submit" name="contrasenia" class="btn btn-primary btn-block btn-large" value="Contrasenia">

        <input type="submit" name="imgp" class="btn btn-primary btn-block btn-large" value="Imagen de perfil">

    </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

