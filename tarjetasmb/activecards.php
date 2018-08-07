<?php
if(!$_GET){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}
if(!$_GET["asfAsdTfret34opu78"]){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://servicioshuman.mx/");
    exit;
}
if(!$_GET["iytRtgUewfg46lmf92"]){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://servicioshuman.mx/");
	exit;
}
if(!$_GET["rhnYcxTujxz72ple56"]){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://servicioshuman.mx/");
	exit;
}
$idc=$_GET["asfAsdTfret34opu78"];
$numberOrderAct=$_GET["iytRtgUewfg46lmf92"];
$tokenCard=$_GET["rhnYcxTujxz72ple56"];

/* GET DATA CARD CURRENT
 * ######################################################*/
include_once("../adm_promociones/controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../adm_promociones/modelos/class.getdatacard.php");
$dataCardCurrent=new getdatacard($db1);
$dataCardCurrent->idcard=$idc;
$dataCardCurrent->orderNumber=$numberOrderAct;
$dataCardCurrent->cardToken=$tokenCard;
$resultDataCard=$dataCardCurrent->getCardDataCurrent();
$row=$resultDataCard["code"]->fetch(PDO::FETCH_ASSOC);
$numberCardSMB=$row["numimpresocard"];
$typeCard=$row["typecard"];
$validity=explode(" ", $row["vigencia"]);
if($_POST){
    print_r($_POST);
}



//print_r($row);
//exit;

$texto='<p>Para activar su Tarjeta digital SMB proporcione los datos siguientes:</p>';

$texto1='<h1>Hola <br>Bienvenido a Tarjeta SMB <br>(Servicios Médicos y Beneficios)</h1>
            <p><b>Gracias por activar tu cuenta.</b> Con Tarjeta SMB obtiene descuentos en la red médica y comercial a nivel nacional. Solo ingresa tu número de Tarjeta SMB y descarga las promociones</p>';
$texto2='<p>Ocurrió un error, intente activar su cuenta más tarde.
<br>Gracias
</p>';
?>
<!doctype html>
<html lang="es">
<head name="theme-color">
    <meta charset="utf-8">
    <meta name="theme-color" content="#30a6dd">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="público">
    <meta http-equiv="Cache-Control" content="max-age=14400">
    <title>Activa tu Tarjeta SMB</title>
    <link href="../smb.ico" rel="shortcut icon" type="image/x-icon"/>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
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
    <script type="text/javascript">

        $( document ).ready(function() {
            $("#emailCard").on("keyup",function(){
                $("#errorEmail").html("");
                var emailData= $("#emailCard").val();
                var resemail=emailval(emailData);
                if(resemail!="ok"){
                    $("#errorEmail").html(resemail);
                }
            });

            $("#nameUserCard").on("keyup",function(){
                $("#errorName").html("");
                var nameData= $("#nameUserCard").val();
                var resname=textval(nameData);
                if(resname!="ok"){
                    $("#errorName").html(resname);
                }
            });

            $("#surnamesCard").on("keyup",function(){
                $("#errorSurname").html("");
                var surnameData= $("#surnamesCard").val();
                var ressurname=textval(surnameData);
                if(ressurname!="ok"){
                    $("#errorSurname").html(ressurname);
                }
            });

            $("#companycard").on("keyup",function(){
                $("#errorCompany").html("");
                var companyData= $("#companycard").val();
                var rescompany=textval2(companyData);
                if(rescompany!="ok"){
                    $("#errorCompany").html(rescompany);
                }
            });
            $("#phone").on("keyup",function(){
                $("#errorTel").html("");
                var phoneData= $("#phone").val();
                var restelefono=numval(phoneData);
                if(restelefono!="ok"){
                    $("#errorTel").html(restelefono);
                }
            });
            $("#ext").on("keyup",function(){
                $("#errorExt").html("");
                var extData= $("#ext").val();
                var resext=numval(extData);
                if(resext!="ok"){
                    $("#errorExt").html(resext);
                }
            });


            /*$("#sendCardData").submit(function (event) {
                $("#buttonsend").attr("disabled","disabled");
                event.preventDefault();
                $("#errorEmail").html("");
                $("#errorName").html("");
                $("#errorSurname").html("");
                $("#errorCompany").html("");
                $("#errorTel").html("");
                $("#errorExt").html("");
                var emailData= $("#emailCard").val();
                var nameData= $("#nameUserCard").val();
                var surnameData= $("#surnamesCard").val();
                var companyData= $("#companycard").val();
                var phoneData= $("#phone").val();
                var extData= $("#ext").val();
                var resemail=emailval(emailData);
                if(resemail!="ok"){
                    $("#emailCard").focus();
                    $("#errorEmail").html(resemail);
                    enabledB();
                    return false;
                }
                var resname=textval(nameData);
                if(resname!="ok"){
                    $("#nameUserCard").focus();
                    $("#errorName").html(resname);
                    enabledB();
                    return false;
                }
                var ressurname=textval(surnameData);
                if(ressurname!="ok"){
                    $("#surnamesCard").focus();
                    $("#errorSurname").html(ressurname);
                    enabledB();
                    return false;
                }
                var rescompany=textval2(companyData);
                if(rescompany!="ok"){
                    $("#companycard").focus();
                    $("#errorCompany").html(rescompany);
                    enabledB();
                    return false;
                }
                var restelefono=numval(phoneData);
                if(restelefono!="ok"){
                    $("#phone").focus();
                    $("#errorTel").html(restelefono);
                    enabledB();
                    return false;
                }
                var resext=numval(extData);
                if(resext!="ok"){
                    $("#ext").focus();
                    $("#errorExt").html(resext);
                    enabledB();
                    return false;
                }
            })*/
        })

        function valdata(){
            var emailData= $("#emailCard").val();
            var nameData= $("#nameUserCard").val();
            var surnameData= $("#surnamesCard").val();
           if(emailData==""){
               $("#emailCard").focus();
               $("#errorEmail").html("Campo requerido");
               return false;
           }
            if(nameData==""){
                $("#nameUserCard").focus();
                $("#errorName").html("Campo requerido");
                return false;
            }
            if(surnameData==""){
                $("#surnamesCard").focus();
                $("#errorSurname").html("Campo requerido");
                return false;
            }
            $("#sendCardData").submit();
        };

        function enabledB(){
            $("#buttonsend").removeAttr("disabled");
        };


        function numval(dataUsernum){
            var regex1=/^([0-9]{0,3})([0-9]{0,20})$/;
            if(!regex1.test(dataUsernum)){
                return "Solo se permiten números";
            }
            return "ok";
        };
        function textval2(dataUsertxt){
            var regex2=/^([0-9a-zA-ZáéíóúüÁÉÍÓÚÜ]{0,3})([0-9a-zA-ZáéíóúüÁÉÍÓÚÜ/\s]{0,40})$/;
            if(!regex2.test(dataUsertxt)){
                return "Solo se permiten letras";
            }
            return "ok";
        };
        function textval(dataUsertxt){
            var regex2=/^([0-9a-zA-ZáéíóúüÁÉÍÓÚÜ]{3,3})([0-9a-zA-ZáéíóúüÁÉÍÓÚÜ/\s]{0,40})$/;
            if(!regex2.test(dataUsertxt)){
                return "Solo se permiten letras";
            }
            return "ok";
        };
        function emailval(datauser){
            var regex3=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
            if(!regex3.test(datauser)){
                return "Proporcione una dirección correcta";
            }
            return "ok";
        };
    </script>
