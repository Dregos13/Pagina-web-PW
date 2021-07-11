<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

?>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>New password</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
    <link rel="stylesheet" type="text/css" href="./../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post">
                    <h1>Login</h1>
                    <p class="text-muted">Enter the mail, the repeat the new password twice</p>
                    <input type="text" name="mail" required>
                    <input type="password" name="p1" required>
                    <input type="password" name="p2" required>
                    <input type="submit" name="change" value="Change">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

if(isset($_POST['change'])) {

    $db = new Database();

    $db = $db->connect();

    $pass1 = $_POST['p1'];

    $pass2 = $_POST['p2'];

    $mail = $_POST['mail'];

    if($pass1 == $pass2){

        $sql = "UPDATE `usuario` SET `contrasenia`= '$pass1' WHERE `Correo` = '$mail'";

        if($db->query($sql)){

            echo "<script>alert('¡Contrasenia cambiada!')</script>";

            header("Location: logear.php");

        }else{

            echo "El correo ta mal";
        }

    }else{

        echo "<script>alert('¡No coinciden las contraseñas >.<!')</script>";

    }

}