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

$promoid=base64_decode($_SESSION["ficha"]);
//echo json_encode($_POST);
//exit;
if(empty($_POST)){
	echo("Selecciona una localidad");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
	exit;
	}
$txtVal=implode(",",$_POST["object_id"]);
//echo json_encode(array($txtVal,'ok23'));
//exit;

	
	
	
	

//INSERTAMOS LOCALIDAD ASIGNADA
//=========================================================================

include_once("../controlador/database.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regFicha.php");
$delLocalidad=new regFichaSMB($db);
$delLoc=$delLocalidad->delLocalidadAsig($txtVal);
echo json_encode($delLoc);


//TERMINA INSERTAMOS LOCALIDAD ASIGNADA
//=========================================================================

exit;


	};
?>