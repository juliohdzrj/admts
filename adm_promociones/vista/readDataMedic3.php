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
//$resSearchDir=$reg_dir->allDir();

$resEspecialidades=$reg_dir->allEspecialidades();
    $page_title = "Directorio Médico - Especialidad";
    include_once "header.php";
    echo "<div class='right-button-margin'>";
    echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
    echo "<a href=\"dirmediclist.php\" class=\"btn btn-default pull-right left-margin\">Directorio médico</a>";
    echo "</div>";
};

echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
		<th>Especialidad | <span onclick=\"winOpen6()\" style=\"cursor: pointer\">Registrar especialidad <span style='color:red' class=\"glyphicon glyphicon-plus\"></span></span></th>
		<th>*</th>
      </tr>
    </thead>
    <tbody>");



$nameEspecialidad="";
while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
    //print_r($row2);
    //exit;
    echo("
      <tr>
        <td>".utf8_encode($row2["nombre_especialidad"])."</td>
		<td> <span class=\"glyphicon glyphicon-edit editRegMed\" onclick=\"winOpen4('".$row2["id_especialidad"]."',this)\"></span> <span class=\"glyphicon glyphicon-remove-circle editRegMed\" onclick=\"winOpen5('".$row2["id_especialidad"]."',this)\"></span> <span class=\"glyphicon glyphicon-picture editRegMed\" onclick=\"winOpen8('".$row2["id_especialidad"]."',this)\"></span> </td>		
      </tr>");
    $nameEspecialidad.="";
}
echo($nameEspecialidad);

echo("
    </tbody>
  </table>
  </div>
");
include_once "footer.php";
exit;
?>