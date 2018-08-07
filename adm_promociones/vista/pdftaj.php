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
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
    include_once '../modelos/regProm.php';
	$reg_promo = new regProm($db);
	$reg_promo->arrayDataPromo=$_POST;
	$validaDatos=$reg_promo->valDatosPromo();
	if($validaDatos===true){
		/*REGISTRAMOS PROMOCION Y DIRECCIONAMOS A EDICION POR ID*/
		$res=$reg_promo->insertPromo($_SESSION["typ"]);
		if($res!="Error:REG_PROMO. Intente más tarde"){
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: updPromo.php?liuiduncpro=".base64_encode($res));
			exit;
			}
		}else{
$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$validaDatos."</div>";
		}
	}


if ($trueIdSesion==1){
// set page headers
$_SESSION["typ"]=1;//SET TIPO DE PROMOCION 1 COMERCIAL, 2 MEDICA
$page_title = "Red comercial - Nueva promoción";
include_once "header.php";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewPromos.php?ty=".base64_encode($_SESSION["typ"])."' class='btn btn-default pull-right left-margin'>Ver promociones</a>";
echo "</div>";
	};
?>
<div class="row">
<form action="#" method="post" target="_self">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="nombrePromocion"><span class="color1">Nombre promoción</span> </label><input class="w100" type="text" name="nombrePromocion" value=""  required="">
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="fechaCaducidad"><span class="color1">Fecha caducidad</span> </label><input class="w100 datepicker" type="text" name="fechaCaducidad" value=""  required="">
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="fechaPublicacion"><span class="color1">Fecha publicación</span> </label><input class="w100 datepicker" type="text" name="fechaPublicacion" value=""  required="">
<button type="submit" class="btn btn-primary marginTopGeneral">Registrar promoción</button>
</div>
</form>
</div>

<!--EDITAR PROMOCION-->
<!--
<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="#" enctype="multipart/form-data" method="post" target="actualizarRegistro">
<label for="nombrePromocion"><span class="color1">Nombre promoción</span> </label><input style="width:100%" type="text" name="nombrePromocion" value="" placeholder="Nombre promoción" required="">
<label for="fechaCaducidad"><span class="color1">Fecha caducidad</span> </label><input style="width:100%" type="text" name="fechaCaducidad" value="" placeholder="Fecha caducidad" required="">
<label for="fechaPublicacion"><span class="color1">Fecha publicación</span> </label><input style="width:100%" type="text" name="fechaPublicacion" value="" placeholder="Fecha publicación" required="">
</form>
<div class="upLoad143" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="images1/loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<iframe onload="respuestaUpLoad('143')" name="actualizarRegistro" style="display:none"></iframe>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="#" enctype="multipart/form-data" method="post" target="insertFileImg">
<span class="color1">Cuadro promoción en imágen jpg</span><br> 
<input type="file" id="archivo1" name="archivo1"><br><br>
<input name="regLasInsertId" value="MTQzLTE=" type="hidden">
<input class="btn btn-default bloquearBoton143" type="submit" onclick="espereUpLoad('143')" value="Colocar imagen">
<div class="upLoad143" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="images1/loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="#" enctype="multipart/form-data" method="post" target="insertFilePdf">
<span class="color1">Documento PDF no mayor a 2 MB</span><br> 
<input type="file" id="archivo2" name="archivo2"><br><br>
<input name="regLasInsertId2" value="MTQzLTE=" type="hidden">
<input class="btn btn-default bloquearBoton143" type="submit" onclick="espereUpLoad('143')" value="Colocar archivo">
<div class="upLoad143" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="images1/loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
</div>
</div>
<hr>
-->
<!--TERMINA EDITAR PROMOCION-->
<?php
echo($msjError);
include_once "footer.php";
?>