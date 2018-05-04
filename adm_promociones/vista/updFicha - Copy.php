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
	
	$_SESSION["ficha"]=$_GET["liuiduncpro"];
	$idFicha=base64_decode($_GET["liuiduncpro"]);
/*OBTENEMOS DATOS ACTUALES DE LA PROMOCION
========================================================================================================*/	
	include_once("../controlador/database.php");
	// get database connection
	$database=new Database;
	$db = $database->getConnection();
	// termina get database connection
	include_once("../modelos/regFicha.php");
	$getDataFic=new regFichaSMB($db);
	$dataActualFicha=$getDataFic->getdataFicXid($idFicha);
	//print_r($dataActualFicha);
	$dataFicha=$dataActualFicha->fetch(PDO::FETCH_ASSOC);
	setcookie("subcat",$dataFicha["id_subcategoria"]);
	
	$listalocalidades=$getDataFic->getLocalidades();
	
	$listaLoc.="<select class=\"selectpicker\" style=\"width:100%\" name=\"localidad\" onChange=\"\">";
	$listaLoc.="<option value=\"0\" selected>--Selecciona localidad--</option>";
	while($rowListLoc=$listalocalidades->fetch(PDO::FETCH_ASSOC)){
		//print_r($rowListLoc);
		$listaLoc.="<option value=\"".$rowListLoc["id_localidades"]."\" >".utf8_encode($rowListLoc["nombre_localidad"]."</option>");
		}
	$listaLoc.="</select>";
		
		
	$listaCategorias=$getDataFic->getListaCatego($dataFicha["id_tipo_promo"]);
	
			$ListCatego.="<select class=\"selectpicker showlist\" style=\"width:100%\" name=\"categoria\" onChange=\"getvalIdCategoria3()\">";
			$ListCatego.="<option value=\"0\">--Selecciona categoría--</option>";
			while($rowListCatego=$listaCategorias->fetch(PDO::FETCH_ASSOC)){
				
				if($dataFicha["id_categoria"]==$rowListCatego["id_categoria"]){
						$ListCatego.="<option value=\"".$rowListCatego["id_categoria"]."\" selected>".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
					}else{
						$ListCatego.="<option value=\"".$rowListCatego["id_categoria"]."\">".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
						}		
				
				};
			$ListCatego.="</select>";
			
			//Obtenemos select de carrucel
			//================================
			
	($dataFicha["carrucel"]==0)? $selectCarrucel="<select class=\"selectpicker\" style=\"width: 100%; color: rgb(0, 0, 0);\" name=\"edoCarrucel\" onChange=\"edocarrucel(this.value)\"><option value=\"0\" selected>No incluir</option><option value=\"1\">Incluir</option></select>" : $selectCarrucel="<select class=\"selectpicker\" style=\"width: 100%; color: rgb(0, 0, 0);\" name=\"edoCarrucel\" onChange=\"edocarrucel(this.value)\"><option value=\"0\">No incluir</option><option value=\"1\" selected>Incluir</option></select>";			
			
			//Termina obtenemos select de carrucel
			//========================================
					
	//extract($dataFicha);
	//echo ("<pre>");
	//print_r ($dataFicha);
	/*TERMINA OBTENEMOS DATOS ACTUALES DE LA PROMOCION
========================================================================================================*/	
	

// set page headers
($dataFicha["id_tipo_promo"]==3)?$page_title = "Actualizar - ficha red comercial - ".$idFicha."<br>PDF: <a href=\"../../consultafgsv.php?1perAwtXyzdd22ret56=".$idFicha."\" target=\"_blank\"><i class=\"glyphicon glyphicon-file\"></i></a>"  : $page_title = "Actualizar - ficha red médica - ".$idFicha."<br>PDF: <a href=\"../../consultafgsv.php?1perAwtXyzdd22ret56=".$idFicha."\" target=\"_blank\"><i class=\"glyphicon glyphicon-file\"></i></a>";
//$page_title = "Actualizar - ficha red comercial";
($dataFicha["id_tipo_promo"]==3)?$verFichas_title = "Ver fichas red comercial" : $verFichas_title = "Ver fichas red médica";
($dataFicha["id_tipo_promo"]==3)?$newFicha_page = "fichaRedComercial.php" : $newFicha_page = "fichaRedMedica.php";
include_once "header.php";


