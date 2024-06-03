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
    	$sql = "INSERT INTO `tblproduct` VALUES (NULL,:Name, :Description, :Category, now(), current_timestamp(), :Status, :Type, :Color, :Size, :Price, :Image);";
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
  }
?>