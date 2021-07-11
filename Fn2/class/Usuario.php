<?php

require_once('../DB/connect.php');

class Usuario{

    public function insertaUsuario($NomUsuario,$Nombre,$Correo,$Apellidos,$Fechanacimiento,$Municipio,$contrasenia){

        $db = new Database();

        $db = $db->connect();

        $sql = "SELECT * FROM USUARIO WHERE Correo = '$Correo'";

        $resul = $db->query($sql);

        if($resul->num_rows > 0){

            $_SESSION['errorMessage'] = true;

            if (isset($_SESSION['errorMessage'])) {
                echo "<script>alert('¡El correo ya esta siendo utilizado por otro! Prueba con otro. :(!')</script>";
            }
        }else {

            $sql = "SELECT * FROM USUARIO WHERE NombreUsuario = '$NomUsuario'";

            $resul = $db->query($sql);

            if ($resul->num_rows > 0){

                $_SESSION['errorMessage'] = true;

                if (isset($_SESSION['errorMessage'])) {
                    echo "<script>alert('¡El nombre de usuario ya esta siendo utilizado por otro! Prueba con otro. :(!')</script>";
                }

            }else {

                $sql = "INSERT INTO usuario (NombreUsuario,Nombre,Correo,Apellidos,FechaNacimiento,contrasenia,localidad,rol,imagenperfil) VALUES ('$NomUsuario','$Nombre','$Correo','$Apellidos','$Fechanacimiento','$contrasenia','$Municipio',2,1)";

                if ($db->query($sql)) {

                    $_SESSION['errorMessage'] = false;

                }
            }
        }
    }
}