echo ("<script>
	
	$(document).ready(function () {
	getvalIdCategoria3();
	getLocAsignadas();
	

	
	})
	
		</script>");


echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewFichas.php?ty=".base64_encode($dataFicha["id_tipo_promo"])."' class='btn btn-default pull-right left-margin'>".$verFichas_title."</a>";
	echo "<a href='".$newFicha_page."' class='btn btn-default pull-right left-margin'>Nueva ficha</a>";
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
<form action="../modelos/sec1Upficha.php" enctype="multipart/form-data" method="post" target="actualizarFichaS1">
<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<?php echo($ListCatego); ?> <br><br>
<label for="nombresocio"><span class="color1">Nombre socio</span> </label><input class="w100" type="text" name="nombresocio" value="<?php echo (utf8_encode($dataFicha["socio"])); ?>"  required>

<label for="noRegistro"><span class="color1">No. Registro</span> </label><input class="w100" type="text" name="noRegistro" value="<?php echo ($dataFicha["no_registro"]); ?>"  required>

<label for="fechaCaducidad"><span class="color1">Fecha caducidad</span> </label><input class="w100 datepicker" type="text" name="fechaCaducidad" value="<?php echo ($dataFicha["vigencia"]); ?>"  required="">
<label for="fechaPublicacion"><span class="color1">Fecha publicación</span> </label><input class="w100 datepicker" type="text" name="fechaPublicacion" value="<?php echo ($dataFicha["publicacion"]); ?>"  required="">
<label for="observaciones"><span class="color1">Observaciones</span> </label> <textarea class="w100 form-control" rows="5" name="observaciones" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["observaciones"])); ?></textarea>

</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div><select class="selectpicker selectSubCat" style="width:100%" name="subCategoria"><option value="0">--Selecciona categoría--</option></select></div>
<br>
<label for="contacto"><span class="color1">Contacto</span> </label><input class="w100" type="text" name="contacto" value="<?php echo (utf8_encode($dataFicha["contacto"])); ?>" >


<label for="telefono"><span class="color1">Teléfono</span> </label><input class="w100" type="text" name="telefono" value="<?php echo (utf8_encode($dataFicha["telefono"])); ?>"  required>

<label for="tituloPromo"><span class="color1">Título promoción</span> </label><!--input class="w100" type="text" name="tituloPromo" value=""-->

<textarea name="tituloPromo" rows="5" maxlength="1500" class="w100 form-control" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["titulo_promo"])); ?></textarea>


<label for="promocion"><span class="color1">Descripción</span> </label> <textarea name="descripcion" rows="5" maxlength="1500" class="w100 form-control" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["descripcion"])); ?></textarea>

<label for="promocion"><span class="color1">Promoción</span> </label> <textarea class="w100 form-control" rows="5" name="promocion" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["promocion_texto"])); ?></textarea>

<label for="sucursales"><span class="color1">Dirección</span> </label> <textarea class="w100 form-control" rows="5" name="sucursales" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["sucursales"])); ?></textarea>

</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<br><br>
<label for="paginaWeb"><span class="color1">Página web</span> </label><input class="w100" type="text" name="paginaWeb" value="<?php echo (utf8_encode($dataFicha["pagina_web"])); ?>">
<label for="facebook"><span class="color1">Facebook</span> </label><input class="w100" type="text" name="facebook" value="<?php echo (utf8_encode($dataFicha["facebook"])); ?>">
<label for="twitter"><span class="color1">Twitter</span> </label><input class="w100" type="text" name="twitter" value="<?php echo (utf8_encode($dataFicha["twitter"])); ?>">
<label for="email"><span class="color1">Email</span> </label><input class="w100" type="text" name="email" value="<?php echo (utf8_encode($dataFicha["email"])); ?>">
<label for="horarios"><span class="color1">Horarios</span> </label> <textarea class="w100 form-control" rows="5" name="horarios" style="width:100%; max-width:100%; height:100px; max-height:100px;"><?php echo (utf8_encode($dataFicha["horarios"])); ?></textarea>




<div class="color-view">

<label for="colortxtpdf"><span class="color1">Color-PDF</span> </label><br>
<input class="typecolor1" type="text" value="" placeholder="#8FC780" onBlur="getvalueColor('inputcolor1')"><br>
<input class="inputcolor1" name="colortxtpdf" type="color" name="color1" value="<?php ($dataFicha["colorpdf"]=="")?$color_pdf="#8FC780":$color_pdf=$dataFicha["colorpdf"]; echo $color_pdf; ?>"/>


</div>




</div>

</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="centrarDiv"><input class="btn btn-default bloquearBoton marginTopGeneral" type="submit" onclick="espereUpLoad2('1')" value="Actualizar datos"><br><iframe name="actualizarFichaS1" class="iframeGen"></iframe></div>

<hr>
</div>
</div>
</form>





