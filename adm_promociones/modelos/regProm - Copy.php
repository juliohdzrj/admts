<?php
class regProm{
	private $table_name = "cp_pdf_promo";
	private $table_name1="categoria";
	private $timestamp;
	
	public $arrayDataPromo="";
	public $idRegistroPromo="";
	public $fileName="";
	public $content="";
	public $size="";
	public $unitSize="";
	public $type="";
	
	public function __construct($db){
        $this->conn = $db;
    }
	
	
	function valDatosPromo(){
		$dataPromo=$this->arrayDataPromo;
		$regexp_nombre = "/^([a-zA-Z0-9áéíóúÁÉÍÓÚÜ]{3,3})([a-zA-Z0-9áéíóúÁÉÍÓÚÜ\s]{0,40})$/";
		$regexp_fecha = "/^([0-9]{4,4})(-)([0-9]{2,2})(-)([0-9]{2,2})$/";
		$valMsj=true;
		//return 	$this->arrayDataPromo;
		$namePromo=$dataPromo["nombrePromocion"];
		$fcaducidad=$dataPromo["fechaCaducidad"];
		$fpublicacion=$dataPromo["fechaPublicacion"];
		/*if (!preg_match($regexp_nombre, $namePromo)) {
    		$valMsj="No puedes utilizar signos en el campo nombre promoción";
			return $valMsj;
			}*/
		if (!preg_match($regexp_fecha, $fcaducidad)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}
		if (!preg_match($regexp_fecha, $fpublicacion)) {
    		$valMsj="El formato de fecha debe ser aaaa-mm-dd";
			return $valMsj;
			}
		return $valMsj;							
		}
		
