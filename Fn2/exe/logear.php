<?php
session_start();
require_once ("../DB/connect.php")
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Logear</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post">
                    <h1>Login</h1>
                    <p class="text-muted"> Please enter your login and password!</p> <input type="text" name="user" placeholder="Username"> <input type="password" name="password" placeholder="Password"> <a class="forgot text-muted" href="#" onclick="javascript:document.location='./reset.php'">Forgot Password?</a><a></a><input type="submit" name="login" value="Log-in" href="#"><input type="submit" name="registrar" value="Sign-up" href="#">
                    <a href="adminlog.php">Eres admin?</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

if (isset($_POST['login'])) {

    $usario = $_POST['user'];

    $pass = $_POST['password'];

    $db = new Database();

    $db = $db->connect();

    $sql = "SELECT * FROM usuario WHERE (NombreUsuario = '$usario' OR Correo = '$usario')  AND contrasenia = '$pass' AND baja=0";

    $resul = $db->query($sql);

    if ($resul->num_rows > 0) {

        $row = $resul->fetch_assoc();

        $_SESSION['user_id'] = $row['NombreUsuario'];

        header('Location: Inicio.php');

    }else{

        $sql = "SELECT * FROM usuario WHERE (NombreUsuario = '$usario' OR Correo = '$usario')  AND contrasenia = '$pass' AND baja=1";

        $resul = $db->query($sql);

        if ($resul->num_rows > 0){

            $_SESSION['errorMessage'] = true;

            if (isset($_SESSION['errorMessage'])) {
                echo "<script>alert('¡Te han dado de baja loco!')</script>";
            }

        }else{
            $_SESSION['errorMessage'] = true;

            if (isset($_SESSION['errorMessage'])) {
                echo "<script>alert('¡El nombre de usuario o contraseña que ha introducido, no son correctos!')</script>";
            }
        }
        }

}
if (isset($_POST['registrar'])) {

    header('Location: registrar.php');

}
?>