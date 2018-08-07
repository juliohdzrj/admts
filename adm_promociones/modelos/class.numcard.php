<?php
class get_orders
{
    private $table_name="mkwp_posts";
    private $table_name2="mkwp_woocommerce_order_items";
    private $table_name3="mkwp_woocommerce_order_itemmeta";
    private $table_name4="mkwp_postmeta";
    //private $table_name2="mkwp_posts";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getOrders(){
    	$query="SELECT DISTINCT ID FROM ".$this->table_name." WHERE post_type='shop_order';";
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
	function getStatusTypeOrder($numOrder){
		$query="SELECT ID, post_date, post_status, post_type FROM ".$this->table_name." WHERE post_type='shop_order' AND ID='".$numOrder."';";
		try {
			$stmt=$this->conn->prepare($query);
			if($stmt->execute()){
				return array("msg"=>"statusOrder","code"=>$stmt);
			}else{
				$errorQuery=$stmt->errorInfo();
				throw new Exception('Error:status_type_order_'.$errorQuery[2],112);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}
	}
	function getItemsOrder($numOrder2){
		$query="SELECT order_item_id, order_item_name, order_item_type FROM ".$this->table_name2." WHERE order_item_type='line_item' AND order_id='".$numOrder2."';";
		try {
			$stmt=$this->conn->prepare($query);
			if($stmt->execute()){
				return array("msg"=>"itemsOrder","code"=>$stmt);
			}else{
				$errorQuery=$stmt->errorInfo();
				throw new Exception('Error:items_order_'.$errorQuery[2],113);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}
	}
	function getDetailItem($numItem){
		$query="SELECT order_item_id, meta_key, meta_value FROM ".$this->table_name3." WHERE order_item_id='".$numItem."';";
		try {
			$stmt=$this->conn->prepare($query);
			if($stmt->execute()){
				return array("msg"=>"itemsDetail","code"=>$stmt);
			}else{
				$errorQuery=$stmt->errorInfo();
				throw new Exception('Error:items_detail_'.$errorQuery[2],114);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}
	}
	function getAddressOrder($numOrder3){
		$query="SELECT meta_key, meta_value FROM ".$this->table_name4." WHERE post_id='".$numOrder3."';";
		try {
			$stmt=$this->conn->prepare($query);
			if($stmt->execute()){
				return array("msg"=>"addressOrder","code"=>$stmt);
			}else{
				$errorQuery=$stmt->errorInfo();
				throw new Exception('Error:address_order_'.$errorQuery[2],115);
			}
		}catch (Exception $e){
			return array("msg"=>$e->getMessage(),"code"=>$e->getCode());
		}
	}
}