<!doctype html>
<html>
<head>
<title>Title</title>
<meta charset="utf-8"/>
</head>
<body style="padding: 200px 200px">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; //ó $PHP_SELF ?>" >
<div> 
    <label for="nombre">Introduzca los valores a sumar: </label>
    <input type="text" name="valor1" value="" />
    <input type="text" name="valor2" value="" />
    <input type="submit" value="Llamar al Web Service" />
</div>
</form>
<?php  
if (isset($_POST['valor1']) && isset($_POST['valor2'])) {

    $valor1 = $_POST['valor1'];    
    $valor2 = $_POST['valor2'];    

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
     

    $parameters = array('a' => $valor1, 'b' => $valor2);
    $result = $client->call('Suma', $parameters);

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
            echo "<div>Respuesta de Servidor del WS ($valor1 + $valor2) = <span style='color:red;'>".$result."</span></div>";
        }
    }
?>
</body>
</html>