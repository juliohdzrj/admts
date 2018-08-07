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
//"continua formulario para insertar registros.
/*// get database connection
include_once '../controlador/database.php';
$database = new Database();
$db = $database->getConnection();
*/
// set page headers
$page_title = "Administrador de contenido - SMB";
include_once "header.php";
echo "<div class='right-button-margin'>";
	echo "<a href='pdftaj.php' class='btn btn-default pull-right left-margin'>PDF TARJETA</a>";
    echo "<a href='redcomercial.php' class='btn btn-default pull-right left-margin'>Promociones red comercial</a>";
	echo "<a href='redmedica.php' class='btn btn-default pull-right left-margin'>Promociones red médica</a>";
	echo "<a href='fichaRedComercial.php' class='btn btn-default pull-right left-margin'>Fichas red comercial</a>";
	echo "<a href='fichaRedMedica.php' class='btn btn-default pull-right left-margin'>Fichas red médica</a>";
	echo "<a href='viewEncabezados.php' class='btn btn-default pull-right left-margin'>Encabezados cat/cup</a>";
	echo "<a href='dirmediclist.php' class='btn btn-default pull-right left-margin'>Directorio médico</a>";
echo "</div>";
	};
include_once "footer.php";		
?>
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
/*include_once "footer.php";
// if the form was submitted
if($_POST){
	    // instantiate product object
    include_once '../modelos/registros.php';
    $registra = new registro($db);
	
	//(empty($_POST["precio"]))?$_POST["precio"]=NULL:$_POST["precio"];
	
	//echo($_POST["precio"]);
	// set registro property values
	$registra->entidadFederativa = $_POST["entidad"];
	$registra->localidad = $_POST["localidad"];
	$registra->costProperty = (empty($_POST["precio"]))?$_POST["precio"]=NULL:$_POST["precio"];
	$registra->contactoNombre = (empty($_POST["contactoNombre"]))?$_POST["contactoNombre"]=NULL:$_POST["contactoNombre"];
	$registra->apellidosContacto = (empty($_POST["contactoApellidos"]))?$_POST["contactoApellidos"]=NULL:$_POST["contactoApellidos"];
	$registra->telContacto = (empty($_POST["telcontacto"]))?$_POST["telcontacto"]=NULL:$_POST["telcontacto"];
	$registra->emailContacto = (empty($_POST["emailcontacto"]))?$_POST["emailcontacto"]=NULL:$_POST["emailcontacto"];
	$registra->descripcionInmueble = $_POST["descripcionCorta"];
	$registra->caracteristicasInmueble = $_POST["caracteristicas"];
	
	$validaInsert = $registra->insertRegistro();
	
	// create the registro
    if($validaInsert==true){
        echo "<div class=\"alert alert-success alert-dismissable\" tabindex=\"99\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "La informaci&oacute;n fue registrada.";
        echo "</div>";
    }
 
    // if unable to create the registro
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\" tabindex=\"99\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Incapaz de crear el registro.";
        echo "</div>";
    }
	
}*/
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
	
