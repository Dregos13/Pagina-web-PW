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
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script>
        function refrescar() {
            setTimeout(function(){location.href="conversacion.php";}, 10000);
        }
    </script>
</head>
<body onload="javascript:refrescar()">
<div class="contenedor" >
<div class="cajita">
    <a href="./conversation.php"><img src="../images/img.png" height="50px" width="50px" style="left: 40%; position: absolute; border-radius: 50%" ></a>

    <div align="center">
        <?php
        $receptor = $_SESSION['receptor'];
        echo "<p style='color: #33ccff'>$receptor</p>";
        ?>
        <div style="height:200px;width:300px;overflow:auto;">
        <?php
        $db = new Database();
        $db = $db->connect();
        $emisor = $_SESSION['user_id'];
        $receptor = $_SESSION['receptor'];
        $sql = "SELECT * FROM mensaje WHERE (emisor = '$emisor' AND receptor = '$receptor') OR(emisor = '$receptor' AND receptor = '$emisor')  ORDER BY fechallemision";

        $resul = $db->query($sql);

        $fdate = null;

        if($resul->num_rows > 0) {
            while ($row = $resul->fetch_assoc()) {

                $date = $row["fechallemision"];
                $datetime = new DateTime($date);
                $date = $datetime->format('Y-m-d');
                $time = $datetime->format('H:i');
                $recep = $row['fellarecepcion'];
                if($fdate == null){

                    $fdate = $date;

                    echo '<br/><span style="color:#33ccff;text-align:center;">'.$fdate;

                }elseif($fdate!=$date){

                    $fdate = $date;

                    echo '<br/><span style="color:#33ccff;text-align:center;">'.$fdate;

                }
                if($row['emisor'] == $emisor) {

                    echo '<br/><span style="color:#2ecc71;text-align:right;">'. $row['mensaje'] . " - " .$time;

                }elseif ($row['emisor'] == $receptor){

                    if ($recep == '0000-00-00 00:00:00'){

                        $reception = $datetime->format('Y-m-d H:i:s');

                        $sql = "UPDATE mensaje SET fellarecepcion = '$reception' WHERE fellarecepcion = '0000-00-00 00:00:00' AND emisor = '$receptor' AND receptor = '$emisor'";

                        $db->query($sql);
                    }


                    echo '<br/><span style="color:#c0c0c0;text-align:left;">'.$row['mensaje'] . " - " .$time;

                }
            }
        }else{

            echo "Comienza a chatear con tu amigo $receptor :D" ;
        }
        ?>

        </div>
    <form class="fomu" method="post">
        <input type="text" name="mensaje">
        <input type="submit" name="enviar">
    </form>
    </div>
</div>
</div>
<?php

if (isset($_POST['enviar'])){

    $mensaje = $_POST['mensaje'];

    $sql = "INSERT INTO mensaje(emisor,receptor,mensaje) VALUES ('$emisor','$receptor','$mensaje')";

    $db->query($sql);


}

?>
</body>
</html>