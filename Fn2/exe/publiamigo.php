<?php
session_start();
require_once('../DB/connect.php');

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$db = new Database();
$db->connect();

$nombre = $_SESSION['usuario'];

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
<body oncontextmenu='return false' class='snippet-body'>
<div style="position: absolute;right: 0px;">
    <div style="background: #c0c0c0">
        <a href="Perfil.php"><?php
            $nombre2 = $_SESSION['user_id'];
            $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$nombre2'";
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
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <form class="box" method="post">
                    <a href="./perfilamigo.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>
                    <h1>Init</h1>
                    <?php

                    $sql = "SELECT * FROM publi WHERE autor = '$nombre'";

                    $resul = $db->query($sql);

                   while ($row = $resul->fetch_assoc()) {

                       $amigo = $row['autor'];

                           $texto = $row['Contenido'];

                           $img = $row['imagen'];

                           $id = $row['id'];

                           if ($img != null){

                               $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$amigo'";

                               $friend = $db->query($sql);

                               $row3 = $friend->fetch_assoc();

                               $img1 = $row3['imagenperfil'];

                               $fname = $row3['Nombre'];

                               $surfname = $row3['Apellidos'];

                               $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img1'";

                               $resul4 = $db->query($sql);

                               $row4 = $resul4->fetch_assoc();

                               $img1 = $row4['image'];

                               ?>


                               <div class="container bootstrap snippets bootdey" align="center" >
                                   <hr style="color: #999999">
                                   <div class="col-sm-8">
                                       <div class="panel panel-white post panel-shadow">
                                           <div class="post-heading">
                                               <div class="pull-left image">
                                                   <img style="border-radius: 50%" height="50px" width="50px" src="data:image/jpg;base64,<?php echo base64_encode($img1); ?>" alt="img-avatar"/>
                                               </div>
                                               <div class="pull-left meta">
                                                   <div class="title h5">
                                                       <a style="color: gray"><b><?php echo $fname ." ".$surfname; ?></b></a>
                                                       <span style="color: #33ccff"><?php echo $texto; ?></span>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="post-description">
                                           </div>
                                           <div class="post-footer">
                                               <div class="input-group">
                                                   <img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/><br/>

                                                   <br/><button type="button" class="cometario" data-id="<?php echo $id; ?>" style="color: black; background-color: #33ccff; border-color: #191919; height: 35px; border-radius: 10%">Comentar</button>
                                               </div>
                                               <ul class="comments-list">
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                                   <hr style="color: #999999">
                               </div>

                               <?php
                           }else{

                               $sql = "SELECT * FROM usuario WHERE NombreUsuario = '$amigo'";

                               $friend = $db->query($sql);

                               $row3 = $friend->fetch_assoc();

                               $img1 = $row3['imagenperfil'];

                               $fname = $row3['Nombre'];

                               $surfname = $row3['Apellidos'];

                               $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img1'";

                               $resul4 = $db->query($sql);

                               $row4 = $resul4->fetch_assoc();

                               $img1 = $row4['image'];

                               ?>
                               <div class="container bootstrap snippets bootdey" align="center">
                                   <hr style="color: #999999">
                                   <div class="col-sm-8">
                                       <div class="panel panel-white post panel-shadow">
                                           <div class="post-heading">
                                               <div class="pull-left image">
                                                   <img style="border-radius: 50%" height="50px" width="50px" src="data:image/jpg;base64,<?php echo base64_encode($img1); ?>" alt="img-avatar"/>
                                               </div>
                                               <div class="pull-left meta">
                                                   <div class="title h5">
                                                       <a style="color: gray"><b><?php echo $fname.' '.$surfname; ?></b></a>
                                                       <span style="color: #33ccff"><?php echo $texto; ?></span>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="post-description">
                                           </div>
                                           <div class="post-footer">
                                               <div class="input-group">
                                                   <br/><button type="button" class="cometario" data-id="<?php echo $id; ?>" style="color: black; background-color: #33ccff; border-color: #191919; height: 35px; border-radius: 10%">Comentar</button>
                                               </div>
                                               <ul class="comments-list">
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                                   <hr style="color: #999999">
                               </div>
                               <?php
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
