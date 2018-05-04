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

include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
    include_once '../modelos/regFicha.php';
	$reg_catego=new regFichaSMB($db);

$idSubCatego=$_GET["liuiduncpro"];
setcookie("subcatego", $idSubCatego);


if($_POST && isset($_SESSION["typ"])){
// get database connection


	$validaDatos=$reg_catego->valDatosCatego($_POST["nameCategoria"]);
	if($validaDatos===true){
		//print_r($_POST);
		//REGISTRAMOS SUBCATEGORÍA
		$res=$reg_catego->updateSubCatego($idSubCatego , $_POST["nameCategoria"]);
		//echo $res;
		//exit;
		if($res==true){
			setcookie("catego",$_POST["categoria"]);
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: editSubCatego1.php?liuiduncpro=".$idSubCatego);
			//exit;
			}
		}else{
		
		$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$validaDatos."</div>";
		}
	
	/*if($_POST["categoria"]==0){
		
	$msjError="<div class=\"alert alert-danger alert-dismissable marginTopGeneral\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Selecciona una categoría</div>";
		
		}*/	
	
		
	}


if ($trueIdSesion==1 && isset($_GET["liuiduncpro"])){
//Obtenomos datos de sub categoría
//========================================

	$ressubCatego=$reg_catego->getsubCatego($idSubCatego);
	$nrowSubCatego=$ressubCatego->rowCount();
	//$nrowsubCatego=$ressubCatego->rowCount();

//Termina obtenomos datos de sub categoría
//========================================



//Obtenomos lista de categorías
//========================================
	$ListCatego=false;	
	$resListaCatego=$reg_catego->getListaCatego($_SESSION["typ"]);
	$nrowListCatego=$resListaCatego->rowCount();
	if($nrowListCatego===0 && $nrowSubCatego===0){
		$ListCatego="No existe registro";
		}else{
			//Obtenomos datos de sub categoría
			//========================================
			$dataSubCat=$ressubCatego->fetch(PDO::FETCH_ASSOC);
			setcookie("catego", $dataSubCat["id_categoria"]);
			//print_r($dataSubCat);
			
			//termina Obtenomos datos de sub categoría
			//========================================
			
			$ListCatego2.="<select class=\"selectpicker showlist\" style=\"width:100%\" name=\"categoria1\" onChange=\"getvalIdCategoria()\">";
			$ListCatego2.="<option value=\"0\">--Selecciona categoría--</option>";


			$ListCatego.="<select class=\"selectpicker\" style=\"width:100%\" name=\"categoria\" disabled>";
			$ListCatego.="<option value=\"0\">--Selecciona categoría--</option>";
			while($rowListCatego=$resListaCatego->fetch(PDO::FETCH_ASSOC)){
				
				
				if($dataSubCat["id_categoria"]==$rowListCatego["id_categoria"]){
					$ListCatego2.="<option value=\"".$rowListCatego["id_categoria"]."\" selected>".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
					}else{
						$ListCatego2.="<option value=\"".$rowListCatego["id_categoria"]."\">".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
						}
				if($dataSubCat["id_categoria"]==$rowListCatego["id_categoria"]){
						$ListCatego.="<option value=\"".$rowListCatego["id_categoria"]."\" selected>".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
					}else{
						$ListCatego.="<option value=\"".$rowListCatego["id_categoria"]."\">".utf8_encode($rowListCatego["nombre_categoria"]."</option>");
						}		
						
						
				
				};
			$ListCatego2.="</select>";	
			$ListCatego.="</select>";	
			}
	
	//print_r($nrowListCatego);
	
//Termina obtenomos lista de categorías
//========================================	
	
	
// set page headers
//$_SESSION["typ"]=3;//SET TIPO 1 PROMOCION COMERCIAL, 2 PROMOCION MEDICA, 3 FICHA COMERCIAL, 4 FICHA MEDICA  
//$page_title = "Red comercial - Editar SUBCATEGORÍA";
($_SESSION["typ"]===3)?$page_title = "Red comercial - Editar SUBCATEGORÍA" : $page_title = "Red médica - Editar SUBCATEGORÍA";
($_SESSION["typ"]===3)?$verFichas_title = "Ver fichas red comercial" : $verFichas_title = "Ver fichas red médica";
($_SESSION["typ"]===3)?$newFicha_page = "fichaRedComercial.php" : $newFicha_page = "fichaRedMedica.php";
include_once "header.php";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right left-margin'>Inicio</a>";
	echo "<a href='viewFichas.php?ty=".base64_encode($_SESSION["typ"])."' class='btn btn-default pull-right left-margin'>".$verFichas_title."</a>";
	echo "<a href='".$newFicha_page."' class='btn btn-default pull-right left-margin'>Nueva ficha</a>";
	echo "<a href='editCatego.php' class='btn btn-default pull-right left-margin'>Ver categorías</a>";
	echo "<a href='editSubCatego.php' class='btn btn-default pull-right left-margin'>Ver subcategorías</a>";
echo "</div>";
	};
?>

<form action="#" method="post" target="_self">
<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<br><br>
<?php echo ($ListCatego); ?><br><br>
<label for="nameCategoria"><span class="color1">Subcategoría</span> </label><input class="w100" type="text" name="nameCategoria" value="<?php echo ($dataSubCat["nombre_subcategoria"]); ?>"  required><br><br>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>

</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="centrarDiv"><button type="submit" class="btn btn-default marginTopGeneral">Actualizar subcategoría</button></div>
<?php echo($msjError); ?>
<hr>
</div>

</div>
</form>

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

<span class="color1">Ver subcategorías asignadas</span>
<?php echo ($ListCatego2); ?><br><br>
<div class="listaCategorias img-thumbnail" style="width:100%; height:200px; overflow:auto">
<ul class="paso2"></ul>
</div>
<br><br>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
&nbsp;
</div>

</div>
<?php
echo ("


<script>
$(document).ready(function () {
	var idCategoria=$.cookie('catego');
	getListaSubCategorias(idCategoria);
	});

</script>

");
include_once "footer.php";
?>