<?php
function sanear_string($string){$string=trim($string);$string=str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);$string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);$string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);$string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);$string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);$string=str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
//Esta parte se encarga de eliminar cualquier caracter extraño
    $string=str_replace(array('¨', 'º', '~', '#', '@', '|', '!', '"','·', '%', '&', '/','(', ')', '?', '\'', '¡','¿', '[', '^', '<code>', ']','+', '}', '{', '¨', '´','>', '<', ';', ',', ':','.'),'',$string);return $string;}

if ($_GET){
    $resarray=false;
    $resarray=explode("-", $_GET["1perAwtXyzdd22ret56"]);
	$idPromo=end($resarray);
	include_once 'adm_promociones/controlador/database2.php';
	$database = new Database();
	$db = $database->getConnection();
    include_once 'adm_promociones/modelos/regDir.php';
	$reg_dir=new regDirSMB($db);
	$fpdf=$reg_dir->getFichaMedicaEspecialidad($idPromo);
	$dataFpdf=$fpdf->fetch(PDO::FETCH_ASSOC);
    extract($dataFpdf);
    $getDataEspecialidad=$reg_dir->especialidadXid($id_especialidad);
    $dataImgEspe=$getDataEspecialidad->fetch(PDO::FETCH_ASSOC);

    /*echo ("<pre>");
    print_r($dataFpdf);
    print_r($dataImgEspe);
    exit;*/

    $txtsocio=utf8_encode($Nombre);
    $trimmed = trim($txtsocio);
    $strsocio=strtolower($trimmed);
    $resultadosocio=str_replace(' ', '-', $strsocio);
    $trimmedacentos=sanear_string($resultadosocio);
	require_once("adm_promociones/function/dompdf6/dompdf_config.inc.php");

	$html.='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>'.utf8_encode($Nombre).' | Tarjeta SMB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="'.utf8_encode($Promocion_human).'">
<style type="text/css">
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
	color:#337ab7;
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


    (isset($promo_pdf))?$filePromo=1:$filePromo=0;
    (isset($suc_pdf))?$fileSucursales=1:$fileSucursales=0;
    $Paginaweb2=$Paginaweb;
    ($Paginaweb2!="")?$Paginaweb2=preg_split("(http:\/\/www.|https:\/\/www.|http:\/\/|https:\/\/|www.)", $Paginaweb):$Paginaweb2="***";
    (count($Paginaweb2)==2)?$pageweb="http://www.".$Paginaweb2[1]:$pageweb="***";
    if($Paginaweb2[1]){
        $paginawebok='<a href="'.$pageweb.'" target="_blank">'.$Paginaweb2[1].'</a>';
    }else{
        $paginawebok="***";
    }


    //($Paginaweb2[1]!="***")?$paginawebok='<a href="'.$Paginaweb.'" target="_blank">'.$paginaweb[1].'</a>':$paginawebok="***";


    //echo ($paginawebok);
    //exit;

    /*($filePromo==1)?$linkPdfPromo='<a href="http://www.servicioshuman.com.mx/tarjetasmb/informacion-'.utf8_encode($socio).'-'.$idcp_pdf_ficha.'" target="_blank">'.utf8_encode($promocion_texto).'</a>':$linkPdfPromo=utf8_encode($promocion_texto);

    ($fileSucursales==1)?$linkSucursalesPromo='<a href="http://www.servicioshuman.com.mx/tarjetasmb/sucursales-'.utf8_encode($socio).'-'.$idcp_pdf_ficha.'" target="_blank">'.utf8_encode($sucursales).'</a>':$linkSucursalesPromo=utf8_encode($sucursales);*/


    ($Horarios_atencion!="")?$textohorarios=utf8_encode($Horarios_atencion):$textohorarios='***';
    ($Mail!="")?$linkmail='<a href="mailto:'.$Mail.'">'.$Mail.'</a>':$linkmail="***";

//$strnamesocio=utf8_encode($socio);
//$titleSocio=strtoupper($strnamesocio);
    //var_dump( $paginawebok);
    //exit;

$nombre_imagen_original="human/".$imgficha;
$nombre_imagen_ficha="promo-medicas/".$imgficha;
($dataImgEspe["imagenesp"]!="")?$nombre_imagen_generica="promo-medicas/".$dataImgEspe["imagenesp"]:$nombre_imagen_generica="promo-medicas/dos.jpg";
//$nombre_imagen_generica="promo-medicas/".$dataImgEspe["imagenesp"];
    $imgshow=false;

    $img1=file_exists($nombre_imagen_ficha);
    $img2=file_exists($nombre_imagen_generica);
    $img3=file_exists($nombre_imagen_original);

    if($img3==true&&$img2==false&&$img1==false){
        $imgshow=$nombre_imagen_original;
    }
    if($img3==false&&$img2==true&&$img1==false){
        $imgshow=$nombre_imagen_generica;
    }
    if($img3==true&&$img2==true&&$img1==false){
        $imgshow=$nombre_imagen_generica;
    }
    if($img3==false&&$img2==false&&$img1==true){
        $imgshow=$nombre_imagen_ficha;
    }
    if($img3==true&&$img2==false&&$img1==true){
        $imgshow=$nombre_imagen_ficha;
    }
    if($img3==false&&$img2==true&&$img1==true){
        $imgshow=$nombre_imagen_ficha;
    }
    if($img3==true&&$img2==true&&$img1==true){
        $imgshow=$nombre_imagen_ficha;
    }

    //echo $imgshow."<br>";
    //echo "img1:".$img1."-img2:".$img2."-img3:".$img3;
    //exit;
if (file_exists($nombre_imagen_ficha)||file_exists($nombre_imagen_generica)) {
    $orientation="portrait";
    $html.='
@page {
	margin: 0cm;
	margin-bottom: 1.7cm;
}
.tituloPrincipal, .tituloPrincipal h1{
	font-size: 28px !important;
	margin:0;
	padding:0;
    font-style: italic;
    font-weight: bold;
	text-transform: uppercase;
	color:#337ab7;
	}
.tituloPrincipal p, .descripcionPromo p{
	margin:0;
	padding:0;
color:#337ab7 !important;
	}	
.descripcionPromo{
font-size: 16px !important;
font-weight: bold;
	}
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
    $html.='
<body>
<div id="footer">
  <div style="width: 100%; height: 100%;">
  <table style="width:100%; margin:0; padding:0;" cellspacing="0" cellpadding="0">
  <tr>
  <td class="txt1" style="width:40%;"> Presenta tu tarjeta SMB en los establecimientos <br> para hacer v&aacute;lidas tus promociones. Aplican restricciones</td>
  <td style="width:10%; text-align: center;"><a href="http://www.gruporo.com.mx/"><img class="img-thumbnail2" src="tarjetasmb/img/ropdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://servicioshuman.com.mx/"><img class="img-thumbnail2" src="tarjetasmb/img/smbpdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://humanaccess.com.mx/"><img class="img-thumbnail2" src="tarjetasmb/img/humanpdf.jpg"/></a></td>
  </tr>
  </table>
  </div>
</div>
';
    $html.='
<article style="width:100%; margin:0 auto; padding:0;" cellspacing="0" cellpadding="0" id="post-171" class="post-171 post type-post status-publish format-standard hentry category-sin-categoria">
    <div class="imagenicono">
	<img src="'.$imgshow.'" style="height:350px; width:100%;">
	<!--img src="adm_promociones/img/imagen-ficha-smb.jpg" style="height:350px; width:100%;"-->
	</div>
    
	<table style="width:100%; padding-left: 3%;
    padding-right: 3%;">
	<tr>
	<td colspan="2">
	<h3 class="entry-title" style="color:#337ab7; text-transform: uppercase;">
            '.utf8_encode($Nombre).'
        </h3>
		<p>'.utf8_encode($Especialidad).'</p>
	</td>
	</tr>
    
	<tr>
        <td style="width:50%">
		<h4 style="color:#337ab7;">Promoción</h4>
		'.utf8_encode($Promocion_human).'	
		</td>
	   
        <td style="width:50%">
		<h4 style="color:#337ab7;">Dirección</h4>
		'.utf8_encode($Direccion).'
		</td>
    </tr>
	
	<tr>
        <td style="width:50%">
	<h4 style="color:#337ab7;">Horarios</h4>
		'.$textohorarios.'		
		</td>
	   
        <td style="width:50%">
		<h4 style="color:#337ab7;">Teléfono</h4>
		'.utf8_encode($Telefonos).'
		</td>
    </tr>
	
	<tr>
        <td style="width:50%">
		<h4 style="color:#337ab7;">Página web</h4>
		'.$paginawebok.'
		</td>
		<td style="width:50%">
		<h4 style="color:#337ab7;">E-Mail</h4>
		'.utf8_encode($Mail).'
		</td>
    </tr>    
	</table>
</article>';

}else{
    $orientation="landscape";
    $html.='
@page {
	margin: 0cm;
	margin-bottom: 0cm;
}

</style>  
</head>
';
    $html.='<div style="width:97%; margin:0 auto;"> <img src="'.$imgshow.'" style=" width:100%; max-width:100%">  </div>';

}




    $html.='
<!--hr-->
</body></html>
';

//echo $html;
//exit;

    
$dompdf = new DOMPDF();

$dompdf->set_paper('letter', $orientation); //portrait, landscape

$dompdf->load_html($html);

$dompdf->render();

$dompdf->stream($trimmedacentos.".pdf" ,array("Attachment"=>false));
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
exit(0);	
	
	
	
	/*$image64 = base64_encode($dataFImg["cp_img"]);
	$thumbnail='<img class="img-thumbnail" src="data:image/jpeg;base64,'.$image64.'"/>';*/
	
	/*header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
	header('Content-type: '.$tipo_pdf);
	header('Content-Disposition: inline; filename="'.utf8_encode($nombre_archivo_pdf).'"');
	print ($cupon_pdf);*/
	
	
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("Location: index.html");
		}
exit;
?>