	function insertPromo($tipo){
		$dataPromo2=$this->arrayDataPromo;
		$this->getTimestamp();
		$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    fecha_publicacion = ?, fecha_caducidad = ?, tipo_promo_fk = ?, nombre_promo = ?, fecha_reg = ?";			
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $dataPromo2["fechaPublicacion"]);
		$stmt->bindParam(2, $dataPromo2["fechaCaducidad"]);
		$stmt->bindParam(3, $tipo);
		$stmt->bindParam(4, utf8_decode($dataPromo2["nombrePromocion"]));
		$stmt->bindParam(5, $this->timestamp);
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            return "Error:REG_PROMO. Intente más tarde";
        }
		}
	
	function updataXid($idpro){
		$this->getTimestamp();
		$dataPromo3=$this->arrayDataPromo;
		//return $idpro;
		
		$query1 = "UPDATE `".$this->table_name."` SET fecha_publicacion=?, fecha_caducidad=?, nombre_promo=?, fecha_act=? WHERE id_cp_pdf_promo=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, $dataPromo3["fechaPublicacion"]);
		$stmt->bindParam(2, $dataPromo3["fechaCaducidad"]);
		$stmt->bindParam(3, utf8_decode($dataPromo3["nombrePromocion"]));
		$stmt->bindParam(4, $this->timestamp);
		$stmt->bindParam(5, $idpro);
				
		if($stmt->execute()){
			return "Datos actualizados ".$this->timestamp;
        }else{
            return "false";
        }
		
				
		}
		
		function updateFile(){
		$this->getTimestamp();
		$query2 = "UPDATE `".$this->table_name."` SET cp_img=?, tamanio_img=?, tipo_img=?, nombre_archivo_img=?, tamanio_unidad_img=?, fecha_act=? WHERE id_cp_pdf_promo=?;";
		$stmt = $this->conn->prepare($query2);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroPromo);
		if($stmt->execute()){
			return $stmt;
        }else{
            return "false";
        }
        	
		}
		
		
		function updateFile2(){
		$this->getTimestamp();
		$query3 = "UPDATE `".$this->table_name."` SET cupon_pdf=?, tamanio_pdf=?, tipo_pdf=?, nombre_archivo_pdf=?, tamanio_unidad_pdf=?, fecha_act=? WHERE id_cp_pdf_promo=?;";
		$stmt = $this->conn->prepare($query3);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		$stmt->bindParam(6, $this->timestamp);
		$stmt->bindParam(7, $this->idRegistroPromo);
		if($stmt->execute()){
			return $stmt;
        }else{
            return "false";
        }
        	
		}
		
		
		function getFimg($idpro2){
			$query3 = "SELECT cp_img, tipo_img, nombre_archivo_img FROM ".$this->table_name." WHERE id_cp_pdf_promo=".$idpro2.";";
			$stmt = $this->conn->prepare($query3);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		
			}
		
		function getFpdf($idpro3){
			$query4 = "SELECT cupon_pdf, tipo_pdf, nombre_archivo_pdf FROM ".$this->table_name." WHERE id_cp_pdf_promo=".$idpro3.";";
			$stmt = $this->conn->prepare($query4);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		
			}
			
		function getdataProXid($idpro4){
			$query5 = "SELECT fecha_publicacion, fecha_caducidad, nombre_archivo_img, nombre_cupon_img, nombre_archivo_pdf, nombre_promo, tipo_promo_fk FROM ".$this->table_name." WHERE id_cp_pdf_promo=".$idpro4.";";
			$stmt = $this->conn->prepare($query5);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}
			}
			
		function getListaPromosXty($tipoPromo){
			//return "ok";
			$query6 = "SELECT id_cp_pdf_promo, fecha_publicacion, fecha_caducidad, nombre_archivo_img, nombre_archivo_pdf, nombre_promo, act_susp, posicion FROM ".$this->table_name." WHERE tipo_promo_fk=".$tipoPromo." ORDER BY posicion ASC;";
			$stmt = $this->conn->prepare($query6);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}
			
			}		
			
		function changeEdo($idPromo, $valEdo){
		//$this->getTimestamp();
		$query7 = "UPDATE `".$this->table_name."` SET act_susp=? WHERE id_cp_pdf_promo=?;";
		$stmt = $this->conn->prepare($query7);
		$stmt->bindParam(1, $valEdo);
		$stmt->bindParam(2, $idPromo);
		
		if($stmt->execute()){
			return true;
        }else{
            return "false";
        }
			
			
			}
			
		function changePos($idPromo2, $valPos){
		//$this->getTimestamp();
		$query8 = "UPDATE `".$this->table_name."` SET posicion=? WHERE id_cp_pdf_promo=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valPos);
		$stmt->bindParam(2, $idPromo2);
		
		if($stmt->execute()){
			return true;
        }else{
            return "false";
        }	
			
			}
			
	function getProXtipo($tipoPromo2){
		//return $tipoPromo;
		$query9 = "SELECT id_cp_pdf_promo, cp_img, fecha_publicacion, fecha_caducidad FROM ".$this->table_name." WHERE tipo_promo_fk=".$tipoPromo2." AND act_susp=1 ORDER BY posicion ASC;";
			$stmt = $this->conn->prepare($query9);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		
		}					
		
	function changeEdoCategoria($idCatego, $valEdoCat){
		//$this->getTimestamp();
		$query10 = "UPDATE `".$this->table_name1."` SET estado=? WHERE id_categoria=?;";
		$stmt = $this->conn->prepare($query10);
		$stmt->bindParam(1, $valEdoCat);
		$stmt->bindParam(2, $idCatego);
		
		if($stmt->execute()){
			return true;
        }else{
            $errorQuery=$stmt->errorInfo();
            	return "Error:UPD_EDOCATEGORIA_".$errorQuery[2];
        }
		
		}	
		
	function getTimestamp(){
    	date_default_timezone_set('Mexico/General');
    	$this->timestamp = date('Y-m-d H:i:s');
		}
	
	
	
	
	/*function validateUser(){
		$dataUser=$this->arrayData;
		$regexp_nombre = "/^([a-zA-ZáéíóúÁÉÍÓÚÜ]{3,3})([a-zA-ZáéíóúÁÉÍÓÚÜ\s]{0,40})$/";
		$regexp_password = "/^([a-zA-Z0-9áéíóúÁÉÍÓÚÜ]{3,3})([a-zA-Z0-9áéíóúÁÉÍÓÚÜ\s]{0,15})$/";
		$login=true;
		$name=$dataUser["name"];
		$cd=$dataUser["cd"];
if (!preg_match($regexp_nombre, $name)) {
    $login=false;
}

if (!preg_match($regexp_password, $cd)) {
    $login=false;
}
($login===false)? $resVal= "error" : $resVal= "continue";

if($login===false){
return 	$resVal;	
		}else{
			$query1 = "SELECT id_user_smb FROM ".$this->table_name." WHERE nombre='".$name."' AND password='".$cd."';";
			$stmt = $this->conn->prepare($query1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}	
			
			}   
		}*/
	
	
	}







