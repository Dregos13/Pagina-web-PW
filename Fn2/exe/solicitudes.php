<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$db = new Database();
$db = $db->connect();
$nombre = $_SESSION['user_id'];
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post">
                    <h1>Solicitudes de amistad.</h1>
                    <?php
                        $sql = "SELECT * FROM solicitudes WHERE usuario2 = '$nombre'";
                        $resul = $db->query($sql);
                        if($resul->num_rows > 0) {
                            while ($row = $resul->fetch_assoc()) {
                                $emisor = $row['usuario1'];
                                echo "<br/><span style='color: #33ccff'>$emisor quiere ser tu amigo </span><input style='background-color: #33ccff' type='button' class='acepta' name='acepta' id='answer' value='Aceptar' data-id='$emisor'> <input style='background-color: #ff0000' type='button' class='rechaza' name='recha' id='answer' value='Rechazar' data-id='$emisor'><br/>";
                            }
                        }else{

                            echo "<br/><p style='color: #33ccff'>No hay ninguna solicitud, por qué no envías tu una eh mister.</p><br/><a class='btn btn-info'  href='./buscador.php'>Buscar Amigos</a><br/>";
                        }

                    ?>
                    <br/>

                    <a class="btn btn-info "  href="./Inicio.php">Volver Inicio</a>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        $(document).on('click','.acepta',function (){

            var id = $(this).data("id");

            console.log(id);

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "acepta.php?name=" + id, true);
            xmlhttp.send();

        });

        $(document).on('click','.rechaza',function (){

            var id = $(this).data("id");

            console.log(id);

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "rechaza.php?name=" + id, true);
            xmlhttp.send();

        });

    });

</script>
</body>
</html>

