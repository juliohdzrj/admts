<?php
class regFichaSMB{
	private $table_name2 = "cp_pdf_ficha";
	private $table_name6 = "cp_pdf_promo";
	private $table_name = "categoria";
	private $table_name3 = "subcategoria";
	private $table_name4 = "localidades_asignadas";
	private $table_name5 = "localidades";
	private $table_name7 = "encabezados";
	private $timestamp;
	
	public $arrayDataFicha="";
	public $arrayDataFicha2="";
	
	public $idRegistroFicha="";
	public $fileName="";
	public $content="";
	public $size="";
	public $unitSize="";
	public $type="";
	
	public $fileName3="";
	public $content3="";
	public $size3="";
	public $unitSize3="";
	public $type3="";
		
	public function __construct($db){
        $this->conn = $db;
    }
	
	function valDatosFicha(){
		$dataPromo=$this->arrayDataFicha;
		$regexp_nombre = "/^([a-zA-Z0-9áéíóúÁÉÍÓÚÜ]{3,3})([a-zA-Z0-9áéíóúÁÉÍÓÚÜ\s]{0,40})$/";
		$regexp_fecha = "/^([0-9]{4,4})(-)([0-9]{2,2})(-)([0-9]{2,2})$/";
		$regexp_text = "/^([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ\#\%\,!¡?¿\(\)\[\]\{\}°;:+\/*\-+_]{0,2})([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ\.\$\#\%\,!¡?¿\(\)\[\]\{\}°;:+\/*\-+_\s]{0,300})$/";
		$valMsj=true;
		$nombresociof=$dataPromo["nombresocio"];
		$fcaducidad=$dataPromo["fechaCaducidad"];
		$fpublicacion=$dataPromo["fechaPublicacion"];
		$observacionesf=$dataPromo["observaciones"];
		$telefonof=$dataPromo["telefono"];
		$noRegistrof=$dataPromo["noRegistro"];
		
		if (!preg_match($regexp_text, $nombresociof)) {
    		$valMsj="No puedes utilizar signos en el campo nombre socio";
			return $valMsj;
			}
		if (!preg_match($regexp_fecha, $fcaducidad)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}
		if (!preg_match($regexp_fecha, $fpublicacion)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}
		if (!preg_match($regexp_text, $telefonof)) {
    		$valMsj="No puedes utilizar signos en el campo teléfono";
			return $valMsj;
			}	
		if (!preg_match($regexp_text, $observacionesf)) {
    		$valMsj="No puedes utilizar signos en el campo observaciones";
			return $valMsj;
			}
		if (!preg_match($regexp_text, $noRegistrof)) {
    		$valMsj="No puedes utilizar signos en el campo No. Registro";
			return $valMsj;
			}	
		return $valMsj;						
		}
			
	function valDatosFicha2(){
		$dataPromo=$this->arrayDataFicha2;
		//return $dataPromo;
		$regexp_nombre = "/^([a-zA-Z0-9áéíóúÁÉÍÓÚÜ]{3,3})([a-zA-Z0-9áéíóúÁÉÍÓÚÜ\s]{0,40})$/";
		$regexp_fecha = "/^([0-9]{4,4})(-)([0-9]{2,2})(-)([0-9]{2,2})$/";
		$regexp_text = "/^([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ\#\%\,!¡?¿\(\)\[\]\{\}°;:+\/*\-+_]{0,2})([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ\.\$\#\%\,!¡?¿\(\)\[\]\{\}°;:+\/*\-+_\s]{0,300})$/";
		
		$regexp_url = "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.\+]{2,6})([\/\w \+\?=.-]*)*\/?$/";
		$regexp_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		$valMsj=true;
		$nombresociof=$dataPromo["nombresocio"];
		$fcaducidad=$dataPromo["fechaCaducidad"];
		$fpublicacion=$dataPromo["fechaPublicacion"];
		$observacionesf=$dataPromo["observaciones"];
		$telefonof=$dataPromo["telefono"];
		$noRegistrof=$dataPromo["noRegistro"];
		
		$contactof=$dataPromo["contacto"];
		$tituloPromof=$dataPromo["tituloPromo"];
		$descripcionf=$dataPromo["descripcion"];
		$promocionf=$dataPromo["promocion"];
		$paginaWebf=$dataPromo["paginaWeb"];
		$facebookf=$dataPromo["facebook"];
		$twitterf=$dataPromo["twitter"];
		$emailf=$dataPromo["email"];
		$horariosf=$dataPromo["horarios"];
		$sucursalesf=$dataPromo["sucursales"];
		
		if (!preg_match($regexp_text, $nombresociof)) {
    		$valMsj="No puedes utilizar signos en el campo nombre socio";
			return $valMsj;
			}
		if (!preg_match($regexp_text, $noRegistrof)) {
    		$valMsj="No puedes utilizar signos en el campo No. Registro";
			return $valMsj;
			}	
			
		if (!preg_match($regexp_fecha, $fcaducidad)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}
		if (!preg_match($regexp_fecha, $fpublicacion)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}	
		/*if (!preg_match($regexp_text, $observacionesf)) {
    		$valMsj="No puedes utilizar signos en el campo observaciones";
			return $valMsj;
			}*/
		
			
			
			
		if (!preg_match($regexp_text, $contactof)) {
    		$valMsj="No puedes utilizar signos en el campo contacto";
			return $valMsj;
			}
		if (!preg_match($regexp_text, $telefonof)) {
    		$valMsj="No puedes utilizar signos en el campo teléfono";
			return $valMsj;
			}	
		/*if (!preg_match($regexp_text, $tituloPromof)) {
    		$valMsj="No puedes utilizar signos en el campo título promoción";
			return $valMsj;
			}*/
		/*if (!preg_match($regexp_text, $descripcionf)) {
    		$valMsj="No puedes utilizar signos en el campo descripción";
			return $valMsj;
			}*/	
		/*if (!preg_match($regexp_text, $promocionf)) {
    		$valMsj="No puedes utilizar signos en el campo promoción";
			return $valMsj;
			}*/
		/*if (!preg_match($regexp_text, $sucursalesf)) {
    		$valMsj="No puedes utilizar signos en el campo sucursales";
			return $valMsj;
			}*/	
		if (!preg_match($regexp_url, $paginaWebf) && $paginaWebf!="") {
    		$valMsj="Introduce una url correcta en el campo página web";
			return $valMsj;
			}
		if (!preg_match($regexp_url, $facebookf) && $facebookf!="") {
    		$valMsj="Introduce una url correcta en el campo facebook";
			return $valMsj;
			}
		if (!preg_match($regexp_url, $twitterf) && $twitterf!="") {
    		$valMsj="Introduce una url correcta en el campo twitter";
			return $valMsj;
			}
		if (!preg_match($regexp_email, $emailf) && $emailf!="") {
    		$valMsj="Introduce una dirección correcta en el campo email";
			return $valMsj;
			}			
		/*if (!preg_match($regexp_text, $horariosf)) {
    		$valMsj="No puedes utilizar signos en el campo horarios";
			return $valMsj;
			}*/	
			
			
				
		return $valMsj;						
		}	
		
