<!DOCTYPE html>
<html lang="es">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
 
    <!-- some custom CSS -->
    <style>
	
	<!--INPUT COLOR-->
.color-view{
padding:20px;
margin:20px auto;
}

input[type=color]{
-webkit-appearance:none;
cursor:pointer;
display:inline-block;
margin:0;
position:relative;
vertical-align:middle;
line-height:1;
padding: 2px 6px;
border-radius:3px;
border: 1px solid #999;
border-top-color: #777;
min-width:5.6em;
box-shadow:inset 0 1px 3px rgba(0,0,0,0.1);
    height: 30px;
    width: 91px;
}

input[type=color]::-webkit-color-swatch-wrapper{
margin:0;padding:2px;padding-right:3px;border:0;
margin-left:-4px;
width:24px;
}
input[type=color]::-webkit-color-swatch{
padding:0;margin:0;border:0;
border-radius:3px;
box-shadow: 0 1px 0 rgba(0,0,0,0.2), inset 0 0 1px rgba(0,0,0,0.4);
}
input[type=color]::before{
content:"";
display:block;
width:17px;height:17px;
position:absolute;
left:5px;top:5px;
/*background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAQAAACRZI9xAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAACoSURBVBgZhcFbToNAAADA6YZ7+uM5PYwxJk27sDyELrBdE/+Mtsyc6qsXvagXjUaDbJNlm6Iop/omuui0ksHkZrbarHa7rDQ+XV1dJJ3Fl9kiyza7u0Lj7EMnGiSTyWK1u6uqH413UdTq9UZZcfdL46zVSjqTVfVHI4p6yWj1ryAZJJPNA8FgNFtVDwST2ap6KFjcFE8EN7ungk31VFAcCKoDwaFTdeQb9Z1sBSFcjZUAAAAASUVORK5CYII=');*/
background-position: 0 0;
background-repeat:no-repeat;
}
input[type=color]::after{
content: attr(data-value);
display:block;
position:absolute;
top:0;left:30px;
line-height:28px;
}
input[type="color"]:disabled{
color:#444;
-webkit-user-select: none !important;
background-color: #d1d1d1 !important;
}
input[type="color"][readonly="readonly"]{
color:#444;
background-color: #d1d1d1 !important;
}
<!--TERMINA INPUT COLOR-->
	
	
	
	
	
    .left-margin{
        margin:0 0 0 0.5em;
    }
 
    .right-button-margin{
        margin: 0 0 1em 0;
        overflow: hidden;
    }
	.OK{
		color:red;
		}
	.color1{
		color: #0088AB;
		}
	.w100{
		width:100%;
		}
	.marginTopGeneral{
		margin-top: 3%;
		}			
	.iframeGen{
		margin: 0px;
width: 100%;
overflow: hidden;
height: 60px;
border: 0;
		}
		
	.rowUl, .rowUl li{
		margin:0;
		padding:0;
		}
	.rowUl{
		padding-top:1%;
		padding-bottom:1%;
		color:rgba(91,105,208,1.00);
		border-bottom:1px solid rgb(236, 236, 236);
		}	
	.rowUl li{
		display:inline-block;
		padding-left:3%;
		padding-right:3%
		}
	.centrarDiv{
		width:100%;
		margin:0 auto;
		text-align: center
		}
		
		
	.selectEdit{
		color:#F90105;
		}		
	
	.changeEspecialidad:hover, .resetEdit:hover, .selectEdit:hover, .editRegMed:hover, .changeLocalidad:hover{
		cursor:pointer;
		color:#0064FF
		}	
	
					
    </style>
 
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!--script type="text/javascript" src="../function/tinymce/tinymce.min.js"></script-->
 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--script src="//cdn.tinymce.com/4/tinymce.min.js"></script-->
    <script src="../function/tinymce/tinymce.min.js"></script>
    
    <script>
	
	<!--OBTIENE COLOR DE INPUT-->
	;(function($){
	$.fn.form_color = function(options){
		this.each(function(){
			$(this).on("change", function(){
				this.title = this.value;
				this.dataset.value = this.value;
			}).trigger("change");
		});
		return this;
	};
})(jQuery);

