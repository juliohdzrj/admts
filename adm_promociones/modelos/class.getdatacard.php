<?php
class Listc
{
    private $table_name="regtarg";
    public $numberOrder;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getListCards(){
    	//return $this->numberOrder;
	    $query="SELECT * FROM ".$this->table_name." WHERE `ordern`='".$this->numberOrder."';";
	    try {
		    $stmt=$this->conn->prepare($query);
		    if($stmt->execute()){
			    return array("msg"=>"valdata","code"=>$stmt);
		    }else{
			    $errorQuery=$stmt->errorInfo();
			    throw new Exception('Error:list_number_card_'.$errorQuery[2],1);
		    }
	    }catch (Exception $e){
		    return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
	    }
    }



    /*function noRepeatNumberCard($numberCard){
    	$query="SELECT * FROM ".$this->table_name." WHERE `numimpresocard`='".$numberCard."';";
    	try {
		    $stmt=$this->conn->prepare($query);
		    if($stmt->execute()){
			    return array("msg"=>"valdata","code"=>$stmt);
		    }else{
			    $errorQuery=$stmt->errorInfo();
			    throw new Exception('Error:repeat_number_card_'.$errorQuery[2],111);
		    }
	    }catch (Exception $e){
		    return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
	    }
    }
    function insCardNumber(){
//return $this->nc."-".$this->ty."-".$this->da."-".$this->dv."-".$this->tk;
	    $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    numimpresocard = ?, typecard = ?, fecha_create = ?, vigencia = ?, tk = ?, ordern = ?";
	    try {
		    $stmt=$this->conn->prepare($query);
		    $stmt->bindParam(1, $this->nc);
		    $stmt->bindParam(2, $this->ty);
		    $stmt->bindParam(3, $this->da);
		    $stmt->bindParam(4, $this->dv);
		    $stmt->bindParam(5, $this->tk);
		    $stmt->bindParam(6, $this->od);
		    if($stmt->execute()){
			    $last_id = $this->conn->lastInsertId();
			    return array("msg"=>"valdata","code"=>$last_id);
		    }else{
			    $errorQuery=$stmt->errorInfo();
			    throw new Exception('Error:toregister_number_card_'.$errorQuery[2],222);
		    }
	    }catch (Exception $e){
		    return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
	    }
    }*/
}