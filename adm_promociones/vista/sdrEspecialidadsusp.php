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

    /*OBTENEMOS NOMBRE DE LA ESPECIALIDAD POR ID
     * =============================================================================*/
    include_once("../controlador/database2.php");
// get database connection
    $database=new Database;
    $db = $database->getConnection();
// termina get database connection
    include_once("../modelos/regDir.php");
    $reg_dir=new regDirSMB($db);

    //print_r($_GET);
    //exit;

    $resEspecialidades=$reg_dir->allEspecialidades();
    $inputNameEspecialidad="";
    $selectopt="";
    while($row2=$resEspecialidades->fetch(PDO::FETCH_ASSOC)){
        // id_especialidad, nombre_especialidad
        if($_GET["valR"]==$row2["id_especialidad"]){
            $inputNameEspecialidad='<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Nombre</span>
  <input type="text" class="form-control editnameespecial-'.$_GET["valR"].'" placeholder="Nombre especialidad" aria-describedby="basic-addon1" value="'.utf8_encode($row2["nombre_especialidad"]).'" disabled="disabled">
</div>';
            ($row2["estado"]==1)?$selectopt="<option value='1' selected>ACTIVO</option><option value='0'>SUSPENDIDO</option>":$selectopt="<option value='1'>ACTIVO</option><option value='0' selected>SUSPENDIDO</option>";
        }
    }
    //print_r($_GET["valR"]);
    //exit;
    /*TERMINA OBTENEMOS NOMBRE DE LA ESPECIALIDAD POR ID*/
    $page_title = "Suspender especialidad";
    $idelement=$_GET["valR"];
    /*$botoonFormAjax='<div style="margin: 3% 0%"><button type="button" class="btn btn-primary" onclick="updEspecialidades(\'editnameespecial-'.$idelement.'\')">Actualizar</button><br><br>
<span class="messangeres"></span></div>';*/
    $selectchangeajax='<br><label for="sel1">Selecciona una opción:</label>
  <select class="form-control getvalreg'.$idelement.'" id="sel1" onchange="changeEspecialidadMedicsusp(\''.$idelement.'\')">
    '.$selectopt.'
  </select><br>
  <span class="messageStatus"></span>
  
  ';
    include_once "header.php";

    //echo ($inputNameEspecialidad.$botoonFormAjax);
    echo ($inputNameEspecialidad.$selectchangeajax);
    echo("
    </tbody>
  </table>
  </div>
");
    include_once "footer.php";
    exit;
};
?>