$(function(){
	$("input[type='color']").form_color();
});

function getvalueColor(classInputColor){
	var c1=$(".typecolor1").val();
	if(c1!=""){
		$(".inputcolor1").val(c1);
		$("input[type='color']").form_color();
		}
	return false;	
	}
	<!--TERMINA OBTIENE COLOR DE INPUT-->

tinymce.init({
  selector: 'textarea',
  height: 200,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code',
	'textcolor colorpicker',
  ],
  /*menubar: "tools",*/
  textcolor_map: [
    "000000", "Black",
    "993300", "Burnt orange",
    "333300", "Dark olive",
    "003300", "Dark green",
    "003366", "Dark azure",
    "000080", "Navy Blue",
    "333399", "Indigo",
    "333333", "Very dark gray",
    "800000", "Maroon",
    "FF6600", "Orange",
    "808000", "Olive",
    "008000", "Green",
    "008080", "Teal",
    "0000FF", "Blue",
    "666699", "Grayish blue",
    "808080", "Gray",
    "FF0000", "Red",
    "FF9900", "Amber",
    "99CC00", "Yellow green",
    "339966", "Sea green",
    "33CCCC", "Turquoise",
    "3366FF", "Royal blue",
    "800080", "Purple",
    "999999", "Medium gray",
    "FF00FF", "Magenta",
    "FFCC00", "Gold",
    "FFFF00", "Yellow",
    "00FF00", "Lime",
    "00FFFF", "Aqua",
    "00CCFF", "Sky blue",
    "993366", "Red violet",
    "FFFFFF", "White",
    "FF99CC", "Pink",
    "FFCC99", "Peach",
    "FFFF99", "Light yellow",
    "CCFFCC", "Pale green",
    "CCFFFF", "Pale cyan",
    "99CCFF", "Light sky blue",
    "CC99FF", "Plum",
	"30A6DD","SMB BLUE"
	
  ],
  spellchecker_language: 'English=en,Spanish=es',
  spellchecker_rpc_url: 'spellchecker.php',
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | forecolor backcolor',
  content_css: [
       '//www.tinymce.com/css/codepen.min.css'
  ],
    /*content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
    ],*/
  /*spellchecker_callback: function(method, text, success, failure) {
    var words = text.match(this.getWordCharPattern());
    if (method == "spellcheck") {
      var suggestions = {};
      for (var i = 0; i < words.length; i++) {
        suggestions[words[i]] = ["First", "Second"];
      }
      success(suggestions);
    }
  }*/
});
	
	
	/*$(document).on('click', '.delete-object', function(){
		
	});*/
	
	
		$(document).ready(function () {
	
	
	
			
			
		/*$("#cpa-form").on("submit",function(e){
    e.preventDefault();
	alert("ok");
  });*/
			
			
			if ($('html').hasClass('desktop')) {
				new WOW().init();
			}
			
	$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);  
	  


    $( ".datepicker" ).datepicker({	
	
	
	changeMonth: true,
	changeYear: true,
	minDate: new Date(2015, 1 - 1, 1)
	 //defaultDate: -6570,
	
	});
	
	

	
	/*$('.selectpicker').selectpicker({
  	style: 'btn-info',
  	size: 4
	});*/

/*var idCategoria=$.cookie('catego');
getListaSubCategorias(idCategoria);
getListaSubCategorias2(idCategoria);*/					
		});

function getvalIdCategoria(){
	var idCatego1=$(".showlist").val();
	getListaSubCategorias(idCatego1);		
	//alert(idCatego1);
	}
function getvalIdCategoria2(){
	var idCatego1=$(".showlist").val();
	getListaSubCategorias2(idCatego1);		
	//alert(idCatego1);
	}
function getvalIdCategoria3(){
	var idCatego1=$(".showlist").val();
	getListaSubCategorias3(idCatego1);		
	//alert(idCatego1);
	}
function changeTipoCat(sel){
	var tipoCat=$(sel).val();
	if (tipoCat==0){
		$(".contEncabezados").html("");
		alert ("Selecciona un catálogo");
		return false;	
		}else{
			getListaTipoCat(tipoCat);
			}
	return false;
	}	

