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
$idCategoriaCodificado=$_GET["liuiduncpro"];
$idCategoria=base64_decode($_GET["liuiduncpro"]);
// get database connection
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
    include_once '../modelos/regFicha.php';
	$reg_catego=new regFichaSMB($db);
if(isset($_POST["nameCategoria"]) && isset($_SESSION["typ"])){
	
//print_r($_POST);
/*			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: editCatego1.php"); */


	$validaDatos=$reg_catego->valDatosCatego($_POST["nameCategoria"]);
	if($validaDatos===true){
		//echo "insertar registro de categoria";
		//echo ($_SESSION["typ"]);
		//exit;
		//REGISTRAMOS PROMOCION Y DIRECCIONAMOS A EDICION POR ID
		$res=$reg_catego->editCategoria($idCategoria, $_POST["nameCategoria"]);
		//echo $res;
		
		if($res!="Error:REG_CATEGORIA"){
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: editCatego1.php?liuiduncpro=".$idCategoriaCodificado);
			exit;
			}
		}else{
$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$validaDatos."</div>";
		}
	}


if ($trueIdSesion==1){
//Obtenomos lista de categorías
//========================================
	$ListCatego=false;
	$nameCategoriaXeditar=false;	
	$resListaCatego=$reg_catego->getListaCatego($_SESSION["typ"]);
	$nrowListCatego=$resListaCatego->rowCount();
	if($nrowListCatego===0){
		$ListCatego="No existen categorías";
		}else{
			$ListCatego.="<ul>";
			while($rowListCatego=$resListaCatego->fetch(PDO::FETCH_ASSOC)){
				//print_r($rowListCatego);
				if($rowListCatego["id_categoria"]==$idCategoria){
					$nameCategoriaXeditar=utf8_encode($rowListCatego["nombre_categoria"]);
				$ListCatego.="<li style=\"background-color:#87CEEB\">".utf8_encode($rowListCatego["nombre_categoria"])."</li>";	
					}else{
				$ListCatego.="<li>".utf8_encode($rowListCatego["nombre_categoria"])."</li>";
					}
				};
			$ListCatego.="</ul>";	
			
			}
	
	//print_r($nrowListCatego);
	
//Termina obtenomos lista de categorías
//========================================	
	
	
// set page headers
//$_SESSION["typ"]=3;//SET TIPO 1 PROMOCION COMERCIAL, 2 PROMOCION MEDICA, 3 FICHA COMERCIAL, 4 FICHA MEDICA  
($_SESSION["typ"]===3)?$page_title = "Red comercial - Editar CATEGORÍA":$page_title = "Red médica - Editar CATEGORÍA";
($_SESSION["typ"]===3)?$verFichas_title = "Ver fichas red comercial" : $verFichas_title = "Ver fichas red médica";
($_SESSION["typ"]===3)?$newFicha_page = "fichaRedComercial.php" : $newFicha_page = "fichaRedMedica.php";

include_once "header.php";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewFichas.php?ty=".base64_encode($_SESSION["typ"])."' class='btn btn-default pull-right left-margin'>".$verFichas_title."</a>";
	echo "<a href='".$newFicha_page."' class='btn btn-default pull-right left-margin'>Nueva ficha</a>";
	echo "<a href='editCatego.php' class='btn btn-default pull-right left-margin'>Ver categorías</a>";
echo "</div>";
	};
?>

<form action="#" method="post" target="_self">
<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<label for="nameCategoria"><span class="color1">Nombre categoría</span> </label><input class="w100" type="text" name="nameCategoria" value="<?php echo ($nameCategoriaXeditar); ?>"  required><br><br>
<div class="listaCategorias">

</div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>

</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="centrarDiv"><button type="submit" class="btn btn-default marginTopGeneral">Editar categoría</button></div>
<?php echo($msjError); ?>
</div>

</div>

</form>


<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<br><br>
<p>Categorías: <?php echo ($nrowListCatego) ?></p>
<div class="listaCategorias img-thumbnail" style="width:100%; height:200px; overflow:auto">
<?php print_r ($ListCatego); ?>
</div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>

</div>


<?php
include_once "footer.php";
?>