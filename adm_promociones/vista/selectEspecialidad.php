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
if ($trueIdSesion==1){
	
	
include_once("../controlador/database2.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regDir.php");
$reg_dir=new regDirSMB($db);
//$resSearchDir=$reg_dir->allDir();

$resSearchDir=$reg_dir->regActual($_GET["valR"]);
$row1=$resSearchDir->fetch(PDO::FETCH_ASSOC);

$resEspecialidades=$reg_dir->allEspecialidades();

//print_r($_GET);
// set page headers
$page_title = "Cambiar especialidad - ".$row1["Registro"];
include_once "header.php";
echo "<div class='right-button-margin'>";
//	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
echo "</div>";
	};
	
/*echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        
        <th>Registro</th>
        
		<th>Especialidad</th>
		<th>id_especialidad</th>
		<th>Subespecialidad</th>
		
		<th>Empresa</th>
		<th>Nombre</th>
		
		
      </tr>
    </thead>
    <tbody>");*/
	
$selectEspecialidaOk="";
while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
	//extract($row2);
	//print_r($row2);
	if ($row2["id_especialidad"]==$row1["id_especialidad"]){
		$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\" selected>".utf8_encode($row2["nombre_especialidad"])."</option>";		
		}else{
			$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\">".utf8_encode($row2["nombre_especialidad"])."</option>";
			}
	
}	
echo ("<select class=\"selectpicker valedo".$_GET["valR"]."\" onchange=\"changeEspecialidadMedic('".$_GET["valR"]."')\">");
echo ("<option value=\"0\" selected>Selecciona especialidad</option>");
echo ($selectEspecialidaOk);
echo ("</select>");

/*while($row=$resSearchDir->fetch(PDO::FETCH_ASSOC)){
	extract($row);
	//$id_especialidad
	
//echo($row["No"]);
	
//$selectEspecialida="";
//$selectEspecialida.="<select class=\"selectpicker edo".$No."\" onchange=\"changeEspecialidadMedic('".$No."','edo".$No."')\" >";
//$selectEspecialida.='<option value=0>Asigna Especialidad</option>';


//echo ("<pre/>");
//$selectEspecialida.=$selectEspecialidaOk;

//$selectEspecialida.='</select>';
	
	
	
	
	
	
	
	echo("
      <tr>
        <td>".utf8_encode($Registro)."</td>
		<td>".utf8_encode($Especialidad)."&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\"><span class=\"glyphicon glyphicon-pencil\" onclick=\"winOpen('".$No."')\"></span></a></td>
		<td>".utf8_encode($Subespecialidad)."</td>
		<td>".utf8_encode($Empresa)."</td>
		<td>".utf8_encode($Nombre)."</td>		
      </tr>");
}	*/
	
/*echo("
    </tbody>
  </table>
  </div>
");*/
	
/*$selectPosicion.="<select class=\"selectpicker\" onchange=\"changeTipoCat(this)\">";
$selectPosicion.="<option value=\"0\" selected>Selecciona catálogo</option>";
while($row=$listaTipoCatalogo->fetch(PDO::FETCH_ASSOC)){
	extract($row);
	switch ($tipo_catalogo) {
    case 1:
        $nametipo="Cuponera comercial";
        break;
    case 2:
        $nametipo="Cuponera médica";
        break;
    case 3:
        $nametipo="Catálogo comercial";
        break;
	case 4:
        $nametipo="Catálogo médico";
        break;
}
	$selectPosicion.="<option value=\"".$tipo_catalogo."\">".$nametipo."</option>";
	//print_r($row);	
}
$selectPosicion.="</select>";

echo $selectPosicion; 
echo "<div class=\"contEncabezados\" style=\"padding-top:2em;padding-bottom:2em\">&nbsp;</div>";*/ 
include_once "footer.php";





/*echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        <th>#</th>
        <th>Imagen</th>
        <th>Mes</th>
      </tr>
    </thead>
    <tbody>");


	
echo("

    </tbody>
  </table>
  </div>


")*/	

?>