</head>
<body>
<div class="container margintop">
<div class="row">
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4"><div class="align_center"><a href="http://servicioshuman.com.mx" alt="Servicios Human Access"><img src="https://www.servicioshuman.mx/tarjetasmb/img/SMBlogo.png" width="190" height="82" border="0" alt="Tarjetas SMB" style="height: 82px;"/></a></div></div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4"><div class="align_center"><span class="titulo_seccion">ACTIVA TU </span><br><span class="subtitulo_seccion">TARJETA SMB</span></div></div>
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2">&nbsp;</div>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
        <div>
            <br><br>
            <?php echo($texto); ?>
            <form id="sendCardData" method="post">
                <div class="form-group">
                    <label for="emailCard"><b>Dirección de Email<span style="color: red">*</span></b></label>
                    <input name="email" type="email" class="form-control" id="emailCard" placeholder="name@example.com">
                    <span style="color: red" id="errorEmail"></span>
                </div>
                <div class="form-group">
                    <label for="nameUserCard"><b>Nombre (s)<span style="color: red">*</span></b></label>
                    <input name="nameUser" class="form-control" id="nameUserCard" type="text" placeholder="Nombre (s)">
                    <span style="color: red" id="errorName"></span>
                </div>
                <div class="form-group">
                    <label for="surnamesCard"><b>Apellidos (s)<span style="color: red">*</span></b></label>
                    <input name="surnameUser" class="form-control" id="surnamesCard" type="text" placeholder="Apellidos (s)">
                    <span style="color: red" id="errorSurname"></span>
                </div>
                <div class="form-group">
                    <label for="companycard"><b>Nombre Empresa</b></label>
                    <input name="companyUser" class="form-control" id="companycard" type="text" placeholder="Nombre Empresa">
                    <span style="color: red" id="errorCompany"></span>
                </div>
                <div class="form-group">
                    <label for="phone"><b>Lada + Teléfono</b></label>
                    <input name="phoneUser" class="form-control" id="phone" type="text" placeholder="01044552623456789">
                    <span style="color: red" id="errorTel"></span>
                </div>
                <div class="form-group">
                    <label for="ext"><b>Ext.</b></label>
                    <input name="extUser" class="form-control" id="ext" type="text" placeholder="5023">
                    <span style="color: red" id="errorExt"></span>
                </div>
                <button onclick="valdata()" type="button" id="buttonsend" class="btn btn-primary">Enviar</button>
            </form>
            <iframe src="" frameborder="0"></iframe>


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

                <a href="https://www.facebook.com/">
                    <img src="https://www.servicioshuman.mx/tarjetasmb/img/SMB_facebook.jpg" width="50" height="56" alt="Facebook" border="0" style="height: auto;" alt="facebook.com/TarjetaSmb"/>
                </a>
                <a href="https://www.twitter.com/">
                    <img src="https://www.servicioshuman.mx/tarjetasmb/img/SMB_twitter.jpg" width="50" height="56" alt="Twitter" border="0" style="height: auto;" alt="twitter.com/smbtarjetas"/>
                </a>

            </div></div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2"> </div>
    </div>
    <br>
</div>

</body>
</html>