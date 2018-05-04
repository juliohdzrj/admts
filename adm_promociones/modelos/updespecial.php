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
    $idespecialidadget=explode("-",$_POST["object_id"]);
    /*ACTUALIZAMOS NOMBRE DE LA ESPECIALIDAD POR ID
    * =============================================================================*/
    include_once("../controlador/database2.php");
// get database connection
    $database=new Database;
    $db = $database->getConnection();
// termina get database connection
    include_once("../modelos/regDir.php");
    $reg_dir=new regDirSMB($db);
    $resUpdateName=$reg_dir->updespecialidadesxid($idespecialidadget[1],utf8_decode($_POST["opsol"]));
    /*TERMINA ACTUALIZAMOS NOMBRE DE LA ESPECIALIDAD POR ID*/
    echo json_encode(array("message"=>$resUpdateName));
exit;
	};
?>