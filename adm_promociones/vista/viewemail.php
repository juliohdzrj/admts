<?php
session_start();
require_once("../function/dompdf6/dompdf_config.inc.php");

$html2.= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>ok | Human Access Tarjeta SMB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="ok">
<style type="text/css">


@page {
	margin: 0cm;
	margin-bottom: 3cm;
}
';

$html2.="
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

$html2.='

.tituloPrincipal, .tituloPrincipal h1{
	font-size: 28px !important;
	margin:0;
	padding:0;
    font-style: italic;
    font-weight: bold;
	text-transform: uppercase;
	}

.tituloPrincipal p, .descripcionPromo p{
	margin:0;
	padding:0;
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
	color:#322C20;
	height: 100%;
	font-size: 1.2em;
	font-weight: bold;
	}
.img-thumbnail2{
	height:59px;
	}

							
</style>
  
</head>

<body>
<div id="footer">
  <div style="background-color:#83A3C6; width: 100%; height: 100%;">
  <table style="width:100%; margin:0; padding:0;" cellspacing="0" cellpadding="0">
  <tr>
  <td class="txt1" style="width:70%;"> Presenta tu tarjeta SMB en los establecimientos <br> para hacer v&aacute;lidas tus promociones. Aplican restricciones</td>
  <td style="width:10%; text-align: center;"><a href="http://www.gruporo.com.mx/"><img class="img-thumbnail2" src="adm_promociones/img/gro_smbPdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://servicioshuman.com.mx/"><img class="img-thumbnail2" src="adm_promociones/img/smb_smbPdf.jpg"/></a></td>
  <td style="width:10%; text-align: center;"><a href="http://humanaccess.com.mx/"><img class="img-thumbnail2" src="adm_promociones/img/ha_smbPdf.jpg"/></a></td>
  </tr>
  </table>
  
  </div>
</div>


<div class="boxCenter"></div>

<div style="z-index:2; width: 65%; margin: 0 auto; text-align: left; padding-top:20px;margin-top:20px;">

contendiv
';

$html2.='
</div>
<!--hr-->
</body></html>
';
$dompdf = new DOMPDF();
$dompdf->set_paper('letter', 'landscape');
$dompdf->load_html($html2);
$dompdf->render();
$dompdf->stream('ok.pdf', array("Attachment"=>0));
exit;
?>
