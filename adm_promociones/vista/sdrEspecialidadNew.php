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
    $inputNameEspecialidad='<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Nombre</span>
  <input type="text" class="form-control newreg" placeholder="Nombre especialidad" aria-describedby="basic-addon1">
</div>';
    /*updEspecialidades(\'editnameespecial-'.$idelement.'\')*/
    $page_title = "Registrar nueva especialidad";
    $idelement=$_GET["valR"];
    $botoonFormAjax='<div style="margin: 3% 0%"><button type="button" class="btn btn-primary" onclick="addEspeMedic()">Actualizar</button><br><br>
<span class="messangeres"></span></div>';
    include_once "header.php";
    echo ($inputNameEspecialidad.$botoonFormAjax);
    echo("
    </tbody>
  </table>
  </div>
");
    include_once "footer.php";
    exit;
};
?>