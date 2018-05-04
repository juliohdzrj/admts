<?php
class userLogin{
	private $table_name = "user_smb";
	
	public $arrayData="";
	public function __construct($db){
        $this->conn = $db;
    }
	
	
	function validateUser(){
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
		}
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