function getListaTipoCat(tipoCat){
	
	
	$.ajax({
		url: "encabezadoslist.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:tipoCat}		
		}).done(function(data) {
		console.log(data);
		$(".contEncabezados").html(data);
		
				
		}).fail(function() {
  		alert("Ajax failed to fetch data");
		});
		
		
		
	 return false;
	}





/*function selectSubCat(idSubcat){
	var idCatego1=$(".selectSubCat option").removeAttr("selected");
	$(".selectSubCat option[value='"+idSubcat+"']").delay(1000).attr("selected","selected");
	console.log(idSubcat);
	}*/ 							




function getListaSubCategorias(valIdCategoria){
	$.ajax({
		url: "subcatlist.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:valIdCategoria}
				
		}).done(function(data) {
		//console.log(data);
		var nrow=data.length;
		if(nrow==0){
		$(".paso2").html("<li> No existen subcategorías </li>");
		return false;	
			}
			
		//<select class="selectpicker" style="width:100%" name="empresa" onchange="changeEmpresa2()"><option value="0" selected="">Seleccione empresa</option><option value="1">cosmocolor</option></select>
		var idsubCategoria1=$.cookie('subcatego');
		$(".paso2").html("");
		for (x in data) {
			//console.log(data[x]);
			
			if(data[x]["id_subcategoria"]==idsubCategoria1){
				selectCurso="<li style=\"background-color: #87CEEB;\">"+data[x]["nombre_subcategoria"]+"</li>";
				}else{
					selectCurso="<li>"+data[x]["nombre_subcategoria"]+"</li>";
					}		
			$(".paso2").append(selectCurso);
			}
		
		//console.log(selectCurso);
		//$(".paso2").html(selectCurso);	
		}).fail(function() {
  		alert("Ajax failed to fetch data");
		});
	 return false;
	}
	

function getListaSubCategorias2(valIdCategoria){
	$.ajax({
		url: "subcatlist2.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:valIdCategoria}
				
		}).done(function(data) {
		//console.log(data);
		var nrow=data.length;
		if(nrow==0){
		$(".tablaSubCat").html("<li> No existen subcategorías </li>");
		return false;	
			}
		/* <tr>
        <td>".utf8_encode($nombre_categoria)."</td>
		<td>".$selectEdo."</td>
        <td><a href=\"editCatego1.php?liuiduncpro=".base64_encode($id_categoria)."\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></a></td>
      </tr>	*/
		$(".tablaSubCat").html("");
		for (x in data) {
			//console.log(data[x]);
			/*
			
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
			
			*/
			var selectEdo="";
			(data[x]["estado"]==0)? selectEdo="<select class=\"selectpicker edo"+data[x]["id_subcategoria"]+"\" onchange=\"changeEdoSubCat('"+data[x]["id_subcategoria"]+"','edo"+data[x]["id_subcategoria"]+"')\"><option value=\"0\" selected>Suspendido</option><option value=\"1\">Activo</option></select>" : selectEdo="<select class=\"selectpicker edo"+data[x]["id_subcategoria"]+"\" onchange=\"changeEdoSubCat('"+data[x]["id_subcategoria"]+"','edo"+data[x]["id_subcategoria"]+"')\"><option value=\"0\">Suspendido</option><option value=\"1\" selected>Activo</option></select>";
			var editBotonSubCat="<a href=\"editSubCatego1.php?liuiduncpro="+data[x]["id_subcategoria"]+"\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></a>";
			
			
			var selectCurso="<tr><td>"+data[x]["nombre_subcategoria"]+"</td><td>"+selectEdo+"</td> <td>"+editBotonSubCat+"</td></tr>";
			//console.log(selectCurso);
			$(".tablaSubCat").append(selectCurso);
			}
		
		//console.log(selectCurso);
		//$(".paso2").html(selectCurso);	
		}).fail(function() {
  		alert("Ajax failed to fetch data");
		});
	 return false;
	} 	
	
	
