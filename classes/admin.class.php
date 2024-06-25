<?php
class Admin
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $status;
    private $role;
    private $dbConn;

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }

    public function setPassword($password) { $this->password = $password; }
    public function getPassword() { return $this->password; }

    public function setPhone($phone) { $this->phone = $phone; }
    public function getPhone() { return $this->phone; }

    public function setAddress($address) { $this->address = $address; }
    public function getAddress() { return $this->address; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function setRole($role) { $this->role = $role; }
    public function getRole() { return $this->role; }

    public function __construct()
    {
        require_once("../db/DbConnect.php");
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

   public function InsertAdmin()
    {
        $sql = "INSERT INTO admins (Username, Email, Password, status,Role) VALUES (:name, :email, :password,'Active', :role)";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        try{
            $stmt->execute();
            return "Success";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) { // Check if error is due to duplicate entry
               return 1062;
            } else {
                return "Error: " . $e->getMessage();
            }
            header("location: ../forms/admin.php");
            exit();
        }
    }

    public function RemoveAdmin()
    {
        $sql = "DELETE FROM admins WHERE ID = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function GetAdmins()
    {
        $sql = "SELECT * FROM admins";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $admins;
    }

    public function UpdateAdmin()
    {
        $sql = "UPDATE admins SET Username = :name, Email = :email, status = :status, Role=:role, Password =:password WHERE ID = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminPassword($adminID, $hashedPassword)
    {
        $sql = "UPDATE admins SET password = :Password WHERE id = :ID";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':Password', $hashedPassword);
        $stmt->bindParam(':ID', $adminID);
        return $stmt->execute();
    }
    public function getAdminById($id)
    {
        $sql = "SELECT * FROM admins WHERE ID = :ID";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin;
    }
}
?>
