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


/*if($_POST){
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
		/*$res=$reg_promo->insertPromo(2);
		if($res!="Error:REG_PROMO. Intente más tarde"){
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: updPromo.php?liuiduncpro=".base64_encode($res));
			exit;
			}
		}else{
$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$validaDatos."</div>";
		}
	}*/


if ($trueIdSesion==1 && $_GET){
	
	$_SESSION["prom"]=$_GET["liuiduncpro"];
	$idPromo=base64_decode($_GET["liuiduncpro"]);
/*OBTENEMOS DATOS ACTUALES DE LA PROMOCION
========================================================================================================*/	
	include_once("../controlador/database.php");
	// get database connection
	$database=new Database;
	$db = $database->getConnection();
	// termina get database connection
	include_once("../modelos/regProm.php");
	$getDataPro=new regProm($db);
	$dataActualPromo=$getDataPro->getdataProXid($idPromo);
	$dataPromo=$dataActualPromo->fetch(PDO::FETCH_ASSOC);
	extract($dataPromo);
	
	
	/*OBTENEMOS SELECT DE LOCALIDADES
	===================================*/
	$dataSelectPromo=$getDataPro->getLocalidades();
	$listaLoc.="<select class=\"selectpicker\" style=\"width:100%\" name=\"localidad\" onChange=\"\">";
	$listaLoc.="<option value=\"0\" selected>--Selecciona localidad--</option>";
	while($rowListLoc=$dataSelectPromo->fetch(PDO::FETCH_ASSOC)){
		//print_r($rowListLoc);
		$listaLoc.="<option value=\"".$rowListLoc["id_localidades"]."\" >".utf8_encode($rowListLoc["nombre_localidad"]."</option>");
		}
	$listaLoc.="</select>";
	
	/*TERMINA OBTENEMOS SELECT DE LOCALIDADES
	===========================================*/
	
	
	
	
	//print_r ($dataPromo);

	
/*TERMINA OBTENEMOS DATOS ACTUALES DE LA PROMOCION
========================================================================================================*/	
	
	
// set page headers
$page_title = "Actualizar - promoción";
include_once "header.php";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewPromos.php?ty=".base64_encode($tipo_promo_fk)."' class='btn btn-default pull-right left-margin'>Ver promociones</a>";
echo "</div>";
	};
?>
<!--EDITAR PROMOCION

function respuestaUpLoad(elementoActual2){
		$(".bloquearBoton"+elementoActual2).removeAttr("disable");
		$(".upLoad"+elementoActual2).css("display","none");
		return false;
		}
        
 function espereUpLoad(elementoActual){
		$(".bloquearBoton"+elementoActual).attr("display","block");
		$(".upLoad"+elementoActual).css("display","block");
		return false;
		}

-->

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec1UpD.php" enctype="multipart/form-data" method="post" target="actualizarRegistro">
<label for="nombrePromocion"><span class="color1">Nombre promoción</span> </label><input class="w100" type="text" name="nombrePromocion" value="<?php echo( utf8_encode($dataPromo["nombre_promo"])) ?>" required="">
<label for="fechaCaducidad"><span class="color1">Fecha caducidad</span> </label><input class="datepicker w100" type="text" name="fechaCaducidad" value="<?php echo($dataPromo["fecha_caducidad"]) ?>" required="">
<label for="fechaPublicacion"><span class="color1">Fecha publicación</span> </label><input class="datepicker w100" type="text" name="fechaPublicacion" value="<?php echo($dataPromo["fecha_publicacion"]) ?>"  required="">
<input class="btn btn-default bloquearBoton marginTopGeneral" type="submit" onclick="espereUpLoad2('1')" value="Actualizar datos">
</form>
<!--div class="upLoad1" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div-->
<iframe name="actualizarRegistro" class="iframeGen"></iframe>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec2UpD.php" enctype="multipart/form-data" method="post" target="insertFileImg">
<span class="color1">Cuadro promoción en imágen jpg</span><br> 
<input type="file" id="archivo1" name="archivo1">
<p class="marginTopGeneral"><?php echo ("Imagen actual: <a href=\"consultaF.php?1perAwtXyzdd22ret56=".$_SESSION["prom"]."\" target=\"_blank\">".utf8_encode($nombre_archivo_img)."</a>"); ?></p>
<input name="regLasInsertId" value="MTQzLTE=" type="hidden">
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('2')" value="Colocar imagen">
<div class="upLoad2" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
<iframe onload="respuestaUpLoad('2')" name="insertFileImg" class="iframeGen"></iframe>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec3UpD.php" enctype="multipart/form-data" method="post" target="insertFilePdf">
<span class="color1">Documento PDF no mayor a 2 MB</span><br>
<input name="MAX_FILE_SIZE" value="2097152" type="hidden">  
<input type="file" id="archivo2" name="archivo2">
<p class="marginTopGeneral"><?php echo ("Archivo actual: <a href=\"consultaF2.php?1perAwtXyzdd22ret56=".$_SESSION["prom"]."\" target=\"_blank\">".utf8_encode($nombre_archivo_pdf)."</a>"); ?></p>
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('3')" value="Colocar archivo">
<div class="upLoad3" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
<iframe onload="respuestaUpLoad('3')" name="insertFilePdf" class="iframeGen"></iframe>
</div>
</div>



<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec2UpDpon.php" enctype="multipart/form-data" method="post" target="insertFileImgCupon">
<span class="color1">Imágen jpg para cuponera</span><br> 
<input type="file" id="archivoCupon" name="archivoCupon">
<p class="marginTopGeneral"><?php echo ("Imagen actual: <a href=\"consultaFpon.php?1perAwtXyzdd22ret56=".$_SESSION["prom"]."\" target=\"_blank\">".utf8_encode($nombre_cupon_img)."</a>"); ?></p>
<input name="regLasInsertId" value="MTQzLTE=" type="hidden">
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('4')" value="Colocar imagen">
<div class="upLoad4" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
<iframe onload="respuestaUpLoad('4')" name="insertFileImgCupon" class="iframeGen"></iframe>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

<form action="../modelos/sec4UpDlocProm.php" enctype="multipart/form-data" method="post" target="insertLocalidad">
<span class="color1">Asigna las localidades en las que aparece esta promoción</span>
<?php echo ($listaLoc); //sec4UpDloc.php?>
    <input type="hidden" value="<?php echo ($idPromo); ?>" name="updid">
<input class="btn btn-default bloquearBoton marginTopGeneral" type="submit" onclick="espereUpLoad('8')" value="Asignar localidad">
<div class="upLoad8" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<iframe onload="respuestaUpLoadLocalidad2('8','<?php echo ($idPromo); ?>')" name="insertLocalidad" class="iframeGen"></iframe>
</form>

</div>







    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <span class="color1">Localidades asignadas:</span>

        <div style="height: 113px; overflow-y: auto">

            <div class="contLoc"></div>

        </div>
        <input class="btn btn-default bloquearBoton marginTopGeneral" type="button" onclick="espereUpLoadLocalidad2('9','<?php echo ($idPromo); ?>')" value="Eliminar localidad seleccionada">
        <div class="upLoad9" style="padding-top: 3%; visibility: visible; display: none;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
        <p><span class="errorLoc" style="color:#FF0000"></span></p>
    </div>

</div>


<hr>
<p>
  <!--TERMINA EDITAR PROMOCION-->
</p>
<p>&nbsp; </p>


<?php
include_once "footer.php";
?>
