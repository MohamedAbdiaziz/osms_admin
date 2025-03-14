<?php
  class DbConnect{
    // session_start();
    private $host = "localhost";
    private $dbName = "db_osms";
    private $user = "root";
    private $pass = "";
    public  function  getDbName(){
      return $this->dbName;
    }
     public  function  getUser(){
      return $this->user;
    }
 public  function  getHost(){
      return $this->host;
    }public  function  getPassword(){
      return $this->pass;
    }




    public function connect(){
      try{
        
        $conn = new PDO('mysql:host='.$this->host . '; dbname='. $this->dbName, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
      } catch( PDOException $e){
        echo 'Database Error: '. $e->getMessage();
      }
    }

  }


?>