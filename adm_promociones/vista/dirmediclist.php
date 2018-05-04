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

if ($trueIdSesion==1){
	
include_once("../controlador/database2.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regDir.php");
$reg_dir=new regDirSMB($db);
$resSearchDir=$reg_dir->allDir();

$resEspecialidades=$reg_dir->allEspecialidades();



// set page headers
$page_title = "Directorio Médico";
include_once "header.php";
echo "<div class='right-button-margin'>";
	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
	echo "<a href=\"readDataMedic.php\" class=\"btn btn-default pull-right left-margin\">Nuevos socios</a>";
	echo "<a href=\"readDataMedic2.php\" class=\"btn btn-default pull-right left-margin\">Buscar</a>";
    echo "<a href=\"readDataMedic3.php\" class=\"btn btn-default pull-right left-margin\">Especialidad</a>";
    echo "<a href=\"#\" onclick=\"winOpen9()\" class=\"btn btn-default pull-right left-margin\">Imágenes</a>";
echo "</div>";
	};
	
echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        
        <th>Registro</th>
        
		<th>Especialidad</th>
		
		<th>Localidad</th>
		
		<th>Subespecialidad</th>
		
		<th>Empresa</th>
		<th>Nombre</th>
		<th></th>
		
      </tr>
    </thead>
    <tbody>");
	
$selectEspecialidaOk="";
while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
	$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\">".utf8_encode($row2["nombre_especialidad"])."</option>";
}	

while($row=$resSearchDir->fetch(PDO::FETCH_ASSOC)){
	extract($row);
	echo("
      <tr>
        <td>".utf8_encode($Registro)."</td>
		<td>".utf8_encode($Especialidad)."&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil changeEspecialidad\" onclick=\"winOpen('".$No."',this)\"></span></td>
		<td>".utf8_encode($Estado)."&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil changeLocalidad\" onclick=\"winOpenLocalidad('".$No."',this)\"></span></td>
		<td>".utf8_encode($Subespecialidad)."</td>
		<td>".utf8_encode($Empresa)."</td>
		<td>".utf8_encode($Nombre)."</td>
		<td> <span class=\"glyphicon glyphicon-edit editRegMed\" onclick=\"winOpen2('".$No."',this)\"></span> <span class=\"glyphicon glyphicon-remove-circle editRegMed\" onclick=\"winOpen3('".$No."',this)\"></span> <span class=\"glyphicon glyphicon-picture editRegMed\" onclick=\"winOpen7('".$No."',this)\"></span> </td>		
      </tr>");
}	
	
echo("
    </tbody>
  </table>
  </div>
");
	

include_once "footer.php";

?>