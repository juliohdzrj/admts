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

if ($trueIdSesion==1 && $_GET){
	
	$idPromo=$_GET["1perAwtXyzdd22ret56"];
	include_once("../controlador/database.php");
	// get database connection
	$database=new Database;
	$db = $database->getConnection();
	// termina get database connection
	include_once("../modelos/regProm.php");
	$getFileImg=new regProm($db);
	$fImg=$getFileImg->getHimg3($idPromo);
	//print_r($fImg);
	//exit;
	
	
	$dataFImg=$fImg->fetch(PDO::FETCH_ASSOC);
	
	extract($dataFImg);
	
	/*$image64 = base64_encode($dataFImg["cp_img"]);
	$thumbnail='<img class="img-thumbnail" src="data:image/jpeg;base64,'.$image64.'"/>';*/
	
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
	header('Content-type: '.$tipo_himg);
	header('Content-Disposition: inline; filename="'.utf8_encode($nombre_himg).'"');
	print ($encabezado_jpg);
	
	
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("Location: ../index.php");
		}
exit;
?>
