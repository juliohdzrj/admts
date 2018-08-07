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
include_once("../controlador/database3.php");
$database=new Database;
$db = $database->getConnection();
include_once("../modelos/class.orders.php");
$getStatusTypeOrders=new get_orders($db);

$requestOrder=$getStatusTypeOrders->getStatusTypeOrder($dataPost["n"]);
$valMsj=$requestOrder["msg"];
$row=$requestOrder["code"]->fetch(PDO::FETCH_ASSOC);
$dataOrderGeneral=array();
$dataOrderItem=array();
$dataOrderAddress=array();
$dataOrderGeneral["status"]=array($row);
$requestOrder2=$getStatusTypeOrders->getItemsOrder($dataPost["n"]);
$valMsj=$requestOrder2["msg"];
$n=0;
while($row2=$requestOrder2["code"]->fetch(PDO::FETCH_ASSOC)){
	$dataOrderItem[$n]=array("itemid"=>$row2["order_item_id"],"name"=>utf8_encode($row2["order_item_name"]),"type"=>utf8_encode($row2["order_item_type"]));
	$requestOrder3=$getStatusTypeOrders->getDetailItem($row2["order_item_id"]);
	//$valueMeta=array();
	$valMsj=$requestOrder3["msg"];
	while($row3=$requestOrder3["code"]->fetch(PDO::FETCH_ASSOC)){
		if($row3["meta_key"]=="_qty"){
			$dataOrderItem[$n][$row3["meta_key"]]=$row3["meta_value"];
		}
		if($row3["meta_key"]=="_line_total"){
			$dataOrderItem[$n][$row3["meta_key"]]=$row3["meta_value"];
		}
		if($row3["meta_key"]=="_line_tax"){
			$dataOrderItem[$n][$row3["meta_key"]]=$row3["meta_value"];
		}
	};
	$n++;
};
$dataOrderGeneral["art"]=$dataOrderItem;

$requestOrder4=$getStatusTypeOrders->getAddressOrder($dataPost["n"]);
$valMsj=$requestOrder4["msg"];
while($row4=$requestOrder4["code"]->fetch(PDO::FETCH_ASSOC)){
	if($row4["meta_key"]=="_billing_address_index"){
		$dataOrderAddress["billing_address"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_shipping_address_index"){
		$dataOrderAddress["address_shipping"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_payment_method_title"){
		$dataOrderAddress["payment_method"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_order_total"){
		$dataOrderAddress["billing_total"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_billing_phone"){
		$dataOrderAddress["billing_phone"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_billing_email"){
		$dataOrderAddress["billing_email"]=utf8_encode($row4["meta_value"]);
	}
	if($row4["meta_key"]=="_billing_myfield12"){
		$dataOrderAddress["rfc"]=utf8_encode($row4["meta_value"]);
	}
};
$dataOrderGeneral["address"]=array($dataOrderAddress);

$datos=array("msg"=>$valMsj, "datosapi"=>$dataOrderGeneral);
echo json_encode($datos);
exit;
/*CONNECTION DB WP
##############################################################################*/



/*$dataOrders=array();
while($row=$requestOrder["code"]->fetch(PDO::FETCH_ASSOC)){
	$num_caracter=strlen($row["post_id"]);
	if($num_caracter>=5){
	$dataOrders[]=$row["post_id"];
	}
};*/
/*END CONNECTION DB WP
##############################################################################*/
/*$datos=array("msg"=>$valMsj, "datosapi"=>$dataOrders);
echo json_encode($datos);
exit;*/