//class membresia{
	// database connection and table name
    /*private $conn;
	private $table_name = "attr_mem";
	private $table_name1 = "membresia";
	private $table_name2 = "usuarios_ex";
	private $table_name3 = "reg_mem";
	
	private $caracteristicas_act="";
	private $tipo_act="";
	private $categoria_act="";
	
	
	public $nombre="";
	public $apMaterno="";
	public $apPaterno="";
	public $tipoMem="";
	public $idUserReg="";
	public $update_user="";*/
	
	/*public function __construct($db){
        $this->conn = $db;
    }*/
	
	/*function getTypeMem(){
			$query1 = "SELECT e.id_attr_mem, e.caracteristicas, e.id_membresia AS id_membresia_fk, c.id_membresia, c.tipo, c.categoria FROM ".$this->table_name." AS e LEFT JOIN ".$this->table_name1." AS c ON e.id_membresia=c.id_membresia";
			$stmt = $this->conn->prepare($query1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		   
			
		}*/
		
	/*function getTypeMemXid($idMem){
			$query1 = "SELECT e.id_attr_mem, e.caracteristicas, e.id_membresia AS id_membresia_fk, c.id_membresia, c.tipo, c.categoria
					   FROM ".$this->table_name." AS e
					   INNER JOIN ".$this->table_name1." AS c ON e.id_membresia ={$idMem}
					   AND c.id_membresia={$idMem}";
			$stmt = $this->conn->prepare($query1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		   
			
		}*/
		
	/*function getAttrUserXid($idUser){
			$query1 = "SELECT * 
					   FROM `".$this->table_name2."`
					   WHERE `id_usuarios`={$idUser}";
			$stmt = $this->conn->prepare($query1);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	return "false";
        	}		   
			
		}*/
		
	/*function registrarMem(){
		$arrayDataUser=$this->update_user;
		//return $arrayDataUser["nombre"];
		$query1 = "UPDATE `".$this->table_name2."` SET nombre=?, apellido_paterno=?, apellido_materno=?, edad=?, genero=?, tel_area_pais=?, tel_area_ciudad=?, tel_telefono=?, tel_extension=?, celular=?, cp=?, colonia=?, calle_numero=?, ciudad=?, estado=?, pais=?  WHERE id_usuarios=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, utf8_decode($arrayDataUser["nombre"]));
		$stmt->bindParam(2, utf8_decode($arrayDataUser["paterno"]));
		$stmt->bindParam(3, utf8_decode($arrayDataUser["materno"]));
		$stmt->bindParam(4, $arrayDataUser["edad"]);
		$stmt->bindParam(5, $arrayDataUser["genero"]);
		$stmt->bindParam(6, $arrayDataUser["DE_AreaPais"]);
		$stmt->bindParam(7, $arrayDataUser["DE_AreaCiudad"]);
		$stmt->bindParam(8, $arrayDataUser["DE_Telefono"]);
		$stmt->bindParam(9, $arrayDataUser["DE_ExtTel"]);
		$stmt->bindParam(10, $arrayDataUser["cel"]);
		$stmt->bindParam(11, $arrayDataUser["cp"]);
		$stmt->bindParam(12, utf8_decode($arrayDataUser["colonia"]));
		$stmt->bindParam(13, utf8_decode($arrayDataUser["calle"]));
		$stmt->bindParam(14, utf8_decode($arrayDataUser["delegacionMunicipio"]));
		$stmt->bindParam(15, utf8_decode($arrayDataUser["estado"]));
		$stmt->bindParam(16, utf8_decode($arrayDataUser["pais"]));
		$stmt->bindParam(17, $this->idUserReg);
		
		if($stmt->execute()){
		
		$inMemGen=$this->genIdMem();//OBTENEMOS ID DE MEMBRESIA		
		$caracteristicasMem=$this->getTypeMemXid($this->tipoMem);//OBTENEMOS CARACTERISTICAS DE LA MEMBRESIA ACTUAL
		$rowMemCaract=$caracteristicasMem->fetch(PDO::FETCH_ASSOC);
		extract($rowMemCaract);
		$this->categoria_act=$rowMemCaract["categoria"];
		$this->caracteristicas_act=$rowMemCaract["caracteristicas"];
		$this->tipo_act=$rowMemCaract["tipo"];
		//INSERTAMOS REGISTRO DE MMBRESIA
		//return $this->idUserReg;
		$query = "INSERT INTO
                    " . $this->table_name3 . "
                SET
                    id_bc_mem = ?, caracteristicas = ?, idusuarios_ex = ?, tipo_regmem = ?, categoria_regmem = ?";
					
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $inMemGen);
		$stmt->bindParam(2, $this->caracteristicas_act);
		$stmt->bindParam(3, $this->idUserReg);
		$stmt->bindParam(4, $this->tipo_act);
		$stmt->bindParam(5, $this->categoria_act);
				
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            return "Error:REG_MEM. Intente más tarde";
        }
        }else{
            return "Error:NUPDATE_USER. Intente más tarde";
        }
		
		
		/*
		$inMemGen=$this->genIdMem();//OBTENEMOS ID DE MEMBRESIA		
		$caracteristicasMem=$this->getTypeMemXid($this->tipoMem);//OBTENEMOS CARACTERISTICAS DE LA MEMBRESIA ACTUAL
		$rowMemCaract=$caracteristicasMem->fetch(PDO::FETCH_ASSOC);
		extract($rowMemCaract);
		$this->categoria_act=$rowMemCaract["categoria"];
		$this->caracteristicas_act=$rowMemCaract["caracteristicas"];
		$this->tipo_act=$rowMemCaract["tipo"];
		//INSERTAMOS REGISTRO DE MMBRESIA
		//return $this->idUserReg;
		$query = "INSERT INTO
                    " . $this->table_name3 . "
                SET
                    id_bc_mem = ?, caracteristicas = ?, idusuarios_ex = ?, tipo_regmem = ?, categoria_regmem = ?";
					
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $inMemGen);
		$stmt->bindParam(2, $this->caracteristicas_act);
		$stmt->bindParam(3, $this->idUserReg);
		$stmt->bindParam(4, $this->tipo_act);
		$stmt->bindParam(5, $this->categoria_act);
				
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            return "false";
        }*/
		
		//}	
		
		
	//function genIdMem(){
			//return ("continue");
