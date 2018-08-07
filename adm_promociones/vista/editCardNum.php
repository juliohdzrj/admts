<?php
session_start();
$valMsj="Espere...";
$dataPost=json_decode(file_get_contents('php://input'),true);
$headers = apache_request_headers();
$valToken=$headers["Host"];
($valToken!="servicioshuman.mx")?$token="false":$token="true";
if($token!="true"){
	$valMsj="No autorizado";
	$datos=array("msg"=>$valMsj, "datosapi"=>false);
	echo json_encode($datos);
	exit;
}
/* GET CARD FOR ID
 * ######################################################*/
include_once("../controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../modelos/class.getdatacard.php");
$getDataCardForId=new getdatacard($db1);
$getDataCardForId->idcard=$dataPost["idcact"];
$getDataCardForId->cardToken=$dataPost["idtact"];
$getDataCardForId->orderNumber=$dataPost["nmoract"];
$requestResult=$getDataCardForId->getCardDataCurrent();
$row=$requestResult["code"]->fetch(PDO::FETCH_ASSOC);
$valMsj=$requestResult["msg"];
/* END GET CARD FOR ID
 * ######################################################*/
$datos=array("msg"=>$valMsj, "datosapi"=>$row);
echo json_encode($datos);
exit;