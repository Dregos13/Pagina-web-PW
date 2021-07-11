<?php
session_start();
require_once("../DB/connect.php ");
require_once("../class/Usuario.php");


function checkEmail($email) {
    $find1 = strpos($email, '@');
    $find2 = strpos($email, '.');
    return ($find1 !== false && $find2 !== false && $find2 > $find1);
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

if (isset($_POST['registra'])){

    $user = new Usuario();

    $uname = $_POST['uname'];
    $correo = $_POST['mail'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $bday = $_POST['bday'];
    $pais = $_POST['pais'];
    $province = $_POST['provincia'];
    $local = $_POST['local'];
    $pass = $_POST['pw'];

    $error = [];

    if (!checkEmail($correo)) {

        $error[] = "Hotia pue en verdad si eh fuera coñas";

    }

    if($uname == ""){

        $error[] = "Has introducido un nombre de usario vacío.";

    }

    if($name == ""){

        $error[] = "El nombre está vacío.";

    }

    if($surname == ""){

        $error[] = "El/los apellido/s está/án vacíos.";

    }

    if(!validateDate($bday)){

        $error[] = "el formato está mal introducido o vacío.";

    }

    if($pais == "Pais"){

        $error[] = "No has elegido a Espania";

    }

    if($province == "Provincia"){

        $error[] = "No has elegido ninguna provincia.";

    }

    if($local == "Localidad"){

        $error[] =  "No has elegio ningún municipio.";

    }

    if(empty($error)){

        $user->insertaUsuario($uname,$name,$correo,$surname,$bday,$local,$pass);

        if ($_SESSION['errorMessage']===false) {

            header('Location: Inicio.php');

        }

    }else{

        foreach($error as $key => $value)
        {
            echo $value."<br/>";
        }

    }




}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Registrar</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type='text/javascript'></script>
    <link rel="stylesheet" type="text/css" href="./../css/mi.css">
    <link rel="icon" href="../images/logo-removebg-preview.png">
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post">
                    <a href="./Inicio.php"><img src="../images/img.png" height="50px" width="50px" style="left: 0px; position: absolute" ></a>
                    <h1>Sign in</h1>
                <p class="text-muted">Introduce ur data!</p>
                <input type="text" name="uname" placeholder="Username" />
                <input type="text" name="mail" placeholder="email" />
                <input type="text" name="name" placeholder="Name" />
                <input type="text" name="surname" placeholder="Surname" />
                <input type="date" style="background-color: olivedrab; border: aquamarine; width: 250px" name="bday" placeholder="Birthday" />
                <input type="password" name="pw" placeholder="Password" />
                    <select id="pais" class="select" onChange="javascript:cargaProvincia()">
                        <?php
                        //Cambia por los detalles de tu base datos
                        $db = new Database();
                        $db = $db->connect();

                        $sql = "SELECT * FROM pais ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['IdPais'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        $db->close();
                        ?>
                    </select>
                <select id="provincia" class="select" onChange="javascript:cargaMunicipios()">
                    <option>Provincia</option>
                        <?php
                        //Cambia por los detalles de tu base datos
                        $db = new Database();
                        $db = $db->connect();

                        $sql = "SELECT * FROM provincia ORDER BY Nombre ASC";
                        $provincias = $db->query($sql);

                        while ($row = $provincias->fetch_assoc()) {
                            echo '<option value="' . $row['idProvincia'] . '" >' . $row['Nombre'] . '</option>';
                        }
                        $db->close();
                        ?>
                </select>
                <select name="local" id="municipio" class="select" ><option>Localidad</option></select>
                <input type="submit" name="registra" value="Sign-up"/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>