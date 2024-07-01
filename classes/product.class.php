<?php
  class product{
    private $id;
    private $productName;
    private $description;
    private $image;
    private $price;
    private	$type;
    private	$color;
    private	$size;
    private $status;
    private $createdOn;
    public $dConn;
    private	$cid;

    public function setId($id){$this->id = $id;}
    public function getId(){return $this->id;}

    public function setName($productName){$this->productName = $productName;}
    public function getName(){return $this->productName;}

    public function setDescription($description){$this->description = $description;}
    public function getDescription(){return $this->description;}

    public function setImage($image){$this->image = $image;}
    public function getImage(){return $this->image;}

    public function setPrice($price){$this->price = $price;}
    public function getPrice(){return $this->price;}

    public function setCreatedOn($createdOn){$this->createdOn = $createdOn;}
    public function getCreatedOn(){return $this->createdOn;}

    public function setCid($cid){$this->cid = $cid;}
    public function getCid(){return $this->cid;}

    public function setType($type){$this->type = $type;}
    public function getType(){return $this->type;}

    public function setColor($color){$this->color = $color;}
    public function getColor(){return $this->color;}

    public function setSize($size){$this->size = $size;}
    public function getSize(){return $this->size;}

    public function setStatus($status){$this->status = $status;}
    public function getStatus(){return $this->status;}

    public function __construct()
    {
      require_once('../db/DbConnect.php');
      $db = new DbConnect();
      $this->dConn = $db->connect();
    }

    public function getAllProducts()
    {
      $sql = "SELECT * FROM tblProduct";
      $stmt = $this->dConn->prepare($sql);
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    }

    public function getProductById()
    {
      $sql = "SELECT * FROM `tblproduct` WHERE ID= :pid";
      $stmt = $this->dConn->prepare($sql);
      $stmt->bindParam('pid', $this->id);
      $stmt->execute();
      $products = $stmt->fetch(PDO::FETCH_ASSOC);
      return $products;
    }



    public function InsertProduct()
    {
    	$sql = "INSERT INTO `tblproduct` VALUES (NULL,:Name, :Description, :Category, now(), current_timestamp(), :Status, :Type, :Color, :Size, :Price, :Image,0);";
	 	$stmt = $this->dConn->prepare($sql);
	 	$stmt->bindParam('Name', $this->productName);
	 	$stmt->bindParam('Description', $this->description);
	 	$stmt->bindParam('Category', $this->cid);
	 	$stmt->bindParam('Status', $this->status);
	 	$stmt->bindParam('Type', $this->type);
	 	$stmt->bindParam('Color', $this->color);
	 	$stmt->bindParam('Size', $this->size);
	 	$stmt->bindParam('Price', $this->price);	 	
	 	$stmt->bindParam('Image', $this->image);
	 	if($stmt->execute()){
	 		return "Success";
	 	}
	 	else{
	 		return "Failed";
	 	}
    }

    public function DeleteProduct()
    {
    	$sql = "DELETE FROM `tblproduct` WHERE `tblproduct`.`ID` = :id";
	 	$stmt = $this->dConn->prepare($sql);
	 	$stmt->bindParam('id', $this->id);
	 	
	 	if($stmt->execute()){
	 		return "Success";
	 	}
	 	else{
	 		return "Failed";
	 	}
    }
    public function updateProduct($productID, $name, $description, $categoryID, $type, $color, $size, $price, $status, $image)
    {
    	$sql = "UPDATE `tblproduct` SET 
    	`ProductName` = :Name, 
    	`Description` = :Description, 
    	`Category` = :Category, 
    	`Status` = :Status, 
    	`Type` = :Type, 
    	`Color` = :Color, 
    	`Size` = :Size, 
    	`Price` = :Price, 
    	`Image` = :Image 
    	WHERE `tblproduct`.`ID` = :id";
	 	$stmt = $this->dConn->prepare($sql);
	 	$stmt->bindParam('id', $productID);
	 	$stmt->bindParam('Name', $name);
	 	$stmt->bindParam('Description', $description);
	 	$stmt->bindParam('Category', $categoryID);
	 	$stmt->bindParam('Status', $status);
	 	$stmt->bindParam('Type', $type);
	 	$stmt->bindParam('Color', $color);
	 	$stmt->bindParam('Size', $size);
	 	$stmt->bindParam('Price', $price);	 	
	 	$stmt->bindParam('Image', $image);
	 	if($stmt->execute()){
	 		return "Success";
	 	}
	 	else{
	 		return "Failed";
	 	}
    }
    public function bestChartProduct(){
      $sql = "SELECT ProductName, SalesCount FROM tblProduct ORDER BY SalesCount DESC LIMIT 6";
      $stmt = $this->dConn->prepare($sql);
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    }
    public function CurrentYearAmount(){
      $sql = "SELECT 
        ROUND((current_year_sum / (current_year_sum + last_year_sum)) * 100,2) AS percentage, Current_year_amount
        FROM (
            SELECT 
                SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) THEN amount ELSE 0 END) AS current_year_sum,
                SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) - 1 THEN amount ELSE 0 END) AS last_year_sum,
              SUM(CASE WHEN YEAR(created_at) = YEAR(cURDATE()) THEN amount ELSE 0 END) AS Current_year_amount
            FROM transactions WHERE status = 'completed'
        ) AS totals;
        ";
      $stmt = $this->dConn->prepare($sql);
      $stmt->execute();
      $products = $stmt->fetch(PDO::FETCH_ASSOC);
      return $products;
    }
    public function CurrentMonthAmount(){
      $sql = "SELECT 
        ROUND((current_month_sum / (current_month_sum + last_month_sum)) * 100,2) AS percentage, Current_month_amount
        FROM (
            SELECT 
                SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) THEN amount ELSE 0 END) AS current_month_sum,
                SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) - 1 THEN amount ELSE 0 END) AS last_month_sum,
              SUM(CASE WHEN MONTH(created_at) = MONTH(cURDATE()) THEN amount ELSE 0 END) AS Current_month_amount
            FROM transactions WHERE status = 'completed'
        ) AS totals;
        ";
      $stmt = $this->dConn->prepare($sql);
      $stmt->execute();
      $products = $stmt->fetch(PDO::FETCH_ASSOC);
      return $products;
    }
    public function TransactionRecent(){
      $sql = "SELECT * FROM transactions  ORDER BY `transactions`.`id` DESC LIMIT 4 ";
      $stmt = $this->dConn->prepare($sql);
      $stmt->execute();
      $transaction = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $transaction;
    }
  }
?>