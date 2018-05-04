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
include_once("../controlador/database.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regProm.php");
$getListaTipoCatalogo=new regProm($db);
$listaTipoCatalogo=$getListaTipoCatalogo->getListaCatalogoTipo();
$numPosicion=$listaTipoCatalogo->rowCount();
//$posicionN=$numPosicion-1;
//print_r ($listaTipoCatalogo);
//echo ($numPosicion);

// set page headers
$page_title = "Encabezados catalogo-cuponera";
include_once "header.php";
echo "<div class='right-button-margin'>";
	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
echo "</div>";
	};
	
$selectPosicion.="<select class=\"selectpicker\" onchange=\"changeTipoCat(this)\">";
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
echo "<div class=\"contEncabezados\" style=\"padding-top:2em;padding-bottom:2em\">&nbsp;</div>"; 
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