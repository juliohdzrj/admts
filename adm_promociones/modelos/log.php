<?php
$valMsj="Espere...";
$dataPost=json_decode(file_get_contents('php://input'),true);
    $headers = apache_request_headers();
    $valToken=$headers["Host"];
($valToken!="servicioshuman.mx")?$token="false":$token="true";

//echo json_encode($headers);
//exit;

if($token!="true"){
    $valMsj="No autorizado";
    $datos=array("msg"=>$valMsj, "datosapi"=>false);
    echo json_encode($datos);
    exit;
}
    /*if ($headers["authorization"]=='35f13ff714ce50c37baccead2e5a90c5='){
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode($headers);
        exit;
    }*/

$trimmed1 = trim($dataPost["p"]);
$trimmed2 = trim($dataPost["u"]);
$passok=md5($trimmed1);

    $email_reg="/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/";
    $pass_reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/";
    if (!preg_match($pass_reg, $trimmed1)) {
        $valMsj="Proporcione una <br> contraseña correcta";
    }
    if (!preg_match($email_reg, $trimmed2)) {
        $valMsj="Proporcione un <br> correo correcto";
    }
//$valMsj=session_id();
    /*OBTENEMOS DATOS DEL USUARIO
    ##############################################################################*/
    include_once("../controlador/database.php");
    $database=new Databaseapi;
    $db = $database->getConnection();
    include_once("../modelos/logusext.php");
    $getdatauser=new log_user($db);
    $datos_res=$getdatauser->getDatosUsuario($trimmed2,$passok);
	$num_row=$datos_res["code"]->rowCount();
    //$datos=array("msg"=>$valMsj, "datosapi"=>$datos_res);

//$datos=array("msg"=>$datos_res,"norepit"=>$headers["authorization"],"dpost"=>$dataPost,"list"=>array(array("d0"=>"0","d1"=>"1"),array("d0"=>"2","d1"=>"3"))); /*LA VARIABLE POST SOLO ES UN ARRAY EL CUAL NO SE REPITE, ARMAR LISTA CON VALORES REPETIDOS EN ESTE CASO UNA FILA*/
//echo json_encode($datos);
//exit;


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
    $datos=array("msg"=>$valMsj, "datosapi"=>$res);

//$datos=array("msg"=>$datos_res,"norepit"=>$headers["authorization"],"dpost"=>$dataPost,"list"=>array(array("d0"=>"0","d1"=>"1"),array("d0"=>"2","d1"=>"3"))); /*LA VARIABLE POST SOLO ES UN ARRAY EL CUAL NO SE REPITE, ARMAR LISTA CON VALORES REPETIDOS EN ESTE CASO UNA FILA*/
echo json_encode($datos);
exit;