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
	
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();

include_once '../modelos/regProm.php';
$upDPromo=new regProm($db);
$posPromo=$upDPromo->changePos($_POST["object_id"],$_POST["valPos"]);

if($posPromo==="false"){
	echo ("Error:changePos, intente mas tarde.");
	exit;
	}else{
		echo ($posPromo);
		exit;
		};

	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("../index.php");
		};
?>