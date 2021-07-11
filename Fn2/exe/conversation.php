<?php
session_start();
require_once ("../DB/connect.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Chat</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post">
                    <a href="./Perfil.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
                    <h1>Start chat</h1>
                    <p class="text-muted"> Select a friend to start a chat.</p> <select name="chat" value="Chat" href="#">
                        <?php
                        $db = new Database();
                        $db = $db->connect();
                        $emisor = $_SESSION['user_id'];

                        $sql = "SELECT * FROM amistad WHERE usuario1='$emisor' OR usuario2='$emisor'";

                        $amistades = $db->query($sql);

                        if($amistades->num_rows > 0){

                            while ($row = $amistades->fetch_assoc()) {

                                if($emisor == $row['usuario1']){

                                    echo '<option value="' . $row['usuario2']     . '" >' . $row['usuario2'] . '</option>';

                                }else{

                                    echo '<option value="' . $row['usuario1']     . '" >' . $row['usuario1'] . '</option>';

                                }

                            }

                            echo '<input type="submit" value="Start chat" name="start">';
                        }else{

                            echo '<option value="0" >'.'No tienes amigos todavía.'.'</option>';

                        }
                        ?>
                    </select>

                    <?php

                    $sql = "SELECT * FROM mensaje WHERE receptor='$emisor'";

                    $mensaje = $db->query($sql);

                    $count = true;

                    $name ="";

                    while($mensajes = $mensaje->fetch_assoc()) {

                        if ($mensajes['emisor'] != $name) {

                            $recep = $mensajes['fellarecepcion'];

                            if ($recep == '0000-00-00 00:00:00') {

                                $name = $mensajes['emisor'];

                                echo "<p style='color: #33ccff'>$name te ha enviado un mensaje uwu, entra en su chat y mira que es ^.^</p>";
                            }
                        }
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['start'])){

    $_SESSION['receptor'] = $_POST['chat'];

    header('Location: conversacion.php');

}
?>