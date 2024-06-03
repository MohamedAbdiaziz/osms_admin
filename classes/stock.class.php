<?php
	/**
	 * 	
	 */
	class stock
	{
		private	$id;
		private $productid;
		private	$quantity;
		private	$status;
		private	$dConn;

		public function setId($id){$this->id=$id;}
		public function getId(){return $this->id;}

		public function setQuantity($quantity){$this->quantity=$quantity;}
		public function getQuantity(){return $this->quantity;}

		public function setProdId($productid){$this->productid=$productid;}
		public function getProdId(){return $this->productid;}

		public function setStatus($status){$this->status=$status;}
		public function getStatus(){return $this->status;}

		
		
		public function __construct()
		{
			require_once('../db/DbConnect.php');
  			$db = new DbConnect();
	    	$this->dConn = $db->connect();
		}

		public function getStocks() {
	        $sql = "SELECT s.ID,p.ID AS prodid, p.ProductName, c.Name, p.Status, s.Quantity, s.Status AS StockStatus FROM tblproduct p INNER JOIN tblstock s ON p.ID = s.Product INNER JOIN tblcategory c ON p.Category = c.ID WHERE p.Status = 'Active';";
	        $stmt = $this->dConn->prepare($sql);
	        $stmt->execute();
	        $stock = $stmt->fetchAll(PDO::FETCH_ASSOC);
	        
	        return $stock;
	    }
	}
		



?>