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
    $nameespenew=trim($_POST["opsol"]);
    if(!preg_match('/^([A-Za-záéíóúñ]{2,2})([A-Za-záéíóúñ\s]{0,60})$/', $nameespenew)){
        echo json_encode(array("message"=>"<span style=\"color: red\">Proporcione un nombre válido, No utilice caracteres especiales</span>"));
        exit;
    }
    /*INSERT NOMBRE DE LA ESPECIALIDAD
    * =============================================================================*/
    include_once("../controlador/database2.php");
// get database connection
    $database=new Database;
    $db = $database->getConnection();
// termina get database connection
    include_once("../modelos/regDir.php");
    $reg_dir=new regDirSMB($db);
    $resInsertName=$reg_dir->regEspeMedicNew($nameespenew);
    echo json_encode(array("message"=>$resInsertName));
    /*TERMINA INSERT NOMBRE DE LA ESPECIALIDAD*/
    exit;
	};
?>