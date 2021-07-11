<?php
session_start();
require_once ("../DB/connect.php");

$db = new Database();

$db = $db->connect();

if (!isset($_SESSION['user_id'])) {

    header("Location: logear.php");

}

$usuario = $_SESSION['user_id'];

if(isset($_POST['subirfor'])){

    $centro = $_POST['centro'];

    $formacion = $_POST['titulacion'];

    $fechaini = $_POST['dateini0'];

    $fechafin = $_POST['datefin0'];

    $sql = "INSERT INTO `formación` (`usuario`, `centro`, `titulacion`, `fecha_inicio`, `fecha_fin`)  VALUES ('$usuario', '$centro', '$formacion', '$fechaini','$fechafin')";

    $db->query($sql);
}

if(isset($_POST['subirexp'])){

    $empresa = $_POST['empresa'];

    $puesto = $_POST['puesto'];

    $fechaini = $_POST['dateini1'];

    $fechafin = $_POST['datefin1'];

    $sql = "INSERT INTO `experiencia` (`usuario`, `puesto`, `empresa`, `fecha_ini`, `fecha_fin`) VALUES ('$usuario', '$empresa', '$puesto', '$fechaini', '$fechafin')";

    $db->query($sql);

}

?>



<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Gestión de la experiencia.</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
    <script type="text/javascript" src="../js/functions.js"></script>

</head>

<body>
<script>
    function confirma(centro, titulacion) {
        myconfirm("Desea borrar la formacion", "borraformacion.php?centro=" + centro + "&titulacion=" + titulacion);
    }
    function confirma2(centro, titulacion) {
        myconfirm("Desea borrar la experiencia", "borraexp.php?centro=" + centro + "&titulacion=" + titulacion);
    }

</script>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" action="" class="box">
                    <a href="./gestionPerfil.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute; border-radius: 50%" ></a>

                    <h1><br/>Use the selects in order to add the experience.</h1>
                    <select id="centro" class="select" name="centro">
                        <option>Centro</option>
                        <?php

                        $sql = "SELECT * FROM centro ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['idCentro'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <select id="titulacion" class="select" name="titulacion">
                        <option>Formacion</option>
                        <?php

                        $sql = "SELECT * FROM titulacion ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['IdTitulacion'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <span style="color:#33ccff;text-align:center;">Fecha inicio
                    <input type="date" name="dateini0"><br/>

                    <span style="color:#33ccff;text-align:center;">Fecha fin
                    <input type="date" name="datefin0">
                    <br/>
                    <a href="nueva_formacion.php">No se adapta a tu formacion?</a>
                    <input type="submit" name="subirfor" value="Añadir Formacion">
                    <br/>
                    <select id="empresa" class="select" name="empresa">
                        <option>Empresa</option>
                        <?php

                        $sql = "SELECT * FROM empresa ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['idEmpresa'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <select id="puesto" class="select" name="puesto">
                        <option>Puesto</option>
                        <?php

                        $sql = "SELECT * FROM puesto ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['idPuesto'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <span style="color:#33ccff;text-align:center;">Fecha inicio
                    <input type="date" name="dateini1"><br/>

                    <span style="color:#33ccff;text-align:center;">Fecha fin
                    <input type="date" name="datefin1">
                    <input type="submit" name="subirexp" value="Añadir Experiencia Laboral">
                        <a href="nueva_experiencia.php">No se adapta a tu experiencia?</a>
                    <div style="height:200px;width:400px;overflow:auto;">
                        <?php

                            $sql ="SELECT * FROM `formación` WHERE usuario='$usuario'";

                            $resul = $db->query($sql);

                            if($resul->num_rows > 0) {

                                while ($row = $resul->fetch_assoc()) {

                                    $Ctitulacion = $row['titulacion'];

                                    $Ccentro = $row['centro'];

                                    $sql = "SELECT * FROM centro WHERE idCentro = '$Ccentro'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $centro = $fila['Nombre'];

                                    $sql = "SELECT * FROM titulacion WHERE IdTitulacion = '$Ctitulacion'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $titulacion = $fila['Nombre'];

                                    $datecom = $row['fecha_inicio'];

                                    $datefin = $row['fecha_fin'];

                                    echo '<br/><span style="color:#33ccff;text-align:center;">Estudió en: '.$centro.', se formó en: '. $titulacion .' empezó en: '.$datecom.' y terminó en: '.$datefin.' </span>';

                                    echo "<br/><button type='button' onclick='javascript:confirma($Ccentro,$Ctitulacion)' >Eliminar</button>";

                                }

                            }else{

                                echo "<span>No tienes formacion añadida</span>";
                            }

                            $sql ="SELECT * FROM experiencia WHERE usuario='$usuario'";

                            $resul = $db->query($sql);

                            if($resul->num_rows > 0) {

                                while ($row = $resul->fetch_assoc()) {

                                    $Ctitulacion = $row['puesto'];

                                    $Ccentro = $row['empresa'];

                                    $sql = "SELECT * FROM empresa WHERE idEmpresa = '$Ccentro'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $centro = $fila['Nombre'];

                                    $sql = "SELECT * FROM puesto WHERE idPuesto = '$Ctitulacion'";

                                    $resultado = $db->query($sql);

                                    $fila = $resultado->fetch_assoc();

                                    $titulacion = $fila['Nombre'];

                                    $fechaini = $row['fecha_ini'];

                                    $fechafin = $row['fecha_fin'];

                                    echo '<br/><span style="color:#33ccff;text-align:center;">Trabajó en: '.$centro.' en el puesto de: '. $titulacion .' empezó en: '.$fechaini.' y terminó en: '.$fechafin.' </span>';
                                    echo "<br/><button type='button' name='boton' onclick='javascript:confirma2($Ccentro,$Ctitulacion)'>Eliminar</button>";
                                }

                            }else{
                                echo '<br/><span style="color:#33ccff;text-align:center;">No tienes experiencia establecida.</span>';
                            }


                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


