<?php
session_start();
//$idFicha=base64_decode($_SESSION["ficha"]);
//echo json_encode(array($idFicha,"ok2"));
//exit;

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
//echo json_encode($_POST);
//exit;
//$idFicha=base64_decode($_SESSION["ficha"]);
	$idFicha=$_POST["object_id"];
include_once("../controlador/database.php");
$database=new Database;
$db = $database->getConnection();
include_once("../modelos/regFicha.php");
$getLocAsig=new regFichaSMB($db);
$listaLocAsig=$getLocAsig->getLocAsigProm($idFicha);
$nrow=$listaLocAsig->rowCount();
$dataLocAct=false;
//$dataLocAct.="";
//$arrayLoc=array();
while($rowLocAsig=$listaLocAsig->fetch(PDO::FETCH_ASSOC)){
	$dataLocAct.="<div class=\"checkbox\"><label><input type=\"checkbox\" name=\"localidad-".$rowLocAsig["id_localidades_asignadas_promo"]."\" value=\"".$rowLocAsig["id_localidades_asignadas_promo"]."\">".utf8_encode($rowLocAsig["nombre_localidad"])."</label></div>";
	//$arrayLoc[]=array("id_localidades"=>$rowLocAsig["id_localidades"],"id_localidades_asignadas"=>$rowLocAsig["id_localidades_asignadas"],"idcp_pdf_ficha"=>$rowLocAsig["idcp_pdf_ficha"],"nombre_localidad"=>utf8_encode($rowLocAsig["nombre_localidad"]));
	}
//$dataLocAct.="";	
echo json_encode(array($nrow,$dataLocAct));
exit;
	








	/*$idPromo=base64_decode($_GET["1perAwtXyzdd22ret56"]);
	include_once("../controlador/database.php");
	// get database connection
	$database=new Database;
	$db = $database->getConnection();
	// termina get database connection
	include_once("../modelos/regProm.php");
	$getFileImg=new regProm($db);
	$fImg=$getFileImg->getFimg($idPromo);
	$dataFImg=$fImg->fetch(PDO::FETCH_ASSOC);
	extract($dataFImg);*/
	/*$image64 = base64_encode($dataFImg["cp_img"]);
	$thumbnail='<img class="img-thumbnail" src="data:image/jpeg;base64,'.$image64.'"/>';*/
	
	/*header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
	header('Content-type: '.$tipo_img);
	header('Content-Disposition: inline; filename="'.utf8_encode($nombre_archivo_img).'"');
	print ($cp_img);
	*/
	
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("Location: ../index.php");
		}
exit;
?>
