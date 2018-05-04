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
	
//print_r($_POST);
//exit;	
	
include_once '../controlador/database2.php';
$database = new Database();
$db = $database->getConnection();

include_once 'regDir.php';
$reg_dir=new regDirSMB($db);

$valTransaccion=$reg_dir->selectValTransaccion($_POST["object_id"]);
//echo($_POST["object_id"]."/".$_POST["valPos"]);
//exit;

//$especialidadChage=$reg_dir->changeEspecialidad($_POST["object_id"],$_POST["valPos"]);
//print_r($especialidadChage);
$valTrans=array();

while($row=$valTransaccion->fetch(PDO::FETCH_ASSOC)){
	extract($row);
$valTrans[]="<tr>
        <td>".utf8_encode($Registro)."</td>
		<td>".utf8_encode($Especialidad)."&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil changeEspecialidad\" onclick=\"winOpen('".$No."',this)\"></span></td>
		<td>".utf8_encode($Estado)."&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil changeLocalidad\" onclick=\"winOpenLocalidad('".$No."',this)\"></span></td>
		<td>".utf8_encode($Subespecialidad)."</td>
		<td>".utf8_encode($Empresa)."</td>
		<td>".utf8_encode($Nombre)."</td>
		<td><span class=\"glyphicon glyphicon-edit editRegMed\" onclick=\"winOpen2('".$No."',this)\"></span></td>			
      </tr>";


	}

		echo json_encode($valTrans);
		exit;

	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("../index.php");
		};
?>