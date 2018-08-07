<?php
session_start();
$valMsj="Espere...";
$headers = apache_request_headers();
$valToken=$headers["Host"];
($valToken!="servicioshuman.mx")?$token="false":$token="true";
if($token!="true"){
	$valMsj="No autorizado";
	$datos=array("msg"=>$valMsj, "datosapi"=>false);
	echo json_encode($datos);
	exit;
}
$idc=$_GET["1perAwtXyzdd22ret56"];
$numberOrderAct=$_GET["2perAwtXyzdd22ret56"];
$tokenCard=$_GET["3perAwtXyzdd22ret56"];
/* GET DATA CARD CURRENT
 * ######################################################*/
include_once("../controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../modelos/class.getdatacard.php");
$dataCardCurrent=new getdatacard($db1);
$dataCardCurrent->idcard=$idc;
$dataCardCurrent->orderNumber=$numberOrderAct;
$dataCardCurrent->cardToken=$tokenCard;
$resultDataCard=$dataCardCurrent->getCardDataCurrent();
$row=$resultDataCard["code"]->fetch(PDO::FETCH_ASSOC);
$numberCardSMB=$row["numimpresocard"];
$typeCard=$row["typecard"];
$validity=explode(" ", $row["vigencia"]);
/*GENERAMOS CODIGO DE BARRAS
==============================================================================*/
$idBarcode = $row["numimpresocard"];
if (!file_exists("../barcode2/" . md5( $idBarcode ) . ".gif")) {
	include_once "../function/Barcode39.php";
// set object
	$bc = new Barcode39( $idBarcode );
// set text size
	$bc->barcode_text_size = 5;
// set barcode bar thickness (thick bars)
	$bc->barcode_bar_thick = 3;
// set barcode bar thickness (thin bars)
	$bc->barcode_bar_thin = 2;
// save barcode GIF file
	$bc->draw( "../barcode2/" . md5( $idBarcode ) . ".gif" );
}
/*END GENERAMOS CODIGO DE BARRAS
==============================================================================*/
$url = "sitio";
$body.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Activa tu registro | Tarjeta SMB</title>

    <style type="text/css">

        @media only screen and (min-device-width: 601px) {
            .content {width: 600px !important;}
            .col425 {width: 355px!important;}
            .col380 {width: 380px!important;}
        }

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            .buttonwrapper {background-color: transparent!important;}
            .button a {background-color: #e05443; padding: 15px 15px 13px!important; display: block!important;}
            .botonlink {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
        }

    </style>

    <head>';
$body.='

<body>
<!--/head-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
    <tr><td>
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
            <![endif]-->

            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>

                        <!--[if (gte mso 9)|(IE)]>
                        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->

                        <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td bgcolor="#ffffff" style="padding: 40px 30px 20px 30px;">
                                    <!--fila responsiva-->
                                    <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="70" style="padding: 0 20px 20px 0;">
                                                <a href="https://servicioshuman.mx" alt="Servicios Human Access"><img src="https://www.servicioshuman.mx/tarjetasmb/img/SMBlogo.png" width="190" height="82" border="0" alt="Tarjetas SMB" style="height: 82px;"/></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--termina fila responsiva-->

                                    <!--fila responsiva-->
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table width="305" align="left" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td>
                                    <![endif]-->
                                    <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 305px; width: 100%; max-width: 305px;">
                                        <tr>
                                            <td height="70">
                                                <!--contenido columna2-->
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="subhead"  style="font-size: 15px; font-family: sans-serif; letter-spacing: 6px; padding: 0 0 0 3px;">
                                                        <br>
                                                            ACTIVA TU
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 33px; line-height: 38px; font-weight: bold; padding: 5px 0 0 0;">
                                                            TARJETA SMB
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!--termina contenido columna2-->
                                            </td>
                                        </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                    <!--termina fila responsiva-->
                                </td>
                            </tr>




                            <tr>
                                <td style="padding: 30px 30px 30px 30px; border-bottom: 1px solid #dedede;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="color: #153643; font-family: sans-serif; padding: 0 0 15px 0; font-size: 20px; line-height: 28px; font-weight: bold;">
                                                &iexcl;Bienvenido a Tarjeta SMB!
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size: 16px; line-height: 22px; color: #153643; font-family: sans-serif;">
                                            <p>Es necesario que proporcione su nombre completo y dirección de correo para activar su <b>\'Tarjeta SMB\'</b>, haga clic aquí: <a target="_blank" href="'.$url.'" title="Activa tu Tarjeta SMB">'.$url.'</a> o copie y pegue el enlace en su navegador.</p>
                                            <br>
                                            <b>Número de Tarjeta SMB:</b> '.$numberCardSMB.'
                                            <br>
                                            <b>Tipo:</b> '.$typeCard.'
                                            <br>
                                            <b>Vigencia:</b> '.$validity[0].'
                                            <br>
                                            <p>Una vez activada puede imprimir su <b>\'Tarjeta SMB\'</b> desde su correo electrónico o ingresando a su cuenta en nuestro sitio web. Cuando realice una compra en los establecimientos participantes debe presentar su número de Tarjeta SMB impreso o desde su celular junto con su identificación oficial (INE).</p>
                                            <p>En caso de contar con una Tarjeta plástica es necesario crear una cuenta en nuestro sitio web y activar su tarjeta.</p>
                                                
                                                <!--Se ha solicitado la apertura de una cuenta en <b>\'Tarjeta SMB\'</b> utilizando su dirección de correo. Para completar el proceso de inscripción haga clic aquí: <a target="_blank" href="'.$url.'" title="Activa tu cuenta">
                                                    </a> o copia y pega el enlace en tu navegador.-->
                                                    
                                            </td>
                                        </tr>
                                        <tr>
                                        <td align="center">
                                        <img src="../barcode2/'.md5($idBarcode).'.gif" alt="">
</td>
</tr>

                                        <!--tr>
                                            <td style="text-align:center; color: #153643; font-family: sans-serif; font-size: 20px; line-height: 22px; font-weight: bold;">
                                                <br/> &iexcl;Bienvenido a Tarjeta SMB!
                                            </td>
                                        </tr-->
                                    </table>
                                </td>
                            </tr>



                            <!--tr>
                                <td style="padding: 3px 3px 3px 3px; border-bottom: 1px solid #f2eeed;">
                                    <br/>

                                </td>
                            </tr-->


                            <tr>
                                <td class="footer" bgcolor="#44525F">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" class="footercopy" style="color: #FFFFFF;"><br/>
                                                &copy; Copyright 2016<br/>
                                                <a href="mailto:tarjetasmb@servicioshuman.mx" class="botonlink" target="_blank"><font color="#7fc3ff">tarjetasmb@servicioshuman.mx</font></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                            <a href="https://www.facebook.com/">
                                                                <img src="https://www.servicioshuman.mx/tarjetasmb/img/SMB_facebook.jpg" width="50" height="56" alt="Facebook" border="0" style="height: auto;" alt="facebook.com/TarjetaSmb"/>
                                                            </a>
                                                        </td>
                                                        <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                            <a href="https://www.twitter.com/">
                                                                <img src="https://www.servicioshuman.mx/tarjetasmb/img/SMB_twitter.jpg" width="50" height="56" alt="Twitter" border="0" style="height: auto;" alt="twitter.com/smbtarjetas"/>
                                                            </a>

                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>

                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->

                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td></tr>
</table>
<!--/html-->
</body>
</html>
';

echo $body;
exit;
