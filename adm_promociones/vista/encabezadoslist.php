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

if ($trueIdSesion==1){
include_once("../controlador/database.php");
$database=new Database;
$db = $database->getConnection();
include_once("../modelos/regProm.php");
$getHeaders=new regProm($db);
$listaHeaders=$getHeaders->getHeadersList($_POST["object_id"]);
$arrayListaHeaders=array();
$tablaEnc.="<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        <th>#</th>
        <th>Imagen</th>
        <th>Mes</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>";
while($rowHeaders=$listaHeaders->fetch(PDO::FETCH_ASSOC)){
	extract($rowHeaders);
	$tablaEnc.="
    <tr>
        <td>".$idencabezado."</td>
        <td><a href=\"#\"><a href=\"consultaF7.php?1perAwtXyzdd22ret56=".$idencabezado."\" target=\"_blank\">".$nombre_himg."</a></td>
        <td>".$mes."</td>
		<td>
		
<form action=\"../modelos/updHeadCat.php\" enctype=\"multipart/form-data\" method=\"post\" target=\"insertFileImg".$idencabezado."\">
<span class=\"color1\">Encabezado catálogo en imágen jpg</span><br>
<input type=\"file\" id=\"archivo2\" name=\"archivo2\"><p class=\"marginTopGeneral\">

</p><input name=\"regLasInsertId\" value=\"".$idencabezado."\" type=\"hidden\"><input class=\"btn btn-default bloquearBoton\" type=\"submit\" onclick=\"espereUpLoad('".$idencabezado."')\" value=\"Colocar imagen\">

</form></td>
<td>

<div class=\"upLoad".$idencabezado."\" style=\"display: none; padding-top: 3%; visibility: visible;\"><div style=\"float:left\">Espere...</div><div style=\"width:16px;float:left\"><img src=\"loader.gif\" style=\"width:100%; max-width:100%;\"></div></div>

<iframe onload=\"respuestaUpLoad('".$idencabezado."')\" name=\"insertFileImg".$idencabezado."\" class=\"iframeGen\"></iframe></td>

</tr>";

}
$tablaEnc.="</tbody>
  </table>
  </div>";	
echo json_encode($tablaEnc);
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("Location: ../index.php");
		}
exit;
?>
