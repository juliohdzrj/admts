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
if ($trueIdSesion==1 && $_GET){
    //print_r($_GET);
    //exit;
    include_once("../controlador/database2.php");
// get database connection
    $database=new Database;
    $db = $database->getConnection();
// termina get database connection
    include_once("../modelos/regDir.php");
    $reg_dir=new regDirSMB($db);
    $getDataEspecialidad=$reg_dir->especialidadXid($_GET["valR"]);
    $rowData=$getDataEspecialidad->fetch(PDO::FETCH_ASSOC);
    //print_r($rowData);
    //extract($rowData);

    $nameEspecialidad='<p><b>Especialidad:</b> '.utf8_encode($rowData["nombre_especialidad"]).'</p><br><div><img class="thumbnail"  width="100%" src="../../promo-medicas/'.utf8_encode($rowData['imagenesp']).'"></div><br>';
$formFile='<form id="upload_form" enctype="multipart/form-data" method="post" action="../modelos/upimagenesp.php" target="upimg">
<label class="custom-file">
<input type="hidden" value="'.$_GET["valR"].'" name="idsoc">
    <input type="file" id="file"  class="custom-file-input" name="image_file">
    <span class="custom-file-control"></span>
</label>
<br><br>
    <button type="submit" class="btn btn-primary">Actualizar</button> <i style="cursor: pointer; color: #1b7aa6; font-size: 1.5em;
    margin-left: 5%;" class="glyphicon glyphicon-refresh" onclick="location.reload();"></i>
</form>
<object data="../modelos/upimagenesp.php" name="upimg"></object>
';
$page_title = "Editar imagen de especialidad";
include_once "header.php";
echo $nameEspecialidad.$formFile;
include_once "footer.php";
exit;
};
?>