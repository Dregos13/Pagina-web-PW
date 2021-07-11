<?php
session_start();
require_once('../DB/connect.php');
require_once('../class/Usuario.php');
if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}
?>
    <!doctype html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Cambiar Contrasenia</title>
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
                        <h1>Modify Password.</h1>
                        <p class="text-muted"> Introduce the new date</p> <input type="submit" name="actualiza" value="Change" href="#"><input type="password" href ="#" name="contra1"><input type="password" href ="#" name="contra2"><input type="submit" value="Atras" name="volver">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

<?php

if (isset($_POST['volver'])) {

    header("Location: gestionPerfil.php");
}


if (isset($_POST['actualiza'])) {

    $contra = $_POST['contra1'];

    $contra2 = $_POST['contra2'];

    $usuario = $_SESSION['user_id'];

    if($contra == $contra2) {

        $db = new Database();

        $db = $db->connect();

        $sql = "UPDATE `usuario` SET `contrasenia` = '$contra' WHERE `usuario`.`NombreUsuario` = '$usuario'";

        if ($db->query($sql)) {

            header("Location: gestionPerfil.php");

        } else {

            echo "<script>alert('Haaaaaaaa GAAAAAAAAAAAAAAAAAAAAAY...')</script>";

        }
    }else{

        echo "<script>alert('No son iguales las contrasenias...')</script>";
    }

}



?>.