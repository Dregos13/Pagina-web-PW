<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

if(isset($_POST['items'])){
    header("LOCATION: gestionitems.php");
}

if(isset($_POST['subir'])){
    header("LOCATION: adminbuscador.php");
}

if(isset($_POST['gestion'])){
    header("LOCATION: adminpublicaciones.php");
}

?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Inicio</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<a href="cierra.php" style="position: absolute; right: 0px; color: black; ">Log out</a>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <form class="box" method="post">
                    <h1>Init</h1>
                    <p class="text-muted"> Select an action :)</p><input type="submit" name="items" value="Gestionar items"><input type="submit" name="subir" value="Buscar Usuario"><input type="submit" name="gestion" value="Gestionar Publicaciones">

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

