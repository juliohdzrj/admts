<?php
class get_orders
{
    private $table_name ="mkwp_promociones";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getOrders(){
    	return "ok-orders";

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
}