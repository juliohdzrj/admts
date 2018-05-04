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
$locid=$_POST["localidad"];
if($locid==="0"){
	echo("Selecciona una localidad");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
	exit;
	}

//INSERTAMOS LOCALIDAD ASIGNADA
//=========================================================================

include_once("../controlador/database.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regFicha.php");
$asignarLocalidad=new regFichaSMB($db);
$insertLoc=$asignarLocalidad->insertLocalidadAsig($promoid,$locid);
echo ($insertLoc);


//TERMINA INSERTAMOS LOCALIDAD ASIGNADA
//=========================================================================

exit;


	};
?>