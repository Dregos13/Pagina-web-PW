<?php
require_once ("../DB/connect.php");
?>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - BBBootstrap</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
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
                    <h1>Login</h1>
                            <p class="text-muted">Enter Email Address To Send Password Link</p>
                            <input type="text" name="email" required>
                            <input type="submit" name="submit_email" value="Send request">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

if(isset($_POST['submit_email'])){

    $email = $_POST['email'];

    $db = new Database();

    $db = $db->connect();

    $sql = "SELECT * FROM usuario WHERE Correo = '$email'";

    $resul = $db->query($sql);

    if ($resul->num_rows > 0){

        header("Location: newpass.php");

    }else{

        echo "Nt, pero prueba a meter tu correo, sino no estas en el sistema chan chan chan chaaaaaaaaan";
    }
}




