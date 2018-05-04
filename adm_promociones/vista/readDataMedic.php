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
	
	//echo("base con 48 registros");
	//exit;
	
	
//$valty=base64_decode($_GET["ty"]);
//echo($valty);


//$nrowSearchDir=$resSearchDir->rowCount();
//echo($nrowSearchDir);
//exit;

//$nrowSearchDir=$resEspecialidades->rowCount();
//echo($nrowSearchDir);


/*<select class="selectpicker edo49" onchange="changeEdo('49','edo49')">
  <option value="0">Suspendido</option>
  <option value="1" selected="">Activo</option>
</select>*/




	


//echo $selectEspecialida;
//exit;


// set page headers
$page_title = "Nuevos socios médicos";
include_once "header.php";
echo "<div class='right-button-margin'>";
	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
	echo "<a href=\"dirmediclist.php\" class=\"btn btn-default pull-right left-margin\">Directorio médico</a>";
echo "</div>";
	};
	
	
echo("

<form action=\"../modelos/regMedc.php\" enctype=\"multipart/form-data\" method=\"post\" target=\"insertFileImg\">
<span class=\"color1\">Archivo CSV con los nuevos registros</span><br> 
<input type=\"file\" id=\"archivo1\" name=\"archivo1\"><br>
<input class=\"btn btn-default bloquearBoton\" type=\"submit\" onclick=\"espereUpLoad('2')\" value=\"Colocar registros\">
<div class=\"upLoad2\" style=\"padding-top: 3%; visibility: visible; display: none;\">
<div style=\"float:left\">Espere...</div><div style=\"width:16px;float:left\"><img src=\"loader.gif\" alt=\"\" style=\"width:100%; max-width:100%;\"></div></div>

<iframe onload=\"respuestaUpLoad('2')\" name=\"insertFileImg\" style=\"margin: 0px;
    width: 100%;
    overflow: hidden;
    height: 600px;
    border: 0;
    padding-top: 3%;
    padding-bottom: 3%;
    padding-left: 0;
    padding-right: 0;\"></iframe>

</form>");		
	
exit;	
	
$file = fopen("filetmp/lista prueba read2.csv","r");
$filaDataArray=array();
while(! feof($file))
  {
  $filaDataArray[]=fgetcsv($file);
  }

fclose($file);
echo ("<pre/>");
//print_r($filaDataArray);
$filaOk=array();
foreach($filaDataArray as $dataFila){
	$filaOk[]=array(utf8_encode($dataFila[0]),utf8_encode($dataFila[1]),utf8_encode($dataFila[2]),utf8_encode($dataFila[3]),utf8_encode($dataFila[4]),utf8_encode($dataFila[5]),utf8_encode($dataFila[6]),utf8_encode($dataFila[7]),utf8_encode($dataFila[8]),utf8_encode($dataFila[9]),utf8_encode($dataFila[10]),utf8_encode($dataFila[11]),utf8_encode($dataFila[12]),utf8_encode($dataFila[13]),utf8_encode($dataFila[14]),utf8_encode($dataFila[15]),utf8_encode($dataFila[16]),utf8_encode($dataFila[17]),utf8_encode($dataFila[18]),utf8_encode($dataFila[19]));
	}
	
//print_r($filaOk);
//exit;


include_once("../controlador/database2.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regDir.php");
$reg_dir=new regDirSMB($db);
$resInsertDir=$reg_dir->InsertallDir($filaDataArray);
	
	
print_r($resInsertDir);
	
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
	
/*$selectEspecialidaOk="";
while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
	//extract($row2);
	//print_r($row2);
	$selectEspecialidaOk.="<option value=\"".$row2["id_especialidad"]."\">".utf8_encode($row2["nombre_especialidad"])."</option>";
}	*/

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
		<td>".utf8_encode($Especialidad)."&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil changeEspecialidad\" onclick=\"winOpen('".$No."',this)\"></span></td>
		<td>".utf8_encode($Subespecialidad)."</td>
		<td>".utf8_encode($Empresa)."</td>
		<td>".utf8_encode($Nombre)."</td>		
      </tr>");
}	
	*/
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