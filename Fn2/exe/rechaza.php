<?php
session_start();
require_once ("../DB/connect.php");
$db = new Database();
$db = $db->connect();
$emisor = $_REQUEST["name"];
$usuario = $_SESSION['user_id'];
$sql = "DELETE FROM `solicitudes` WHERE `usuario1` = '$emisor' AND `usuario2` = '$usuario'";
$db->query($sql);
$sql = "DELETE FROM `solicitudes` WHERE `usuario1` = '$usuario' AND `usuario2` = '$emisor'";
$db->query($sql);
?>