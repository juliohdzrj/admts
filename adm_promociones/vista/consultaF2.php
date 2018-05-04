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

function sanear_string($string){
	$string=trim($string);
	$string=str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);
	$string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);
	$string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);
	$string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);
	$string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);
	$string=str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
//Esta parte se encarga de eliminar cualquier caracter extraño
    $string=str_replace(array('¨', 'º', '~', '#', '@', '|', '!', '"','·', '%', '&', '/','(', ')', '?', '\'', '¡','¿', '[', '^', '<code>', ']','+', '}', '{', '¨', '´','>', '<', ';', ',', ':','.'),'',$string);
    return $string;}

if ($trueIdSesion==1 && $_GET){
	$idPromo=base64_decode($_GET["1perAwtXyzdd22ret56"]);
	include_once("../controlador/database.php");
	// get database connection
	$database=new Database;
	$db = $database->getConnection();
	// termina get database connection
	include_once("../modelos/regProm.php");
	$getFilePdf=new regProm($db);
	$fpdf=$getFilePdf->getFpdf($idPromo);
	$dataFpdf=$fpdf->fetch(PDO::FETCH_ASSOC);
	extract($dataFpdf);
	/*$image64 = base64_encode($dataFImg["cp_img"]);
	$thumbnail='<img class="img-thumbnail" src="data:image/jpeg;base64,'.$image64.'"/>';*/
	//print_r($dataFpdf);
    $strName=utf8_encode($nombre_promo);
    $strName=strtolower($strName);
    $trimmedacentos=sanear_string($strName);
    $name_file=preg_replace('/\s/i', "-", $trimmedacentos);

    $name_file=strtolower($name_file);

    $filename = "../../promociones/".utf8_encode($name_file).".pdf";
    if (file_exists($filename)) {
        unlink($filename);
    }

    $fp = fopen($filename, "a");
    fwrite($fp, $cupon_pdf);
    fclose($fp);
if (file_exists($filename)) {
	//echo($filename);
	//echo('<a href="http://servicioshuman.com.mx/promociones/'.utf8_decode($name_file).'.pdf">link</a>');
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
    header('Content-type: '.$tipo_pdf);
    header('Content-Disposition: inline; filename="'.utf8_encode($nombre_archivo_pdf).'"');
    print ($cupon_pdf);
}
    exit;
    //$filename = "../../promociones/".utf8_decode($trimmedacentos).".pdf";




	
	
	}else{
		header("HTTP/1.1 301 Moved Permanently"); 
    	header("Location: ../index.php");
		}


exit;
?>
