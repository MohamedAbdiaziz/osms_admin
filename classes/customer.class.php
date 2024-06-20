<?php
class Customer
{
    private $id;
    private $name;
    private $email;
    private $username;
    private $password;
    private $phone;
    private $address;
    private $status;
    private $dbConn;

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }

    public function setUsername($username) { $this->username = $username; }
    public function getUsername() { return $this->username; }

    // public function setPassword($password) { $this->password = $password; }
    // public function getPassword() { return $this->password; }

    public function setPhone($phone) { $this->phone = $phone; }
    public function getPhone() { return $this->phone; }

    public function setAddress($address) { $this->address = $address; }
    public function getAddress() { return $this->address; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function __construct()
    {
        require_once("../db/DbConnect.php");
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    // public function InsertCustomer()
    // {
    //     $sql = "INSERT INTO tblcustomer (name, email, password, phone, address, status, created_date) VALUES (:name, :email, :password, :phone, :address, 'Active', now())";
    //     $stmt = $this->dbConn->prepare($sql);
    //     $stmt->bindParam(':name', $this->name);
    //     $stmt->bindParam(':email', $this->email);
    //     $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
    //     $stmt->bindParam(':phone', $this->phone);
    //     $stmt->bindParam(':address', $this->address);

    //     if ($stmt->execute()) {
    //         return "Success";
    //     } else {
    //         return "Failed";
    //     }
    // }

    public function RemoveCustomer()
    {
        $sql = "DELETE FROM tblcustomer WHERE Username = :username";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':username', $this->username);

        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function GetCustomers()
    {
        $sql = "SELECT * FROM tblcustomer";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $admins;
    }

    public function UpdateCustomer()
    {
        $sql = "UPDATE tblcustomer SET status = :status WHERE Username = :username";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        
        $stmt->bindParam(':status', $this->status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // public function UpdateCustomerPassword($newPassword)
    // {
    //     $sql = "UPDATE tblcustomer SET password = :password WHERE id = :id";
    //     $stmt = $this->dbConn->prepare($sql);
    //     $stmt->bindParam(':password', password_hash($newPassword, PASSWORD_BCRYPT));
    //     $stmt->bindParam(':id', $this->id);

    //     if ($stmt->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
?>