/*GENERAR ID MEMBRESIA
=================================*/
/*$letraGen.= substr($this->nombre, 0, 1);
$letraGen.= substr($this->apPaterno, 0, 1);
$letraGen.= substr($this->apMaterno, 0, 1);
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
    for ($i = 0; $i < 12; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }	
return base64_encode($letraGen.$randomString);*7
/*TERMINA GENERAR ID MEMBRESIA
=================================*/			
		//}
		
				
	
	/*
	
	
	
	
	
	
	function verificaFileExiste(){
		$query1 = "SELECT id_pay_art FROM `".$this->table_name."` WHERE id_usuarios_ex=".$this->idUsuariosExt." AND id_registro_art=".$this->idRegistroArt.";";
		$stmt = $this->conn->prepare($query1);
		
		
		if($stmt->execute()){
			return $stmt;
        }else{
            return "false";
        }
				
		}
	
	function updateFile(){
		
		$query1 = "UPDATE `".$this->table_name."` SET contenido=?, tamanio=?, tipo=?, nombre_archivo=?, tamanio_unidad=? WHERE id_pay_art=?;";
		
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		$stmt->bindParam(6, $this->idArtPayUpdate);
		
		if($stmt->execute()){
			return $stmt;
        }else{
            return "false";
        }
        	
		}
	
	
	function getFile($id_user,$id_registro){
		//return $id_file;
		$query1 = "SELECT contenido, tamanio, tipo AS typeFile, nombre_archivo, tamanio_unidad,
   CASE tipo
      WHEN 'application/pdf' THEN 'archivo'
      WHEN 'image/jpeg' THEN 'image'
      WHEN 'image/jpg' THEN 'image'
      WHEN 'image/png' THEN 'image'
      WHEN 'image/gif' THEN 'image'
   ELSE 'vacio'
   END AS tipo
FROM ".$this->table_name."
WHERE id_usuarios_ex={$id_user} AND id_registro_art={$id_registro};";
		$stmt = $this->conn->prepare($query1);
		$stmt->execute();
		return $stmt;
		
		}
	
	
	function insertArchivo(){
		//return "continue insert";
		$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    contenido = ?, tamanio = ?, tipo = ?, nombre_archivo = ?, tamanio_unidad = ?, id_usuarios_ex = ?, id_registro_art = ?";
					
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->content);
		$stmt->bindParam(2, $this->size);
		$stmt->bindParam(3, $this->type);
		$stmt->bindParam(4, utf8_decode($this->fileName));
		$stmt->bindParam(5, $this->unitSize);
		
        $stmt->bindParam(6, $this->idUsuariosExt);
		$stmt->bindParam(7, $this->idRegistroArt);
		
		if($stmt->execute()){
			$last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            return "false";
        }
	}	*/
//}
?>