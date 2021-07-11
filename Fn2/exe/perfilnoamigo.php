<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$nombre = $_SESSION['usuario'];
$usuario = $_SESSION['user_id'];


if(isset($_POST['aniade'])){

    $db = new Database();
    $db = $db->connect();
    $sql = "INSERT INTO `solicitudes` (`usuario1`, `usuario2`) VALUES ('$usuario', '$nombre')";
    $db->query($sql);
    header("LOCATION: perfilnoamigo.php");
}

if(isset($_POST['quita'])){

    $db = new Database();
    $db = $db->connect();
    $sql = "DELETE FROM `solicitudes` WHERE `usuario1`='$usuario' AND `usuario2`='$nombre'";
    $db->query($sql);
    header("LOCATION: perfilnoamigo.php");
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
            $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre'";
            $db = new Database();
            $db = $db->connect();
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $name = $row['Nombre'];
            $surname = $row['Apellidos'];
            $img = $row['imagenperfil'];
            $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img'";
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $img = $row['image'];
            ?></p>
    </div>
</div>
<div class="container">
    <div class="main-body">

        <br/><br/><br/><br/><br/>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?php echo $nombre ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $name.' '.$surname?>
                            </div>
                        </div>
                        <hr>
                        <div style="height:200px;width:400px;overflow:auto;">
                            <?php

                            $sql ="SELECT * FROM `formación` WHERE usuario='$nombre' ORDER BY `formación`.`fecha_inicio` DESC";

                            $resul = $db->query($sql);

                            if($resul->num_rows > 0) {

                                $row = $resul->fetch_assoc();

                                    $Ctitulacion = $row['titulacion'];

                                    $Ccentro = $row['centro'];

                                    $sql = "SELECT * FROM centro WHERE idCentro = '$Ccentro'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $centro = $fila['Nombre'];

                                    $sql = "SELECT * FROM titulacion WHERE IdTitulacion = '$Ctitulacion'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $titulacion = $fila['Nombre'];

                                    $datecom = $row['fecha_inicio'];

                                    $datefin = $row['fecha_fin'];

                                    echo '<br/><span style="color:#33ccff;text-align:center;">Estudió en: '.$centro.', se formó en: '. $titulacion .' empezó en: '.$datecom.' y terminó en: '.$datefin.' </span>';

                            }else{

                                echo "<span style='color:#33ccff;text-align:center;'>No tiene formacion añadida</span>";
                            }

                            $sql ="SELECT * FROM experiencia WHERE usuario='$nombre' ORDER BY `experiencia`.`fecha_ini` DESC
";

                            $resul = $db->query($sql);

                            if($resul->num_rows > 0) {

                                    $row = $resul->fetch_assoc();

                                    $Ctitulacion = $row['puesto'];

                                    $Ccentro = $row['empresa'];

                                    $sql = "SELECT * FROM empresa WHERE idEmpresa = '$Ccentro'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $centro = $fila['Nombre'];

                                    $sql = "SELECT * FROM puesto WHERE idPuesto = '$Ctitulacion'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $titulacion = $fila['Nombre'];

                                    $fechaini = $row['fecha_ini'];

                                    $fechafin = $row['fecha_fin'];

                                    echo '<br/><span style="color:#33ccff;text-align:center;">Trabajó en: '.$centro.' en el puesto de: '. $titulacion .' empezó en: '.$fechaini.' y terminó en: '.$fechafin.' </span>';

                            }else{
                                echo '<br/><span style="color:#33ccff;text-align:center;">No tiene experiencia establecida.</span>';
                            }


                            ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                    $sql = "SELECT * FROM solicitudes WHERE usuario1= '$usuario' AND usuario2 = '$nombre'";

                                    $resul = $db->query($sql);

                                    if ($resul->num_rows == 0){
                                    ?>
                                            <form method="post" action="">
                                <input type="submit" class="btn btn-info" value="Añadir amigo" name="aniade">
                                            </form>
                                                <?php

                                    }elseif($resul->num_rows > 0){
                                        ?>
                                        <form method="post" action="">
                                            <input type="submit" class="btn btn-info" value="Cancelar solicitud" name="quita">
                                        </form>
                                        <?php
                                    }

                                ?>
                                <br/>
                                <a class="btn btn-info "  href="./Inicio.php">Volver Inicio</a>
                            </div>
                        </div>
                    </div>

                </div>
                </div>



            </div>
        </div>

    </div>
</div>
</body>
</html>

