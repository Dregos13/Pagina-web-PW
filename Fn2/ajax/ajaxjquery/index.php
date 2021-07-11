<html>

<head>

<title>Ejemplo sencillo de AJAX</title>

<script type="text/javascript" src="jquery-1.11.3.min.js"></script>

<script>
function realizaProceso(valorCaja1, valorCaja2){
        /*var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };*/
        $.ajax({
                data:  {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
                },
                url:   'ajax.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
</script>

</head>

<body>

<h1>Introduce valor 1

<input type="text" name="caja_texto" id="valor1" value="0"/> 
</h1>

<h1>
Introduce valor 2

<input type="text" name="caja_texto" id="valor2" value="0"/>
</h1>

<h1>
Realiza suma

<input type="button" href="javascript:;" onclick="realizaProceso($('#valor1').val(), $('#valor2').val());return false;" value="Calcula"/>
</h1>

<br/>
<h1>
Resultado: <span id="resultado">0</span>
</h1>
</body>

</html>