<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

<form action="../modelos/sec2UpDcpf.php" enctype="multipart/form-data" method="post" target="insertFileImg">
<span class="color1">Cuadro promoción en imágen jpg</span><br> 
<input type="file" id="archivo1" name="archivo1">
<p class="marginTopGeneral"><?php echo ("Imagen actual: <a href=\"consultaF3.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".utf8_encode($dataFicha["nombre_cpimg"])."</a>"); ?></p>
<!--input name="regLasInsertId" value="MTQzLTE=" type="hidden"-->
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('2')" value="Colocar imagen">
<div class="upLoad2" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<iframe onload="respuestaUpLoad('2')" name="insertFileImg" class="iframeGen"></iframe>
</form>

<input class="btn btn-default" type="button" onclick="alert('ok')" value="Borrar imagen">

</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec2UpDbkf.php" enctype="multipart/form-data" method="post" target="insertFileImg2">
<span class="color1">Ilustración de fondo en imágen jpg</span><br> 
<input type="file" id="archivo2" name="archivo2">
<p class="marginTopGeneral"><?php echo ("Imagen actual: <a href=\"consultaF4.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".utf8_encode($dataFicha["nombre_bkimg"])."</a>"); ?></p>
<!--input name="regLasInsertId" value="MTQzLTE=" type="hidden"-->
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('3')" value="Colocar imagen">
<div class="upLoad3" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<iframe onload="respuestaUpLoad('3')" name="insertFileImg2" class="iframeGen"></iframe>
</form>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec3UpDpromo.php" enctype="multipart/form-data" method="post" target="insertFilePdf">
<span class="color1">Promoción en PDF no mayor a 2 MB </span><br>
<input name="MAX_FILE_SIZE" value="2097152" type="hidden">  
<input type="file" id="archivo3" name="archivo3">
<p class="marginTopGeneral"><?php echo ("Archivo actual: <a href=\"consultaF5.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".utf8_encode($dataFicha["nombre_promopdf"])."</a>"); ?></p>
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('5')" value="Colocar archivo">
<div class="upLoad5" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
<iframe onload="respuestaUpLoad('5')" name="insertFilePdf" class="iframeGen"></iframe>
</div>
</div>


<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form action="../modelos/sec3UpDsuc.php" enctype="multipart/form-data" method="post" target="insertFilePdf2">
<span class="color1">Sucursales en PDF no mayor a 2 MB </span><br>
<input name="MAX_FILE_SIZE" value="2097152" type="hidden">  
<input type="file" id="archivo4" name="archivo4">
<p class="marginTopGeneral"><?php echo ("Archivo actual: <a href=\"consultaF6.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".utf8_encode($dataFicha["nombre_sucpdf"])."</a>"); ?></p>
<input class="btn btn-default bloquearBoton" type="submit" onclick="espereUpLoad('6')" value="Colocar archivo">
<div class="upLoad6" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
</form>
<iframe onload="respuestaUpLoad('6')" name="insertFilePdf2" class="iframeGen"></iframe>
</div>




<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

</div>

</div>

<hr>

<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

<form action="../modelos/sec4UpDloc.php" enctype="multipart/form-data" method="post" target="insertLocalidad">
<span class="color1">Asigna las localidades en las que aparece esta ficha</span>
<?php echo ($listaLoc); ?>
<input class="btn btn-default bloquearBoton marginTopGeneral" type="submit" onclick="espereUpLoad('7')" value="Asignar localidad">
<div class="upLoad7" style="display: none; padding-top: 3%; visibility: visible;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<iframe onload="respuestaUpLoadLocalidad('7')" name="insertLocalidad" class="iframeGen"></iframe>
</form>

</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<span class="color1">Localidades asignadas:</span>

<div style="height: 113px; overflow-y: auto">

<div class="contLoc"></div>

</div>
<input class="btn btn-default bloquearBoton marginTopGeneral" type="button" onclick="espereUpLoadLocalidad('8')" value="Eliminar localidad seleccionada">
<div class="upLoad8" style="padding-top: 3%; visibility: visible; display: none;"><div style="float:left">Espere...</div><div style="width:16px;float:left"><img src="loader.gif" alt="" style="width:100%; max-width:100%;"></div></div>
<p><span class="errorLoc" style="color:#FF0000"></span></p>

</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<span class="color1">Incluir en carrucel:</span>
<?php echo ($selectCarrucel); ?>
</div>
</div>
<p>
  <!--TERMINA EDITAR PROMOCION-->
</p>
<p>&nbsp; </p>


<?php
include_once "footer.php";
?>
