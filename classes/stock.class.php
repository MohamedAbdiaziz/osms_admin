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
	    public function updateStock()
	    {

	    	try {
			    // Start the transaction
			    $this->dConn->beginTransaction();

			    // Execute the first update query
			    $stmt1 = $this->dConn->prepare("UPDATE tblstock SET Quantity = :quantity WHERE ID = :id");
			    $stmt1->bindParam('quantity',$this->quantity);
			    $stmt1->bindParam('id',$this->id);
			    $stmt1->execute();

			    // Execute the second update query
			    $stmt2 = $this->dConn->prepare("
			        UPDATE tblcartitem c
			        JOIN tblstock s ON s.Product = c.Product
			        JOIN tblproduct p ON p.ID = c.Product
			        SET c.Quantity = s.Quantity, c.Subtotal = s.Quantity * p.Price
			        WHERE c.Quantity > s.Quantity
			    ");
			    $stmt2->execute();

			    // Commit the transaction
			    $this->dConn->commit();
			    
			    return true;
			} catch (PDOException $e) {
			    // Rollback the transaction if an error occurred
			    $pdo->rollBack();
			    
			    return false;
			}
	    	// $sql = "UPDATE tblstock SET Quantity=:quantity where ID = :id";
	    	// $stmt = $this->dConn->prepare($sql);
	    	// $stmt->bindParam('quantity',$this->quantity);
	    	// $stmt->bindParam('id',$this->id);
	    	// if($stmt->execute()){
	 		// return "Success";
		 	// }
		 	// else{
		 	// 	return "Failed";
		 	// }
	    }
	    public function removeStock()
	    {
	    	$sql = "DELETE FROM tblstock where ID = :id";
	    	$stmt = $this->dConn->prepare($sql);
	    	
	    	$stmt->bindParam('id',$this->id);
	    	if($stmt->execute()){
	 		return "Success";
		 	}
		 	else{
		 		return "Failed";
		 	}
	    }
	}
		



?>