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
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
if ($trueIdSesion==1){
    //BUSCAR ARCHIVOS EN DIRECTORIO
    //echo ("<pre>");

    $formFile='<form id="upload_form" enctype="multipart/form-data" method="post" action="../modelos/upimagengeneral.php" target="upimggeneral">
<label class="custom-file">
    <input type="file" id="file"  class="custom-file-input" name="image_file">
    <span class="custom-file-control"></span>
</label>
<br><br>
    <button type="submit" class="btn btn-primary">Subir imagen</button>
</form>
<object style="width:100%; height:64px;" data="../modelos/upimagengeneral.php" name="upimggeneral"></object>
';


    $inputNameImgSearch='
<form id="searchimg_form" enctype="multipart/form-data" method="post" action="../modelos/searchimagen.php" target="searchimg">
<div class="input-group">
  <span class="input-group-addon glyphicon glyphicon-search" style="top:0px !important;" id="basic-addon1"></span>
  <input name="txtsearch" type="text" class="form-control searchNameImagen"  placeholder="Nombre de imagen" aria-describedby="basic-addon1">
</div><br>
<button type="submit" class="btn btn-primary">Buscar</button>
</form>
<br>
<object data="../modelos/searchimagen.php" name="searchimg" style="width:100%;height:300px;"></object>
';
    /*$nameSearch="s";
    $htmlShowImg=false;
    $archivosname=glob("../../promo-medicas/[".$nameSearch."]*.{jpg}", GLOB_BRACE);
    //print_r($archivosname);
    if(count($archivosname)){
        natcasesort($archivosname);
        foreach($archivosname as $imgname) {
            $imgnamefiltrado=explode("/", $imgname);
            $htmlShowImg.='<div class="img-thumbnail" style="width: 280px"><img src="'.$imgname.'" title="'.$imgnamefiltrado[3].'" width="100%"></div><p>'.$imgnamefiltrado[3].'</p><br>';
            //echo $imgname."*".$imgnamefiltrado[3]."<br>";
        }
        //echo $htmlShowImg;
    }else{$htmlShowImg="Lo sentimos, no hay imágenes para mostrar";}*/

    $page_title = "Subir imagen";
    include_once "header.php";
    echo $formFile."<br>".$inputNameImgSearch;
    include_once "footer.php";
    exit;

    include_once("../controlador/database2.php");
// get database connection
    $database=new Database;
    $db = $database->getConnection();
// termina get database connection
    include_once("../modelos/regDir.php");
    $reg_dir=new regDirSMB($db);
    $getDataXeditar=$reg_dir->allDirXid($_GET["valR"]);
    $rowData=$getDataXeditar->fetch(PDO::FETCH_ASSOC);
    extract($rowData);
    $rutaimg = explode("/", $imgficha);
    $nelement=count($rutaimg);
    $rutaimgshow=false;
    ($nelement==2)?$rutaimgshow=$rutaimgshow="../../human/".utf8_encode($imgficha):$rutaimgshow="../../promo-medicas/".utf8_encode($imgficha);




$nameSocio='<p><b>Empresa:</b> '.utf8_encode($rowData["Empresa"]).'</p><p><b>Nombre:</b> '.utf8_encode($rowData["Nombre"]).'</p><br><div><img class="thumbnail"  width="100%" src="'.$rutaimgshow.'"></div>';
$formFile='<form id="upload_form" enctype="multipart/form-data" method="post" action="../modelos/upimagen.php" target="upimg">
<label class="custom-file">
<input type="hidden" value="'.$_GET["valR"].'" name="idsoc">
    <input type="file" id="file"  class="custom-file-input" name="image_file">
    <span class="custom-file-control"></span>
</label>
<br><br>
    <button type="submit" class="btn btn-primary">Actualizar</button><i style="cursor: pointer; color: #1b7aa6; font-size: 1.5em;
    margin-left: 5%;" class="glyphicon glyphicon-refresh" onclick="location.reload();"></i>
</form>
<object data="../modelos/upimagen.php" name="upimg"></object>
';
$page_title = "Editar imagen de ficha";
include_once "header.php";
echo $nameSocio.$formFile;
include_once "footer.php";
exit;
};
?>