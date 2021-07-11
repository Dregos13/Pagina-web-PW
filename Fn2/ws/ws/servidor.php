<?php ini_set('error_reporting', E_STRICT);
require_once("lib/nusoap.php");
$namespace = "www.ugr.es";
 
// Creamos un soap server
$server = new soap_server();
 
$server->soap_defencoding = 'utf-8';
$server->decode_utf8 = false;
 
// Configuramos nuestro WSDL
$server->configureWSDL("PruebaWsdl");
 
// Instanciamos nuestro namespace
$server->wsdl->schemaTargetNamespace = $namespace;
 
//Registramos nuestro primer metodo
$server->register(
    // Nombre del metodo:
    'HolaMundo',
    // Lista de parametros:
    array('name'=>'xsd:string'),
    // Valores devueltos:
    array('return'=>'xsd:string'),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: descripcion del metodo
    'Metodo Simple Hola Mundo'
);
 
//Registramos nuestro segundo metodo
$server->register(
    // Nombre del metodo:
    'Suma',
    // Lista de parametros:
    array('a'=>'xsd:int','b'=>'xsd:int'),
    // Valores devueltos:
    array('return'=>'xsd:int'),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: documentation for the method
    'Metodo Simple que suma 2 valores'
);
 
//first function implementation
function HolaMundo($name) {
    return 'Que tal? '.$name.'!';
}
 
function Suma($a, $b) {
    return $a+$b;
}
 
//$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
// pass our posted data (or nothing) to the soap service
//$server->service($POST_DATA);

$server->service(file_get_contents("php://input"));
exit();
?>