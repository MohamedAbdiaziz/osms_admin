<?php
	/**
	 * 
	 */
	class product
	{
		private $id;
	    private $productName;
	    private $description;
	    private $image;
	    private $price;
	    private $createdOn;
		private $dbConn;
		
		function __construct(argument)
		{
			require_once("../db/DbConnect.php");
			$dbobj = new DbConnect();
			$this->dbConn=$dbobj->connect();
		}

		public function InsertProduct()
		 {
		 	$sql = "INSERT into tblProduct";
		 } 

	}


?>