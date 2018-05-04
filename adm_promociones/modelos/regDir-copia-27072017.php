<?php
class regDirSMB{
	private $table_name = "medica";
	private $table_name1 = "especialidades";
	private $table_name2 = "localidades";
	private $timestamp;
	public function __construct($db){
        $this->conn = $db;
    }
	
	function getEspecialidades(){
		$query = "SELECT `nombre_especialidad`,`id_especialidad`  FROM  `".$this->table_name1."` 
				  ORDER BY `nombre_especialidad` ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR".$errorQuery[2];
        	}
		}
		
	function getLocalidades(){
		$query = "SELECT `id_localidades`,`nombre_localidad`  FROM  `".$this->table_name2."` 
				  ORDER BY `nombre_localidad` ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRMED_LOCALIDAD".$errorQuery[2];
        	}
		}
	
	function allDir(){
		//return "continue excel";
			$query = "SELECT No,Registro,Especialidad,Subespecialidad,Empresa,Nombre,Estado FROM  `".$this->table_name."` ORDER BY TRIM(`Especialidad`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_ALLDIR".$errorQuery[2];
        	}
		
		}
		
	function allEspecialidades(){
		
		$query = "SELECT id_especialidad, nombre_especialidad FROM  `".$this->table_name1."` ORDER BY nombre_especialidad ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_ALLDIR".$errorQuery[2];
        	}
		
		}	
		
	function allLocalidades(){
		
		$query = "SELECT id_localidades, nombre_localidad FROM  `".$this->table_name2."` ORDER BY nombre_localidad ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_ALLDIR_LOCALIDADES".$errorQuery[2];
        	}
		
		}		
	
	function searchDir($cadenatxt){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `Especialidad` LIKE '%".utf8_decode($cadenatxt)."%' AND `act_sup`=1 || `Delegacion` LIKE '%".utf8_decode($cadenatxt)."%' AND `act_sup`=1 || `Nombre` LIKE '%".utf8_decode($cadenatxt)."%' AND `act_sup`=1 || `Estado` LIKE '%".utf8_decode($cadenatxt)."%' AND `act_sup`=1 || `Especialidad` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Delegacion` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Nombre` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Estado` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Especialidad` LIKE '".utf8_decode($cadenatxt)."%' AND `act_sup`=1 || `Delegacion` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Nombre` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1 || `Estado` LIKE '%".utf8_decode($cadenatxt)."' AND `act_sup`=1
				  ORDER BY  TRIM(`Especialidad`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR".$errorQuery[2];
        	}
		
		}	
		
	function searchDir21($cadenatxt2){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `id_especialidad`=".$cadenatxt2." AND `act_sup`=1
				  ORDER BY TRIM(`Delegacion`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR21".$errorQuery[2];
        	}
		
		}
		
	function searchDir22($cadenatxt3, $nameMedico){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `id_especialidad`=".$cadenatxt3." AND `Nombre` LIKE '%".utf8_decode($nameMedico)."%' AND `act_sup`=1 
				  ORDER BY TRIM(`Nombre`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR22".$errorQuery[2];
        	}
		
		}
		
	function searchDir23($cadenatxt4, $delegacionData){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `id_especialidad`=".$cadenatxt4." AND `Delegacion` LIKE '%".utf8_decode($delegacionData)."%' AND `act_sup`=1 || `id_especialidad`=".$cadenatxt4." AND `Estado` LIKE '%".utf8_decode($delegacionData)."%' AND `act_sup`=1 ORDER BY  TRIM(`Nombre`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR23".$errorQuery[2];
        	}
		
		}
		
	function searchDir24($cadenatxt5, $delegacionData, $nameMedico){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `id_especialidad`=".$cadenatxt5." AND `Delegacion` LIKE '%".utf8_decode($delegacionData)."%' AND `Nombre` LIKE '%".utf8_decode($nameMedico)."%' AND `act_sup`=1 || `id_especialidad`=".$cadenatxt5." AND `Estado` LIKE '%".utf8_decode($delegacionData)."%' AND `Nombre` LIKE '%".utf8_decode($nameMedico)."%' AND `act_sup`=1 ORDER BY  TRIM(`Nombre`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR23".$errorQuery[2];
        	}
		
		}
		
	function searchDir25($cadenatxt6){
		
			$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE `id_localidades`=".$cadenatxt6." AND `act_sup`=1 ORDER BY  TRIM(`Nombre`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR25".$errorQuery[2];
        	}
		
		}	
		
	function searchDirMedic25($idLocalidadDirMedic){
		$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE id_localidades={$idLocalidadDirMedic} AND act_sup=1
				  ORDER BY TRIM(`Nombre`) ASC";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR_MEDIC_LOCALIDAD".$errorQuery[2];
        	}
		}	
		
	function getFichaMedica($idpromedic){
		$query = "SELECT No, Especialidad, imgficha, Nombre FROM  `".$this->table_name."` 
				  WHERE No='".utf8_decode($idpromedic)."'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIR23".$errorQuery[2];
        	}
		}
	
	function changeEspecialidad($RegDirMed,$valEsp){
		//$this->getTimestamp();
		//return $this->timestamp;
		
		$query8 = "UPDATE `".$this->table_name."` SET id_especialidad=? WHERE No=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valEsp);
		$stmt->bindParam(2, $RegDirMed);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDATE_ESPECIALIDAD".$errorQuery[2];
        }	
		
		}
		
	function changeLocalidad($RegDirMed2,$valLoc){
		$query8 = "UPDATE `".$this->table_name."` SET id_localidades=? WHERE No=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $valLoc);
		$stmt->bindParam(2, $RegDirMed2);
		
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_LOCALIDAD".$errorQuery[2];
        }	
		}	
	
	function regActual($idRegDir){
		
		$query = "SELECT Registro,id_especialidad FROM  `".$this->table_name."` 
				  WHERE No='".utf8_decode($idRegDir)."'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRIndividual".$errorQuery[2];
        	}
		
		}
		
	function regActualLocalidad($idRegDir2){
		
		$query = "SELECT Registro,id_localidades FROM  `".$this->table_name."` 
				  WHERE No='".utf8_decode($idRegDir2)."'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRIndividualLocalidad".$errorQuery[2];
        	}
		
		}
		
	function regActualAll($idRegDir2){
		
		$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE No='".utf8_decode($idRegDir2)."'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRIndividualAll".$errorQuery[2];
        	}
		
		}	
		
	function InsertallDir($arrayDatainsert){
		//return $arrayDatainsert;
		//exit;
		$this->getTimestamp();
		
		foreach($arrayDatainsert as $dataFila2){
			$query = "INSERT INTO
                    " . $this->table_name . "
                SET
Registro = ?, Tipo_Red = ?, Especialidad = ?, Subespecialidad = ?, imagen = ?, Tipo = ?, Empresa = ?, Nombre = ?, Sucursal = ?, Direccion = ?, Delegacion = ?, Estado = ?, Telefonos = ?, Mail = ?, Horarios_atencion = ?, Paginaweb = ?, Estudios = ?, Promocion_human = ?, Observaciones = ?, imgficha = ?, fecha_reg = ? ";			
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $dataFila2[0]);
		$stmt->bindParam(2, $dataFila2[1]);
		$stmt->bindParam(3, $dataFila2[2]);
		$stmt->bindParam(4, $dataFila2[3]);
		$stmt->bindParam(5, $dataFila2[4]);
		$stmt->bindParam(6, $dataFila2[5]);
		$stmt->bindParam(7, $dataFila2[6]);
		$stmt->bindParam(8, $dataFila2[7]);
		$stmt->bindParam(9, $dataFila2[8]);
		$stmt->bindParam(10, $dataFila2[9]);
		$stmt->bindParam(11, $dataFila2[10]);
		$stmt->bindParam(12, $dataFila2[11]);
		$stmt->bindParam(13, $dataFila2[12]);
		$stmt->bindParam(14, $dataFila2[13]);
		$stmt->bindParam(15, $dataFila2[14]);
		$stmt->bindParam(16, $dataFila2[15]);
		$stmt->bindParam(17, $dataFila2[16]);
		$stmt->bindParam(18, $dataFila2[17]);
		$stmt->bindParam(19, $dataFila2[18]);
		$stmt->bindParam(20, $dataFila2[19]);
						
		$stmt->bindParam(21, $this->timestamp);
		$stmt->execute();
			}
		return true;	
		
		}
		
	function iniTransaccion(){
		$query = "BEGIN;";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return true;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:ini_transaccion".$errorQuery[2];
        	}
		}
		
	function terminarTransaccion(){
		$query = "COMMIT;";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return true;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:end_transaccion".$errorQuery[2];
        	}
		}		
		
	function selectValTransaccion($fechaCunsulta){
		
		//return $fechaCunsulta;
		
		$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE fecha_reg LIKE '".$fechaCunsulta."%'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRIndividual".$errorQuery[2];
        	}
		
		
		}
		
	function selectValUpdate($fechaCunsulta2){
		
		//return $fechaCunsulta;
		
		$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE fecha_update LIKE '".$fechaCunsulta2."%'";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_DIRUPDATE".$errorQuery[2];
        	}
		
		
		}					
		
	function updateDirMedic($regMedicData){
		
		$this->getTimestamp();
		
		//$query1 = "UPDATE `".$this->table_name."` SET fecha_publicacion=?, fecha_caducidad=?, nombre_promo=?, fecha_act=? WHERE id_cp_pdf_promo=?;";
		$query1 = "UPDATE `".$this->table_name."` SET Registro=?, Tipo_Red=?, Especialidad=?, Subespecialidad=?, imagen=?, Tipo=?, Empresa=?, Nombre=?, Sucursal=?, Direccion=?, Delegacion=?, Estado=?, Telefonos=?, Mail=?, Horarios_atencion=?, Paginaweb=?, Estudios=?, Promocion_human=?, Observaciones=?, imgficha=?, id_especialidad=?, fecha_update=? WHERE No=?;";
		$stmt = $this->conn->prepare($query1);
		$stmt->bindParam(1, utf8_decode($regMedicData["Registro"]));
		$stmt->bindParam(2, utf8_decode($regMedicData["Tipo_Red"]));
		$stmt->bindParam(3, utf8_decode($regMedicData["Especialidad"]));
		$stmt->bindParam(4, utf8_decode($regMedicData["Subespecialidad"]));
		$stmt->bindParam(5, utf8_decode($regMedicData["imagen"]));
		$stmt->bindParam(6, utf8_decode($regMedicData["Tipo"]));
		$stmt->bindParam(7, utf8_decode($regMedicData["Empresa"]));
		$stmt->bindParam(8, utf8_decode($regMedicData["Nombre"]));
		$stmt->bindParam(9, utf8_decode($regMedicData["Sucursal"]));
		$stmt->bindParam(10, utf8_decode($regMedicData["Direccion"]));
		$stmt->bindParam(11, utf8_decode($regMedicData["Delegacion"]));
		$stmt->bindParam(12, utf8_decode($regMedicData["Estado"]));
		$stmt->bindParam(13, utf8_decode($regMedicData["Telefonos"]));
		$stmt->bindParam(14, utf8_decode($regMedicData["Mail"]));
		$stmt->bindParam(15, utf8_decode($regMedicData["Horarios_atencion"]));
		$stmt->bindParam(16, utf8_decode($regMedicData["Paginaweb"]));
		$stmt->bindParam(17, utf8_decode($regMedicData["Estudios"]));
		$stmt->bindParam(18, utf8_decode($regMedicData["Promocion_human"]));
		$stmt->bindParam(19, utf8_decode($regMedicData["Observaciones"]));
		$stmt->bindParam(20, utf8_decode($regMedicData["imgficha"]));
		$stmt->bindParam(21, $regMedicData["id_especialidad"]);
		$stmt->bindParam(22, $this->timestamp);
		$stmt->bindParam(23, $regMedicData["id_reg_update"]);
				
		if($stmt->execute()){
			return "Datos actualizados ".$this->timestamp;
        }else{
           $errorQuery=$stmt->errorInfo();
           return "Error:UPDATEDATA_REGMEDIC".$errorQuery[2];
        }
				
		}	
		
	function getArrayDirMedic($arrayIds){
				$query = "SELECT * FROM  `".$this->table_name."` 
				  WHERE No IN ({$arrayIds})";
			$stmt = $this->conn->prepare($query);		   
			if($stmt->execute()){
				return $stmt;
        	}else{
            	 $errorQuery=$stmt->errorInfo();
           return "Error:GETDATA_ARRAYids".$errorQuery[2];
        	}
		}
		
	function edoChangeRegistro($idregSelct,$edoChangeVal){
		$query8 = "UPDATE `".$this->table_name."` SET act_sup=? WHERE No=?;";
		$stmt = $this->conn->prepare($query8);
		$stmt->bindParam(1, $edoChangeVal);
		$stmt->bindParam(2, $idregSelct);
		if($stmt->execute()){
			return true;
        }else{
           $errorQuery=$stmt->errorInfo();
            return "Error:UPDATE_EDO_REG".$errorQuery[2];
        }
		}										
	
	function getTimestamp(){
    	date_default_timezone_set('Mexico/General');
    	$this->timestamp = date('Y-m-d H:i:s');
		}
		
}
?>