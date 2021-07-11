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
    <title>Buscador</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script>
        function muestra(str) {
            if (str.length == 0) {
                document.getElementById("txt").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txt").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "buscad_nombres.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div style="position: absolute;right: 0px;">
    <div style="background: #c0c0c0">
    <a href="Perfil.php"><?php
        $db = new Database();
        $db = $db->connect();
        $nombre = $_SESSION['user_id'];
        $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre'";
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
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <form class="box" method="post">
                    <h1>Buscador</h1>
                    <p class="text-muted"> Busca ususarios</p>
                    <input type="text" onkeyup="muestra(this.value)">
                    <p><span style="color:#33ccff;text-align:center;"><span id="txt"></span></p>
                    <a class="btn btn-info "  href="./Inicio.php">Volver Inicio</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $(document).on('click','.ususario',function (){

            var id = $(this).data("id");

            console.log(id);

            url = "mostrar_perfil.php?user="+id;

            window.location = url;

        });

    });

</script>
</body>
</html>