function getListaSubCategorias3(valIdCategoria){
	$.ajax({
		url: "subcatlist.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:valIdCategoria}
				
		}).done(function(data) {
		//console.log(data);
		
		
		var nrow=data.length;
		if(nrow==0){
		$(".selectSubCat").css("color","#000000");	
		$(".selectSubCat").html("<option value=\"0\">--No tiene subcategoría--</option>");
		return false;	
			}
			
		//<select class="selectpicker" style="width:100%" name="empresa" onchange="changeEmpresa2()"><option value="0" selected="">Seleccione empresa</option><option value="1">cosmocolor</option></select>
		//var idsubCategoria1=$.cookie('subcatego');
		$(".selectSubCat").html("");
		$(".selectSubCat").html("<option value=\"0\">--Selecciona subcategoría--</option>");
		$(".selectSubCat").css("color","rgb(132, 189, 0)");
		var subCatid=$.cookie('subcat');
		for (x in data) {
			(subCatid==data[x]["id_subcategoria"])?attrVal="selected":attrVal="";
			selectCurso="<option value=\""+data[x]["id_subcategoria"]+"\" "+attrVal+">"+data[x]["nombre_subcategoria"]+"</option>";
			$(".selectSubCat").append(selectCurso);
			}
		$.cookie('subcat', '-');
		//console.log(selectCurso);
		//$(".paso2").html(selectCurso);	
		}).fail(function() {
  		alert("Ajax failed to fetch data");
		});
	 return false;
	}	
	
		
		
function respuestaUpLoad(elementoActual2){
	//console.log(elementoActual2);
		$(".bloquearBoton").removeAttr("disable");
		$(".upLoad"+elementoActual2).css("display","none");
		return false;
		}
		
 
function respuestaUpLoadLocalidad(elementoActual2){
		$(".bloquearBoton").removeAttr("disable");
		$(".upLoad"+elementoActual2).css("display","none");
		getLocAsignadas();
		return false;
		}

    function respuestaUpLoadLocalidad2(elementoActual2,promid){
        $(".bloquearBoton").removeAttr("disable");
        $(".upLoad"+elementoActual2).css("display","none");
        //console.log(ipd);
        getLocAsignadasPromo(promid);
        return false;
    }
		
        
 function espereUpLoad(elementoActual){
		$(".bloquearBoton").attr("display","block");
		$(".upLoad"+elementoActual).css("display","block");
		return false;
		}
		
function espereUpLoad2(elementoActual){
		$(".bloquearBoton").attr("display","block");
		//$(".upLoad"+elementoActual).css("display","block");
		return false;
		}
		
