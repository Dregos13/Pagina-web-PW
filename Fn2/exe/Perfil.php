<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

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
            $nombre = $_SESSION['user_id'];
            $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre'";
            $db = new Database();
            $db = $db->connect();
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $name = $row['Nombre'];
            $mail = $row['Correo'];
            $surname = $row['Apellidos'];
            $bday = $row['FechaNacimiento'];
            $local = $row['localidad'];
            $local1 = $row['localidad'];
            $img = $row['imagenperfil'];
            $sql = "SELECT * FROM localidad WHERE idLocalidad='$local'";
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $local = $row['Nombre'];

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
                                <a href="conversation.php" style="border: #44BCDD; background-color: #3B5998; border-radius: 10%; width: 40px; color: white">Chat</a>
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
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $mail?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Fecha Nacimiento</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $bday?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Localidad</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php
                                echo $local;
                                $sql = "SELECT * FROM localidad WHERE idLocalidad='$local1'";
                                $resul = $db->query($sql);
                                $row = $resul->fetch_assoc();
                                $provincia = $row['idProvincia'];
                                $sql = "SELECT * FROM provincia WHERE idProvincia='$provincia'";
                                $resul = $db->query($sql);
                                $row = $resul->fetch_assoc();
                                $provincia = $row['Nombre'];
                                $pais = $row['idPais'];
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Provincia</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $provincia?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Pais</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php
                                $sql = "SELECT * FROM pais WHERE IdPais='$pais'";
                                $resul = $db->query($sql);
                                $row = $resul->fetch_assoc();
                                $pais = $row['Nombre'];
                                echo $pais;
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Amigos</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <form method="post">

                                <input type="submit" name="muestra" value="Muestra amigos">
                            </form>
                                <?php

                                if (isset($_POST['muestra'])){

                                    $sql = "SELECT * FROM amistad WHERE usuario1 = '$nombre' OR usuario2 = '$nombre'";

                                    $amigos = $db->query($sql);

                                    while ($ami = $amigos->fetch_assoc()){

                                        if ($ami['usuario1'] == $nombre){

                                            $amigo = $ami['usuario2'];

                                            echo "<p>$amigo</p>";

                                        }elseif($ami['usuario2'] == $nombre){


                                            $amigo = $ami['usuario1'];

                                            echo "<p>$amigo</p>";

                                        }
                                    }

                                }

                                ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info "  href="./gestionPerfil.php">Editar Perfil</a>
                                <a class="btn btn-info "  href="./solicitudes.php">Ver solicitudes</a>
                                <a class="btn btn-info "  href="./Inicio.php">Volver Inicio</a>
                                <a class="btn btn-info "  href="./cierra.php">Cerrar sesion</a>
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

