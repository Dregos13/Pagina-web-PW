<?php
session_start();
require_once ("../DB/connect.php");

$id= $_REQUEST["user"];

$_SESSION['usuario'] = $id;

header("Location: adminperfil.php");

?>