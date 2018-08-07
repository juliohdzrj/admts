<?php
if(!$_GET){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}
if(!$_GET["1234jnferSadut89"]){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}

/*
 * VERIFICAMOS SI ESTÁ ACTIVA SU CUENTA
 */

include_once("../api_cmp/controlador/database.php");
$database=new Databaseapi;
$db = $database->getConnection();
include_once("../api_cmp/modelos/selectusext.php");
$getdatauser=new select_user($db);
$getdatauser->id_user_ext=base64_decode($_GET["1234jnferSadut89"]);
$res=$getdatauser->get_data_user_ext();
$valres=$res->fetch(PDO::FETCH_ASSOC);
//print_r($valres);
$name_user=strtoupper($valres["nombres"]);
$apellido_user=strtoupper($valres["apellidos"]);
if($valres==false){
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}
if($valres["activo"]==1){
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}
$nombre_full=$name_user."&nbsp;".$apellido_user;
$texto1='<h1>Hola '.$nombre_full.' <br>Bienvenido a Tarjeta SMB <br>(Servicios Médicos y Beneficios)</h1>
            <p><b>Gracias por activar tu cuenta.</b> Con Tarjeta SMB obtiene descuentos en la red médica y comercial a nivel nacional. Solo ingresa tu número de Tarjeta SMB y descarga las promociones</p>';
$texto2='<p>Ocurrió un error, intente activar su cuenta más tarde.
<br>Gracias
</p>';
if($valres["activo"]==0) {
    $res1 = $getdatauser->activar_cuenta_user_ext();
    ($res1=="true")?$texto=$texto1:$texto=$texto2;
    //print_r($res1);
}
//echo $res1;
//print_r($res1);
//var_dump($res1);



//print_r($res1);
//echo ("<br>");
/*
 * TERMINA VERIFICAMOS SI ESTÁ ACTIVA SU CUENTA
 */


//print_r(base64_decode($_GET["1234jnferSadut89"]));
?>
<!doctype html>
<html lang="es">
<head name="theme-color">
    <meta charset="utf-8">
    <meta name="theme-color" content="#30a6dd">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="público">
    <meta http-equiv="Cache-Control" content="max-age=14400">
    <title>Activa tu cuenta Tarjeta SMB</title>
    <link href="../smb.ico" rel="shortcut icon" type="image/x-icon"/>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        body{
            font-size: 16px;
            font-family: sans-serif;
        }
        h1{
            color: #153643; padding: 0 0 15px 0; font-size: 1.25em; line-height: 28px; font-weight: bold;
            text-align: left;
        }
        p{
            font-size: 1em; line-height: 22px; color: #153643;
            text-align: left;
        }
        .align_center{
            text-align: center;
            padding: 3%;
        }
        span.titulo_seccion{
            font-size: 0.9375em; /*15px/16px*/ font-family: sans-serif; letter-spacing: 6px; padding: 0 0 0 3px;
            text-align: center;
        }
        span.subtitulo_seccion{
            font-size: 2.0625em; /*33px/16px*/ line-height: 38px;  font-weight: bold; padding: 5px 0 0 0;
        }
        div.margintop{
            margin-top: 45px;
        }
    </style>
</head>
<body>
<div class="container margintop">
<div class="row">
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4"><div class="align_center"><a href="http://servicioshuman.com.mx" alt="Servicios Human Access"><img src="http://www.servicioshuman.com.mx/tarjetasmb/img/grupo_ro_smb.jpg" width="190" height="64" border="0" alt="Tarjetas SMB" style="height: 64px;"/></a></div></div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4"><div class="align_center"><span class="titulo_seccion">ACTIVA TU CUENTA</span> <span class="subtitulo_seccion">TARJETA SMB</span></div></div>
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8"><div class="align_center">
            <br><br>
            <?php echo($texto); ?>
        </div></div>
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
</div>

    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
                <hr>
                <br><br><br>
            <br><br><br>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8"><div class="align_center" style="background-color:#44525F; color: #FFFFFF;">
        SMB  &copy; Copyright 2016<br><br>

                <a href="http://www.facebook.com/">
                    <img src="http://www.servicioshuman.com.mx/tarjetasmb/img/SMB_facebook.jpg" width="50" height="56" alt="Facebook" border="0" style="height: auto;" alt="facebook.com/TarjetaSmb"/>
                </a>
                <a href="http://www.twitter.com/">
                    <img src="http://www.servicioshuman.com.mx/tarjetasmb/img/SMB_twitter.jpg" width="50" height="56" alt="Twitter" border="0" style="height: auto;" alt="twitter.com/smbtarjetas"/>
                </a>

            </div></div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2"> </div>
    </div>
    <br>
</div>

</body>
</html>
