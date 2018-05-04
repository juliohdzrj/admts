<?php
session_start();
$current_id=session_id();
if($current_id!=$_SESSION["IN"]){
	header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: ../index.php");
	};
$trueIdSesion=session_valid_id($current_id);
function session_valid_id($session_id)
{
    return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0;
}

function sanear_string($string){$string=trim($string);$string=str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);$string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);$string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);$string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);$string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);$string=str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
//Esta parte se encarga de eliminar cualquier caracter extraño
    $string=str_replace(array('¨', 'º', '~', '#', '@', '|', '!', '"','·', '%', '&', '/','(', ')', '?', '\'', '¡','¿', '[', '^', '<code>', ']','+', '}', '{', '¨', '´','>', '<', ';', ',', ':','.'),'',$string);return $string;}

if ($trueIdSesion==1 && $_POST){
	// get database connection	
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'regFicha.php';
$upDFicha=new regFichaSMB($db);
//print_r($_POST);
$upDFicha->arrayDataFicha2=$_POST;
$resupDFicha=$upDFicha->valDatosFicha2();

if($resupDFicha===true){
	//echo("<pre>");
	//print_r($_POST);
	//exit;
	if($_POST["categoria"]==0){
		echo ("Selecciona una categoria");
		exit;
		}
	if($_POST["subCategoria"]==0){
		//echo ("upd sin subcat");
		$resUpdateFicha=$upDFicha->updateFichaSinSubCat($_SESSION["ficha"]);
		echo ("<pre>");
		}
	if($_POST["subCategoria"]!=0){
		//echo ("upd con subcat");
		$resUpdateFicha=$upDFicha->updateFichaConSubCat($_SESSION["ficha"]);
		echo("<pre>");
		}
    //print_r($resUpdateFicha);
	//exit;
	if($resUpdateFicha==="1 records UPDATED"){
        $hoy = date("Y-m-d H:i:s");
	    echo($resUpdateFicha."-".$hoy);
        $idFicha=base64_decode($_SESSION["ficha"]);
        $idPromo=$idFicha;
        //include_once("adm_promociones/controlador/database.php");
        // get database connection
        //$database=new Database;
        //$db = $database->getConnection();
        // termina get database connection
        //include_once("adm_promociones/modelos/regFicha.php");
        //$getFilePdf=new regFichaSMB($db);
        $fpdf=$upDFicha->getFpdf($idPromo);
        $dataFpdf=$fpdf->fetch(PDO::FETCH_ASSOC);
        extract($dataFpdf);

        $txtsocio=utf8_encode($socio);
        $strsocio=strtolower($txtsocio);
        $resultadosocio=str_replace(' ', '-', $strsocio);
        //echo($resultadosocio);
        //print_r($dataFpdf);
        //exit;

        $image64 = base64_encode($bk_img);
        $thumbnail='<img class="img-thumbnail" src="data:image/jpeg;base64,'.$image64.'"/>';
        //echo($tipoplan);
        //exit;



        require_once("../function/dompdf6/dompdf_config.inc.php");

        $html=false;
        if($tipoplan!=1){
            $html.= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>'.$txtsocio.' | Tarjeta SMB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
@page {
	margin: 0cm;
	margin-bottom: 3cm;
}
';

            $html.="
body {
  font-family:helvetica;
  	margin:0;
	text-align: justify;
	font-size: 16px;
	color: #000000;
}

table p{
	padding:0;
	margin:0;
	padding-top:4px;
	padding-bottom:4px;
	}
a{
	color:".$colorpdf." !important;
	text-decoration: none
	}
.boxCenter{
opacity: 0.3;
z-index:-1;
  filter:  alpha(opacity=30); background-color:#ffffff;
  width: 63%; margin:0; height:750px; position: fixed; z-index:-1;
  top:0%; left:50%; margin-left:-31.5%;
	}		
";

            $html.='

.tituloPrincipal, .tituloPrincipal h1{
	font-size: 28px !important;
	margin:0;
	padding:0;
    font-style: italic;
    font-weight: bold;
	text-transform: uppercase;
	color:'.$colorpdf.' !important;
	}

.tituloPrincipal p, .descripcionPromo p{
	margin:0;
	padding:0;
color:'.$colorpdf.' !important;
	}	
		
.descripcionPromo{
font-size: 16px !important;
font-weight: bold;
	}	

 body { background-image: url(data:image/jpeg;base64,'.$image64.'); background-position: bottom right; background-repeat: no-repeat; }

#header,
#footer {
  position: fixed;
  left: 0;
	right: 0;
	color: #aaa;
	font-size: 0.9em;
}
#header {
  top: 0;
	border-bottom: 0.1pt solid #aaa;
}
#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}
#header table,
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}
#header td,
#footer td {
  padding: 0;
	width: 50%;
}
.page-number {
  text-align: center;
}
.page-number:before {
  content: "" counter(page);
}
hr {
  page-break-after: always;
  border: 0;
}
.colorTexto1{
	color:#007979; 
	font-weight:bold;
	}
