<?php
session_start();
require_once("../DB/connect.php ");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$db = new Database();

$db = $db->connect();

$usuario = $_SESSION['user_id'];

if (isset($_POST['subir'])){

    $usuarios = array();

    $date = date('Y-m-d');

    if (isset($_POST['check_list'])) {

        foreach ($_POST['check_list'] as $selected) {

            $usuarios[] = $selected;

        }

    }

        $comentario = $_POST['comentario'];

        if ($_FILES['Imagen']['tmp_name'] != null) {

            echo "aqui entra lol";

            $Imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

            $sql = "INSERT INTO `publi` (`autor`, `Contenido`, `imagen`,`date`) VALUES ('$usuario', '$comentario', '$Imagen','$date')";

            $db->query($sql);

            $sql = "INSERT INTO imagenes(Nombre,image,owner) VALUES('publi','$Imagen','$usuario')";

            $db->query($sql);

            if ($usuarios != null) {

                $sql = "SELECT * FROM `publi` WHERE `autor`='$usuario' ORDER BY `publi`.`id` DESC";

                $publicacion = $db->query($sql);

                $publicacion = $publicacion->fetch_assoc();

                $idpubli = $publicacion['id'];

                foreach ($usuarios as $valor) {

                    $sql = "INSERT INTO `listareferencias` (`usuario`, `publicaion`) VALUES ('$valor', '$idpubli')";

                    $db->query($sql);
                }
            }

            header("LOCATION: Inicio.php");

        } else {

            $sql = "INSERT INTO `publi` (`autor`, `Contenido`, `date`) VALUES ('$usuario', '$comentario','$date')";

            $db->query($sql);

            if ($usuarios != null) {

                $sql = "SELECT * FROM `publi` WHERE `autor`='$usuario' ORDER BY `publi`.`id` DESC";

                $publicacion = $db->query($sql);

                $publicacion = $publicacion->fetch_assoc();

                $idpubli = $publicacion['id'];

                foreach ($usuarios as $valor) {

                    $sql = "INSERT INTO `listareferencias` (`usuario`, `publicaion`) VALUES ('$valor', '$idpubli')";

                    $db->query($sql);
                }
            }
            header("LOCATION: Inicio.php");
        }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Crear publicación</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type='text/javascript'></script>
    <link rel="stylesheet" type="text/css" href="./../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div style="position: absolute;right: 0px;">
    <div style="background: #c0c0c0">
        <a href="Perfil.php"><?php
            $nombre = $_SESSION['user_id'];
            $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre'";
            $db = new Database();
            $db = $db->connect();
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $img = $row['imagenperfil'];
            $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img'";
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $img = $row['image'];
            echo $nombre;
            ?></a>
        <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post" enctype="multipart/form-data">
                    <a href="./Inicio.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
                    <h1>Introduce tu publicación</h1>
                    <input type="text" name="comentario" placeholder="Escribe algo." required>
                    <input type="file" style="color: gray" name="Imagen">
                    <div style="height:100px;width:400px;overflow:auto;">

                        <?php

                        $sql = "SELECT * FROM amistad WHERE usuario1 ='$usuario' OR usuario2 = '$usuario'";

                        $amigos = $db->query($sql);

                        if ($amigos->num_rows > 0){

                        while ($datos = $amigos->fetch_assoc()) {

                            if($datos['usuario1'] != $usuario){

                                $amigo = $datos['usuario1'];

                                echo "<input type='checkbox' name='check_list[]' value='$amigo'> <label style='color: #33ccff'> $amigo</label><br/>";
                            }


                            if($datos['usuario2'] != $usuario){

                                $amigo = $datos['usuario2'];
                                echo "<input type='checkbox' name='check_list[]' value='$amigo'> <label style='color: #33ccff'> $amigo</label><br/>";


                            }

                        }


                        }

                        ?>
                    </div>
                    <input type="submit" name="subir">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>