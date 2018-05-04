<?php
/** * Created by PhpStorm. * User: julio.ramos * Date: 17/08/2017 * Time: 03:18 PM */
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
if ($trueIdSesion==1&&$_POST["txtsearch"]){
    $nameSearch = trim($_POST["txtsearch"]);
    $htmlShowImg = false;
    $archivosname = glob("../../promo-medicas/*[" . $nameSearch . "]*.{jpg}", GLOB_BRACE);
//print_r($archivosname);
    if (count($archivosname)) {
        natcasesort($archivosname);
        foreach ($archivosname as $imgname) {
            $imgnamefiltrado = explode("/", $imgname);
            $htmlShowImg .= '<div class="img-thumbnail" style="width: 280px"><img src="' . $imgname . '" title="' . $imgnamefiltrado[3] . '" width="100%"></div><p>' . $imgnamefiltrado[3] . '</p><br>';
            //echo $imgname."*".$imgnamefiltrado[3]."<br>";
        }
        //echo $htmlShowImg;
    } else {
        $htmlShowImg = "Lo sentimos, no hay imágenes para mostrar";
    }

    echo("<style>
body{
margin: 0;
}
</style>");
    echo $htmlShowImg;
}
