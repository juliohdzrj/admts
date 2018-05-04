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
//print_r($_POST);
include_once("../controlador/database.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("regFicha.php");
$udateNullFile=new regFichaSMB($db);

switch ($_POST['opsol']) {
    case "cimg1":
        $resUpdNull=$udateNullFile->upImgFichaCpNull($_POST['object_id']);
		echo ($resUpdNull);
        break;
    case "backimg2":
        $resUpdNull=$udateNullFile->upImgfichaBkNull($_POST['object_id']);
		echo ($resUpdNull);
		break;
    case "promopdf3":
        $resUpdNull=$udateNullFile->upPdfpromoNull($_POST['object_id']);
		echo ($resUpdNull);
		break;
	case "sucspdf4":
		$resUpdNull=$udateNullFile->upPdfsucNull($_POST['object_id']);
		echo ($resUpdNull);
		break;
}


//$insertarFile->idUsuariosExt=$userExt;
exit;
	};
?>