<?php
session_start();
require_once ("../DB/connect.php");
$db = new Database();
$db = $db->connect();
// Array with names


// get the q parameter from URL
$q = $_REQUEST["q"];
$usuario = $_SESSION['user_id'];
$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $sql = "SELECT * FROM usuario WHERE (NombreUsuario LIKE '$q%') AND (NombreUsuario != '$usuario')";
    $resul = $db->query($sql);
    if ($resul->num_rows > 0) {
        while ($row = $resul->fetch_assoc()) {
            $user = array('id'=> utf8_encode($row['imagenperfil']), 'nombre'=> $row['NombreUsuario']);
            $a[] = $user;
        }
        foreach($a as $name) {
            $img = $name['id'];
            $sql = "SELECT * FROM imagenes WHERE idImagenes = '$img'";
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            $img = $row['image'];
            ?>
            <img style="border-radius: 50%" height="50px" src="data:image/jpg;base64,<?php echo base64_encode($img); ?>" alt="img-avatar"/>
            <?php
            $resul = $db->query($sql);
            $row = $resul->fetch_assoc();
            echo "<br/><a class='ususario' id='user' href='#' data-id=".$name['nombre'].">".$name['nombre']."</a><br/>";
        }
    }
}else{
    echo "<a>No hay coincidencias.</a>";
}

// Output "no suggestion" if no hint was found or output correct values

?>