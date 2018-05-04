<?php
/**User: julio.ramos * Date: 14/08/2017 * Time: 03:22 PM */
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
    if(isset($_FILES["image_file"])){

        function sanear_string($string){$string=trim($string);$string=str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);$string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);$string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);$string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);$string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);$string=str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
//Esta parte se encarga de eliminar cualquier caracter extraño
            $string=str_replace(array('¨', 'º', '~', '#', '@', '|', '!', '"','·', '%', '&', '/','(', ')', '?', '\'', '¡','¿', '[', '^', '<code>', ']','+', '}', '{', '¨', '´','>', '<', ';', ',', ':','.'),'',$string);return $string;}


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
        if($_FILES["image_file"]["error"]!=0){
            echo ($phpFileUploadErrors[$_FILES["image_file"]["error"]]." Error:".$_FILES["image_file"]["error"]);
            exit;
        }
        $archivosPermitidos=Array('image/jpeg');
        if(!in_array($_FILES["image_file"]["type"],$archivosPermitidos)){
            echo ("Solo se permite imagen jpeg (foto)");
            exit;
        }

        $archivo = $_FILES["image_file"]["tmp_name"];
        $tamanio = $_FILES["image_file"]["size"];
        $tamanioProcesado=false;
        $tipo = $_FILES["image_file"]["type"];
        $nombre_archivo = $_FILES["image_file"]["name"];


        set_time_limit(0);
        $folder = "../../promo-medicas/";
        $file = basename( $_FILES['image_file']['name']);
        $full_path = $folder.$file;

        $newnamefile=explode(".", $file);
        $trimmed = trim($newnamefile[0]);
        $trimmedacentos=sanear_string($trimmed);
        $nameSinExtencion=$trimmedacentos;

        if ($tamanio<1048576){
            $numero=number_format($tamanio/1024, 0, '.', ',');
            $tamanioProcesado=array($numero,"KB");
        }

        if ($tamanio>1048576){
            $tamanioMB=$tamanio/1024;
            $numero=number_format($tamanioMB/1024, 3, '.', ',');
            $tamanioProcesado=array($numero,"MB");
        }

        if ($tamanio>2097152){
            echo $tamanioProcesado[0]." ".$tamanioProcesado[1]."<br> No se permiten imágenes mayores a 2 MB";
            exit;
        }

        //print_r ($_FILES['image_file']['tmp_name']);
        //exit;

        if(move_uploaded_file($_FILES['image_file']['tmp_name'], $full_path)) {
//echo "Carga exitosa";
//exit;
            $img_url= $full_path;
            /*************************************
             *
             ************************************/


            //Ruta de la imagen original
            $rutaImagenOriginal=$img_url;

            //Creamos una variable imagen a partir de la imagen original
            $img_original = imagecreatefromjpeg($rutaImagenOriginal);

            //Se define el maximo ancho o alto que tendra la imagen final
            $max_ancho = 3300;
            $max_alto = 1458;

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
            $calidad=70;

            //Se crea la imagen final en el directorio indicado
            $nuevaImgName="../../promo-medicas/".$nameSinExtencion."-.jpg";

            if(file_exists($nuevaImgName)){
                unlink($nuevaImgName);
            };


            $soloname=$nameSinExtencion."-.jpg";
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

        echo("Nombre: ".$nameSinExtencion."-.jpg<br>".$tamanioProcesado[0]." ".$tamanioProcesado[1]);
        /*



    //$insertarFile->idUsuariosExt=$userExt;
        $promoid=base64_decode($_SESSION["ficha"]);
        $insertarFile->idRegistroFicha=$promoid;
        $insertarFile->fileName=$nombre_archivo;//*
        $insertarFile->content=$contenido;//*
        $insertarFile->size=$tamanioProcesado[0];//*
        $insertarFile->unitSize=$tamanioProcesado[1];//*
        $insertarFile->type=$tipo;//*
        $updateImg=$insertarFile->upImgFichaCp();
        if($updateImg!="true"){
            echo ($updateImg);
        }else{
            echo ("Se almaceno su archivo: <br> <a href=\"../vista/consultaF3.php?1perAwtXyzdd22ret56=".$_SESSION["ficha"]."\" target=\"_blank\">".$nombre_archivo."</a>");
        }*/

        unlink($img_url);
        //unlink($nuevaImgName);
        exit;
        /*Termina Verificamos si se selecciono algun archivo
        ====================================================*/
    };

};