function espereUpLoadLocalidad(elementoActual){
		$(".bloquearBoton").attr("display","block");
		$(".upLoad"+elementoActual).css("display","block");
		$(".errorLoc").empty();
		
		
		var q = confirm("¿Estas seguro de eliminar las localidades seleccionadas?");
     
    	if (q == true){
			var delLoc=Array();
			var ndataLoc=false;
			$(".bloquearBoton").removeAttr("disable");
			$(".upLoad"+elementoActual).css("display","none");
			
			$(".contLoc input[type=checkbox]").each(function(index, element) {
                var $locSel=$(this);
				var valSelc=false;
				if($locSel.is(":checked")){
					valSelc=$locSel.val();
					delLoc.push(valSelc);
					}
				
            });
			ndataLoc=delLoc.length;
			if (ndataLoc===0){
				$(".errorLoc").html("Seleccione una o más localidades asignadas");
				return false;
				}else{
				
				/*for(x in delLoc){
					var text=+delLoc[x]
					}
				
				console.log(text);*/
					
		$.ajax({
		url: "../modelos/sec4Dloc.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:delLoc}
				
		}).done(function(data) {
		
		console.log(data);
		if(data==="true"){
			getLocAsignadas();
			$(".errorLoc").html("Localidad eliminada");
			return false;
			}
		//$(".contLoc").html(data[1]);
		
		}).fail(function() {
  		alert("Revisa tu conexión a internet");
		});
					
					}
			
		return false;
   		}	
	$(".bloquearBoton").removeAttr("disable");
	$(".upLoad"+elementoActual).css("display","none");
		return false;	
	
		}

    function espereUpLoadLocalidad2(elementoActual,idpromo){
    console.log(elementoActual);
    //return false;
        $(".bloquearBoton").attr("display","block");
        $(".upLoad"+elementoActual).css("display","block");
        $(".errorLoc").empty();
        var q = confirm("¿Estas seguro de eliminar las localidades seleccionadas?");

        if (q == true){
            var delLoc=Array();
            var ndataLoc=false;
            $(".bloquearBoton").removeAttr("disable");
            $(".upLoad"+elementoActual).css("display","none");
            $(".contLoc input[type=checkbox]").each(function(index, element) {
                var $locSel=$(this);
                var valSelc=false;
                if($locSel.is(":checked")){
                    valSelc=$locSel.val();
                    delLoc.push(valSelc);
                }
            });
            ndataLoc=delLoc.length;
            if (ndataLoc===0){
                $(".errorLoc").html("Seleccione una o más localidades asignadas");
                return false;
            }else{
                //console.log(delLoc);
                $.ajax({
                    url: "../modelos/sec4DlocPromo.php",
                    dataType:"json",
                    type:"POST",
                    cache:false,
                    data:{object_id:idpromo,object_id2:delLoc}

                }).done(function(data) {
                    //console.log(data);
                    if(data==="true"){
                        //getLocAsignadas();
                        getLocAsignadasPromo(idpromo);
                        $(".errorLoc").html("Localidad eliminada");
                        return false;
                    }
                    //$(".contLoc").html(data[1]);
                }).fail(function() {
                    alert("Revisa tu conexión a internet");
                });
            }

            return false;
        }
        $(".bloquearBoton").removeAttr("disable");
        $(".upLoad"+elementoActual).css("display","none");
        return false;

    }



    function changeEspecialidadMedic(idpromo,classElem){
		var edo=$("."+classElem).val();
		console.log(edo);
		return false;
		
        $.post('../modelos/changeEdo.php', {
            object_id: idpromo, valEdo:edo 
        }, function(data){
			console.log(data);
			if(data==true){
				return false;
				}else{
					alert("Error. Intentelo mas tarde.");
					}
        }).fail(function() {
            alert('Error. Intentelo mas tarde.');
        });
	 return false;
	}



		
		
function changeEdo(idpromo,classElem){		
		var edo=$("."+classElem).val();
        $.post('../modelos/changeEdo.php', {
            object_id: idpromo, valEdo:edo 
        }, function(data){
			console.log(data);
			if(data==true){
				return false;
				}else{
					alert("Error. Intentelo mas tarde.");
					}
        }).fail(function() {
            alert('Error. Intentelo mas tarde.');
        });
	 return false;
	}
	

function changeEdoFichas(idficha,classElem){		
		var edo=$("."+classElem).val();
        $.post('../modelos/changeEdoFicha.php', {
            object_id: idficha, valEdo:edo 
        }, function(data){
			console.log(data);
			if(data==true){
				return false;
				}else{
					alert("Error. Intentelo mas tarde.");
					}
        }).fail(function() {
            alert('Error. Intentelo mas tarde.');
        });
	 return false;
	}

	
	
function changeEdoCurso(idcatego,classElem){		
		var edo=$("."+classElem).val();
        $.post('../modelos/changeEdoCatego.php', {
            object_id: idcatego, valEdo:edo 
        }, function(data){
			console.log(data);
			if(data==true){
				return false;
				}else{
					alert("Error. Intentelo mas tarde.");
					}
        }).fail(function() {
            alert('Error. Intentelo mas tarde.');
        });
	 return false;
	}

function changeEdoSubCat(idcatego,classElem){
		var edo=$("."+classElem).val();
        $.post('../modelos/changeEdoSubCatego.php', {
            object_id: idcatego, valEdo:edo 
        }, function(data){
			//console.log(data);
			if(data==true){
				return false;
				}else{
					alert("Error. Intentelo mas tarde.");
					}
        }).fail(function() {
            alert('Error. Intentelo mas tarde.');
        });	
	 return false;
	}				


