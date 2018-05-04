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
	if($_FILES["archivo4"]["error"]!=0){
		echo ($phpFileUploadErrors[$_FILES["archivo4"]["error"]]." Error:".$_FILES["archivo4"]["error"]);
		exit;
		}
$archivosPermitidos=Array('application/pdf');
if(!in_array($_FILES["archivo4"]["type"],$archivosPermitidos)){
	echo ("Solo se permite archivos PDF");
	exit;
	}

$archivo = $_FILES["archivo4"]["tmp_name"];
$tamanio = $_FILES["archivo4"]["size"];
$tamanioProcesado=false;
$tipo = $_FILES["archivo4"]["type"];
$nombre_archivo = $_FILES["archivo4"]["name"];

$fp = fopen($archivo, "r+b");
$contenido = fread($fp, filesize($archivo));
//$contenido = addslashes($contenido);
fclose($fp);

if ($tamanio<1048576){
$numero=number_format($tamanio/1024, 0, '.', ',');
$tamanioProcesado=array($numero,"KB");
}

if ($tamanio>1048576){
$tamanioMB=$tamanio/1024;
$numero=number_format($tamanioMB/1024, 3, '.', ',');
$tamanioProcesado=array($numero,"MB");
}

include_once("../controlador/database.php");
// get database connection
$database=new Database;
$db = $database->getConnection();
// termina get database connection
include_once("regFicha.php");
$insertarFile=new regFichaSMB($db);
//$insertarFile->idUsuariosExt=$userExt;
$promoid=base64_decode($_SESSION["ficha"]);
$insertarFile->idRegistroFicha=$promoid;//**
		$insertarFile->fileName3=$nombre_archivo;//**
		$insertarFile->content3=$contenido;//**
		$insertarFile->size3=$tamanioProcesado[0];//**
		$insertarFile->unitSize3=$tamanioProcesado[1];//**
		$insertarFile->type3=$tipo;//**
$updatePdf=$insertarFile->upPdfsuc();
	echo ($updatePdf);
if($updatePdf!="true"){
	echo ($updatePdf);
	}else{
	echo ("Se almaceno su archivo: <br> <a href=\"../vista/consultaF6.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".$nombre_archivo."</a>");
	}
exit;		










//$insertarFile=new almacenaArchivo($db);




/*

$insertarFile=new almacenaArchivo($db);
$insertarFile->title="erase test";
$insertarFile->fileName=$nombre_archivo;
$insertarFile->description="archivo almacenado por el usuario";
$insertarFile->content=$contenido;
$insertarFile->size=$tamanio[0];
$insertarFile->unitSize=$tamanio[1];
$insertarFile->type=$tipo;
$resInsert=$insertarFile->insertArchivo();

echo (" <pre/> ");
echo ($resInsert);
*/

//}
/*Termina Verificamos si se selecciono algun archivo
====================================================*/	
	};


//ESTA FUNCION LA USAREMOS PARA OBTENER EL TAMAÑO DE NUESTRO ARCHIVO
//function filesize_format($bytes){
//	return $bytes;
	//$bytes=(float)$bytes;



/*if ($bytes< 1024){
$numero=number_format($bytes, 0, '.', ',');
return array($numero,"B");
}*/
/*if ($bytes<1048576){
$numero=number_format($bytes/1024, 0, '.', ',');
return array($numero,"KBs");
}
if ($bytes>1048576){
$bytes2=$bytes/1024;	
$numero=number_format($bytes2/1024, 0, '.', ',');
return array($numero,"MB");
}*/

//}

/*TERMINA OBTENEMOS ARCHIVO
======================================================================================================*/
	
	
	/*
	// get database connection
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();

include_once '../modelos/regProm.php';
$upDPromo=new regProm($db);
$upDPromo->arrayDataPromo=$_POST;
$valDres=$upDPromo->valDatosPromo();	

if($valDres===true){
	$promoid=base64_decode($_SESSION["prom"]);
	$updateXID=$upDPromo->updataXid($promoid);
	print_r($updateXID);
	}else{
		echo($valDres);
		exit;
		};*/
	};
?>