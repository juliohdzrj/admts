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
	
	//echo json_encode(array($_POST,base64_decode($_SESSION["ficha"])));
//exit;
	
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();

include_once '../modelos/regFicha.php';
$upDFicha=new regFichaSMB($db);



$posPromo=$upDFicha->changeEdoCarrucel($_POST["object_id"],base64_decode($_SESSION["ficha"]));

if($posPromo!=true){
	echo json_encode(array("Error:changePos, intente mas tarde.","error"));
	exit;
	}else{
		echo json_encode(array($posPromo,"ok"));
		exit;
		};

	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("../index.php");
		};
?>