.colorTexto2{
	color:#000000;
	font-weight:bold;
		}	
.bordeParrafo{
	border-bottom:1px solid #007979;
	}
.minusculas{
	text-transform:lowercase;
	}		
.capital{
	text-transform:capitalize;
	}
.img-thumbnail{
	    width: 100%;
    max-width: 100%;
	}
.txt1{
	text-align: center;
	vertical-align: middle;
	color:#322C20;
	height: 100%;
	font-size: 1.2em;
	font-weight: bold;
	}
.img-thumbnail2{
	height:59px;
	}

/*h2, h3{
	font-size: 1em !important;
	color:#6A6464 !important;
	
	}*/							
</style>
  
</head>

<body>
<div id="footer">
  <div style="background-color:#83A3C6; width: 100%; height: 100%;">
  <table style="width:100%; margin:0; padding:0;" cellspacing="0" cellpadding="0">
  <tr>
  <td class="txt1" style="width:70%;"> Presenta tu tarjeta SMB en los establecimientos <br> para hacer v&aacute;lidas tus promociones. Aplican restricciones</td>
  <td style="width:10%; text-align: center;"><a href="http://www.gruporo.com.mx/"><img class="img-thumbnail2" src="../img/gro_smbPdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://servicioshuman.com.mx/"><img class="img-thumbnail2" src="../img/smb_smbPdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://humanaccess.com.mx/"><img class="img-thumbnail2" src="../img/ha_smbPdf.jpg"/></a></td>
  </tr>
  </table>
  
  </div>
</div>

<div class="boxCenter"></div>

<div style="z-index:2; width: 65%; margin: 0 auto; text-align: right; padding-top:20px;margin-top:20px;">

<table cellpadding="0" cellspacing="0" style="width:100%; margin:0;">

