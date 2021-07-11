<?php
session_start();
require_once ("../DB/connect.php");
$centro = $_REQUEST["centro"];
$titulacion = $_REQUEST["titulacion"];
$usuario = $_SESSION['user_id'];
$sql = "DELETE FROM `formación` WHERE centro = '$centro' AND titulacion = '$titulacion' AND usuario = '$usuario'";
$db = new Database();
$db = $db->connect();
$db->query($sql);
header("Location: modificar_formacion.php");
?>