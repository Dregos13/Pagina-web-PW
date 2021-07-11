<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$db = new Database();

$db = $db->connect();
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
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
    <form class="box" method="post">
        <a href="./adminpage.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
        <h1>Select the item you want to modify.</h1>

        <input type="submit" name="tit" class="btn btn-primary btn-block btn-large"value="Titulaciones">

        <?php
        if (isset($_POST['tit'])) {

            echo "<select name='titulaciones'>";

            $sql = "SELECT * FROM titulacion";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }

            }

            echo "</select>";
            echo "<input type='submit' name='edit1' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra1' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade1' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit1'])){

            $valor = $_POST['titulaciones'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify1'>";

        }elseif (isset($_POST['borra1'])){

            $valor = $_POST['titulaciones'];

            $sql = "DELETE FROM titulacion WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify1'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `titulacion` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }
        if (isset($_POST['aniade1'])){


            echo "<input type='text' name='new'> <input type='submit' name='create1'>";

        }

        if (isset($_POST['create1'])){


            $item = $_POST['new'];

            $sql = "INSERT INTO titulacion(Nombre) VALUES('$item')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="cen" class="btn btn-primary btn-block btn-large" value="Centros">

        <?php
        if (isset($_POST['cen'])) {

            echo "<select name='centros'>";

            $sql = "SELECT * FROM centro";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit2' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra2' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade2' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit2'])){

            $valor = $_POST['centros'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify2'>";

        }elseif (isset($_POST['borra2'])){

            $valor = $_POST['centros'];

            $sql = "DELETE FROM centro WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify2'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `centro` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }
        if (isset($_POST['aniade2'])){


            echo "<input type='text' name='new'> <input type='submit' name='create2'>";

        }

        if (isset($_POST['create2'])){


            $item = $_POST['new'];

            $sql = "INSERT INTO centro(Nombre) VALUES('$item')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="emp" class="btn btn-primary btn-block btn-large" value="Empresas">

        <?php
        if (isset($_POST['emp'])) {

            echo "<select name='empresa'>";

            $sql = "SELECT * FROM empresa";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit3' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra3' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade3' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit3'])){

            $valor = $_POST['empresa'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify3'>";

        }elseif (isset($_POST['borra3'])){

            $valor = $_POST['empresa'];

            $sql = "DELETE FROM empresa WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify3'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `empresa` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }
        if (isset($_POST['aniade3'])){


            echo "<input type='text' name='new'> <input type='submit' name='create3'>";

        }

        if (isset($_POST['create3'])){


            $item = $_POST['new'];

            $sql = "INSERT INTO empresa(Nombre) VALUES('$item')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="pue" class="btn btn-primary btn-block btn-large" value="Puestos">

        <?php
        if (isset($_POST['pue'])) {

            echo "<select name='puesto'>";

            $sql = "SELECT * FROM puesto";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit4' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra4' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade4' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit4'])){

            $valor = $_POST['puesto'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify4'>";

        }elseif (isset($_POST['borra4'])){

            $valor = $_POST['puesto'];

            $sql = "DELETE FROM puesto WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify4'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `puesto` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }

        if (isset($_POST['aniade4'])){


            echo "<input type='text' name='new'> <input type='submit' name='create4'>";

        }

        if (isset($_POST['create4'])){


            $item = $_POST['new'];

            $sql = "INSERT INTO puesto(Nombre) VALUES('$item')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="pai" class="btn btn-primary btn-block btn-large" value="Pais">

        <?php
        if (isset($_POST['pai'])) {

            echo "<select name='pais'>";

            $sql = "SELECT * FROM pais";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit5' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra5' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade5' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit5'])){

            $valor = $_POST['pais'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify4'>";

        }elseif (isset($_POST['borra5'])){

            $valor = $_POST['puesto'];

            $sql = "DELETE FROM pais WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify5'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `pais` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }

        if (isset($_POST['aniade5'])){


            echo "<input type='text' name='new'> <input type='submit' name='create5'>";

        }

        if (isset($_POST['create5'])){


            $item = $_POST['new'];

            $sql = "SELECT * FROM `pais` ORDER BY `IdPais` DESC";

            $equiv = $db->query($sql);

            $row = $equiv->fetch_assoc();

            $id = $row['IdPais'] + 1;

            $sql = "INSERT INTO pais(Nombre,IdPais) VALUES('$item','$id')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="pro" class="btn btn-primary btn-block btn-large" value="Provincia">

        <?php
        if (isset($_POST['pro'])) {

            echo "<select name='provincia'>";

            $sql = "SELECT * FROM provincia";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit6' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra6' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade6' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit6'])){

            $valor = $_POST['provincia'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify6'>";

        }elseif (isset($_POST['borra6'])){

            $valor = $_POST['provincia'];

            $sql = "DELETE FROM provincia WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify6'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `provincia` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }

        if (isset($_POST['aniade6'])){

            echo "<select name='paispro'>";

            $sql = "SELECT * FROM pais";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    $id = $row['IdPais'];

                    echo "<option value='$id'>$titu</option>";

                }
            }

            echo "</select>";

            echo "<input type='text' name='new'> <input type='submit' name='create6'>";

        }

        if (isset($_POST['create6'])){

            $idpais = $_POST['paispro'];

            $item = $_POST['new'];

            echo $idpais." ".$item;

            $sql = "SELECT * FROM `provincia` ORDER BY `provincia`.`idProvincia` DESC ";

            $prov = $db->query($sql);

            $idprovi = $prov->fetch_assoc();

            $id = $idprovi['idProvincia'] + 1;

            $sql = "INSERT INTO provincia(Nombre,idPais,idProvincia) VALUES('$item','$idpais','$id')";

            $db->query($sql);

        }
        ?>

        <input type="submit" name="loc" class="btn btn-primary btn-block btn-large" value="Localidad">

        <?php
        if (isset($_POST['loc'])) {

            echo "<select name='localidad'>";

            $sql = "SELECT * FROM localidad";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    echo "<option>$titu</option>";

                }
            }

            echo "</select>";
            echo "<input type='submit' name='edit7' style='background-color: #33ccff; border: unset' value='Editar'>";
            echo "<input type='submit' name='borra7' style='background-color: #b92b27; border: unset' value='Eliminar'>";
            echo "<input type='submit' name='aniade7' style='background-color: #2ecc71; border: unset' value='Añadir'>";

        }

        if (isset($_POST['edit7'])){

            $valor = $_POST['localidad'];

            $_SESSION['old'] = $valor;

            echo "Introduce un nuevo valor para $valor <input type='text' name='new'> <input type='submit' name='modify6'>";

        }elseif (isset($_POST['borra7'])){

            $valor = $_POST['localidad'];

            $sql = "DELETE FROM provincia WHERE Nombre = '$valor'";

            $db->query($sql);

            echo "$valor ha sido eliminada";
        }

        if (isset($_POST['modify7'])){

            $newvalue = $_POST['new'];

            $valor = $_SESSION['old'];

            $sql = "UPDATE `localidad` SET `Nombre` = '$newvalue' WHERE `Nombre` = '$valor'";

            $db->query($sql);

        }

        if (isset($_POST['aniade7'])){

            echo "<select name='provincialo'>";

            $sql = "SELECT * FROM provincia";

            $resul =$db->query($sql);

            if ($resul->num_rows > 0){

                while ($row = $resul->fetch_assoc()){

                    $titu = $row['Nombre'];

                    $id = $row['idProvincia'];

                    echo "<option value='$id'>$titu</option>";

                }
            }

            echo "</select>";

            echo "<input type='text' name='new'> <input type='submit' name='create7'>";

        }

        if (isset($_POST['create7'])){

            $idpais = $_POST['provincialo'];

            $item = $_POST['new'];

            echo $idpais." ".$item;

            $sql = "INSERT INTO localidad(Nombre,idProvincia) VALUES('$item','$idpais')";

            $db->query($sql);

        }
        ?>

    </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>