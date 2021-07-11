<?php
session_start();
require_once ("../DB/connect.php");

$id= $_REQUEST["user"];

if(isset($id)){

    $db = new Database();

    $db = $db->connect();

    $usuario = $_SESSION['user_id'];

    $sql = "SELECT * FROM amistad WHERE ((usuario1 = '$usuario') AND (usuario2 = '$id')) OR ((usuario1 = '$id') AND (usuario2 = '$usuario'))";

    echo $sql;

    $resul = $db->query($sql);

    if($resul->num_rows > 0){

        $_SESSION['usuario'] = $id;

        header("Location: perfilamigo.php");

    }else{

        $_SESSION['usuario'] = $id;

       header("Location: perfilnoamigo.php");
    }
}
?>