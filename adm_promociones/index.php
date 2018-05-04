<?php
session_start();
$current_id=session_id();
if($current_id===$_SESSION["IN"]){
	header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: vista/index.php");
	};
// get database connection
include_once 'controlador/database.php';
$database = new Database();
$db = $database->getConnection();
// set page headers
$page_title = "Iniciar sesión";
include_once "vista/header.php";
/*echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Ver registros</a>";
echo "</div>";*/

//include_once "footer.php";

// if the form was submitted
?>
<!-- HTML form for creating a product -->
<form action='index.php' method='post'>
     <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Nombre de usuario</td>
            <td><input type='text' name='name' class='form-control' required></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><input type='password' name='cd' class='form-control' required></td>
        </tr> 
        <tr>
            <td></td>
            <td>
               <button type="submit" class="btn btn-primary">Acceder</button>
            </td>
        </tr>
     </table>
</form>
<?php
if($_POST){
	$msjError="<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>El nombre de usuario y la contraseña que ingresaste no coinciden.</div>";
    include_once 'modelos/usr.php';
    $login_user = new userLogin($db);
	$login_user->arrayData=$_POST;
	$stmt=$login_user->validateUser();
	if($stmt=="error"){
		echo $msjError;
include_once "vista/footer.php";
exit;
		}
	$num = $stmt->rowCount();
	if($num===1){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//print_r($row);
		extract($row);
		$_SESSION["IDU"]=$row["id_user_smb"];
		$_SESSION["IN"]=session_id();
		//header("Refresh:0");
		echo("<script> window.location.reload(true); </script>");
		/*header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: vista/index.php");*/
		//exit;
		
				//echo("direccionar-".$_SESSION["IDU"]);
		}
}

echo $msjError;
include_once "vista/footer.php";
exit;
?>