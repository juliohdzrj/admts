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

if($_POST){
// get database connection
//print_r($_POST);
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
    include_once '../modelos/regFicha.php';
	$reg_ficha2=new regFichaSMB($db);
	$reg_ficha2->arrayDataFicha=$_POST;
	$validaDatos=$reg_ficha2->valDatosFicha();
	//echo($validaDatos);
	//print_r ($validaDatos);	  
	if($validaDatos===true){
		//echo "insertar registro de ficha";
		//echo ($_SESSION["typ"]);
		//REGISTRAMOS PROMOCION Y DIRECCIONAMOS A EDICION POR ID
		$res=$reg_ficha2->insertFicha($_SESSION["typ"]);
		//echo $res;
		if($res!="Error:REG_FICHA. Intente más tarde"){
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: updFicha.php?liuiduncpro=".base64_encode($res));
			exit;
			}
		}else{
$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$validaDatos."</div>";
		}
	}


if ($trueIdSesion==1){
// set page headers
$_SESSION["typ"]=4;//SET TIPO 1 PROMOCION COMERCIAL, 2 PROMOCION MEDICA, 3 FICHA COMERCIAL, 4 FICHA MEDICA  
$page_title = "Red médica - Nueva FICHA";
include_once "header.php";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewFichas.php?ty=".base64_encode($_SESSION["typ"])."' class='btn btn-default pull-right left-margin'>Ver fichas red médica</a>";
	echo "<a href='regCategoria.php' class='btn btn-default pull-right left-margin'>Registrar categoría</a>";
	echo "<a href='regSubCategoria.php' class='btn btn-default pull-right left-margin'>Registrar Sub categoría</a>";
echo "</div>";
	};
?>

<form action="#" method="post" target="_self">
<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="nombresocio"><span class="color1">Nombre socio</span> </label><input class="w100" type="text" name="nombresocio" value=""  required="">
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="fechaCaducidad"><span class="color1">Fecha caducidad</span> </label><input class="w100 datepicker" type="text" name="fechaCaducidad" value=""  required="">
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="fechaPublicacion"><span class="color1">Fecha publicación</span> </label><input class="w100 datepicker" type="text" name="fechaPublicacion" value=""  required="">

</div>

</div>

<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="telefono"><span class="color1">Teléfono</span> </label><input class="w100" type="text" name="telefono" value=""  required="">
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="observaciones"><span class="color1">Observaciones</span> </label> <textarea class="w100 form-control" rows="5" name="observaciones" style="width:100%; max-width:100%; height:100px; max-height:100px;"></textarea>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="noRegistro"><span class="color1">No. Registro</span> </label><input class="w100" type="text" name="noRegistro" value=""  required="">
</div>

</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="centrarDiv"><button type="submit" class="btn btn-primary marginTopGeneral">Registrar ficha</button></div>
</div>

</div>

</form>

<?php
echo($msjError);
include_once "footer.php";
?>