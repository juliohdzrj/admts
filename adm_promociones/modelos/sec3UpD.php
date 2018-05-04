<?php
session_start();
function sanear_string($string){$string=trim($string);$string=str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);$string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);$string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);$string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);$string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);$string=str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
//Esta parte se encarga de eliminar cualquier caracter extraño
    $string=str_replace(array('¨', 'º', '~', '#', '@', '|', '!', '"','·', '%', '&', '/','(', ')', '?', '\'', '¡','¿', '[', '^', '<code>', ']','+', '}', '{', '¨', '´','>', '<', ';', ',', ':','.'),'',$string);return $string;}
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
	if($_FILES["archivo2"]["error"]!=0){
		echo ($phpFileUploadErrors[$_FILES["archivo2"]["error"]]." Error:".$_FILES["archivo2"]["error"]);
		exit;
		}
$archivosPermitidos=Array('application/pdf');
if(!in_array($_FILES["archivo2"]["type"],$archivosPermitidos)){
	echo ("Solo se permite archivos PDF");
	exit;
	}

$archivo = $_FILES["archivo2"]["tmp_name"];
$tamanio = $_FILES["archivo2"]["size"];
$tamanioProcesado=false;
$tipo = $_FILES["archivo2"]["type"];
$nombre_archivo = $_FILES["archivo2"]["name"];

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
include_once("regProm.php");
$insertarFile=new regProm($db);
//$insertarFile->idUsuariosExt=$userExt;
$promoid=base64_decode($_SESSION["prom"]);
$insertarFile->idRegistroPromo=$promoid;//**
		$insertarFile->fileName=$nombre_archivo;//**
		$insertarFile->content=$contenido;//**
		$insertarFile->size=$tamanioProcesado[0];//**
		$insertarFile->unitSize=$tamanioProcesado[1];//**
		$insertarFile->type=$tipo;//**
$updatePdf=$insertarFile->updateFile2();
if($updatePdf==="false"){
	echo ($updatePdf);
	}else{
    //echo ($promoid);
    $fpdf=$insertarFile->getFpdf($promoid);
    $dataFpdf=$fpdf->fetch(PDO::FETCH_ASSOC);
    extract($dataFpdf);
    //print_r($dataFpdf);
    $strName=strtolower($nombre_promo);
    $trimmed = trim($strName);
    $trimmedacentos=sanear_string($trimmed);
    $name_file=preg_replace('/\s/i', "-", $trimmedacentos);

    $filename = "../../promociones/".utf8_decode($name_file)."-cupon.pdf";
    if (file_exists($filename)) {
        unlink($filename);
    }

    $fp = fopen($filename, "a");
    fwrite($fp, $cupon_pdf);
    fclose($fp);
    echo('Se almaceno su archivo: <br> <a href="http://servicioshuman.com.mx/promociones/'.utf8_decode($name_file).'.pdf" target="_blank">'.$name_file.'.pdf</a>');

	//echo ("Se almaceno su archivo: <br> <a href=\"../vista/consultaF2.php?1perAwtXyzdd22ret56=".$_SESSION["prom"]."\" target=\"_blank\">".$nombre_archivo."</a>");
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