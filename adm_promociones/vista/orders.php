<?php
session_start();
$valMsj="Espere...";
$dataPost=json_decode(file_get_contents('php://input'),true);
    $headers = apache_request_headers();
    $valToken=$headers["Host"];
($valToken!="servicioshuman.mx")?$token="false":$token="true";
$trimmed1 = trim($dataPost["u"]);
$passok=md5($trimmed1);
$pass_reg="/^([a-zA-z]{5,5})+([a-zA-z0-9\-\*]{5,30})$/";
if (!preg_match($pass_reg, $trimmed1)) {
	$valMsj="Proporcione un <br> token correcto";
	$datos=array("msg"=>$valMsj, "datosapi"=>"errorValidate");
	echo json_encode($datos);
	exit;
}
/*OBTENEMOS DATOS TOKEN
##############################################################################*/
include_once("../controlador/database.php");
$database=new Database;
$db = $database->getConnection();
include_once("../modelos/logusext.php");
$getdatauser=new log_user($db);
$datos_res=$getdatauser->getDatosUsuariointer("newt",$passok);
$num_row=$datos_res["code"]->rowCount();
if($num_row==0){
	$valMsj="Error token incorrecto";
	$res=$num_row;
	$_SESSION['token-api']=false;
}
if($num_row==1){
	$rowdata=$datos_res["code"]->fetch(PDO::FETCH_ASSOC);
	$_SESSION['token-api']=true;
	$res=array("nombre_user"=>utf8_encode($rowdata["password"]));
}
$datos=array("msg"=>$valMsj, "datosapi"=>$res, "temp"=>$_SESSION);
echo json_encode($datos);
exit;


    /*$datos_res=$getdatauser->getDatosUsuario($trimmed2,$passok);
	$num_row=$datos_res["code"]->rowCount();


	if($num_row==0){
		$valMsj="-";
		$res=$num_row;
	}
	if($num_row==1){
		//nombre_user, diremail, link_img
		$rowdata=$datos_res["code"]->fetch(PDO::FETCH_ASSOC);
		$res=array("nombre_user"=>utf8_encode($rowdata["nombre_user"]),"diremail"=>$rowdata["diremail"],"link_img"=>$rowdata["link_img"]);

	}
    /*TERMINA OBTENEMOS DATOS DEL USUARIO
    ##############################################################################*/
    /*$datos=array("msg"=>$valMsj, "datosapi"=>$res);
echo json_encode($datos);
exit;*/