function changeLugar(idpromo2,classElem2){
	var posicionVal=$("."+classElem2).val();
        $.post('../modelos/changePos.php', {
            object_id: idpromo2, valPos:posicionVal
        }, function(data){
			console.log(data);
			/*if(data==true){
			return false;
			}else{
				alert("Error. Intentelo mas tarde.");
				}*/
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	 return false;
	}
	
function changeLugar2(idpromo3,classElem3){
	var posicionVal2=$("."+classElem3).val();
        $.post('../modelos/changePos2.php', {
            object_id: idpromo3, valPos:posicionVal2
        }, function(data){
			console.log(data);
			/*if(data==true){
			return false;
			}else{
				alert("Error. Intentelo mas tarde.");
				}*/
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	 return false;
	}	

function getLocAsignadas(){
	$.ajax({
		url: "listLocAsig.php",
		dataType:"json",
		type:"POST",
		cache:false
		//data:{object_id:valIdCategoria}
				
		}).done(function(data) {
			console.log(data);
		//var nLoc=data[0].length;
		if(data[0]==0){
		$(".contLoc").html("No existen localidades asignadas");
		return false;
		}
		
		$(".contLoc").html(data[1]);
		
		}).fail(function() {
  		alert("Ajax failed to fetch data aq");
		});
	return false;
	}

    function getLocAsignadasPromo(promoid){
        $.ajax({
            url: "listLocAsigPromo.php",
            dataType:"json",
            type:"POST",
            cache:false,
            data:{object_id:promoid}
        }).done(function(data) {
            console.log(data);
            //var nLoc=data[0].length;
            if(data[0]==0){
                $(".contLoc").html("No existen localidades asignadas");
                return false;
            }

            $(".contLoc").html(data[1]);

        }).fail(function() {
            alert("Ajax failed to fetch data aq");
        });
        return false;
    }

function edocarrucel(dataEdoCarrucel){
	var value = dataEdoCarrucel;
	$.ajax({
		url: "updEdoCar.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:value}
				
		}).done(function(data) {
			//console.log(data);
			//console.log(value);
		
		}).fail(function() {
  		alert("No se puede obtener datos");
		});
return false;	
	}
	
function edoplan(dataEdoplan){
	var valueplan = dataEdoplan;
	var valPlan=$("select."+valueplan).val();
	
	//console.log(valPlan);
	//return false;
	
	$.ajax({
		url: "updEdoplan.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:valPlan}
				
		}).done(function(data) {
			console.log(data);
			//console.log(value);
		
		}).fail(function() {
  		alert("No se puede obtener datos");
		});
return false;	
	}	
	
	
function winOpen(regDir,elemento)
{
	$(".changeEspecialidad").removeClass("selectEdit");
	$(elemento).addClass("selectEdit");
    //window.open("selectEspecialidad.php?valR="+regDir,"Cambiar especialidad","height=200,width=400,status=yes,toolbar=no,menubar=no,location=no");
	PopupCenter('selectEspecialidad.php?valR='+regDir,'Cambiar especialidad','400','500'); 
	return false;
}


function winOpenLocalidad(regDir,elemento)
{
	$(".changeLocalidad").removeClass("selectEdit");
	$(elemento).addClass("selectEdit");
    //window.open("selectEspecialidad.php?valR="+regDir,"Cambiar especialidad","height=200,width=400,status=yes,toolbar=no,menubar=no,location=no");
	PopupCenter('selectLocalidad.php?valR='+regDir,'Cambiar localidad','400','500'); 
	return false;
}



function winOpen2(regDir,elemento)
{
	$(".editRegMed").removeClass("selectEdit");
	$(elemento).addClass("selectEdit");
	PopupCenter('editRegistroMedic.php?valR='+regDir,'Actualizar registro','400','600');  
	
/*var viewportwidth = document.documentElement.clientWidth;
var viewportheight = document.documentElement.clientHeight;

console.log(viewportwidth);
console.log(viewportheight);

window.resizeBy(-400,0);
window.moveTo(0,0);

//window.open("editRegistroMedic.php?valR="+regDir,"Actualizar registro","width=300,left="+(viewportwidth-300)+",top=0");
window.open("editRegistroMedic.php?valR="+regDir, "Actualizar registro","width=400,height="+viewportheight+", left="+(viewportwidth-400)+",top=0,screenX=0,screenY=0");
*/

	return false;
}


function winOpen3(regDir,elemento)
{
	$(".editRegMed").removeClass("selectEdit");
	$(elemento).addClass("selectEdit");
	PopupCenter('sdr.php?valR='+regDir,'Actualizar-registro','400','600');  
	return false;
}

    function winOpen4(regDir,elemento)
    {
        $(".editRegMed").removeClass("selectEdit");
        $(elemento).addClass("selectEdit");
        PopupCenter('sdrEspecialidad.php?valR='+regDir,'Actualizar-registro','400','600');
        return false;
    }

    function winOpen5(regDir,elemento)
    {
        $(".editRegMed").removeClass("selectEdit");
        $(elemento).addClass("selectEdit");
        PopupCenter('sdrEspecialidadsusp.php?valR='+regDir,'suspender-registro','400','600');
        return false;
    }

    function winOpen6()
    {
        PopupCenter('sdrEspecialidadNew.php?','registrar-especialidad','400','600');
        return false;
    }

    function winOpen7(regDirS,elemento){
        $(".editRegMed").removeClass("selectEdit");
        $(elemento).addClass("selectEdit");
        PopupCenter('updimgfich.php?valR='+regDirS,'suspender-registro','400','600');
    return false;
    }
    function winOpen8(regDirS,elemento){
        $(".editRegMed").removeClass("selectEdit");
        $(elemento).addClass("selectEdit");
        PopupCenter('updimgfichesp.php?valR='+regDirS,'suspender-registro','400','600');
        return false;
    }

    function winOpen9(){
        //$(".editRegMed").removeClass("selectEdit");
        //$(elemento).addClass("selectEdit");
        PopupCenter('updimggeneral.php','Upload-imagen','400','600');
        return false;
    }

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}


	

function changeEspecialidadMedic(regDir2){
	var valueEspecialidad=$(".valedo"+regDir2).val();
	$.post('../modelos/changeEspecialidad.php', {
            object_id:regDir2, valPos:valueEspecialidad
        }, function(data){
			console.log(data);
			/*if(data==true){
			return false;
			}else{
				alert("Error. Intentelo mas tarde.");
				}*/
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	
	
	
	console.log(valueEspecialidad);
	return false;
	}



    function changeEspecialidadMedicsusp(regDir2){
        $(".messageStatus").empty();
        var valueEspecialidad=$(".getvalreg"+regDir2).val();
        $.ajax({
            url: "../modelos/changeEdoEspecialidadMedic.php",
            dataType:"json",
            type:"POST",
            cache:false,
            data:{object_id:regDir2,opsol:valueEspecialidad}
        }).done(function(data) {
            console.log(data);
            $(".messageStatus").html(data.message);
            //$(".messangeres").html(data.message[1]);
        }).fail(function() {
            alert("Revise su conexión a internet");
        });
        return false;
    }
	

function changeLocalidadMedic(regDir3){
	
	var valueLocalidad=$(".valedoLoc"+regDir3).val();
	
	//console.log(regDir3+"//"+valueLocalidad);
	//return false;
	$.post('../modelos/changeLocalidadMedic.php', {
            object_id:regDir3, valPos3:valueLocalidad
        }, function(data){
			console.log(data);
			/*if(data==true){
			return false;
			}else{
				alert("Error. Intentelo mas tarde.");
				}*/
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	
	
	
	console.log(valueLocalidad);
	return false;
	}	
	
	
function revisarTransaccion(){
	var fechaSearch=$(".f1").val();
	if(fechaSearch===""){
		alert("Introduce una fecha");
		$(".f1").focus();
		return false;
		}
		
		$.ajax({
		url: "../modelos/valTransaccion.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:fechaSearch}
				
		}).done(function(data){
			$(".resultSearch tbody").empty();
			for (x in data) {
				$(".resultSearch tbody").append(data[x]);
			}
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	return false;
	}
	
function revisarActualizacion(){
	var fechaSearch2=$(".f2").val();
	if(fechaSearch2===""){
		alert("Introduce una fecha");
		$(".f2").focus();
		return false;
		}
		
		$.ajax({
		url: "../modelos/valUpdateRegMed.php",
		dataType:"json",
		type:"POST",
		cache:false,
		data:{object_id:fechaSearch2}		
		}).done(function(data){
			$(".resultSearch tbody").empty();
			for (x in data) {
				$(".resultSearch tbody").append(data[x]);
			}
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
	return false;
	}
	
	
	function confirma(idfichaact,modoop){
           var confirmaAccion=confirm("¿Desea borrar este archivo?");
            if(confirmaAccion===true){

                switch (modoop){
                    case "cimg1":
                        opconf(idfichaact,modoop);
                        //console.log(modoop);
                        break;
                    case "backimg2":
                        opconf(idfichaact,modoop);
                        //console.log(modoop);
                        break;
                    case "promopdf3":
                        opconf(idfichaact,modoop);
                        //console.log(modoop);
                        break;
                    case "sucspdf4":
                        opconf(idfichaact,modoop);
                        //console.log(modoop);
                        break;
                    default:
                        return false;
                        break
                }
                //console.log("BORRAR ARCHIVO");
                return false;
            }else{
                console.log("ACCION CANCELADA");
            }
            return false;
        }

        function opconf(idfichaacttrue,operacionmodo){
			console.log(idfichaacttrue+'/'+operacionmodo);
			//return false;
			
            $.ajax({
                url: "../modelos/confsol.php",
                dataType:"text",
                type:"POST",
                cache:false,
                data:{object_id:idfichaacttrue,opsol:operacionmodo}
            }).done(function(data) {
                console.log(data);
				if(data=="true"){
					alert("Se borró el archivo.");
					}
            }).fail(function() {
                alert("Revise su conexión a internet");
            });
            return false;
        }
		
		
function changeEdoregistromed(regmeddiredo){
	var valueEdoreg=$(".charegedoact"+regmeddiredo).val();
	console.log(valueEdoreg);
	//return false;
	$.post('../modelos/chaedoreg.php', {
            object_id:regmeddiredo, valPos:valueEdoreg
        }, function(data){
			console.log(data);
			if(data==""){
				alert("Cambios aplicados.");
				}
			/*if(data==true){
			return false;
			}else{
				alert("Error. Intentelo mas tarde.");
				}*/
        }).fail(function() {
            alert("Error. Intentelo mas tarde.");
        });
		return false;		
}

function updEspecialidades(cerespecial) {

    var valueinputEspecial=$("."+cerespecial).val();

        //console.log(valueinputEspecial);
        //console.log(cerespecial);
    $.ajax({
        url: "../modelos/updespecial.php",
        dataType:"json",
        type:"POST",
        cache:false,
        data:{object_id:cerespecial,opsol:valueinputEspecial}
    }).done(function(data) {
        console.log(data.message[1]);
        $(".messangeres").html(data.message[1]);
    }).fail(function() {
        alert("Revise su conexión a internet");
    });
    return false;
}

    function addEspeMedic(){
        var nameEspeMedicNew=$(".newreg").val();
        var nameEspTrim=nameEspeMedicNew.trim();
        var resValueMedic=validaTextoGen(nameEspTrim);
        if(resValueMedic==false){ $(".newreg").focus(); $(".messangeres").html("<span style='color: red'>Proporcione un nombre válido, No utilice caracteres especiales</span>"); return false; }
        $(".messangeres").empty();
        var r = confirm("¿Desea registrar este nombre de especialidad?");
        if (r == true) {
            $.ajax({
                url: "../modelos/regNewEspecial.php",
                dataType:"json",
                type:"POST",
                cache:false,
                data:{opsol:nameEspTrim}
            }).done(function(data) {
                console.log(data);
                console.log(data.message);
                $(".messangeres").html(data.message);
            }).fail(function() {
                alert("Revise su conexión a internet");
            });
        }
        return false;
    }


    function validaTextoGen(valtexto){
        var patron = /^([A-Za-záéíóúñ]{2,2})([A-Za-záéíóúñ\s]{0,60})$/;
        if(!valtexto.search(patron))
            return true;
        else
            return false;
    }

	</script>
    
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <?php
        // show page header
        echo "<div class='page-header'>";
            echo "<h3>{$page_title}</h3>";
        echo "</div>";
        ?>