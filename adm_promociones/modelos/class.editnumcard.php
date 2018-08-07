<?php
class NumCard
{
    private $table_name="regtarg";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getRegisterOrder($orderNum){
    	$query="SELECT * FROM ".$this->table_name." WHERE `ordern`='".$orderNum."';";
    	try {
		    $stmt=$this->conn->prepare($query);
		    if($stmt->execute()){
			    return array("msg"=>"valdata","code"=>$stmt);
		    }else{
			    $errorQuery=$stmt->errorInfo();
			    throw new Exception('Error:total_register_order_'.$errorQuery[2],111);
		    }
	    }catch (Exception $e){
		    return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
	    }
    }
}