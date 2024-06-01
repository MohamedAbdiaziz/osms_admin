<?php
	/**
	 * 
	 */
	class category
	{
		private $id;
	    private $name;
	    private $description;
	    private $image;
	    private $status;



	    public function setid($id){$this->id = $id;}
	    public function getid(){return $this->id;}

	    public function setname($name){$this->name = $name;}
	    public function getname(){return $this->name;}

	    public function setdescription($description){$this->description = $description;}
	    public function getdescription(){return $this->description;}

	    public function setimage($image){$this->image = $image;}
	    public function getimage(){return $this->image;}

	    public function setstatus($status){$this->status = $status;}
	    public function getstatus(){return $this->status;}
	    
	    
	    
	    
		
		public function __construct()
		{
			require_once("../db/DbConnect.php");
			$db = new DbConnect();
			$this->dbConn=$db->connect();
		}

		public function InsertCategory()
		{
		 	$sql = "INSERT INTO tblcategory(Name,Description,Status,Image,CreatedDate) values(:Name,:Description,'Active',:Image,now())";
		 	$stmt = $this->dbConn->prepare($sql);
		 	$stmt->bindParam('Name', $this->name);
		 	$stmt->bindParam('Description', $this->description);
		 	$stmt->bindParam('Name', $this->name);
		 	$stmt->bindParam('Image', $this->image);
		 	if($stmt->execute()){
		 		return "Success";
		 	}
		 	else{
		 		return "Failed";
		 	}

		} 

		public function RemoveCategory()
		{
		 	$sql = "DELETE FROM `tblcategory` WHERE `tblcategory`.`ID` = :id";
		 	$stmt = $this->dbConn->prepare($sql);
		 	$stmt->bindParam('id', $this->id);
		 	
		 	if($stmt->execute()){
		 		return "Success";
		 	}
		 	else{
		 		return "Failed";
		 	}

		} 

		public function GetCategies()
		{
			$sql = "SELECT * FROM tblcategory WHERE Status = 'Active'";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->execute();
			$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $categories;
		}



		// public function updateCategory($categoryId, $fields)
		// {
		// 	$set = [];
	    //     $params = [];
	    //     $types = '';

	    //     foreach ($fields as $field => $value) {
	    //         $set[] = "$field = ?";
	    //         $params[] = $value;
	    //         $types .= 's';
        // 	}

        // 	$params[] = $categoryId;
        // 	$types .= 'i';

        // 	$sql = "UPDATE tblcategory SET " . implode(", ", $set) . " WHERE ID = ?";
	    //     $stmt = $this->conn->prepare($sql);

	    //     if (!$stmt) {
	    //         return ["success" => false, "message" => "Preparation failed: " . $this->conn->error];
	    //     }

	    //     $stmt->bind_param($types, ...$params);

	    //     if ($stmt->execute()) {
	    //         return ["success" => true];
	    //     } else {
	    //         return ["success" => false, "message" => "Execution failed: " . $stmt->error];
	    //     }

		// }

		public function UpdateCategory()
		{
			$sql = "SET @p0='$this->id'; SET @p1='$this->name'; SET @p2='$this->description'; SET @p3='$this->status'; SET @p4='$this->image'; CALL `UpdateCategory`(@p0, @p1, @p2, @p3, @p4);";
		 	$stmt = $this->dbConn->prepare($sql);
		 	
		 	
		 	if($stmt->execute()){
		 		return true;
		 	}
		 	else{
		 		return false;
		 	}
		}

	}


?>