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

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado

if ($trueIdSesion==1 && $_GET){
	
/*"DELETE FROM `u233862_human`.`medica` WHERE `medica`.`No` = 12580"*/	

/*Obtener datos del registro por id
##################################*/

include_once("../controlador/database2.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regDir.php");

$reg_dir=new regDirSMB($db);
$resRegMedic=$reg_dir->regActualAll($_GET["valR"]);
$row=$resRegMedic->fetch(PDO::FETCH_ASSOC);

//$resEspecialidades=$reg_dir->allEspecialidades();

//echo ("<pre/>");
//print_r($row['act_sup']);

// set page headers

$page_title = "Suspender registro - ".$_GET["valR"];
include_once "header.php";

$selectEdoReg=false;
$selectEdoReg.='<select onChange="changeEdoregistromed('.$_GET["valR"].')" class="charegedoact'.$_GET["valR"].'">';
($row['act_sup']==1)?$selectEdoReg.='<option value="1" selected>Activo</option><option value="0">Suspendido</option>':$selectEdoReg.='<option value="1">Activo</option><option value="0" selected>Suspendido</option>';
$selectEdoReg.='</select>';	
	 

echo $selectEdoReg;

//echo "<div class='right-button-margin'>";
//	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
//echo "</div>";
	};
	
/*$selectEspecialidaOk="";
while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
	if ($row2["id_especialidad"]==$row["id_especialidad"]){
		$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\" selected>".utf8_encode($row2["nombre_especialidad"])."</option>";		
		}else{
			$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\">".utf8_encode($row2["nombre_especialidad"])."</option>";
			}
	
}*/	
/*echo ("

<form action=\"../modelos/updRegMedic.php\" method=\"post\" target=\"actualizarRegistroMedc\">




<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<select name=\"id_especialidad\" class=\"selectpicker valedo".$_GET["valR"]."\" ><option value=\"0\" selected>Selecciona especialidad</option>".$selectEspecialidaOk."</select>
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"nombrePromocion\"><span class=\"color1\">Registro</span> </label>
<input class=\"w100\" type=\"text\" name=\"Registro\" value=\"".utf8_encode($row["Registro"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"nombrePromocion\"><span class=\"color1\">Tipo red</span> </label>
<input class=\"w100\" type=\"text\" name=\"Tipo_Red\" value=\"".utf8_encode($row["Tipo_Red"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"nombrePromocion\"><span class=\"color1\">Especialidad</span> </label>
<input class=\"w100\" type=\"text\" name=\"Especialidad\" value=\"".utf8_encode($row["Especialidad"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"nombrePromocion\"><span class=\"color1\">Subespecialidad</span></label>
<input class=\"w100\" type=\"text\" name=\"Subespecialidad\" value=\"".utf8_encode($row["Subespecialidad"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"nombrePromocion\"><span class=\"color1\">Imagen</span></label>
<input class=\"w100\" type=\"text\" name=\"imagen\" value=\"".utf8_encode($row["imagen"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"Tipo\"><span class=\"color1\">Tipo</span></label>
<input class=\"w100\" type=\"text\" name=\"Tipo\" value=\"".utf8_encode($row["Tipo"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"Empresa\"><span class=\"color1\">Empresa</span></label>
<input class=\"w100\" type=\"text\" name=\"Empresa\" value=\"".utf8_encode($row["Empresa"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Nombre\"><span class=\"color1\">Nombre</span></label>
<input class=\"w100\" type=\"text\" name=\"Nombre\" value=\"".utf8_encode($row["Nombre"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Sucursal\"><span class=\"color1\">Sucursal</span></label>
<input class=\"w100\" type=\"text\" name=\"Sucursal\" value=\"".utf8_encode($row["Sucursal"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Delegacion\"><span class=\"color1\">Delegación</span></label>
<input class=\"w100\" type=\"text\" name=\"Delegacion\" value=\"".utf8_encode($row["Delegacion"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Estado\"><span class=\"color1\">Estado</span></label>
<input class=\"w100\" type=\"text\" name=\"Estado\" value=\"".utf8_encode($row["Estado"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"Direccion\"><span class=\"color1\">Dirección</span></label>
<textarea class=\"w100\" name=\"Direccion\">".utf8_encode($row["Direccion"])."</textarea>
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-bottom:3%\">
<label for=\"Telefonos\"><span class=\"color1\">Teléfonos</span></label>
<input class=\"w100\" type=\"text\" name=\"Telefonos\" value=\"".utf8_encode($row["Telefonos"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Mail\"><span class=\"color1\">E-Mail</span></label>
<input class=\"w100\" type=\"text\" name=\"Mail\" value=\"".utf8_encode($row["Mail"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Horarios_atencion\"><span class=\"color1\">Horarios de atención</span></label>
<textarea class=\"w100\" name=\"Horarios_atencion\">".utf8_encode($row["Horarios_atencion"])."</textarea>
</div>
</div>

<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Paginaweb\"><span class=\"color1\">Página web</span></label>
<input class=\"w100\" type=\"text\" name=\"Paginaweb\" value=\"".utf8_encode($row["Paginaweb"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Estudios\"><span class=\"color1\">Estudios</span></label>
<input class=\"w100\" type=\"text\" name=\"Estudios\" value=\"".utf8_encode($row["Estudios"])."\">
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Promocion_human\"><span class=\"color1\">Promoción Human</span></label>
<textarea class=\"w100\" name=\"Promocion_human\">".utf8_encode($row["Promocion_human"])."</textarea>
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"Observaciones\"><span class=\"color1\">Observaciones</span></label>
<textarea class=\"w100\" name=\"Observaciones\">".utf8_encode($row["Observaciones"])."</textarea>
</div>
</div>


<div class=\"row\">
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<label for=\"imgficha\"><span class=\"color1\">Imagen Ficha</span></label>
<input class=\"w100\" type=\"text\" name=\"imgficha\" value=\"".utf8_encode($row["imgficha"])."\">
</div>
<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\" style=\"padding-top:3%;padding-bottom:3%\">
<input class=\"w100\" type=\"text\" name=\"id_reg_update\" value=\"".$_GET["valR"]."\" hidden>
</div>
</div>

<input class=\"btn btn-default bloquearBoton\" type=\"submit\" onclick=\"espereUpLoad('4')\" value=\"Actualizar\">
<div class=\"upLoad4\" style=\"padding-top: 3%; visibility: visible; display: none;\"><div style=\"float:left\">Espere...</div><div style=\"width:16px;float:left\"><img src=\"loader.gif\" alt=\"\" style=\"width:100%; max-width:100%;\"></div></div>
<iframe name=\"actualizarRegistroMedc\" onload=\"respuestaUpLoad('4')\" class=\"iframeGen\"></iframe>
</form>


");*/
	
include_once "footer.php";
?>