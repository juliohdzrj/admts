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
include_once "../vista/header.php";
/*OBTENEMOS ARCHIVO
======================================================================================================*/
if($_FILES){
	/*$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);*/

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'El archivo seleccionado no debe exceder los 2 MB',
    2 => 'El archivo seleccionado no debe exceder los 2 MB',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'Seleccione un archivo',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);
	if($_FILES["archivo1"]["error"]!=0){
		echo ($phpFileUploadErrors[$_FILES["archivo1"]["error"]]." Error:".$_FILES["archivo1"]["error"]);
		exit;
		}
$archivosPermitidos=Array('text/csv','text/plain','application/csv','text/comma-separated-values','application/excel','application/vnd.ms-excel','application/vnd.msexcel','text/anytext','application/octet-stream','application/txt');

if(!in_array($_FILES["archivo1"]["type"],$archivosPermitidos)){
	echo ("Solo se permite archivo CSV");
	exit;
	}

$archivo = $_FILES["archivo1"]["tmp_name"];
$tamanio = $_FILES["archivo1"]["size"];
//$tamanioProcesado=false;
$tipo = $_FILES["archivo1"]["type"];
$nombre_archivo = $_FILES["archivo1"]["name"];


set_time_limit(0);	  
$folder = "img/";
$file = basename($_FILES['archivo1']['name']);
$full_path = $folder.$file;

if(move_uploaded_file($_FILES['archivo1']['tmp_name'],$full_path)) {
	
include_once("../controlador/database2.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("../modelos/regDir.php");
$reg_dir=new regDirSMB($db);




$iniciarTransaccion=$reg_dir->iniTransaccion();

//$resInsertDir=$reg_dir->InsertallDir($filaDataArray);
	
//print_r($resInsertDir);





$file = fopen($full_path,"r");
$filaDataArray=array();
while(! feof($file))
  {
  $filaDataArray[]=fgetcsv($file);
  }
/*echo("<pre>");  
print_r($filaDataArray);
exit;*/  	


if($iniciarTransaccion===true){
	$resInsertDir=$reg_dir->InsertallDir($filaDataArray);
	//echo("<pre>");
	//print_r($resInsertDir);
	//exit();
	if($resInsertDir===true){
		$conData=$reg_dir->terminarTransaccion($filaDataArray);
		echo("Carga exitosa<br><br>");
		}
	};



//echo ("Carga exitosa<br><br>");

//echo ("<label for=\"fechaCaducidad\"><span class=\"color1\">Buscar por fecha de transacción</span> </label><input class=\"w100 datepicker\" type=\"text\" name=\"fechaCaducidad\"  required><input class=\"btn btn-default\" type=\"button\" onClick=\"revisarTransaccion()\" value=\"Buscar registros\" style=\"margin-top:3%\">");











	 
echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        <th>Registro</th>
		<th>Tipo_Red</th>
		<th>Especialidad</th>
		<th>Subespecialidad</th>
		<th>imagen</th>
		<th>Tipo</th>
		<th>Empresa</th>
		<th>Nombre</th>
		<th>Sucursal</th>
		<th>Direccion</th>
		<th>Delegacion</th>
		<th>Estado</th>
		<th>Telefonos</th>
		<th>Mail</th>
		<th>Horarios_atencion</th>
		<th>Paginaweb</th>
		<th>Estudios</th>
		<th>Promocion_human</th>
		<th>Observaciones</th>
		<th>imgficha</th>
      </tr>
    </thead>
    <tbody>");


//$filaOk=array();
foreach($filaDataArray as $dataFila){
	//$filaOk[]=array(utf8_encode($dataFila[0]),utf8_encode($dataFila[1]),utf8_encode($dataFila[2]),utf8_encode($dataFila[3]),utf8_encode($dataFila[4]),utf8_encode($dataFila[5]),utf8_encode($dataFila[6]),utf8_encode($dataFila[7]),utf8_encode($dataFila[8]),utf8_encode($dataFila[9]),utf8_encode($dataFila[10]),utf8_encode($dataFila[11]),utf8_encode($dataFila[12]),utf8_encode($dataFila[13]),utf8_encode($dataFila[14]),utf8_encode($dataFila[15]),utf8_encode($dataFila[16]),utf8_encode($dataFila[17]),utf8_encode($dataFila[18]),utf8_encode($dataFila[19]));
	
	echo("<tr>
        <td>".utf8_encode($dataFila[0])."</td>
		<td>".utf8_encode($dataFila[1])."</td>
		<td>".utf8_encode($dataFila[2])."</td>
		<td>".utf8_encode($dataFila[3])."</td>
		<td>".utf8_encode($dataFila[4])."</td>
		<td>".utf8_encode($dataFila[5])."</td>
		<td>".utf8_encode($dataFila[6])."</td>
		<td>".utf8_encode($dataFila[7])."</td>
		<td>".utf8_encode($dataFila[8])."</td>
		<td>".utf8_encode($dataFila[9])."</td>
		<td>".utf8_encode($dataFila[10])."</td>
		<td>".utf8_encode($dataFila[11])."</td>
		<td>".utf8_encode($dataFila[12])."</td>
		<td>".utf8_encode($dataFila[13])."</td>
		<td>".utf8_encode($dataFila[14])."</td>
		<td>".utf8_encode($dataFila[15])."</td>
		<td>".utf8_encode($dataFila[16])."</td>
		<td>".utf8_encode($dataFila[17])."</td>
		<td>".utf8_encode($dataFila[18])."</td>
		<td>".utf8_encode($dataFila[19])."</td>
      </tr>");
	
	
	
	}	


echo("
    </tbody>
  </table>
  </div>
");


//echo ("<pre>");
//print_r($filaOk);
exit;
}



		

	};

include_once "../vista/footer.php";
	
	};
?>