<tr>
<td colspan="2" align="center" style="padding-top:20px;"> <span class="tituloPrincipal" style="padding:0; margin:0;">'.utf8_encode($titulo_promo).'</span>
<span align="center" class="descripcionPromo">'.utf8_encode($descripcion).'</span><br>
<br>
</td>
</tr>';

            if($promo_pdf==""){
                ($promocion_texto=="") ? $html.='' : $html.='<tr style="padding-top: 3%;"> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>PROMOCI&Oacute;N</p></td> 
<td align="letf" style="width:80%; padding-left: 10px;" class="cont">'.utf8_encode($promocion_texto).'</td>
</tr>';
            }else{
                ($promocion_texto=="") ? $html.='' : $html.='<tr style="padding-top: 3%;"> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>PROMOCI&Oacute;N</p></td> 
<td align="letf" style="width:80%; padding-left: 10px;" class="cont"><a href="http://servicioshuman.com.mx/tarjeta-smb/consultaF5.php?1perAwtXyzdd22ret56='.$idb64.'">'.utf8_encode($promocion_texto).'</a></td>
</tr>';
            }


            if($suc_pdf==""){
                ($sucursales=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>DIRECCI&Oacute;N</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont">'.utf8_encode($sucursales).'</td>
</tr>';
            }else{
                ($sucursales=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>DIRECCI&Oacute;N</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont"><a href="http://servicioshuman.com.mx/tarjeta-smb/consultaF6.php?1perAwtXyzdd22ret56='.$idb64.'">'.utf8_encode($sucursales).'</a></td>
</tr>';
            }





            ($horarios=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>HORARIOS</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont">'.utf8_encode($horarios).'</td>
</tr>';

            ($telefono=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>TEL&Eacute;FONO</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont"><p>'.utf8_encode($telefono).'</p></td>
</tr>';

            ($pagina_web=="") ? $html.='' : $html.='<tr> <td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>P&Aacute;GINA WEB</p></td> <td align="left" style="width:80%; padding-left: 10px; " class="cont"><a href="'.$pagina_web.'" target="_blank"><p>'.$pagina_web.'</p></a></td></tr>';

            ($facebook=="") ? $html.='' : $html.='<tr> <td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>FACEBOOK</p></td> <td align="left" style="width:80%; padding-left: 10px; " class="cont"><a href="'.$facebook.'" target="_blank"><p>'.$facebook.'</p></a></td></tr>';

            ($twitter=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>TWITTER</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont"><a href="'.$twitter.'" target="_blank"><p>'.$twitter.'</p></a></td>
</tr>';

            ($email=="") ? $html.='' : $html.='<tr> 
<td align="right" style="width:20%; border-right: 10px solid '.$colorpdf.'; padding-right: 10%; padding-bottom: 3%;" class="cont"><p>MAIL</p></td> 
<td align="left" style="width:80%; padding-left: 10px; " class="cont"><a href="mailto:'.$email.'" target="_blank"><p>'.$email.'</p></a></td>
</tr>';


            $html.='
</table>
</div>
<!--hr-->
</body></html>
';

        }
        else{

            $html.='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>'.$txtsocio.' | Tarjeta SMB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="'.utf8_encode($descripcion).'">
<style type="text/css">


@page {
	margin: 0cm;
	margin-bottom: 1.7cm;
}
';

            $html.='

    p{
        padding: 0;
        margin: 0;
    }
    h3{
        padding: 0;
        margin: 0;
    }

    article {
        opacity: 1.00;
        border-radius: 3px;
        width: 100%;
    }

article div.imagenicono{
        opacity: 1.00;
        width: 100%;
        height: 350px;
        border-radius: 3px 3px 0px 0px;
 		border: 1px solid #ececec;
		background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    }
article header, article div.entry-content{
        padding: 0% 3% 0% 3%;
    }



article header a{
        text-decoration: none;
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 32 px;
        opacity: 1.00;
        cursor: pointer;
    }

article p.namenivel, article p.descripcion, article h4, article p, article a, article td{        
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 20px;
    color:rgb(103, 103, 103);
    opacity: 1.00;
    }

article a.linkinfo{        
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 100%;
		color: #337ab7;
        opacity: 1.00;
        text-decoration: none;
		font-weight:bold
    }
article h4{
		color: #337ab7;
		font-weight:bold;
		margin:0
	}	
article h3{
        padding:10px 0px 10px 0px;
		text-align: left;
    }
	
article ul, article ul li{
	margin:0;
	padding:0;
	list-style:none    
	}

article ul li{	
    margin-bottom: 15px;
}

article ul li a, article ul li a p{

	}
	article ul{
	padding-top: 30px;
		}	
article p.descripcion, article a.linkinfo{
        padding:10px 0px 10px 0px;
    }
';


            $html.="
body {
  font-family:helvetica;
  	margin:0;
	text-align: justify;
	font-size: 16px;
	color: #000000;
}

table tr td{
	    padding-bottom: 11px;
	}
table p{
	padding:0;
	margin:0;
	/*padding-top:4px;
	padding-bottom:4px;*/
	}
table td {
	vertical-align: top;
	}	
a{
	/*color:".$colorpdf." !important;*/
	color:#000000;
	text-decoration: none
	}

.boxCenter{
opacity: 0.3;
z-index:-1;
  filter:  alpha(opacity=30); background-color:#ffffff;
  width: 63%; margin:0; height:750px; position: fixed; z-index:-1;
  top:0%; left:50%; margin-left:-31.5%;
	}
		
";

            $html.='
.tituloPrincipal, .tituloPrincipal h1{
	font-size: 28px !important;
	margin:0;
	padding:0;
    font-style: italic;
    font-weight: bold;
	text-transform: uppercase;
	color:'.$colorpdf.' !important;
	}
.tituloPrincipal p, .descripcionPromo p{
	margin:0;
	padding:0;
color:'.$colorpdf.' !important;
	}	
.descripcionPromo{
font-size: 16px !important;
font-weight: bold;
	}	
 /*.imagenicono { background-image: url(data:image/jpeg;base64,'.$image64.'); background-position: bottom right; background-repeat: no-repeat; }*/
#header,
#footer {
  position: fixed;
  left: 0;
	right: 0;
	color: #aaa;
	font-size: 0.9em;
}
#header {
  top: 0;
	border-bottom: 0.1pt solid #aaa;
}
#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}
#header table,
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}
#header td,
#footer td {
  padding: 0;
	width: 50%;
}
.page-number {
  text-align: center;
}
.page-number:before {
  content: "" counter(page);
}
hr {
  page-break-after: always;
  border: 0;
}
.colorTexto1{
	color:#007979; 
	font-weight:bold;
	}
.colorTexto2{
	color:#000000;
	font-weight:bold;
		}	
.bordeParrafo{
	border-bottom:1px solid #007979;
	}
.minusculas{
	text-transform:lowercase;
	}		
.capital{
	text-transform:capitalize;
	}
.img-thumbnail{
	    width: 100%;
    max-width: 100%;
	}
.txt1{
	text-align: center;
	vertical-align: middle;
	/*color:#322C20;*/
	color:rgb(103, 103, 103);
	height: 100%;
	font-size: 0.9em;
	font-weight: bold;
	}
.img-thumbnail2{
	height:59px;
	margin-top:3px;
	}	
</style>  
</head>
';

            (isset($promo_pdf))?$filePromo=1:$filePromo=0;
            (isset($suc_pdf))?$fileSucursales=1:$fileSucursales=0;

            ($pagina_web!="")?$paginaweb=split("(http:\/\/www.|https:\/\/www.|http:\/\/|https:\/\/|www.)", $pagina_web):$paginaweb="***";
            ($paginaweb[1]!="*")?$paginawebok='<a href="'.$pagina_web.'" target="_blank">'.$paginaweb[1].'</a>':$paginawebok="***";

            ($facebook!="")?$linkfacebook=split("(http:\/\/www.|https:\/\/www.|http:\/\/|https:\/\/|www.)", $facebook):$linkfacebook="***";
            ($linkfacebook[1]!="*")?$linkfacebook2='<a href="'.$facebook.'" target="_blank">'.$linkfacebook[1].'</a>':$linkfacebook2="***";

            ($twitter!="")?$linktwitter=split("(http:\/\/www.|https:\/\/www.|http:\/\/|https:\/\/|www.)", $twitter):$linktwitter="***";
            ($linktwitter[1]!="*")?$linktwitterok='<a href="'.$twitter.'" target="_blank">'.$linktwitter[1].'</a>':$linktwitterok="***";

            ($filePromo==1)?$linkPdfPromo='<a href="http://www.servicioshuman.com.mx/tarjetasmb/informacion-'.utf8_encode($socio).'-'.$idcp_pdf_ficha.'" target="_blank">'.utf8_encode($promocion_texto).'</a>':$linkPdfPromo=utf8_encode($promocion_texto);

            ($fileSucursales==1)?$linkSucursalesPromo='<a href="http://www.servicioshuman.com.mx/tarjetasmb/sucursales-'.utf8_encode($socio).'-'.$idcp_pdf_ficha.'" target="_blank">'.utf8_encode($sucursales).'</a>':$linkSucursalesPromo=utf8_encode($sucursales);


            ($horarios!="")?$textohorarios=utf8_encode($horarios):$textohorarios='***';
            ($email!="")?$linkmail='<a href="mailto:'.$email.'">'.$email.'</a>':$linkmail="***";

//$strnamesocio=utf8_encode($socio);
//$titleSocio=strtoupper($strnamesocio);

            $html.='
<body>
<div id="footer">
  <div style="width: 100%; height: 100%;">
  <table style="width:100%; margin:0; padding:0;" cellspacing="0" cellpadding="0">
  <tr>
  <td class="txt1" style="width:40%;"> Presenta tu tarjeta SMB en los establecimientos <br> para hacer v&aacute;lidas tus promociones. Aplican restricciones</td>
  <td style="width:10%; text-align: center;"><a href="http://www.gruporo.com.mx/"><img class="img-thumbnail2" src="../img/ropdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://servicioshuman.com.mx/"><img class="img-thumbnail2" src="../img/smbpdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://humanaccess.com.mx/"><img class="img-thumbnail2" src="../img/humanpdf.jpg"/></a></td>
  </tr>
  </table>
  </div>
</div>
';


            $html.='
<article style="width:100%; margin:0 auto; padding:0;" cellspacing="0" cellpadding="0" id="post-171" class="post-171 post type-post status-publish format-standard hentry category-sin-categoria">
    <div class="imagenicono">
	<img src="data:image/jpeg;base64,'.$image64.'" style="height:350px; width:100%;">
	<!--img src="adm_promociones/img/imagen-ficha-smb.jpg" style="height:350px; width:100%;"-->
	</div>
    
	<table style="width:100%; padding-left: 3%;
    padding-right: 3%;">
	<tr>
	<td colspan="2">
	<h3 class="entry-title" style="color:'.$colorpdf.'; text-transform: uppercase;">
            '.utf8_encode($socio).'
        </h3>
		<p>'.utf8_encode($descripcion).'</p>
	</td>
	</tr>
    
	<tr>
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Promoción</h4>
		'.$linkPdfPromo.'	
		</td>
	   
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Dirección</h4>
		'.$linkSucursalesPromo.'
		
		</td>
    </tr>
	
	<tr>
        <td style="width:50%">
	<h4 style="color:'.$colorpdf.'">Horarios</h4>
		'.$textohorarios.'		
		</td>
	   
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Teléfono</h4>
		'.utf8_encode($telefono).'
		</td>
    </tr>
	
	<tr>
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Página web</h4>
		'.$paginawebok.'
		</td>
	   
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Twitter</h4>
		'.$linktwitterok.'
		</td>
    </tr>
	
	<tr>
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">Facebook</h4>
		'.$linkfacebook2.'
		</td>
	   
        <td style="width:50%">
		<h4 style="color:'.$colorpdf.'">E-Mail</h4>
		'.$linkmail.'
		</td>
    </tr>    
	</table>
</article>';
            $html.='
<!--hr-->
</body></html>
';
        }

//echo ($html);
//exit;
        $trimmed = trim($resultadosocio);
        $trimmedacentos=sanear_string($trimmed);

        $filename = "../../promociones/".utf8_decode($trimmedacentos).".pdf";
        if (file_exists($filename)) {
            unlink($filename);
        }

        $dompdf = new DOMPDF();
        if($tipoplan!=1){
            $dompdf->set_paper('letter', 'landscape');
        }else{
            $dompdf->set_paper('letter', 'portrait'); //portrait, landscape
        }
        //$dompdf->set_paper('letter', 'landscape');
        $dompdf->load_html($html);


        $dompdf->render();
//$dompdf->stream(utf8_encode($socio).".pdf" ,array("Attachment"=>0));
        $pdfoutput = $dompdf->output();

        $fp = fopen($filename, "a");
        fwrite($fp, $pdfoutput);
        fclose($fp);


        //http://servicioshuman.com.mx/consultafgsv-down.php?1perAwtXyzdd22ret56=768


        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
    }



	}else{
	echo($resupDFicha);
	exit;	
	}
	
	exit;
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("../index.php");
		};


?>