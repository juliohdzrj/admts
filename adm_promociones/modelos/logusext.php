<?php
class log_user
{
    private $table_name ="userext";
    private $timestamp;

    public $nombreUsuario="";
    public $contraseña="";
    public $email2="";
    public $nombres="";
    public $appellidos="";

    public $idreguser="";

    public function __construct($db)
    {
        $this->conn = $db;
    }


    function insertDataUser(){
        $this->getTimestamp();
        $query = "INSERT INTO
                    ".$this->table_name."
                SET
                    nombre_user = ?, csp = ?, diremail = ?, nombres = ?, apellidos = ?, fecha_create = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nombreUsuario);
        $stmt->bindParam(2, $this->contraseña);
        $stmt->bindParam(3, $this->email2);
        $stmt->bindParam(4, $this->nombres);
        $stmt->bindParam(5, $this->appellidos);
        $stmt->bindParam(6, $this->timestamp);
        if($stmt->execute()){
            $last_id = $this->conn->lastInsertId();
            return $last_id;
        }else{
            $errorQuery=$stmt->errorInfo();
            return $errorQuery[0];
        }
    }

    function getDatosUsuario($useremail,$userpass){
    	$query="SELECT nombre_user, diremail, link_img FROM ".$this->table_name." WHERE diremail='".$useremail."' AND csp='".$userpass."'";
	    //$resRow=$stmt->rowCount();
	    //$resRow2=$stmt->fetch(PDO::FETCH_ASSOC);
	    //$num_row=$datos_res->rowCount();
	    //$rowok=$stmt->fetch(PDO::FETCH_ASSOC);
	    //return utf8_encode($resRow2["nombre_user"]);
	    try {
		    $stmt=$this->conn->prepare($query);
		    if($stmt->execute()){
			    return array("msg"=>"valdata","code"=>$stmt);
		    }else{
			    $errorQuery=$stmt->errorInfo();
			    throw new Exception('Error:val_us_'.$errorQuery[2],111);
		    }
	    }catch (Exception $e){
		    return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
	    }
    }


	function verificarEmailTipo($useremail2){
		$query="SELECT tipol, id_userext, csp FROM ".$this->table_name." WHERE diremail='".$useremail2."';";
		$stmt = $this->conn->prepare($query);
		try {
		if($stmt->execute()){
			return array("msg"=>"TIPO REGISTRO","code"=>$stmt);
		}else{
			$errorQuery=$stmt->errorInfo();
			throw new Exception('Error:Verifica_reg_'.$errorQuery[2],11);
		}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}


		/*try {
			if ( $stmt->execute() ) {
				$last_id = $this->conn->lastInsertId();
				return array("msg"=>"Buscar tarjeta","code"=>$last_id);
			} else {
				$errorQueryInsert=$stmt->errorInfo();
				throw new Exception('Error:IN_LFBV_'.$errorQueryInsert[2],01);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}*/



	}


function updateRegistry(){
		$this->getTimestamp();
		$query2="UPDATE ".$this->table_name." SET csp='".$this->contraseña."', fecha_update=? WHERE id_userext=".$this->idreguser.";";
		$stmt = $this->conn->prepare($query2);
		$stmt->bindParam(1, $this->timestamp);

		try {
			if($stmt->execute()){
				throw new Exception('Registro Actualizado',12);
			}else{
				$errorQuery=$stmt->errorInfo();
				throw new Exception('Error:updateRegistry'.$errorQuery[2],13);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}

}


    function getTimestamp(){
        date_default_timezone_set('Mexico/General');
        $this->timestamp = date('Y-m-d H:i:s');
    }


}