		function insertFicha($tipo){
			//return $tipo;
		$dataficha2=$this->arrayDataFicha;
		$this->getTimestamp();
		
		$query = "INSERT INTO
                    " . $this->table_name2 . "
                SET
                    fecha_registro = ?, no_registro = ?, socio = ?, vigencia = ?, publicacion = ?, telefono = ?, observaciones = ?, id_tipo_promo = ?";			
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->timestamp);
		$stmt->bindParam(2, $dataficha2["noRegistro"]);
		$stmt->bindParam(3, utf8_decode($dataficha2["nombresocio"]));
		$stmt->bindParam(4, $dataficha2["fechaCaducidad"]);
		$stmt->bindParam(5, $dataficha2["fechaPublicacion"]);
		$stmt->bindParam(6, $dataficha2["telefono"]);
		$stmt->bindParam(7, $dataficha2["observaciones"]);
		$stmt->bindParam(8, $tipo);
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            return "Error:REG_FICHA. Intente más tarde";
        }
			}
			
		function getdataFicXid($idficha4){
			//return "continue";
			
			$query5 = "SELECT no_registro, socio, vigencia, publicacion, telefono, observaciones, id_tipo_promo, id_categoria, id_subcategoria, titulo_promo, promocion_texto, horarios, pagina_web, facebook, twitter, email, contacto, sucursales, nombre_cpimg, nombre_bkimg, nombre_promopdf, nombre_sucpdf, descripcion, colorpdf, carrucel, tipoplan FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idficha4.";";
			$stmt = $this->conn->prepare($query5);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}
			
			}
			
		function getListaCatego($idTipoPromo1){
			
			$query5 = "SELECT nombre_categoria, estado, id_categoria FROM ".$this->table_name." WHERE id_tipo_promo=".$idTipoPromo1." ORDER BY id_categoria ASC;";
			$stmt = $this->conn->prepare($query5);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_LISTACATEGORIA_".$errorQuery[2];
        	}
			
			}	
			
		function getListaCatego2($idTipoPromo2){
			
			$query5 = "SELECT nombre_categoria, id_categoria FROM ".$this->table_name." WHERE id_tipo_promo=".$idTipoPromo2." AND estado=1 ORDER BY id_categoria ASC;";
			$stmt = $this->conn->prepare($query5);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_LISTACATEGORIA_".$errorQuery[2];
        	}
			
			}		
					
		function insertCatego($nameCatego,$idTipoPromo){
			//return ($idTipoPromo);
			$this->getTimestamp();
		
		$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre_categoria = ?, id_tipo_promo = ?, fecha_registro = ?";			
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, utf8_decode($nameCatego));
		$stmt->bindParam(2, utf8_decode($idTipoPromo));
		$stmt->bindParam(3, $this->timestamp);
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            $errorQuery=$stmt->errorInfo();
            	return "Error:REG_CATEGORIA";
        }
			}		
		
		function valDatosCatego($nameCatego2){
			//return $nameCatego2;
			$regexp_text = "/^([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ]{0,3})([0-9a-zA-ZáéíóúÁÉÍÓÚÜÑñ\.\,!¡?¿\(\)\[\]\{\}°;:+\/*\-+_\s]{0,300})$/";
			$valMsj=true;
			if (!preg_match($regexp_text, $nameCatego2)) {
    		$valMsj="Error: No puedes utilizar signos en el campo Nombre categoría";
			return $valMsj;
			}	
		return $valMsj;	
			
			
			}
			
		function editCategoria($idCategoriaActual, $nameCategoriaNew){
			//return false;
		$this->getTimestamp();
		$query1 = "UPDATE `".$this->table_name."` SET nombre_categoria=?, fecha_update=? WHERE id_categoria=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, utf8_decode($nameCategoriaNew));
		$stmt->bindParam(2, $this->timestamp);
		$stmt->bindParam(3, $idCategoriaActual);
					
		if($stmt->execute()){
			return "Datos actualizados".$this->timestamp;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:GET_LISTACATEGORIA_".$errorQuery[2];
        }
			}
			
		function insertSubCatego($nameSubcatego, $idcatego){
		$this->getTimestamp();
		
		$query = "INSERT INTO
                    " . $this->table_name3 . "
                SET
                    nombre_subcategoria = ?, id_categoria = ?, fecha_registro = ?";			
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $nameSubcatego);
		$stmt->bindParam(2, $idcatego);
		$stmt->bindParam(3, $this->timestamp);
		
		if($stmt->execute()){
			//$last_id = $this->conn->lastInsertId();
            return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:INSERT_SUBCATEGORIA_".$errorQuery[2];
        }
			
			}
			
		function getSubCatXidCatego($idCatego1){
			$query5 = "SELECT nombre_subcategoria, id_subcategoria FROM ".$this->table_name3." WHERE id_categoria=? ORDER BY id_subcategoria ASC;";
			$stmt = $this->conn->prepare($query5);
			$stmt->bindParam(1, $idCatego1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_LISTACATEGORIA_".$errorQuery[2];
        	}
			}
			
		function getSubCatXidCatego2($idCatego1){
			$query5 = "SELECT id_subcategoria, nombre_subcategoria, id_categoria, estado FROM ".$this->table_name3." WHERE id_categoria=? ORDER BY id_subcategoria ASC;";
			$stmt = $this->conn->prepare($query5);
			$stmt->bindParam(1, $idCatego1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_LISTACATEGORIA2_".$errorQuery[2];
        	}
			}
			
		function getSubCatXidCatego3($idCatego2){
			$query5 = "SELECT id_subcategoria, nombre_subcategoria, id_categoria FROM ".$this->table_name3." WHERE id_categoria=? AND estado=1 ORDER BY id_subcategoria ASC;";
			$stmt = $this->conn->prepare($query5);
			$stmt->bindParam(1, $idCatego2);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_LISTACATEGORIA2_".$errorQuery[2];
        	}
			}	
			
		function changeEdoSubCategoria($idSubCat,$valEdoSubCat){
			//return $idSubCat;
			//$this->getTimestamp();
		$query10 = "UPDATE `".$this->table_name3."` SET estado=? WHERE id_subcategoria=?;";
		$stmt = $this->conn->prepare($query10);
		$stmt->bindParam(1, $valEdoSubCat);
		$stmt->bindParam(2, $idSubCat);
		
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            	return "Error:UPD_EDOCATEGORIA_".$errorQuery[2];
        }
			}	
			
		function getsubCatego($idSubCat){
			//return $idSubCat;
			$query5 = "SELECT id_subcategoria, nombre_subcategoria, id_categoria, estado FROM ".$this->table_name3." WHERE id_subcategoria=? ORDER BY id_subcategoria ASC;";
			$stmt = $this->conn->prepare($query5);
			$stmt->bindParam(1, $idSubCat);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_SUBCATEGORIA_".$errorQuery[2];
        	}
			
			}	
			
		function updateSubCatego($idSubcatego, $nameSubcatego){
		$this->getTimestamp();
		
		$query1 = "UPDATE `".$this->table_name3."` SET nombre_subcategoria=?, fecha_update=? WHERE id_subcategoria=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, $nameSubcatego);
		$stmt->bindParam(2, $this->timestamp);
		$stmt->bindParam(3, $idSubcatego);
		
		
				
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:INSERT_SUBCATEGORIA_".$errorQuery[2];
        }
			}
							 		
		function updateFichaSinSubCat($idFichaAct1){
			$fichaAct1=base64_decode($idFichaAct1);
			$dataFichaAct=$this->arrayDataFicha2;
			$this->getTimestamp();
			
			//return $fichaAct;
			
			$query_1 = "UPDATE `".$this->table_name2."` 
		SET id_categoria=?, titulo_promo=?, promocion_texto=?, horarios=?, pagina_web=?, facebook=?, twitter=?, email=?, no_registro=?, socio=?, vigencia=?, publicacion=?, contacto=?, telefono=?, observaciones=?, fecha_update=?, sucursales=?, descripcion=?, colorpdf=?
		WHERE idcp_pdf_ficha=?;";
		
		$stmt = $this->conn->prepare($query_1);
		$stmt->bindParam(1, $dataFichaAct["categoria"]);
		$stmt->bindParam(2, utf8_decode($dataFichaAct["tituloPromo"]));
		$stmt->bindParam(3, utf8_decode($dataFichaAct["promocion"]));
		$stmt->bindParam(4, utf8_decode($dataFichaAct["horarios"]));
		$stmt->bindParam(5, $dataFichaAct["paginaWeb"]);
		$stmt->bindParam(6, $dataFichaAct["facebook"]);
		$stmt->bindParam(7, $dataFichaAct["twitter"]);
		$stmt->bindParam(8, $dataFichaAct["email"]);
		$stmt->bindParam(9, $dataFichaAct["noRegistro"]);
		$stmt->bindParam(10, utf8_decode($dataFichaAct["nombresocio"]));
		$stmt->bindParam(11, $dataFichaAct["fechaCaducidad"]);
		$stmt->bindParam(12, $dataFichaAct["fechaPublicacion"]);
		$stmt->bindParam(13, utf8_decode($dataFichaAct["contacto"]));
		$stmt->bindParam(14, utf8_decode($dataFichaAct["telefono"]));
		$stmt->bindParam(15, utf8_decode($dataFichaAct["observaciones"]));
		$stmt->bindParam(16, $this->timestamp);
		$stmt->bindParam(17, utf8_decode($dataFichaAct["sucursales"]));
		$stmt->bindParam(18, utf8_decode($dataFichaAct["descripcion"]));
		$stmt->bindParam(19, utf8_decode($dataFichaAct["colortxtpdf"]));
		$stmt->bindParam(20, $fichaAct1);
				
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_".$errorQuery[2];
        }
			
			
			
					
			
			
			}
			
		function updateFichaConSubCat($idFichaAct2){
			$fichaAct2=base64_decode($idFichaAct2);
			$dataFichaAct=$this->arrayDataFicha2;
			$this->getTimestamp();
			
			//return $fichaAct;
			
			$query_2 = "UPDATE `".$this->table_name2."` 
		SET id_categoria=?, id_subcategoria=?, titulo_promo=?, promocion_texto=?, horarios=?, pagina_web=?, facebook=?, twitter=?, email=?, no_registro=?, socio=?, vigencia=?, publicacion=?, contacto=?, telefono=?, observaciones=?, fecha_update=?, sucursales=?, descripcion=?, colorpdf=?
		WHERE idcp_pdf_ficha=?;";
		
		$stmt = $this->conn->prepare($query_2);
		$stmt->bindParam(1, $dataFichaAct["categoria"]);
		$stmt->bindParam(2, $dataFichaAct["subCategoria"]);
		$stmt->bindParam(3, utf8_decode($dataFichaAct["tituloPromo"]));
		$stmt->bindParam(4, utf8_decode($dataFichaAct["promocion"]));
		$stmt->bindParam(5, utf8_decode($dataFichaAct["horarios"]));
		$stmt->bindParam(6, $dataFichaAct["paginaWeb"]);
		$stmt->bindParam(7, $dataFichaAct["facebook"]);
		$stmt->bindParam(8, $dataFichaAct["twitter"]);
		$stmt->bindParam(9, $dataFichaAct["email"]);
		$stmt->bindParam(10, $dataFichaAct["noRegistro"]);
		$stmt->bindParam(11, utf8_decode($dataFichaAct["nombresocio"]));
		$stmt->bindParam(12, $dataFichaAct["fechaCaducidad"]);
		$stmt->bindParam(13, $dataFichaAct["fechaPublicacion"]);
		$stmt->bindParam(14, utf8_decode($dataFichaAct["contacto"]));
		$stmt->bindParam(15, utf8_decode($dataFichaAct["telefono"]));
		$stmt->bindParam(16, utf8_decode($dataFichaAct["observaciones"]));
		$stmt->bindParam(17, $this->timestamp);
		$stmt->bindParam(18, utf8_decode($dataFichaAct["sucursales"]));
		$stmt->bindParam(19, utf8_decode($dataFichaAct["descripcion"]));
		$stmt->bindParam(20, utf8_decode($dataFichaAct["colortxtpdf"]));
		$stmt->bindParam(21, $fichaAct2);
				
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_".$errorQuery[2];
        }
			
			
			
			/*if ($dataFichaAct["subCategoria"]===0){
				
				$query1 = "UPDATE `".$this->table_name2."` 
		SET id_categoria=?, titulo_promo=?, promocion_texto=?, horarios=?, pagina_web=?, facebook=?, twitter=?, email=?, no_registro=?, socio=?, vigencia=?, publicacion=?, contacto=?, telefono=?, observaciones=?, fecha_update=?;
		WHERE idcp_pdf_ficha=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, $dataFichaAct["categoria"]);
		//$stmt->bindParam(2, $dataFichaAct["subCategoria"]);
		$stmt->bindParam(2, $dataFichaAct["tituloPromo"]);
		$stmt->bindParam(3, $dataFichaAct["promocion"]);
		$stmt->bindParam(4, $dataFichaAct["horarios"]);
		$stmt->bindParam(5, $dataFichaAct["paginaWeb"]);
		$stmt->bindParam(6, $dataFichaAct["facebook"]);
		$stmt->bindParam(7, $dataFichaAct["twitter"]);
		$stmt->bindParam(8, $dataFichaAct["email"]);
		$stmt->bindParam(9, $dataFichaAct["noRegistro"]);
		$stmt->bindParam(10, $dataFichaAct["nombresocio"]);
		$stmt->bindParam(11, $dataFichaAct["fechaCaducidad"]);
		$stmt->bindParam(12, $dataFichaAct["fechaPublicacion"]);
		$stmt->bindParam(13, $dataFichaAct["contacto"]);
		$stmt->bindParam(14, $dataFichaAct["telefono"]);
		$stmt->bindParam(15, $dataFichaAct["observaciones"]);
		$stmt->bindParam(16, $this->timestamp);
		$stmt->bindParam(17, $fichaAct);
				
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:INSERT_SUBCATEGORIA_".$errorQuery[2];
        }
				
				}else{
					
					$query1 = "UPDATE `".$this->table_name2."` 
		SET id_categoria=?, id_subcategoria=?, titulo_promo=?, promocion_texto=?, horarios=?, pagina_web=?, facebook=?, twitter=?, email=?, no_registro=?, socio=?, vigencia=?, publicacion=?, contacto=?, telefono=?, observaciones=?, fecha_update=?;
		WHERE idcp_pdf_ficha=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, $dataFichaAct["categoria"]);
		$stmt->bindParam(2, $dataFichaAct["subCategoria"]);
		$stmt->bindParam(3, $dataFichaAct["tituloPromo"]);
		$stmt->bindParam(4, $dataFichaAct["promocion"]);
		$stmt->bindParam(5, $dataFichaAct["horarios"]);
		$stmt->bindParam(6, $dataFichaAct["paginaWeb"]);
		$stmt->bindParam(7, $dataFichaAct["facebook"]);
		$stmt->bindParam(8, $dataFichaAct["twitter"]);
		$stmt->bindParam(9, $dataFichaAct["email"]);
		$stmt->bindParam(10, $dataFichaAct["noRegistro"]);
		$stmt->bindParam(11, $dataFichaAct["nombresocio"]);
		$stmt->bindParam(12, $dataFichaAct["fechaCaducidad"]);
		$stmt->bindParam(13, $dataFichaAct["fechaPublicacion"]);
		$stmt->bindParam(14, $dataFichaAct["contacto"]);
		$stmt->bindParam(15, $dataFichaAct["telefono"]);
		$stmt->bindParam(16, $dataFichaAct["observaciones"]);
		$stmt->bindParam(17, $this->timestamp);
		$stmt->bindParam(18, $fichaAct);
				
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:INSERT_SUBCATEGORIA_".$errorQuery[2];
        }
					
					}*/
			
		
		
			
			
			}	
			
		function upImgFichaCp(){
			$this->getTimestamp();
		$query2 = "UPDATE `".$this->table_name2."` SET cp_img=?, tamanio_cpimg=?, tipo_cpimg=?, nombre_cpimg=?, tamanio_unidad_cpimg=?, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query2);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroFicha);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_CP_".$errorQuery[2];
        }			
			}
			
		function upImgFichaBk(){
			$this->getTimestamp();
		$query2 = "UPDATE `".$this->table_name2."` SET bk_img=?, tamanio_bkimg=?, tipo_bkimg=?, nombre_bkimg=?, tamanio_unidad_bkimg=?, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query2);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroFicha);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_CP_".$errorQuery[2];
        }			
			
			
			}
			
		function upPdfpromo(){
			
			$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name2."` SET promo_pdf=?, tamanio_promopdf=?, tipo_promopdf=?, nombre_promopdf=?, tamanio_unidad_promopdf=?, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->content3);
		$stmt->bindParam(2, $this->size3);
		$stmt->bindParam(3, $this->type3);
		$stmt->bindParam(4, utf8_decode($this->fileName3));
		$stmt->bindParam(5, $this->unitSize3);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroFicha);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_PDFPROMO_".$errorQuery[2];
        }
			
			}	
			
		function upPdfsuc(){
			$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name2."` SET suc_pdf=?, tamanio_sucpdf=?, tipo_sucpdf=?, nombre_sucpdf=?, tamanio_unidad_sucpdf=?, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->content3);
		$stmt->bindParam(2, $this->size3);
		$stmt->bindParam(3, $this->type3);
		$stmt->bindParam(4, utf8_decode($this->fileName3));
		$stmt->bindParam(5, $this->unitSize3);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroFicha);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_PDFPROMO_".$errorQuery[2];
        }
			
			}
			
		
		function upImgFichaCpNull($idfichaacct){
			//return $idfichaacct;
		$this->getTimestamp();
		
		/*SET NULL IMAGEN LOGOTIPO*/
/*UPDATE `promociones_smb`.`cp_pdf_ficha`
SET cp_img = NULL, tamanio_cpimg = NULL, tipo_cpimg = NULL, nombre_cpimg = NULL, tamanio_unidad_cpimg = NULL
WHERE idcp_pdf_ficha = 15;*/
		
		$query3 = "UPDATE `".$this->table_name2."` SET cp_img=NULL, tamanio_cpimg=NULL, tipo_cpimg=NULL, nombre_cpimg=NULL, tamanio_unidad_cpimg=NULL, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->timestamp);
		$stmt->bindParam(2, $idfichaacct);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_NULL_IMGCP_".$errorQuery[2];
        }
			
			
			
					
			}
		function upImgfichaBkNull($idfichaacctBackImg){
			//return $idfichaacctBackImg;
			/*SET NULL BACKGROUND*/
/*UPDATE `promociones_smb`.`cp_pdf_ficha`
SET bk_img = NULL, tamanio_bkimg = NULL, tipo_bkimg = NULL, nombre_bkimg = NULL, tamanio_unidad_bkimg = NULL
WHERE idcp_pdf_ficha = 15;*/
$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name2."` SET bk_img=NULL, tamanio_bkimg=NULL, tipo_bkimg=NULL, nombre_bkimg=NULL, tamanio_unidad_bkimg=NULL, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->timestamp);
		$stmt->bindParam(2, $idfichaacctBackImg);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_NULL_IMGBK_".$errorQuery[2];
        }
			
			
			
			}
		function upPdfpromoNull($idfichaacctPdfPromo){
			//return $idfichaacctPdfPromo;
			
			/*SET NULL ARCHIVO PDF PROMO*/
/*UPDATE `promociones_smb`.`cp_pdf_ficha`
SET promo_pdf = NULL, tamanio_promopdf = NULL, tipo_promopdf = NULL, nombre_promopdf = NULL, tamanio_unidad_promopdf = NULL
WHERE idcp_pdf_ficha = 15;*/
		$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name2."` SET promo_pdf=NULL, tamanio_promopdf=NULL, tipo_promopdf=NULL, nombre_promopdf=NULL, tamanio_unidad_promopdf=NULL, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->timestamp);
		$stmt->bindParam(2, $idfichaacctPdfPromo);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_NULL_PDFPROMO_".$errorQuery[2];
        }
			
			}
		function upPdfsucNull($idfichaacctPdfSuc){
			//return $idfichaacctPdfSuc;
			/*SET NULL ARCHIVO PDF SUCURSALES*/
/*UPDATE `promociones_smb`.`cp_pdf_ficha`
SET suc_pdf = NULL, tamanio_sucpdf = NULL, tipo_sucpdf = NULL, nombre_sucpdf = NULL, tamanio_unidad_sucpdf = NULL
WHERE idcp_pdf_ficha = 15;*/
		$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name2."` SET suc_pdf=NULL, tamanio_sucpdf=NULL, tipo_sucpdf=NULL, nombre_sucpdf=NULL, tamanio_unidad_sucpdf=NULL, fecha_update=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->timestamp);
		$stmt->bindParam(2, $idfichaacctPdfSuc);
		if($stmt->execute()){
			return "true";
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_FICHA_NULL_PDFSUC_".$errorQuery[2];
        }
			
			
			
			
			}			
		
		
		function getFimg2($idpro2){
			$query3 = "SELECT cp_img, tipo_cpimg, nombre_cpimg FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idpro2.";";
			$stmt = $this->conn->prepare($query3);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            return "Error:GET_FICHA_CP_".$errorQuery[2];
        	}		
			}
			
		function getFimg3($idpro3){
			$query3 = "SELECT bk_img, tipo_bkimg, nombre_bkimg FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idpro3.";";
			$stmt = $this->conn->prepare($query3);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            return "Error:GET_FICHA_BK_".$errorQuery[2];
        	}		
			}	
			
		function getFimg4($idpro4){
			$query3 = "SELECT promo_pdf, tipo_promopdf, nombre_promopdf FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idpro4.";";
			$stmt = $this->conn->prepare($query3);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            return "Error:GET_FICHA_BK_".$errorQuery[2];
        	}		
			
			}	
			
		function getFimg5($idpro5){
			$query3 = "SELECT suc_pdf, tipo_sucpdf, nombre_sucpdf FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idpro5.";";
			$stmt = $this->conn->prepare($query3);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            return "Error:GET_FICHA_BK_".$errorQuery[2];
        	}		
			
			}	
			
		function getListaFichasXty($tipoFicha){
			//return $tipoFicha;
			$query6 = "SELECT idcp_pdf_ficha, publicacion, vigencia, nombre_cpimg, nombre_bkimg, nombre_promopdf, nombre_sucpdf, socio, act_susp, posicion FROM ".$this->table_name2." WHERE id_tipo_promo=".$tipoFicha." ORDER BY posicion ASC;";
			$stmt = $this->conn->prepare($query6);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_FICHA_LISTA_".$errorQuery[2];
        	}
			
			}
			
		function getImgFichaXidCatego($idCatFicha){
			
			//return $tipoFicha;
			$query6 = "SELECT idcp_pdf_ficha, cp_img, socio, publicacion, vigencia, tipoplan FROM ".$this->table_name2." WHERE id_categoria=".$idCatFicha." AND act_susp=1 ORDER BY posicion ASC;";
			$stmt = $this->conn->prepare($query6);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_FICHA_LISTA_".$errorQuery[2];
        	}
			
			}	
			
		function getImgFichaXidCategoLoc($idCatFicha2,$idLoc){
			
			$query6 = "SELECT e.`idcp_pdf_ficha`, e.`cp_img`, e.`socio`, e.`publicacion`, e.`vigencia`, c.`idcp_pdf_ficha` AS id_ficha, c.`id_localidades`
FROM ".$this->table_name2." AS e
LEFT JOIN ".$this->table_name4." AS c ON e.idcp_pdf_ficha = c.idcp_pdf_ficha
WHERE e.id_categoria=".$idCatFicha2." AND c.id_localidades=".$idLoc." AND e.act_susp=1 ORDER BY e.posicion ASC;";
			
			$stmt = $this->conn->prepare($query6);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_FICHA_LISTALOC_".$errorQuery[2];
        	}
			
			}		
			
		function changePosFicha($idFicha, $valPos){
			//$this->getTimestamp();
		//return $idFicha;
		$query8 = "UPDATE `".$this->table_name2."` SET posicion=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valPos);
		$stmt->bindParam(2, $idFicha);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDPOS_FICHA".$errorQuery[2];
        }	
			}	
			
		function changeEdoFicha($idFicha2, $valedo){
			$query8 = "UPDATE `".$this->table_name2."` SET act_susp=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valedo);
		$stmt->bindParam(2, $idFicha2);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDEDO_FICHA".$errorQuery[2];
        }	
			}
			
		function changeEdoCarrucel($valedoCarrucel, $idFichaCarr){
			//return (array($valedoCarrucel,$idFichaCarr));
			$query8 = "UPDATE `".$this->table_name2."` SET carrucel=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valedoCarrucel);
		$stmt->bindParam(2, $idFichaCarr);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDEDO_CARR".$errorQuery[2];
        }	
			}	
			
		
		function changeEdoplan($valedoplan, $idFichaCarr2){
			//return (array($valedoCarrucel,$idFichaCarr));
			$query8 = "UPDATE `".$this->table_name2."` SET tipoplan=? WHERE idcp_pdf_ficha=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valedoplan);
		$stmt->bindParam(2, $idFichaCarr2);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDEDO_PLAN".$errorQuery[2];
        }	
			}	
			
			
		function getFpdf($idFicha3){
			$query4 = "SELECT idcp_pdf_ficha, id_categoria, id_tipo_promo, cp_img, bk_img, promo_pdf, suc_pdf, titulo_promo, descripcion, promocion_texto, socio, sucursales, horarios, telefono, pagina_web, facebook, twitter, email, colorpdf FROM ".$this->table_name2." WHERE idcp_pdf_ficha=".$idFicha3.";";
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_FICHA".$errorQuery[2];
        	}
			}
			
		function getFpdfCupon($idFicha3){
			$query4 = "SELECT id_cp_pdf_promo, cupon_img, fecha_publicacion, fecha_caducidad FROM ".$this->table_name6." WHERE tipo_promo_fk=".$idFicha3." AND act_susp=1;";
			$stmt = $this->conn->prepare($query4);	   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_CUPON".$errorQuery[2];
        	}
			}
			
		function numRowTipoPromo($tficha){
			$query4 = "SELECT COUNT(`idcp_pdf_ficha`) AS totalRow FROM `cp_pdf_ficha` WHERE `id_tipo_promo`={$tficha};";
			$stmt = $this->conn->prepare($query4);	   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_CUPON".$errorQuery[2];
        	}
			
			
			}		
			
		function getFpdfDir($idFicha3,$lmin,$lmax){
			
			$query4 = "SELECT e.`idcp_pdf_ficha`, e.publicacion, e.vigencia, e.`id_categoria`, e.`id_subcategoria`, e.`cp_img`, e.socio, e.promocion_texto, e.direccion_texto, e.telefono, d.nombre_categoria, d.id_tipo_promo, c.nombre_subcategoria, c.id_categoria AS ccat
FROM ".$this->table_name2." AS e
LEFT JOIN ".$this->table_name." AS d ON e.`id_categoria`=d.id_categoria
LEFT JOIN ".$this->table_name3." AS c ON e.`id_subcategoria`=c.id_subcategoria
WHERE e.id_tipo_promo=".$idFicha3." AND e.act_susp=1 ORDER BY nombre_categoria LIMIT {$lmin},{$lmax}";
			$stmt = $this->conn->prepare($query4);	   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_CUPON".$errorQuery[2];
        	}
			
			}	
		
		function getfichasXcatSubcat($idcat,$idsubcat){
			//return $tipoFicha;
			$query6 = "SELECT idcp_pdf_ficha, cp_img, socio, publicacion, vigencia, tipoplan FROM ".$this->table_name2." WHERE id_categoria=".$idcat." AND id_subcategoria=".$idsubcat." AND act_susp=1 ORDER BY posicion ASC;";
			$stmt = $this->conn->prepare($query6);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_FICHA_SUBLISTA_".$errorQuery[2];
        	}
			}
			
		function getfichasXcatSubcat2($idcat,$idsubcat,$localodadId){
			//return $tipoFicha;
			$query6 = "SELECT e.`idcp_pdf_ficha`, e.`cp_img`, e.`socio`, e.`publicacion`, e.`vigencia`, c.`idcp_pdf_ficha` AS id_ficha, c.`id_localidades`
FROM ".$this->table_name2." AS e
LEFT JOIN ".$this->table_name4." AS c ON e.idcp_pdf_ficha = c.idcp_pdf_ficha
WHERE e.id_categoria=".$idcat." AND e.id_subcategoria=".$idsubcat." AND c.id_localidades=".$localodadId." AND e.act_susp=1 ORDER BY e.posicion ASC;";
$stmt = $this->conn->prepare($query6);	
			if($stmt->execute()){
				return $stmt;
        	}else{
            	$errorQuery=$stmt->errorInfo();
            	return "Error:GET_FICHA_SUBLISTA_".$errorQuery[2];
        	}
			}					


		function getLocalidades(){
			
			$query4 = "SELECT id_localidades, nombre_localidad FROM ".$this->table_name5.";";
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_LOCALIDADES".$errorQuery[2];
        	}
			
			}
		
		function insertLocalidadAsig($idFicha,$idLocalidad){
			
			//return $idFicha."-".$idLocalidad; 
			
			$this->getTimestamp();
		
		$query = "INSERT INTO
                    " . $this->table_name4 . "
                SET
                    idcp_pdf_ficha = ?, id_localidades = ?;";			
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $idFicha);
		$stmt->bindParam(2, $idLocalidad);
		
		
		if($stmt->execute()){
			//$last_id = $this->conn->lastInsertId();
            return "Localidad asignada ".$this->timestamp;
        }else{
            $errorQuery=$stmt->errorInfo();
            return "Error:INSERT_LOCALIDAD_ASIGNADA_".$errorQuery[2];
        }
			
			
			
			}
		
		function getLocAsig($idfichaProm){
			$query4 = "SELECT e.`id_localidades_asignadas`, e.`idcp_pdf_ficha`, e.`id_localidades`, c.`nombre_localidad` 
FROM `".$this->table_name4."` AS e 
LEFT JOIN `".$this->table_name5."` AS c
ON e.`id_localidades` = c.`id_localidades`
WHERE e.`idcp_pdf_ficha`=".$idfichaProm."
ORDER BY c.`nombre_localidad` ASC";
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_LOCALIDADES_ASIGNADAS".$errorQuery[2];
        	}
			}	
			
		function delLocalidadAsig($locIds){
			
			$query4 = "DELETE FROM `".$this->table_name4."` WHERE `id_localidades_asignadas` IN (".$locIds.");";
			//return $query4;
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return "true";
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:DELETE_LOCALIDADES_ASIGNADAS".$errorQuery[2];
        	}
						
			}	
				
		function getFxEdoLocalidad($id_tipo_promo,$id_localidad){
			$query4 = "SELECT e.id_localidades, e.idcp_pdf_ficha, c.idcp_pdf_ficha AS ficha_id, c.cp_img, c.publicacion, c.vigencia, c.socio, c.tipoplan, f.id_localidades AS localidades_id, f.nombre_localidad, g.nombre_categoria, g.id_categoria
FROM ".$this->table_name4." AS e
LEFT JOIN  ".$this->table_name2." AS c 
    ON e.idcp_pdf_ficha = c.idcp_pdf_ficha
LEFT JOIN  ".$this->table_name5." AS f 
    ON e.id_localidades = f.id_localidades
LEFT JOIN  ".$this->table_name." AS g 
    ON c.id_categoria = g.id_categoria
WHERE e.id_localidades={$id_localidad} AND c.id_tipo_promo={$id_tipo_promo} AND c.act_susp=1 ORDER BY g.nombre_categoria ASC";
			$stmt = $this->conn->prepare($query4);
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GET_FICHAS_LOCALIDAD".$errorQuery[2];
        	}
			}
						
		function getImgEncabezado($tipoCatalogo,$mes){
			$query4 = "SELECT `encabezado_jpg` FROM `encabezados` WHERE `mes`={$mes} AND `tipo_catalogo`={$tipoCatalogo}";
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           		 return "Error:GETIMG_CATALOGOS".$errorQuery[2];
        		}
			}	
		
		
		function getTimestamp(){
    	date_default_timezone_set('Mexico/General');
    	$this->timestamp = date('Y-m-d H:i:s');
		}
		
}
?>