<?php
session_start();
require_once ("../DB/connect.php");
$db = new Database();
$db = $db->connect();

$id = $_REQUEST['id'];

$usuario = $_SESSION['user_id'];


    $sql = "SELECT * FROM listareferencias WHERE publicaion='$id'";
    $resul = $db->query($sql);
    if ($resul->num_rows > 0) {

        while ($row = $resul->fetch_assoc()){

            $referencia = $row['usuario'];

            echo "<p>$referencia</p>";

        }

    }

?>