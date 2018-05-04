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

if ($trueIdSesion==1 && isset($_SESSION["typ"])){
	
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
    include_once '../modelos/regFicha.php';
	$reg_catego=new regFichaSMB($db);


//Obtenomos lista de categorías
//========================================
	$ListCatego=false;	
	$resListaCatego=$reg_catego->getListaCatego($_SESSION["typ"]);
	$nrowListCatego=$resListaCatego->rowCount();
	
//Termina obtenomos lista de categorías
//========================================	





// set page headers
//$tiposPromo=array("red comercial","red médica");

($_SESSION["typ"]===3)?$page_title = "Red comercial - Categorías":$page_title = "Red médica - Categorías";

include_once "header.php";
echo "<div class='right-button-margin'>";

	echo "<a href=\"index.php\" class=\"btn btn-default pull-right left-margin\">Inicio</a>";
	echo "<a href=\"regCategoria.php\" class=\"btn btn-default pull-right left-margin\">Registrar categoría</a>";
echo "</div>";
	};


echo("<div class=\"table-responsive\">          
  <table class=\"table table-hover table-condensed\">
    <thead>
      <tr>
        <th>Nombre categoría</th>
        <th>Estado</th>
		<th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>");



if($nrowListCatego===0){
		echo ($ListCatego="No existen categorías");
		}else{
			while($row=$resListaCatego->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				//print_r($row);

	
$selectEdo="";
	($estado==="0")?$selectEdo="
<select class=\"selectpicker edo".$id_categoria."\" onchange=\"changeEdoCurso('".$id_categoria."','edo".$id_categoria."')\">
  <option value=\"0\" selected>Suspendido</option>
  <option value=\"1\">Activo</option>
</select>":$selectEdo="
<select class=\"selectpicker edo".$id_categoria."\" onchange=\"changeEdoCurso('".$id_categoria."','edo".$id_categoria."')\">
  <option value=\"0\">Suspendido</option>
  <option value=\"1\" selected>Activo</option>
</select>";
	
	
	echo("	
      <tr>
        <td>".utf8_encode($nombre_categoria)."</td>
		<td>".$selectEdo."</td>
        <td><a href=\"editCatego1.php?liuiduncpro=".base64_encode($id_categoria)."\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></a></td>
      </tr>	
	");
			
			
				};
			
			
			}


	
echo("

    </tbody>
  </table>
  </div>


")	

?>
<a href="" target="new"></a>
<!--div class="table-responsive">          
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>#</th>
        <th>Promoción</th>
        <th>F. Publicación</th>
        <th>F. Caducidad</th>
        <th>Cuadro imagen</th>
        <th>Documento PDF</th>
        <th>Estado</th>
        <th>Posición</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Anna</td>
        <td>Pitt</td>
        <td>35</td>
        <td>New York</td>
        <td>USA</td>
        <td>USA</td>
        <td>USA</td>
        <td>USA</td>
      </tr>
    </tbody>
  </table>
  </div-->


                            




<!-- HTML form for creating a record 
<script type="text/javascript">
tinymce.init({
    selector: "textarea#tinymceEdit",
	theme: "modern",
	plugins: [
        "autoresize advlist autolink lists link charmap preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "nonbreaking save table contextmenu directionality",
        "template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    templates: [
        {title: 'Caracteristicas', description: 'Inmuebles', url: 'templateTiny.html'}
    ]
});
</script>-->
<!--form action='index.php' method='post'>
     <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Entidad federativa</td>
            <td><input type='text' name='entidad' class='form-control' required></td>
        </tr>
        <tr>
            <td>Localidad</td>
            <td><input type='text' name='localidad' class='form-control' required></td>
        </tr>
        <tr>
            <td>Precio de venta</td>
            <td><input type='text' name='precio' class='form-control'></td>
        </tr>
        <tr>
            <td>Nombre de contacto</td>
            <td><input type='text' name='contactoNombre' class='form-control'></td>
        </tr>
        <tr>
            <td>Apellidos de contacto</td>
            <td><input type='text' name='contactoApellidos' class='form-control'></td>
        </tr>
        <tr>
            <td>Teléfono de contacto</td>
            <td><input type='text' name='telcontacto' class='form-control'></td>
        </tr>
        <tr>
            <td>E-mail de contacto</td>
            <td><input type='text' name='emailcontacto' class='form-control'></td>
        </tr>
        <tr>
            <td>Descripci&oacute;n corta del inmueble</td>
            <td><textarea name='descripcionCorta' class='form-control' required></textarea></td>
        </tr>
        <tr>
            <td>Caracter&iacute;sticas del inmueble</td>
            <td><textarea  id="tinymceEdit" name='caracteristicas' class='form-control'></textarea></td>
        </tr>
                <tr>
            <td></td>
            <td>
               <button type="submit" class="btn btn-primary">Registrar</button>
            </td>
        </tr>
     </table>
</form-->

<?php
include_once "footer.php";		
?>
<!--script>
$(document).ready(function() {
    $(".alert-dismissable").focus();

         
    /*var id = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
     
    if (q == true){
 
        $.post('delete_product.php', {
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
 
    }*/
         
    return false;
});
</script-->	
	
