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
	if($_FILES["archivo1"]["error"]!=0){
		echo ($phpFileUploadErrors[$_FILES["archivo1"]["error"]]." Error:".$_FILES["archivo1"]["error"]);
		exit;
		}
$archivosPermitidos=Array('image/jpeg');
if(!in_array($_FILES["archivo1"]["type"],$archivosPermitidos)){
	echo ("Solo se permite imagen jpeg (foto)");
	exit;
	}

$archivo = $_FILES["archivo1"]["tmp_name"];
$tamanio = $_FILES["archivo1"]["size"];
$tamanioProcesado=false;
$tipo = $_FILES["archivo1"]["type"];
$nombre_archivo = $_FILES["archivo1"]["name"];


set_time_limit(0);	  
$folder = "img/";
$file = basename( $_FILES['archivo1']['name']);
$full_path = $folder.$file;

if(move_uploaded_file($_FILES['archivo1']['tmp_name'], $full_path)) { 
//echo "Carga exitosa";
$img_url= $full_path;
/*************************************
 * 
 ************************************/


	//Ruta de la imagen original
	$rutaImagenOriginal=$img_url;
	
	//Creamos una variable imagen a partir de la imagen original
	$img_original = imagecreatefromjpeg($rutaImagenOriginal);
	
	//Se define el maximo ancho o alto que tendra la imagen final
	$max_ancho = 250;
	$max_alto = 250;
	
	//Ancho y alto de la imagen original
	list($ancho,$alto)=getimagesize($rutaImagenOriginal);
	
	//Se calcula ancho y alto de la imagen final
	$x_ratio = $max_ancho / $ancho;
	$y_ratio = $max_alto / $alto;
	
	//Si el ancho y el alto de la imagen no superan los maximos, 
	//ancho final y alto final son los que tiene actualmente
	if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
		$ancho_final = $ancho;
		$alto_final = $alto;
	}
	/*
	 * si proporcion horizontal*alto mayor que el alto maximo,
	 * alto final es alto por la proporcion horizontal
	 * es decir, le quitamos al alto, la misma proporcion que 
	 * le quitamos al alto
	 * 
	*/
	elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	}
	/*
	 * Igual que antes pero a la inversa
	*/
	else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
	
	//Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
	$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
	
	//Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
	imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	
	//Se destruye variable $img_original para liberar memoria
	imagedestroy($img_original);
	
	
	//Definimos la calidad de la imagen final
	$calidad=95;
	
	//Se crea la imagen final en el directorio indicado
	$nuevaImgName="img/r".$current_id.".jpg";
	imagejpeg($tmp,$nuevaImgName,$calidad);
	
	
	
	/* SI QUEREMOS MOSTRAR LA IMAGEN EN EL NAVEGADOR
	 * 
	 * descomentamos las lineas 64 ( Header("Content-type: image/jpeg"); ) y 65 ( imagejpeg($tmp); ) 
	 * y comentamos la linea 57 ( imagejpeg($tmp,"./imagen/retoque.jpg",$calidad); )
	 */ 
	/*Header("Content-type: image/jpeg");
	imagejpeg($tmp);*/
}



$fp = fopen($nuevaImgName, "r+b");
$contenido = fread($fp, filesize($nuevaImgName));
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
$insertarFile->idRegistroPromo=$promoid;
		$insertarFile->fileName=$nombre_archivo;//*
		$insertarFile->content=$contenido;//*
		$insertarFile->size=$tamanioProcesado[0];//*
		$insertarFile->unitSize=$tamanioProcesado[1];//*
		$insertarFile->type=$tipo;//*
$updateImg=$insertarFile->updateFile();
if($updateImg==="false"){
	echo ($updateImg);
	}else{
	echo ("Se almaceno su archivo: <br> <a href=\"../vista/consultaF.php?1perAwtXyzdd22ret56=".$_SESSION["prom"]."\" target=\"_blank\">".$nombre_archivo."</a>");
	}
unlink($img_url);
unlink($nuevaImgName);	
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