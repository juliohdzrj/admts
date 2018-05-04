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
	
// set page headers
$page_title = "Buscador - directorio médico";
include_once "header.php";
echo "<div class='right-button-margin'>";
	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
	echo "<a href=\"dirmediclist.php\" class=\"btn btn-default pull-right left-margin\">Directorio médico</a>";
echo "</div>";
	};
	
echo ("<div class=\"row\">

<div class=\"col-xs-12 col-sm-4 col-md-4 col-lg-4\">

<label for=\"fechaCaducidad\"><span class=\"color1\">Buscar por fecha de transacción</span> </label><input class=\"w100 f1 datepicker\" type=\"text\" name=\"fechaTransaccion\"  required><input class=\"btn btn-default\" type=\"button\" onClick=\"revisarTransaccion()\" value=\"Buscar registros\" style=\"margin-top:3%\">

</div>

<div class=\"col-xs-12 col-sm-4 col-md-4 col-lg-4\">

<label for=\"fechaCaducidad\"><span class=\"color1\">Buscar por fecha de Actualización</span> </label><input class=\"w100 f2 datepicker\" type=\"text\" name=\"fechaUpdate\"  required><input class=\"btn btn-default\" type=\"button\" onClick=\"revisarActualizacion()\" value=\"Buscar registros\" style=\"margin-top:3%\">

</div>

</div>

<div class=\"row\">

<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
<div class=\"resultSearch\" style=\"padding-top:3%;\">
<div class=\"table-responsive\">          
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
    <tbody>
	
	
</tbody>
  </table>
  </div>



</div>
</div>

</div>
"




);	
	
	
	

	
include_once "footer.php";

?>