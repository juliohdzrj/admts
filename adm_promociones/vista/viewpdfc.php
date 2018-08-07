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
/* Generamos token de session
 * ######################################################*/
function gentk(){
	$genToken=Time();
	return hash("sha512",$genToken);
}
$tkSession=gentk();
$_SESSION["tklist"]=$tkSession;
/* Termina generamos token de session
 * ######################################################*/
/* GET LIST CARDS
 * ######################################################*/
include_once("../controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../modelos/class.listc.php");
$listCards=new Listc($db1);
$listCards->numberOrder=$dataPost["noa"];
$resultListCards=$listCards->getListCards();
$dataListCards=array();
while($row=$resultListCards["code"]->fetch(PDO::FETCH_ASSOC)){
	$dataListCards[]=$row;
};
/* END GET LIST CARDS
 * ######################################################*/

$datos=array("msg"=>$valMsj, "datosapi"=>$dataListCards);
echo json_encode($datos);
exit;

/* Validamos sesion token
 * #################################################*/
if($_SESSION["tl"]!=$dataPost["appid"]){
	$valMsj="reset";
	$datos=array("msg"=>$valMsj, "datosapi"=>$dataPost["appid"]);
	echo json_encode($datos);
	exit;
}
/* Termina Validamos sesion token
 * #################################################*/
/* Validar datos post
 * #################################################*/
function numberCard($numCard) {
	$num = preg_replace( '/\D+/', '', $numCard);
	return preg_match('/^[0-9]{14,14}$/',$num);
}
function dateValue($dateNumber) {
	$dateNumberok= trim($dateNumber);
	return preg_match('/^(\d{4})(\/|-)(0[1-9]|1[0-2])(\/|-)([0-2][0-9]|3[0-1])$/',$dateNumberok);
}
function typeCard($valueType) {
	$valueTypeok=trim($valueType);
	return preg_match('/Platinum|Black/',$valueTypeok);
}
$numCardVal=numberCard($dataPost["nt"]);
$numDateActive=dateValue($dataPost["da"]);
$numDateValid=dateValue($dataPost["dv"]);
$selectType=typeCard($dataPost["ty"]);
if($numCardVal==0){
	$valMsj="Error en número de tarjeta";
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
if($numDateActive==0){
	$valMsj="Error fecha activo";
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
if($numDateValid==0){
	$valMsj="Error fecha vigente";
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
if($selectType==0){
	$valMsj="Error tipo de tarjeta";
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
/* Termina validar datos post
 * #################################################*/
include_once("../controlador/database.php");
$database1=new Database;
$db1=$database1->getConnection();
include_once("../modelos/class.inc.php");
$insertNumberCard=new Inc($db1);
/* Validar número de tarjeta y que este no se repita
 * #################################################*/
$valNumberExist=$insertNumberCard->noRepeatNumberCard($dataPost["nt"]);
$countRepeatNumberCard=$valNumberExist["code"]->rowCount();
if($countRepeatNumberCard>0){
	$valMsj="El número de tarjeta ya existe, intente con otro número.";
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
/* Termina Validar número de tarjeta y que este no se repita
 * ##########################################################*/
/* Insertamos numero de tarjeta
 * ##########################################################*/
/*function gentk(){
	$genToken=Time();
	return hash("sha512",$genToken);
}*/
$gettk=gentk();
$insertNumberCard->nc=$dataPost["nt"];
$insertNumberCard->ty=$dataPost["ty"];
$insertNumberCard->da=$dataPost["da"];
$insertNumberCard->dv=$dataPost["dv"];
$insertNumberCard->od=$dataPost["od"];
$insertNumberCard->tk=$gettk;
$insertCardData=$insertNumberCard->insCardNumber();
if($insertCardData["code"]==222){
	$valMsj=$insertCardData["msg"];
	$datos=array("msg"=>$valMsj, "datosapi"=>"error");
	echo json_encode($datos);
	exit;
}
/* Termina insertamos numero de tarjeta
 * ##########################################################*/
$datos=array("msg"=>$valMsj, "datosapi"=>$insertCardData);
echo json_encode($datos);
exit;