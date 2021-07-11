<!doctype html>
<html>
<head>
<title>Title</title>
<meta charset="utf-8"/>
</head>
<body style="padding: 200px 200px"> 
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; //ó $PHP_SELF?>" >
<div> 
    <label for="nombre">Introduzca su nombre: </label>
    <input type="text" name="nombre" value="" />
    <input type="submit" value="Llamar al Web Service" />
</div>
</form>
<?php  
if (isset($_POST['nombre'])) {

    $nombre = $_POST['nombre'];

    require_once("lib/nusoap.php");    
    $client = new nusoap_client('http://localhost/ws/servidor.php?wsdl');     

    $client->soap_defencoding = 'UTF-8';
    $client->decode_utf8 = false;
     
    $err = $client->getError();

    if ($err) {
            echo '
    <h2>Error al construir la invocación</h2>
    <pre>' . $err . '</pre>
     
    ';
            die();
    }
     
    $parameters = array('name' => $nombre);
    $result = $client->call('HolaMundo', $parameters);

    if ($client->fault) {
            echo '
    <h2>Error</h2>
    <pre>';
            print_r($result);
            echo '</pre>
     
    ';
            die();
        }
        else
        {
            echo "<div>Respuesta de Servidor del WS: <span style='color:#ff0000;'>" .$result."</span></div>";
        }
}
?>

</body>
</html>