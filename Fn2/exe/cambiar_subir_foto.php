<?php
session_start();
require_once ("../DB/connect.php");

$db = new Database();

$db = $db->connect();

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$usuario = $_SESSION['user_id'];


if(isset($_POST['subir'])) {

    $nombre = $_POST['nombre'];

    $Imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

    $sql = "INSERT INTO imagenes(Nombre,image,owner) VALUES('$nombre','$Imagen','$usuario')";

    $db->query($sql);

}

$sql = "SELECT * FROM imagenes WHERE owner = '$usuario'";
$resul = $db->query($sql);
$resul->fetch_assoc();
while($row = $resul->fetch_assoc()){
    $img=$row['image'];
    $id = $row['idImagenes'];
    ?>
    <br/>
    <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/><a href="#" class="img" data-id="<?php echo $id ?>">Elegir</a>
    <?php

}

if(isset($_POST['id'])){

    $newimg = $_POST['id'];

    $sql = "UPDATE `usuario` SET `imagenperfil` = '$newimg' WHERE `usuario`.`NombreUsuario` = '$usuario'";

    $db->query($sql);
}
?>



<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cambiar o subir foto de perfil</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">

</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $(document).on('click','.img',function (){

            var id = $(this).data("id");

            console.log(id);

            $.ajax({
                url: 'cambiar_subir_foto.php',
                method: 'POST',
                data: {id : id},
                success:function (){

                }

            });

        });

    });

</script>

<form method="POST" enctype="multipart/form-data" action="">
    <input type="text" REQUIRED name="nombre" placeholder="Nombre" value="">
    <input type="file" REQUIRED name="Imagen">
    <input type="submit" name="subir" value="Aceptar">
    <br/>
    <a href="./gestionPerfil.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>

</form>
</body>
</html>


