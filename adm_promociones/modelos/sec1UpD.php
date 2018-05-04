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

if ($trueIdSesion==1 && $_POST){
	// get database connection
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();

include_once '../modelos/regProm.php';
$upDPromo=new regProm($db);
$upDPromo->arrayDataPromo=$_POST;
$valDres=$upDPromo->valDatosPromo();	

if($valDres===true){
	$promoid=base64_decode($_SESSION["prom"]);
	$updateXID=$upDPromo->updataXid($promoid);
	print_r($updateXID);
	}else{
		echo($valDres);
		exit;
		};	
//print_r($valDres);

//echo(base64_decode($_SESSION["prom"]));
//echo("update");
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("../index.php");
		};


?>