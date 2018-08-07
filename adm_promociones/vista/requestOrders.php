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
/*CONNECTION DB WP
##############################################################################*/
include_once("../controlador/database3.php");
$database=new Database;
$db = $database->getConnection();
include_once("../modelos/class.orders.php");
$getDataOrders=new get_orders($db);
$requestOrder=$getDataOrders->getOrders();
$valMsj=$requestOrder["msg"];
$dataOrders=array();
while($row=$requestOrder["code"]->fetch(PDO::FETCH_ASSOC)){
	$num_caracter=strlen($row["post_id"]);
	if($num_caracter>=5){
	$dataOrders[]=$row["post_id"];
	}
};
/*END CONNECTION DB WP
##############################################################################*/
$datos=array("msg"=>$valMsj, "datosapi"=>$dataOrders);
echo json_encode($datos);
exit;