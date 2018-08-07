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
include_once("../controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../modelos/class.numcard.php");
$getRegisterCardOrder=new NumCard($db1);
$requestRegisterOrder=$getRegisterCardOrder->getRegisterOrder($dataPost["order"]);
$countRegisterCard=$requestRegisterOrder["code"]->rowCount();
$valMsj=$requestRegisterOrder["msg"];


//$datos=array("msg"=>$valMsj,"msg2"=>$countRegisterCard, "datosapi"=>$dataOrderGeneral);
//echo json_encode($datos);
//exit;

include_once("../controlador/database3.php");
$database=new Database3;
$db = $database->getConnection();
include_once("../modelos/class.orders.php");
$getStatusTypeOrders=new get_orders($db);

$requestOrder=$getStatusTypeOrders->getStatusTypeOrder($dataPost["order"]);
$valMsj=$requestOrder["msg"];
$row=$requestOrder["code"]->fetch(PDO::FETCH_ASSOC);
$dataOrderGeneral=array();
$dataOrderItem=array();
$dataOrderAddress=array();
$numTotalArticle=false;
$dataOrderGeneral["status"]=array($row);
$requestOrder2=$getStatusTypeOrders->getItemsOrder($dataPost["order"]);
$valMsj=$requestOrder2["msg"];
$n=0;
while($row2=$requestOrder2["code"]->fetch(PDO::FETCH_ASSOC)){
	$dataOrderItem[$n]=array("itemid"=>$row2["order_item_id"]);
	$requestOrder3=$getStatusTypeOrders->getDetailItem($row2["order_item_id"]);
	//$valueMeta=array();
	$valMsj=$requestOrder3["msg"];
	while($row3=$requestOrder3["code"]->fetch(PDO::FETCH_ASSOC)){
		if($row3["meta_key"]=="_qty"){
			$numTotalArticle+=$row3["meta_value"];
			$dataOrderItem[$n][$row3["meta_key"]]=$row3["meta_value"];
		}
	};
	$n++;
};
$dataOrderGeneral["art"]=$dataOrderItem;
$requestOrder4=$getStatusTypeOrders->getAddressOrder($dataPost["order"]);
$valMsj=$requestOrder4["msg"];
while($row4=$requestOrder4["code"]->fetch(PDO::FETCH_ASSOC)){
	if($row4["meta_key"]=="_payment_method_title"){
		$dataOrderAddress["payment_method"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_billing_email"){
		$dataOrderAddress["billing_email"]=utf8_encode($row4["meta_value"]);
	}
};
$dataOrderGeneral["address"]=array($dataOrderAddress);
if($countRegisterCard<$numTotalArticle){
	$genToken=Time();
	$valMsj2=hash("sha512",$genToken);
	//$valMsj2=false;
	$_SESSION["tl"]=$valMsj2;
}
if($countRegisterCard>=$numTotalArticle){
	$valMsj2=false;
}
$datos=array("msg"=>$valMsj,"msg2"=>$valMsj2, "datosapi"=>$dataOrderGeneral);
echo json_encode($datos);
exit;