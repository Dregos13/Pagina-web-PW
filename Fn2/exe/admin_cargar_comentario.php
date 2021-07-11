<?php
session_start();
require_once('../DB/connect.php');

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$usuario = $_SESSION['user_id'];

$db = new Database();

$db = $db->connect();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM publi WHERE id = '$id'";

$resul = $db->query($sql);

$row = $resul->fetch_assoc();

$autor= $row['autor'];

$img1 = $row['imagen'];

$texto = $row['Contenido'];

$img = $row['imagen'];

$sql = "SELECT * FROM usuario WHERE NombreUsuario = '$autor'";

$usuario = $db->query($sql);

$datos = $usuario->fetch_assoc();

$fname = $datos['Nombre'];

$surfname = $datos['Apellidos'];

$img1 = $datos['imagenperfil'];

$sql = "SELECT * FROM imagenes WHERE idImagenes = '$img1'";

$resul = $db->query($sql);

$row1 = $resul->fetch_assoc();

$img1 = $row1['image'];


if (isset($_POST['borrar'])){

    $idc = $_POST['borrar'];

    $sql = "DELETE FROM listacomentarios WHERE id = '$idc'";

    $db->query($sql);
}

if (isset($_POST['borrar_publi'])){

    $idc = $_POST['borrar'];

    $sql = "DELETE FROM publi WHERE id = '$id'";

    $db->query($sql);

    header("LOCATION: adminpublicaciones.php");
}


?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Comentario</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click','.refer',function (){

            var id = $(this).data("id");
            console.log(id);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txt").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "busca_refer.php?id=" + id, true);
            xmlhttp.send();

        });

    });
</script>
<div class="container" align="center">
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="card">
            <div class="container bootstrap snippets bootdey" align="center">
                <hr style="color: #999999">
                <div class="col-sm-8">
                    <div class="panel panel-white post panel-shadow">
                        <div class="post-heading">
                            <div class="pull-left image">
                                <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img1); ?>" alt="img-avatar"/>
                            </div>
                            <div class="pull-left meta">
                                <div class="title h5">
                                    <a style="color: gray"><b><?php echo $fname ." ".$surfname; ?></b></a>
                                    <span style="color: #33ccff"><?php echo $texto; ?></span>
                                    <br/>
                                    <a data-id="<?php echo $id; ?>" id="comentario" href="#" class="refer">Ver referencias:</a>
                                    <span style="color:#33ccff;text-align:center;"><span id="txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="post-description">
                        </div>
                        <div class="post-footer">
                            <div class="input-group">

                                <?php

                                if($img != null){
                                ?>
                                <img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/><br/>
                                <?php
                                }
                                ?>

                                </div>
                            <form method="post" action="">
                            <button name ="borrar_publi" value="<?php echo $id?>">Borra publicacion.</button>
                            </form>
                            <br/>
                            <div class="post-footer">
                                <div class="input-group">
                                </div>
                                <ul class="comments-list">
                                    <?php
                                    $sql = "SELECT * FROM listacomentarios WHERE publicacion = '$id'";
                                    $comentarios = $db->query($sql);
                                    while ($coment = $comentarios->fetch_assoc()) {

                                        $usuariocomen = $coment['autor'];

                                        $comen = $coment['comentario'];

                                        $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$usuariocomen'";

                                        $friend = $db->query($sql);

                                        $row3 = $friend->fetch_assoc();

                                        $img1 = $row3['imagenperfil'];

                                        $fname = $row3['Nombre'];

                                        $surfname = $row3['Apellidos'];

                                        $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img1'";

                                        $resul4 = $db->query($sql);

                                        $row4 = $resul4->fetch_assoc();

                                        $img1 = $row4['image'];

                                        $idcomen = $coment['id'];

                                        ?>
                                            <li class="comment">
                                                <a class="pull-left" href="#">
                                                    <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img1); ?>" alt="img-avatar"/>
                                                </a>
                                                <div class="comment-body">
                                                    <div class="comment-heading">
                                                        <a style="color: gray"><b><?php echo $fname ." ".$surfname; ?></b></a>

                                                    </div>
                                                    <p><span style="color: #33ccff"><?php echo $comen; ?></span></p>
                                                    <form method="POST" action="">
                                                    <button name ="borrar" value="<?php echo $idcomen?>">Borra</button>
                                                    </form>
                                                </div>
                                            </li>
                                            <?php
                                    }
                                    ?>
                                </ul>
                        </div>
                    </div>
                </div>
                <hr style="color: #999999">
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
